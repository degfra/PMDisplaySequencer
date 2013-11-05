<?php include '../../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Clips</title>
    </head>
    <body>

        <p>Add a new Clip :</p>
        <form action="" method="post">
            <div>Note : all clip layouts have a header and a footer</div>
            <div>
                <select name="cliplayout" id="cliplayout">
                    <option value="">Chose a layout</option>
                    <?php foreach ($cliplayouts as $cliplayout): ?>
                        <option value="<?php htmlout($cliplayout['id']); ?>">
                            <?php htmlout($cliplayout['cliplayoutname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label for="clipname">Enter new clip name : </label>
            <input type="text" id="clipname" name="clipname"/>
            <input type="submit" name="action" value="Add" />  
        </form>

        <h2>Here are all the clips in the database:</h2>
        <?php foreach ($clips as $clip): ?>
            <blockquote >
                 
                <form action="" method="get">
                    <?php echo $clip['id']; ?> : 
                    <?php htmlout($clip['cliplayoutid']) ?> : 
                    <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                    (submitted on : <?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                    <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">

                    <!-- <input type="hidden" name="action" value="Preview" > -->
                    <input type="submit" name="action" value="Preview">
                    <input type="submit" name="action" value="Edit">
                    <input type="submit" name="action" value="Delete">
                </form>

            </blockquote>

        <?php endforeach; ?>
    </body>
</html>
