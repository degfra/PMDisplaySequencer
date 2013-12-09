<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../css/base.css">
        <title>DS - Manage Clips</title>
    </head>
    <body style="padding: 40px;">
        
        <div style="position: absolute; left: 800px; top: 40px;" >
            <a href="../../admin/">Return to DS Management</a>
            | 
            <a href="../../">Return to DS Home</a>
        </div>

        <h3>Add a new Clip :</h3>
        <p>    
        <form action="" method="post">
            <label for="clipname">Clip name : </label>
            <input type="text" id="clipname" name="clipname"/>
            &nbsp;
            <label for="clipDuration">Clip duration in seconds : </label>
            <input type="text" id="clipDuration" name="clipDuration" value="4" 
                   style="width: 30px;"/> 

            <div>
                <label for="cliplayout">Choose a Layout : </label>
                &nbsp;
                <select name="cliplayout" id="cliplayout" style="width: 200px;">
                    <!--<option value="">Chose a layout</option>-->
                    <?php foreach ($cliplayouts as $cliplayout): ?>
                        <option value="<?php htmlout($cliplayout['id']); ?>">
                            <?php htmlout($cliplayout['cliplayoutname']); ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="cliplayout"> &nbsp;(Note : all clip layouts have a header and a footer)</label>
            </div>
            <input type="submit" name="action" value="Create" /> 
        </form>
    </p>

    <h3>Here are all the available clips :</h3>
    <br>
    <ul>
        <?php foreach ($clips as $clip): ?>
            <li>             
                <form action="" method="post">
                    <?php echo $clip['id']; ?> : 
                    <?php htmlout($clip['cliplayout_id']) ?> : 
                    <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                    (<?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                    <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">
                    <input type="hidden" name="cliplayout_id" value="<?php echo $clip['cliplayout_id']; ?>" />
                    <input type="hidden" name="nextClipId" value="<?php echo $clip['nextClipId']; ?>">
                    <input type="hidden" name="sequence_id" value="<?php echo $clip['sequence_id']; ?>">
                    <input type="hidden" name="singleClip" value="<?php echo $clip['singleClip']; ?>">

                    <input type="submit" name="action" value="Preview">
                    <input type="submit" name="action" value="Edit">
                    <input type="submit" name="action" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
