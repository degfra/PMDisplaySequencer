<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../css/base.css">
        <title>DS - Clips</title>
    </head>
    <body style="padding: 40px;">

        <h2>Here are all the available clips:</h2>
        <p>
            <?php foreach ($clips as $clip): ?>

            <form action="" method="get">
                <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                (submitted on : <?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">

                <input type="submit" name="action" value="Preview">

            </form>

        <?php endforeach; ?>
    </p>
    <p>
        <a href="../../">Return to Display Sequencer Home</a>
    </p>
</body>
</html>
