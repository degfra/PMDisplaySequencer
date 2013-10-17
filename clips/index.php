<?php

include_once '../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

    /********** PREVIEW CLIP ***********/

if (isset($_GET['action']) and $_GET['action'] == 'Preview')
{
    include '../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    try 
    {
       $sql = 'SELECT header.headercode, 
           leftbar.leftbarcode, mainarea.mainareacode, rightbar.rightbarcode,
           footer.footercode,
           clip.*
                            FROM clip
                            JOIN header ON clip.id = header.clipid
                            JOIN leftbar ON clip.id = leftbar.clipid
                            JOIN mainarea ON clip.id = mainarea.clipid
                            JOIN rightbar ON clip.id = rightbar.clipid
                            JOIN footer ON clip.id = footer.clipid
                            WHERE clip.id = :clip_id';
       
       $s = $pdo->prepare($sql);
       $s->bindValue(':clip_id', $_GET['clip_id']);
       $s->execute();
    }
    catch (PDOException $error)
    {
       $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
       include '../error.html.php';
       exit(); 
    }
    
    foreach ($s as $row)
    {
        $previewedclips[] = array(    
        'id'    => $row['id'],
        'clipname'  => $row['clipname'],

        'html_code_header' => $row['html_code_header'], 
        'clipdate' => $row['clipdate'],
        'headercode' => $row['headercode'],
        'leftbarcode' => $row['leftbarcode'],
        'mainareacode' => $row['mainareacode'],
        'rightbarcode' => $row['rightbarcode'],    
        'footercode' => $row['footercode'],
        'html_code_footer' => $row['html_code_footer']
                
      );
    }
    
    include 'clippreview2.html.php';
    exit();
    
}
    

/**************** DISPLAY CLIPS LIST *****************/

include '../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

try 
{
    $result = $pdo->query('SELECT * FROM clip');
}
catch (PDOException $error)
{
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../includes/error.html.php';
    exit();
}

while ($row = $result->fetch())
{
    $clips[] = array(    
        'id'    => $row['id'],
        'clipname'  => $row['clipname'],
        'clipdate' => $row['clipdate'] //,
      ); 
    
}

include 'cliplist.html.php';
exit();


?>
