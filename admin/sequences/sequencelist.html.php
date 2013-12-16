<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../css/base.css">
    <title>DS - Manage Sequences</title>
    
    <script>
        function quickPreview(clipId) {
            //PopupCenter("/PMDisplaySequencer/admin/clips/?clip_id=" + clipId + "&action=Quickpreview", 'clipPop1',900,700);
            window.open("/PMDisplaySequencer/admin/clips/?clip_id=" + clipId + "&action=Quickpreview");
            window.focus();
        }
        
        function PopupCenter(pageURL, title,w,h) {
                var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            var targetWin = window.open (pageURL, title, 
                'toolbar=no, location=no, \n\
                directories=no, status=no, menubar=no, \n\
                scrollbars=no, resizable=no, copyhistory=yes, \n\
                width='+w+', height='+h+', top='+top+', left='+left);
        
                document.forms.quickpreviewform.submit();
        } 
        
        function Quickpreview() {
            document.forms.quickpreviewform.submit();
        }
        
    </script>
    <script type="text/javascript" src="http://www.websnapr.com/js/websnapr.js"></script>
    
    
</head>
<body style="padding: 40px;">
    
    <div style="position: absolute; left: 800px; top: 40px;" >
        <a href="../../admin/">Return to DS Management</a>
        | 
        <a href="../../">Return to DS Home</a>
    </div>

    <h3>Create a new Sequence :</h3>
    <p>    
    <form name="createSequenceForm" action="" method="post">
        <label for="sequencename">Sequence name : </label>
        <input type="text" id="sequencename" name="sequencename"/>
        &nbsp;

        <label><input type= "checkbox" name="isLoop" /> Loop</label>
        <br>
        <input type="submit" name="action" value="Create" /> 
    </form>
</p>

<h3>Here are all the available sequences :</h3>
<br>
<ul>
    <?php for ($i = 0; $i < count($sequences); $i++): ?>
        <li>             
            <form name="handleSequenceForm_<?php echo $i ?>" action="" method="post" style="display: inline">
                <strong>
                <?php echo $sequences[$i][sequenceId]; ?> : <?php echo htmlout($sequences[$i][sequencename], ENT_QUOTES, 'UTF-8'); ?>
                </strong>    
                (added : <?php echo htmlout($sequences[$i][sequencedate], ENT_QUOTES, 'UTF-8'); ?>) 
                <input type="hidden" name="sequence_id" value="<?php echo $sequences[$i][sequenceId]; ?>">
                
                <input title="Click to preview the Sequence" type="submit" name="action" value="Preview">
                <input title="Click to edit the Sequence" type="submit" name="action" value="Edit">
                <input title="Click to delete the Sequence" type="submit" name="action" value="Delete">
                
                
                <?php for ( $j=0 ; $j < count($sequenceclips[$i]) ; $j++ ): ?> 
                    <br>
                    <form name="quickpreviewform" action ="Quickpreview" method ="post" style="display: inline">
                        <small>
                        <!--<a href="#" title="Click to preview the Clip" onclick="PopupCenter('/PMDisplaySequencer/admin/clips/?clip_id=<?php echo $sequenceclips[$i][$j]['clip_id']; ?>&action=Quickpreview', 'clipPop_<?php echo $i ?>_<?php echo $j ?>',600,600);">
                            <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>
                        <a href="#" title="Click to preview the Clip" onclick="PopupCenter('/PMDisplaySequencer/admin/clips/Quickpreview', 'clipPop_<?php echo $i ?>_<?php echo $j ?>',600,600);">
                            <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>-->
                            <a href="#" title="Click to preview the Clip" class="popup">
                            <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>
                        
                        </small>

                        <!--<input type="hidden" name="clip_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                        <input type="hidden" name="nextClipId_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['nextClipId']; ?>">
                        <input type="hidden" name="singleClip_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['singleClip']; ?>">
                        <input type="hidden" name="sequence_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['sequence_id']; ?>"> -->
                        
                        <input type="hidden" name="clip_id" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                        <input type="hidden" name="nextClipId" value="<?php echo $sequenceclips[$i][$j]['nextClipId']; ?>">
                        <input type="hidden" name="singleClip" value="<?php echo $sequenceclips[$i][$j]['singleClip']; ?>">
                        <input type="hidden" name="sequence_id" value="<?php echo $sequenceclips[$i][$j]['sequence_id']; ?>">
                        
                    </form>
                
                
                <?php endfor;?>
                
                <br><br>
 
            </form>
        </li>
    <?php endfor; //endforeach;  ?>
</ul>

</body>
</html>
