<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

    /********** PREVIEW CLIP ***********/

if (isset($_GET['action']) and $_GET['action'] == 'Preview')
{
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    try 
    {
        $sql = 'SELECT 
                section.sectioncode, sectiontype.sectiontypename, sectiontype.id,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            WHERE clip.id = :clip_id'
                            ;
       
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
      
      if ($row['sectiontypename'] == 'Header') {
            $headercode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'Left sidebar') {
            $leftbarcode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'Main area') {
            $mainareacode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'Right sidebar') {
            $rightbarcode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'Footer') {
            $footercode = $row['sectioncode'];
      }
      
    }
    
    $clips[] = array(    
        'id'    => $row['id'],
        'clipname'  => $row['clipname'],
        'headercode' => $headercode,
        'leftbarcode' => $leftbarcode,
        'mainareacode' => $mainareacode,
        'rightbarcode' => $rightbarcode,
        'footercode' => $footercode
    );
    
    include 'clippreview.html.php';
    exit();
    
}
    

/**************** DISPLAY CLIPS LIST *****************/

include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

try 
{
    $result = $pdo->query('SELECT * FROM clip');
}
catch (PDOException $error)
{
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../../includes/error.html.php';
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
