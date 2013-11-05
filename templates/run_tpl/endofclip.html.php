<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="../../css/base.css">
    </head>
    <body>
        <!--<?php foreach ($clips as $clip): ?>-->
        
        <h4>End of the clip : </h4>
        <?php echo htmlout($_GET['clipname']) ?> .
        
        <!--<?php endforeach; ?>-->
        
        <input type="button" value="Close this preview" onclick="javascript: window.close()"/>
        
    </body>
</html>
