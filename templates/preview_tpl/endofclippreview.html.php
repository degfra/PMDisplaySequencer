<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>End of Clip Preview</title>
        <link rel="stylesheet" href="../../css/base.css">
        <?php echo $_POST['cliplayoutcssref']; ?>
    </head>
    <body>
        <div
                <p><h5>
                    The <?php echo $_POST['clipDuration']?> 
                    seconds preview of '<?php echo $_POST['clipname'] ?>' 
                    has come to an end.<br>
                    There isn't any 'Next Clip' since this clip is not part 
                    of any sequence yet.
                    </h5></p>

                <p><input type="button" value="Return to Clips Management" 
                            onClick="javascript: location='../clips/'"/></p>
        </div>
    </body>
</html>