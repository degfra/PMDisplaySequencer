<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>End of Clip Preview</title>
        <link rel="stylesheet" href="../../css/base.css">
        <?php echo $_POST['cliplayoutcssref']; ?>
    </head>
    <body style="padding: 40px;">

        <h3>End of Clip Preview</h3>

        <div
            <p><h5>
                The <?php echo $_POST['clipDuration'] ?> 
                seconds preview of '<?php echo $_POST['clipname'] ?>' 
                has come to an end.<br>
                There isn't any 'Next Clip' since this clip is not part 
                of any sequence yet.
            </h5></p>

        <p><input type="button" value="Return to Clips Management" 
                  onClick="
                      <?php if ($clip['singleClip'] == 0) {
                         echo("javascript: location = '../sequences/'");
                      } else if ($clip['singleClip'] == 1) {
                          echo("javascript: location = '../clips/'");
                      }
                      ?>"/></p>

        <!--<?php
        if ($clip['singleClip'] == 1) {
            //echo $returntosequencesbutton;
            echo ('<p><input type="button" value="Return to Clips Management" 
                  onClick="javascript: location = ../sequences/"/></p>');
        } else  {
            //echo $returntoclipsbutton;
            echo ('<p><input type="button" value="Return to Clips Management" 
                  onClick="javascript: location = ../clips/"/></p>');
        }
        ?>-->
    </div>
</body>
</html>