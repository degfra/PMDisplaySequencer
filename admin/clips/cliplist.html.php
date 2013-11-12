<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../css/base.css">
        <title>DS - Manage Clips</title>
    </head>
    <body style="padding: 40px;">

        <h3>Add a new Clip :</h3>
        <p>    
        <form action="" method="post">
            <label for="clipname">Clip name : </label>
            <input type="text" id="clipname" name="clipname"/>

            <label for="clipDuration">Clip duration in seconds : </label>
            <input type="text" id="clipDuration" name="clipDuration" value="4"/> 

            <div>
                <label for="cliplayout">Note : all clip layouts have a header and a footer</label>
                <select name="cliplayout" id="cliplayout">
                    <option value="">Chose a layout</option>
                    <?php foreach ($cliplayouts as $cliplayout): ?>
                        <option value="<?php htmlout($cliplayout['id']); ?>">
                            <?php htmlout($cliplayout['cliplayoutname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" name="action" value="Add" /> 
        </form>
    </p>

    <h3>Here are all the available clips :</h3>
    <br>
    <ul>
        <?php foreach ($clips as $clip): ?>
            <li>             
                <form action="" method="post">
                    <?php echo $clip['id']; ?> : 
                    <?php htmlout($clip['cliplayoutid']) ?> : 
                    <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                    (added : <?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                    <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">

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
