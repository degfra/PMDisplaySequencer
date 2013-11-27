<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../css/base.css">
        <title>DS - Clips</title>
    </head>
    <body style="padding: 40px;">
        
    <div style="position: absolute; left: 960px; top: 40px;" >
        <a href="../../">Return to DS Home</a>
    </div>

        <!--<h2>Here are all the available clips:</h2>
        <p>
            <?php foreach ($clips as $clip): ?>

            <form action="" method="get">
                <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                (submitted on : <?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">

                <input type="submit" name="action" value="Preview">

            </form>

        <?php endforeach; ?>
    </p> -->
        
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
                    <input type="hidden" name="nextClipId" value="<?php echo $clip['nextClipId']; ?>">
                    <input type="hidden" name="sequence_id" value="<?php echo $clip['sequence_id']; ?>">
                    <input type="hidden" name="singleClip" value="<?php echo $clip['singleClip']; ?>">

                    <input type="submit" name="action" value="Preview">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>
