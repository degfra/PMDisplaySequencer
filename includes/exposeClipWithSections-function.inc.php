<?php

function exposeClipWithSections($firstClipId, $firstClipOrderNumber, 
                                $sequenceId, $singleClipSequence) {
    
    include 'db.inc.php';
    
    global  $clips;
            //$firstClipId;
            //$nextClipId;
    $firstClipId = $firstClipId;
    $firstClipOrderNumber = $firstClipOrderNumber;
    $sequenceId = $sequenceId;
    $singleClipSequence = $singleClipSequence;
    
    /*if ($firstClipId != NULL and $clipsequence != NULL) {
        $clipId = $firstClipId;
        //$nextClipId = $nextClipId;
    } else {
        $clipId = $_POST['clip_id'];
        $nextClipId = $_POST['nextClipId'];
    } 
    
    // Get the id of the sequence of the clip
    try {
        
        $sql = 'SELECT 
                sequenceclip.sequenceid,
                clip.id
                
                FROM clip
                JOIN sequenceclip ON clip.id = sequenceclip.inSequenceClipId
                WHERE clip.id = :clip_id';
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        
        $s->execute();
        
    } catch (PDOException $error) {
        $error = $error->getMessage(); //getTraceAsString(); //'Error removing joke from categories!'; // getMessage();
        include 'error.html.php';
        exit();
    }
        
        foreach ($s as $row) {
            $sequenceid = $row['sequenceid'];
        } */
    
        // Get the sections of the clip
    try {
        $sql = 'SELECT 
                clip.id, clip.clipname, clip.clipbackgroundcolor, clip.updated,
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypewidth, 
                cliplayout.id as cliplayout_id, cliplayout.cliplayoutcssref,
                sequenceclip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            JOIN sequenceclip ON clip.id = sequenceclip.inSequenceClipid
                            WHERE clip.id = :clip_id 
                              and sequenceclip.sequenceid = :sequence_id
                            
                            GROUP BY section.id';

        $s = $pdo->prepare($sql);
        
        // IN CASE OF A SEQUENCE WITH A SINGLE CLIP
        if ($singleClipSequence == 1) {
            $s->bindValue(':clip_id', $firstClipId);
            $s->bindValue(':sequence_id', $sequenceId);
        
        } else if ($_POST['singleClip'] == 1) {
            $s->bindValue(':clip_id', $_POST['clip_id']);
            $s->bindValue(':sequence_id', $_POST['sequence_id']);
        
        // IN CASE OF A SEQUENCE WITH MULTIPLE CLIPS : FOR THE FIRST CLIP
        } else if ($singleClipSequence == 0 and $firstClipOrderNumber == 1) {
            $s->bindValue(':clip_id', $firstClipId);
            $s->bindValue(':sequence_id', $sequenceId);
        
        } else if ($_POST['singleClip'] == 0 and $_POST['nextClipId'] > 0)  {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
            $s->bindValue(':sequence_id', $_POST['sequence_id']);
        
        // IN CASE OF A SEQUENCE WITH MULTIPLE CLIPS : FOR THE LAST CLIP
        } else if ($singleClipSequence == 0 and $_POST['nextClipId'] == 0) {
            $s->bindValue(':clip_id', $_POST['nextClipId']);
            $s->bindValue(':sequence_id', $_POST['sequence_id']);
        }        
            
        /*
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
            
        }*/
            
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage(); //getTraceAsString(); //'Error removing joke from categories!'; // getMessage();
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
        'cliplayout_id' => $row['cliplayout_id'],
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
