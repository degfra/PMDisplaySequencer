<?php include '../includes/helpers.inc.php'; ?>

<!DOCTYPE html>
        <html>
            <head>
                <title>Clip 1</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            </head>
            <body>
                
                <?php foreach ($previewedclips as $previewedclip): ?>
                <?php echo $previewedclip['headercode']; ?>
                <?php echo $previewedclip['mainareacode']; ?>
                <?php echo $previewedclip['footercode']; ?>
                <?php endforeach; ?>
                
            </body>
        </html>

