<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../css/base.css">
    <title>DS - Manage Sequences</title>
</head>
<body style="padding: 40px;">

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
            <form name="handleSequenceForm_<?php echo $j ?>" action="" method="post">
                <strong>
                <?php echo $sequences[$i][sequenceId]; ?> : 
                <?php echo htmlout($sequences[$i][sequencename], ENT_QUOTES, 'UTF-8'); ?>
                </strong>
                    
                (added : <?php echo htmlout($sequences[$i][sequencedate], ENT_QUOTES, 'UTF-8'); ?>) 
                <input type="hidden" name="sequence_id" value="<?php echo $sequences[$i][sequenceId]; ?>">

                <?php //foreach ($sequenceclips[$i] as $clip): 
                        for ( $j=0 ; $j < count($sequenceclips[$i]) ; $j++ ): ?> 
                <small>
                    &nbsp;
                    <a href="javascript: quickPreview();" title="TODO: Quick Preview">
                    <!--<?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>-->
                    <?php echo htmlout($sequenceclips[$i][$j]['clipname'], ENT_QUOTES, 'UTF-8'); ?></a>
                </small>
                
                <input type="hidden" name="clip_id_<?php echo $i ?>_<?php echo $j ?>" value="<?php echo $sequenceclips[$i][$j]['clip_id']; ?>">
                <?php endfor; //endforeach; ?>
                <br>
                
                <!--<input type="hidden" name="firstClipId_<?php echo $i ?>" value=""/>-->
                
                <input type="submit" name="action" value="Preview">
                <input type="submit" name="action" value="Edit">
                <input type="submit" name="action" value="Delete">
                
            </form>
        </li>
    <?php endfor; //endforeach;  ?>
</ul>

<p>
    <a href="../../admin/">Return to DS Management</a>
    <br><br>
    <a href="../../">Return to DS Home</a>
</p>
<!--
<script type="text/javascript">
    document.getElementsByName("firstClipId_0").value =
        document.getElementsByName("clip_id_0").value ;
</script>
-->
</body>
</html>
