<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';
include_once '../../includes/exposeClipWithSections-function.inc.php';

/* * ************** PREVIEW A SEQUENCE **************** */
//include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
/*
  try {

  $sql = 'SELECT
  clip.id as clipId, clip.clipname, clip.nextClipId,
  sequence.*

  FROM sequence
  JOIN clipsequence ON sequence.id = clipsequence.sequenceid
  JOIN clip ON clip.id = clipsequence.clipid
  WHERE sequence.id =:sequence_id';

  $s = $pdo->prepare($sql);
  $s->bindValue(':sequence_id', $_POST['id']);
  $s->execute();
  } catch (PDOException $error) {
  $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
  include '../../includes/error.html.php';
  exit();
  }

  foreach ($s as $row) {

  $clips[] = array(
  'clip_id' => $row['clipId'],
  'clipname' => $row['clipname'],
  'nextClipId' => $row['nextClipId']
  );
  }
 */
/* * ************** DISPLAY SEQUENCES LIST **************** */

include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

/*
  try {
  $result = $pdo->query('SELECT id, clipname FROM clip');
  } catch (PDOException $error) {
  $error = 'Error fetching clip layouts from database!';
  include '../../includes/error.html.php';
  exit();
  }

  foreach ($result as $row) {
  $cliplayouts[] = array(
  'id' => $row['id'],
  'cliplayoutname' => $row['cliplayoutname']
  );
  }
 */

/* try {
  $result = $pdo->query('SELECT * FROM sequence');
  } catch (PDOException $error) {
  $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
  include '../../includes/error.html.php';
  exit();
  }

  //while ($row = $result->fetch()) {
  foreach ($result as $row) {

  $sequence = $row;

  $sequences[] = array(
  'sequenceId' => $row['id'],
  'sequencename' => $row['sequencename'],
  'sequencedate' => $row['sequencedate'],
  'sequenceDurationInSeconds' => $row['sequenceDurationInSeconds'],
  'isLoop' => $row['isLoop']
  );
 */


//foreach ($sequences as $sequence) {

// GET AN ARRAY OF ALL THE CLIPS BELONGING TO A SEQUENCE

try {

    $sql = 'SELECT 
                clip.id as clipId, clip.clipname, clip.nextClipId, 
                sequence.id as sequenceId

                    FROM sequence
                    JOIN clipsequence ON sequence.id = clipsequence.sequenceid
                    JOIN clip ON clip.id = clipsequence.clipid
                    ';       //  WHERE sequence.id =:sequence_id

    $s = $pdo->prepare($sql);
    $s->bindValue(':sequence_id', $row['id']);
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

// GET AN ARAY OF ALL SEQUENCES
try {
    $result = $pdo->query('SELECT * FROM sequence');

} catch (PDOException $error) {
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../../includes/error.html.php';
    exit();
}


foreach ($result as $row) {

    //$sequence = $row;

    $sequences[] = array(
        'sequenceId' => $row['id'],
        'sequencename' => $row['sequencename'],
        'sequencedate' => $row['sequencedate'],
        'sequenceDurationInSeconds' => $row['sequenceDurationInSeconds'],
        'isLoop' => $row['isLoop']
    );                                  // , 'clips' => $clips


// BUILD THE ARRAY OF CLIPS BELONGING TO EACH TO A SEQUENCE

    $sequenceclips[] = array();

    //for ($i = 1 ; $i = count($sequences) ; $i++) {
    foreach ($clips as $clip) {

        if ($clip['sequence_id'] == $row['id']) {

            $clipsOfSequence[] = array();
            array_push($clipsOfSequence, $clip);

        }

        array_push($sequenceclips, $clipsOfSequence);

    }

}

include 'sequencelist.html.php';
exit();
?>
