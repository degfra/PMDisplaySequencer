<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

    /********** PREVIEW CLIP ***********/

if (isset($_GET['action']) and $_GET['action'] == 'Preview')
{
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    try {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypewidth, sectiontype.sectiontypename, sectiontype.sectiontypecode,
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
       include '../../includes/error.html.php';
       exit(); 
    }
    
    
    foreach ($s as $row) {

        if ($row['sectiontypename'] == 'Header') {
            $headername = $row['sectiontypename'];
            $headercode = $row['sectioncode'];
            $headerwidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Left sidebar') {
            $leftbarname = $row['sectiontypename'];
            $leftbarcode = $row['sectioncode'];
            $leftbarwidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Main area') {
            $mainareaname = $row['sectiontypename'];
            $mainareacode = $row['sectioncode'];
            $mainareawidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Main area 1 sidebar') {
            $mainareaname = $row['sectiontypename'];
            $mainareacode = $row['sectioncode'];
            $mainareawidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Main area 2 sidebars') {
            $mainareaname = $row['sectiontypename'];
            $mainareacode = $row['sectioncode'];
            $mainareawidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Right sidebar') {
            $rightbarname = $row['sectiontypename'];
            $rightbarcode = $row['sectioncode'];
            $rightbarwidth = $row['sectiontypewidth'];
        } else if ($row['sectiontypename'] == 'Footer') {
            $footername = $row['sectiontypename'];
            $footercode = $row['sectioncode'];
            $footerwidth = $row['sectiontypewidth'];
            
        }
        
    }
    
    $clips[] = array(
        'id' => $row['id'],
        'clipname' => $row['clipname'],
        'cliplayoutcssref' => $row['cliplayoutcssref'],
        'clipDurationInSeconds' => $row['clipDurationInSeconds'],
        'clipOrderNumber' => $row['clipOrderNumber'],
        'nextClipUri' => $row['nextClipUri'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],

        'headername' => $headername,
        'headercode' => $headercode,
        'headerwidth' => $headerwidth,
        
        'leftbarname' => $leftbarname,
        'leftbarcode' => $leftbarcode,
        'leftbarwidth' =>$leftbarwidth,
        
        'mainareaname' => $mainareaname,
        'mainareacode' => $mainareacode,
        'mainareawidth' => $mainareawidth,
        
        'rightbarname' => $rightbarname,
        'rightbarcode' => $rightbarcode,
        'rightbarwidth' => $rightbarwidth,
        
        'footername' => $footername,
        'footercode' => $footercode,
        'footerwidth' => $footerwidth    
        
    );
    
    include '../../templates/preview_tpl/clippreview_styled.html.php';
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
