<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>End of Clip Editing Preview</title>
        <link rel="stylesheet" href="../../css/base.css">
         <script type="text/javascript">
            
            function returnToEditor() {
                
                //window.location.assign("?clip_id=<?php echo $_POST['clip_id']; ?>&action=Edit");
                history.back();
                history.back();

            }

        </script>
        <?php echo $_POST['cliplayoutcssref']; ?>
    </head>
    <body>
        <div>
            <form name="clipSaveForm" action="?saveClip" method="post"> 
                <p><h5>
                    The <?php echo $_POST['clipDuration']?> 
                    seconds preview of '<?php echo $_POST['clipname'] ?>' 
                    has been stopped.<br>
                    There isn't any 'Next Clip' since this clip is not part of any sequence yet.
                    </h5></p>
            
                <label for='clipname'>Is the Clip name OK ? You can still change it here :</label>
                <input type='text' name='clipname' value="<?php echo $_POST['clipname']; ?>"/>
                <input type="hidden" id="clip_id" name="clip_id" value="<?php echo $_POST['clip_id']; ?>" />
                <input type="submit" value="Finish editing : save the Clip and return to the List of Clips"/>

               <p> <input type="button" 
                          value="Keep editing : return to the Clip Preview" 
                          onclick="javascript: returnToEditor()"/></p>

            </form>
        </div>
    </body>
</html>
