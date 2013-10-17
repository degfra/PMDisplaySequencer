<?php include '../includes/helpers.inc.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Clips</title>
    </head>
    <body>
        
        <h2>Here are all the clips in the database:</h2>
        <?php foreach ($clips as $clip): ?>
          <blockquote >

             <form action="" method="get">
                <?php echo htmlout($clip['clipname'], ENT_QUOTES, 'UTF-8'); ?>

                 (submitted on : <?php echo htmlout($clip['clipdate'], ENT_QUOTES, 'UTF-8'); ?> ) 
                <input type="hidden" name="clip_id" value="<?php echo $clip['id']; ?>">

                <!-- <input type="hidden" name="action" value="Preview" > -->
                <input type="submit" name="action" value="Preview">
                <input type="submit" name="action" value="Edit">
             </form>

         </blockquote>
        
        <?php endforeach; ?>
    </body>
</html>
