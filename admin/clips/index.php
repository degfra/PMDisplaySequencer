<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

/* * ******** CREATE NEW CLIP ********** */

if (isset($_POST['action']) and $_POST['action'] == 'Add') {
//if (isset($_POST['clipname'])) {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    try {
        
        $sql = 'INSERT into clip SET
                clipname = :clipname';
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':clipname', $_POST['clipname']);
        $s->execute();
        
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!';
        include '../../includes/error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

    /********** PREVIEW CLIP ***********/

if (isset($_GET['action']) and $_GET['action'] == 'Preview')
{
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    /*
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
     */
    
    try 
    {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypecode,
                cliplayout.id, cliplayout.cliplayoutcssref,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
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
      
      if ($row['sectiontypename'] == 'codehead') {
            $codehead = $row['sectioncode'];
      }
        
        if ($row['sectiontypename'] == 'header') {
            $headercode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'left sidebar') {
            $leftbarcode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'main area') {
            $mainareacode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'right sidebar') {
            $rightbarcode = $row['sectioncode'];
      }
      else if ($row['sectiontypename'] == 'footer') {
            $footercode = $row['sectioncode'];
      }
      
      else if ($row['sectiontypename'] == 'codefoot') {
            $codefoot = $row['sectioncode'];
      }
      
    }
    
    $previewedclips[] = array(
        'id'    => $row['id'],
        'clipname'  => $row['clipname'],
        'cliplayoutcssref' => $row['cliplayoutcssref'],
        'clipDurationInSeconds' => $row['clipDurationInSeconds'],
        'clipOrderNumber' => $row['clipOrderNumber'],
        'nextClipUri' => $row['nextClipUri'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],
        
        'codehead' => $codehead,
        'headercode' => $headercode,
        'leftbarcode' => $leftbarcode,
        'mainareacode' => $mainareacode,
        'rightbarcode' => $rightbarcode,
        'footercode' => $footercode,
        'codefoot' => $codefoot
    );
    
    //include 'clippreview.html.php';
   include 'clippreview_styled.html.php';
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
