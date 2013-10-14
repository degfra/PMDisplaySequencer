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
        /*
       $sql = 'SELECT header.headercode, footer.footercode, clip.*
                            FROM header, footer LEFT JOIN clip
                            ON clipid = clip.id
                            WHERE clip.id = :clipid
                            GROUP BY clip.id';
       */
       $sql = 'SELECT header.headercode, footer.footercode, mainarea.mainareacode, clip.*
                            FROM clip
                            JOIN header ON clip.id = header.clipid
                            JOIN footer ON clip.id = footer.clipid
                            JOIN mainarea ON clip.id = mainarea.clipid
                            WHERE clip.id = :clip_id';
       
       $s = $pdo->prepare($sql);
       $s->bindValue(':clip_id', $_GET['clip_id']);
       $s->execute();
    }
    catch (PDOException $error)
    {
       $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
       include 'error.html.php';
       exit(); 
    }
    
    foreach ($s as $row)
    {
        $previewedclips[] = array(    
        'id'    => $row['id'],
        'clipname'  => $row['clipname'],
        //'clipcode'  => $row['clipcode'],
        'clipdate' => $row['clipdate'],
        'headercode' => $row['headercode'],
        'footercode' => $row['footercode'],
        'mainareacode' => $row['mainareacode']
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
    /*
    $result = $pdo->query('SELECT header.headercode, footer.footercode, clip.*
                            FROM header, footer LEFT JOIN clip
                            ON clipid = clip.id
                            GROUP BY clip.id');
     
     $result = $pdo->query('SELECT header.headercode, footer.footercode, clip.*
                            FROM clip
                            JOIN header ON clip.id = header.clipid
                            JOIN footer ON clip.id = footer.clipid');
     */
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
        //'clipcode'  => $row['clipcode'],
        'clipdate' => $row['clipdate'] //,
        //'headercode' => $row['headercode'],
        //'footercode' => $row['footercode']
      ); 
    
}

include 'cliplist.html.php';
exit();


?>
