<?php foreach ($previewedclips as $clip): ?>
   
            <!-- 
            <?php echo $clip['codehead']; ?>
            
            <?php echo $clip['headercode']; ?>
            <?php echo $clip['leftbarcode']; ?>
            <?php echo $clip['mainareacode']; ?>
            <?php echo $clip['rightbarcode']; ?>
            <?php echo $clip['footercode']; ?>
            
            <?php echo $clip['codefoot']; ?>
            -->

            <?php include '../../templates/preview_tpl/codehead_tpl.html.php'; ?>

            <?php include '../../templates/preview_tpl/header_tpl.html.php'; ?>
            <?php include '../../templates/preview_tpl/leftsidebar_tpl.html.php'; ?>
            <?php include '../../templates/preview_tpl/mainarea_tpl.html.php'; ?>
            <?php include '../../templates/preview_tpl/rightsidebar_tpl.html.php'; ?>
            <?php include '../../templates/preview_tpl/footer_tpl.html.php'; ?>

            <?php include '../../templates/preview_tpl/codefoot_tpl.html.php'; ?>




<?php endforeach; ?>
