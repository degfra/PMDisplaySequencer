<?php

function exposeClipWithSections($firstClipId) {
    
    include 'db.inc.php';
    
    global  //$s,
            $clips;
            //$firstClipId;
            //$nextClipId;
    
    if ($firstClipId != NULL) {
        $clipId = $firstClipId;
        //$nextClipId = $nextClipId;
    } /*else {
        $clipId = $_POST['clip_id'];
        $nextClipId = $_POST['nextClipId'];
    } */
    
    try {
        $sql = 'SELECT 
                clip.id, clip.clipname, clip.clipbackgroundcolor, clip.updated, clip.isLoop,
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypewidth, 
                cliplayout.id, cliplayout.cliplayoutcssref,
                sequenceclip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            JOIN sequenceclip ON clip.id = sequenceclip.inSequenceClipid
                            WHERE clip.id = :clip_id and sequenceclip.singleClipSequence = :single_clip
                            
                            GROUP BY section.id'
        ;

        $s = $pdo->prepare($sql);
        if (isset($_POST['nextClipId']) and $_POST['nextClipId'] == 0) {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
            $s->bindValue(':single_clip', 0);
        } else if (isset($_POST['nextClipId']) and $_POST['nextClipId'] > 0) {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
            $s->bindValue(':single_clip', 0);
        } else if (isset($_POST['clip_id'])) { // } else if (isset($_POST['clip_id'])) {   // $nextClipId) and $nextClipId == 0)
            $s->bindValue(':clip_id', $_POST['clip_id']); // $_POST['clip_id'] // $clipId
            $s->bindValue(':single_clip', 1);
        } else if (!isset($_POST['clip_id'])) {
            $s->bindValue(':clip_id', $clipId);
            $s->bindValue(':single_clip', $_POST['singleClip']);
            
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
        'id' => $row['inSequenceClipId'],
        'clipname' => $row['clipname'],
        'cliplayoutcssref' => $row['cliplayoutcssref'],
        'clipDurationInSeconds' => $row['inSequenceClipDurationInSeconds'],
        'clipOrderNumber' => $row['inSequenceClipOrderNumber'],
        'nextClipId' => $row['inSequenceNextClipId'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],
        'isLoop' => $row['isLoop'],
        'singleClip' => $row['singleClipSequence'],
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
