<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="../../css/base.css">
        <?php echo $_POST['cliplayoutcssref']; ?>
    </head>
    <body>
        <div>
            <form name="clipSaveForm" action="saveClip" method="post"> 
                <p><h5>
                    The <?php echo $_POST['clipDuration']?> 
                    seconds preview of '<?php echo $_POST['clipname'] ?>' 
                    has been stopped.<br>
                    There isn't any 'Next Clip' since this clip is not part of any sequence yet.
                    </h5></p>
            
                <label for='clipname'>Is the Clip name OK ? You can still change it here :</label>
                <input type='text' name='clipname' value="<?php echo $_POST['clipname']; ?>"/>

                <input type="submit" value="Save the Clip name"/>

               <p> <input type="button" value="Return to Editor without changing the Clip name" onclick="javascript: window.close()"/></p>

            </form>
        </div>
    </body>
</html>
