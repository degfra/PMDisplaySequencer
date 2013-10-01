<?php

try 
{
    $pdo = new PDO('mysql:host=localhost;dbname=pmdisplayseqdb', 'pmdisplseqdbuser', 'degfra');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    
}
catch (PDOException $error)
{
    if (!$pdo)
    {
        $error = 'Unable to connect to the database server.'; // . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    else if (!$pdo->exec('SET NAMES "utf8"'))
    {
        $error = 'Unable to set database connection encoding..'; // . $e->getMessage();
        include 'error.html.php';
        exit(); 
    }
}

//include 'output.html.php';

?>
