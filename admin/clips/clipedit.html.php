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

            <?php include '../../templates/editor_tpl/codehead_edit_tpl.html.php'; ?>

            <?php include '../../templates/editor_tpl/header_edit_tpl.html.php'; ?>
            <?php include '../../templates/editor_tpl/leftsidebar_edit_tpl.html.php'; ?>
            <?php include '../../templates/editor_tpl/mainarea_edit_tpl.html.php'; ?>
            <?php include '../../templates/editor_tpl/rightsidebar_edit_tpl.html.php'; ?>
            <?php include '../../templates/editor_tpl/footer_edit_tpl.html.php'; ?>

            <?php include '../../templates/editor_tpl/codefoot_edit_tpl.html.php'; ?>

<?php endforeach; ?>