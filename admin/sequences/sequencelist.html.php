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
        <form action="" method="post">
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
        <?php foreach ($sequences as $sequence): ?>
            <li>             
                <form action="" method="post">
                    <?php echo $sequence['sequenceId']; ?> : 

                    <?php echo htmlout($sequence['sequencename'], ENT_QUOTES, 'UTF-8'); ?>

                    (added : <?php echo htmlout($sequence['sequencedate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                    <input type="hidden" name="sequence_id" value="<?php echo $sequence['sequenceId']; ?>">

                    <?php foreach ($sequenceclips as $clip) ?>
                    
                        <div>
                            <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>
                            <input type="hidden" name="clip_id" value="<?php echo $clip['clip_id']; ?>">
                        </div>
                    
                    <?phpendforeach; ?>
                    
                    <input type="submit" name="action" value="Preview">
                    <input type="submit" name="action" value="Edit">
                    <input type="submit" name="action" value="Delete">
          
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <p>
        <a href="../../admin/">Return to DS Management</a>
        <br><br>
        <a href="../../">Return to DS Home</a>
    </p>

</body>
</html>
