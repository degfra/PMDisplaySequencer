<?php

/**************** DISPLAY TEMPLATES LIST *****************/

include '../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

try 
{
    $result = $pdo->query('SELECT * FROM template');
}
catch (PDOException $error)
{
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../includes/error.html.php';
    exit();
}

while ($row = $result->fetch())
{
    $templates[] = array(    
        'id'    => $row['id'],
        'templatename'  => $row['templatename'],
        'templatedate' => $row['templatedate']
      ); 
    
}

include 'templatelist.html.php';
exit();

?>
