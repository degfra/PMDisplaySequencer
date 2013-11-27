<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../css/base.css">
    <title>DS - Manage Sequences</title>
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
            <form name="handleSequenceForm_<?php echo $i ?>" action="" method="post">
                <strong>
                <?php echo $sequences[$i][sequenceId]; ?> : <?php echo htmlout($sequences[$i][sequencename], ENT_QUOTES, 'UTF-8'); ?>
                </strong>
                    
                (added : <?php echo htmlout($sequences[$i][sequencedate], ENT_QUOTES, 'UTF-8'); ?>) 
                <input type="hidden" name="sequence_id" value="<?php echo $sequences[$i][sequenceId]; ?>">

                <?php for ( $j=0 ; $j < count($sequenceclips[$i]) ; $j++ ): ?> 
                    <small>
                    &nbsp;
                    <a href="javascript: quickPreview();" title="TODO: Quick Preview">
                    <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>
                    </small>

                    <input type="hidden" name="clip_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                    <input type="hidden" name="nextClipId_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['nextClipId']; ?>">
                    <input type="hidden" name="singleClip_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['singleClip']; ?>">
                    <input type="hidden" name="sequence_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['sequence_id']; ?>">
                    <?php endfor; //endforeach; ?>
                    <br>
                
                <input type="submit" name="action" value="Preview">
                <input type="submit" name="action" value="Edit">
                <input type="submit" name="action" value="Delete">
                
            </form>
        </li>
    <?php endfor; //endforeach;  ?>
</ul>

</body>
</html>
