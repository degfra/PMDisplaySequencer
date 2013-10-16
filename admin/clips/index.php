<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

/* * ******** CREATE NEW CLIP ********** */

if (isset($_POST['action']) and $_POST['action'] == 'createClip') {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    try {
        
        $sql = 'INSERT into clip SET
                clipname = ":clipname"';
        
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
