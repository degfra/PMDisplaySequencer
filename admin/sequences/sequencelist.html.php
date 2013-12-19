<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../css/base.css">
    <title>DS - Manage Sequences</title>
    
    <style> 
        div#div2
        {
            margin:100px;
            transform:scale(0.5, 0.5);
            -ms-transform:scale(0.5, 0.5); /* IE 9 */
            -webkit-transform:scale(0.5, 0.5); /* Safari and Chrome */
        }
        
        button {
            border: 0;
            padding: 0;
            display: inline;
            //background-color: #A4D4E3;
            background: none;
            text-decoration: underline;
            font-weight: 600;
            //color: grey;
        }
        button:hover {
            //cursor: pointer;
            border: 0;
            padding: 0;
            display: inline;
            //background-color: #A4D4E3;
            background: none;
            text-decoration: underline;
            font-weight: 600;
            //color: black;
        } 
    </style>
    
    <script type="text/javascript">
        
        function postPopup( formElem, w, h ) {      // formElem 
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            // here we popup the new window, the second attribute have to be the same as the form target attribute
           window.open( "", 
           "windowName", "width="+w+", height="+h+", left ="+left+", top="+top+", resizable=no, scrollbars=no, addressbar=no, toolbar=no, status=no, location=no, status=no, menubar=no" );
            // we submit the form 50 milliseconds after so the browser creates the popup 
            setTimeout("document.getElementById(‘" + formElem + "’).submit();",50); // " + formElem + "
            // we stop the regurar form submit
            //return false;
            
            //document.getElementById(‘quickpreviewform_0_0’).submit();
        }
        
    </script>
    
</head>
<body style="padding: 40px;">
    
    <?php   if ($_POST['action'] == 'Quickpreview') {
        
                echo('<div id="div2">');
               }
    ?>
    
    
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
                <br>
            </form>    
                <?php for ( $j=0 ; $j < count($sequenceclips[$i]) ; $j++ ): ?> 
                   |
                    <?php $formElem = "quickpreviewform_". $i . "_" . $j ;?>
                    <!-- <?php echo $formElem; ?> -->
                    <form id="<?php echo $formElem; ?>" 
                          action ="" method ="post" 
                          target="windowName" onsubmit="return postPopup(<?php echo $formElem; ?>, 778, 520);" 
                          style="display: inline">
                        <small>
                        <!--<a href="#" title="Click to preview the Clip" onclick="PopupCenter('/PMDisplaySequencer/admin/clips/?clip_id=<?php echo $sequenceclips[$i][$j]['clip_id']; ?>&action=Quickpreview', 'clipPop_<?php echo $i ?>_<?php echo $j ?>',600,600);">
                            <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>
                        <a href="#" title="Click to preview the Clip" onclick="PopupCenter('../clips/Preview()', 'clipPop_<?php echo $i ?>_<?php echo $j ?>',600,486);">
                            <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>-->



                        </small>

                        <!--<input type="hidden" name="clip_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                        <input type="hidden" name="nextClipId_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['nextClipId']; ?>">
                        <input type="hidden" name="singleClip_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['singleClip']; ?>">
                        <input type="hidden" name="sequence_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['sequence_id']; ?>">-->

                        <input type="hidden" name="clip_id" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                        <input type="hidden" name="nextClipId" value="<?php echo $sequenceclips[$i][$j]['nextClipId']; ?>">
                        <input type="hidden" name="singleClip" value="<?php echo $sequenceclips[$i][$j]['singleClip']; ?>">
                        <input type="hidden" name="sequence_id" value="<?php echo $sequenceclips[$i][$j]['sequence_id']; ?>">

                        <button title="Click to preview the Clip" name="action" value="Quickpreview" onclick='javascript: document.getElementById("<?php echo $formElem; ?>").submit();'><?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></button>
                        <!--<input type="submit" name="action" value="<?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?>"/>-->

                    </form>
                  
                
                <?php endfor;?>
                 |
                <br>
 
            
        </li>
    <?php endfor; //endforeach;  ?>
</ul>

<?php   if ($_POST['action'] == 'Quickpreview') {
        
                echo('</div>');
        }
?>

</body>
</html>
