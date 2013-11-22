<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';
include_once '../../includes/exposeClipWithSections-function.inc.php';
include_once '../../includes/displayNextClip-function.inc.php';

/* * ************** PREVIEW A SEQUENCE **************** */
include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

if (isset($_POST['action']) and ($_POST['action'] == 'Preview')) {
   
  /*if(isset($_POST['clip_id'])) {
      
    exposeClipWithSections();
      
  } else { */
    
    try {

      $sql = 'SELECT
              clip.id as clipId, clip.nextClipId,
              sequence.id as sequenceId

              FROM sequence
              JOIN clipsequence ON sequence.id = clipsequence.sequenceid
              JOIN clip ON clip.id = clipsequence.clipid
              WHERE sequence.id =:sequence_id';

      $s = $pdo->prepare($sql);
      $s->bindValue(':sequence_id', $_POST['sequence_id']);
      $s->execute();

    } catch (PDOException $error) {
      $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
      include '../../includes/error.html.php';
      exit();
    }

    foreach ($s as $row) {

      $sequenceclips[] = array(
      'clip_id' => $row['clipId'],
      'nextClipId' => $row['nextClipId']
      );

    } 

    $firstClipId = $sequenceclips[0]['clip_id'];

    exposeClipWithSections($firstClipId);
    
    include '../../templates/preview_tpl/clippreview_styled.html.php';
    exit();

  
} else if (isset($_GET['Next_Clip'])) {
    
     if ($_POST['nextClipId'] == 0) {        // $_POST['singleClip'] || 
    
        $clips[] = array(
            'clipid' => $_POST['clip_id'],
            'cliplayoutcssref' => $_POST['cliplayoutcssref'],
            'clipname' => $_POST['clipname'],
            'clipDurationInSeconds' => $_POST['clipDuration'],
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
                
        exposeClipWithSections();
        
        include '../../templates/preview_tpl/clippreview_styled.html.php';
        exit();
    } 
    
    //displayNextClip();
    
}
  
 
/* * ************** DISPLAY SEQUENCES LIST **************** */

include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';


// GET AN ARRAY OF ALL SEQUENCES

try {
    $result = $pdo->query('SELECT * FROM sequence');
    
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
                    clip.id as clipId, clip.clipname, clip.nextClipId, 
                    sequence.id as sequenceId

                        FROM sequence
                        JOIN clipsequence ON sequence.id = clipsequence.sequenceid
                        JOIN clip ON clip.id = clipsequence.clipid
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
            'nextClipId' => $sequenceclip['nextClipId']
        );
    }
    
    $sequenceclips[$i] = $clips;
    
}

include 'sequencelist.html.php';
exit();
?>
