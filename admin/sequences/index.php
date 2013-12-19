<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';
include_once '../../includes/exposeClipWithSections-function.inc.php';

/* * ************** CREATE A SEQUENCE **************** */
include '../../includes/db.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

if (isset($_POST['action']) and ($_POST['action'] == 'Create')) {
    
    // SAVE THE CONFIGURABLE SEQUENCE ATTRIBUTES
    
    
    // CREATE A DEFAULT CLIP FOR THIS SEQUENCE
    
    
    //// Save the configurables clip attributes
    
    //// Create the sequenceclip entry for this sequence & this clip
       
    //// Fetch the type of clip layout
    
    //// build the list of section types
    
    //// create the related sections for this clip
    
    
    // ADD THE NEW SEQUENCE TO THE SEQUENCELIST
    
}


/* * ************** PREVIEW A SEQUENCE **************** */
//include '../../includes/db.inc.php';
include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

if (isset($_POST['action']) and ($_POST['action'] == 'Preview') || $_POST['action'] == 'Quickpreview') {
    
    // GET THE FIRST CLIP IN THE SEQUENCE AND REQUIRED SEQUENCE ATTRIBUTES
    if ($_POST['action'] == 'Preview') {
    
    try {  
      $sql = 'SELECT
              clip.id, clip.clipname,
              sequence.id as sequenceId,
              sequenceclip.inSequenceClipid, sequenceclip.sequenceid,
              sequenceclip.inSequenceNextClipId, sequenceclip.inSequenceClipOrderNumber,
              sequenceclip.singleClipSequence

              FROM sequence
              JOIN sequenceclip ON sequence.id = sequenceclip.sequenceid
              JOIN clip ON clip.id = sequenceclip.inSequenceClipid
              WHERE sequence.id =:sequence_id';

      $s = $pdo->prepare($sql);
      $s->bindValue(':sequence_id', $_POST['sequence_id']);
      $s->execute();

    } catch (PDOException $error) {
      $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
      include '../../includes/error.html.php';
      exit();
    }
    
    } else if ($_POST['action'] == 'Quickpreview') {
        
        try {  
          $sql = 'SELECT
                  clip.id, clip.clipname,
                  sequence.id as sequenceId,
                  sequenceclip.inSequenceClipid, sequenceclip.sequenceid,
                  sequenceclip.inSequenceNextClipId, sequenceclip.inSequenceClipOrderNumber,
                  sequenceclip.singleClipSequence

                  FROM sequence
                  JOIN sequenceclip ON sequence.id = sequenceclip.sequenceid
                  JOIN clip ON clip.id = sequenceclip.inSequenceClipid
                  WHERE sequenceclip.inSequenceClipid = :clip_id
                  AND sequenceclip.singleClipSequence = :single_clip';

          $s = $pdo->prepare($sql);
          $s->bindValue(':clip_id', $_POST['clip_id']);
          $s->bindValue(':single_clip', 1);
          $s->execute();

        } catch (PDOException $error) {
          $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
          include '../../includes/error.html.php';
          exit();
        }
    
    } 

    foreach ($s as $row) {
          $sequenceclips[] = array(
          'clip_id' => $row['inSequenceClipid'],
          'nextClipId' => 0,
          'clipOrderNumber' => $row['inSequenceClipOrderNumber'],
          'singleClipSequence' => 1,
          'sequence_id' => $row['sequenceId']
          );
    }

    $firstClipId = $sequenceclips[0]['clip_id']; 
    $firstClipOrderNumber = $sequenceclips[0]['clipOrderNumber'];
    $singleClipSequence = $sequenceclips[0]['singleClipSequence'];
    $sequenceId = $sequenceclips[0]['sequence_id'];
    
    //global $sequenceId, $singleClipSequence;

    exposeClipWithSections($firstClipId, $firstClipOrderNumber, 
                           $sequenceId, $singleClipSequence);
    
    include '../../templates/preview_tpl/clippreview_styled.html.php';
    exit();


    /* * ************** DISPLAY THE NEXT CLIP IN A SEQUENCE **************** */
} else if (isset($_GET['Next_Clip'])) {
    
     if ($_POST['singleClip'] == 1) {        // ($_POST['singleClip'] == 1) || // ($_POST['nextClipId'] == 0)
    
        $clips[] = array(
            'clipid' => $_POST['clip_id'],
            'cliplayoutcssref' => $_POST['cliplayoutcssref'],
            'clipname' => $_POST['clipname'],
            'clipDurationInSeconds' => $_POST['clipDuration'],
            'singleClip' => $_POST['singleClip'],
        );
        
        if ($_POST['updated']) { 
            include '../../templates/preview_tpl/endofeditpreview.html.php';
            exit();
        } 
        else {
            include '../../templates/preview_tpl/endofclippreview.html.php';
            exit();
        }
  
    } else {
        
        if ($_POST['nextClipId'] == 0) {
            
            include '../../templates/preview_tpl/endofclippreview.html.php';
            exit();
            
        } else {
            
            $firstClipId = 0;
            $firstClipOrderNumber = 0;
            $sequenceId = 0;
            $singleClipSequence = 0;
                
            exposeClipWithSections($firstClipId, $firstClipOrderNumber, 
                                $sequenceId, $singleClipSequence);

            include '../../templates/preview_tpl/clippreview_styled.html.php';
            exit();
            
        }
    } 
    
    //displayNextClip();
    
}


/* * ************** EDIT A SEQUENCE **************** */

// FETCH SEQUENCE ATTRIBUTES


// FETCH DEFAULT CLIP ATTRIBUTES AND ITS SECTIONS


// FETCH LIST OF AVAILABLE CLIPS


// DISPLAY THE sequenceeditform.html.php


/* * ************** UPDATE A SEQUENCE **************** */

// SET THE SEQUENCE ATTRIBUTES IN sequence table

// ADD NEW CLIP(S) IN sequenceclip table

// UPDATE THE CLIP ORDER NUMBER FOR ALL CLIPS IN THE SEQUENCE

    //according to the $_POST[array of order numbers]
  
 
/* * ************** DISPLAY SEQUENCES LIST **************** */

include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';


// GET AN ARRAY OF ALL SEQUENCES

try {
    $result = $pdo->query(
            'SELECT * 
             FROM sequence
             JOIN sequenceclip ON sequence.id = sequenceclip.sequenceid
             WHERE sequenceclip.singleClipSequence = 0
             GROUP BY sequence.id');    // WHERE sequenceclip.singleClipSequence = 0
    
} catch (PDOException $error) {
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../../includes/error.html.php';
    exit();
}


foreach ($result as $row) {
    
    $sequences[] = array(
        sequenceId => $row['id'],
        sequencename => $row['sequencename'],
        sequencedate => $row['sequencedate'],
        sequenceDurationInSeconds => $row['sequenceDurationInSeconds'],
        isLoop => $row['isLoop']
    );
}
// BUILD THE ARRAY OF CLIPS BELONGING TO EACH SEQUENCE

for ($i = 0; $i < count($sequences); $i++) {
    
    if ($clips != NULL) {
        unset($clips);
        $clips = array();
    }

    try {

        $sql = 'SELECT 
                    clip.id as clipId, clip.clipname, 
                    sequence.id as sequenceId,
                    sequenceclip.singleClipSequence,
                    sequenceclip.InSequenceNextClipId

                        FROM sequence
                        JOIN sequenceclip ON sequence.id = sequenceclip.sequenceid
                        JOIN clip ON clip.id = sequenceclip.inSequenceClipid
                        WHERE sequence.id =:sequence_id';

        $s = $pdo->prepare($sql);
        //$s->bindValue(':sequence_id', $sequence[sequenceId]);
        $s->bindValue(':sequence_id', $sequences[$i][sequenceId]);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    foreach ($s as $sequenceclip) {
        
        $clips[] = array(
            'sequence_id' => $sequenceclip['sequenceId'],
            'clip_id' => $sequenceclip['clipId'],
            'clipname' => $sequenceclip['clipname'],
            'nextClipId' => $sequenceclip['InSequenceNextClipId'],
            'singleClip' => $sequenceclip['singleClipSequence']
        );
    }
    
    $sequenceclips[$i] = $clips;
    
}

include 'sequencelist.html.php';
exit();
?>
