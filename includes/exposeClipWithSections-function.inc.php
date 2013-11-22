<?php

function exposeClipWithSections($firstClipId) {
    
    include 'db.inc.php';
    
    global  //$s,
            $clips;
            //$firstClipId;
            //$nextClipId;
    
    if ($firstClipId != NULL) {
        $clipId = $firstClipId;
        $nextClipId = $nextClipId;
    } /*else {
        $clipId = $_POST['clip_id'];
        $nextClipId = $_POST['nextClipId'];
    } */
    
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
        if (isset($_POST['nextClipId']) and $_POST['nextClipId'] == 0) {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
        } else if (isset($_POST['nextClipId']) and $_POST['nextClipId'] > 0) {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
        } else if (isset($_POST['clip_id'])) { // } else if (isset($_POST['clip_id'])) {   // $nextClipId) and $nextClipId == 0)
            $s->bindValue(':clip_id', $_POST['clip_id']); // $_POST['clip_id'] // $clipId
        } else if (!isset($_POST['clip_id'])) {
            $s->bindValue(':clip_id', $clipId);
        }
            
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getTraceAsString(); //getTraceAsString(); //'Error removing joke from categories!'; // getMessage();
        include 'error.html.php';
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
        'nextClipId' => $row['nextClipId'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],
        'isLoop' => $row['isLoop'],
        'singleClip' => $row['singleClip'],
        'updated' => $row['updated'],

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
}

?>
