
<?php foreach ($clips as $clip): ?>
      
    <!-- code head -->
    <?php include '../../templates/preview_tpl/codehead_prev_tpl.html.php'; ?>
            

    <!-- header -->
    <?php if ($clip['headername'] != null) { ?>
        <?php include '../../templates/preview_tpl/header_prev_tpl.html.php'; ?>
    <?php } ?>
                        
    <!-- left sidebar -->
    <?php if ($clip['leftbarname'] != null) { ?>
        <?php include '../../templates/preview_tpl/leftsidebar_prev_tpl.html.php'; ?>
    <?php } ?>

    <!-- main content area -->
    <?php if ($clip['mainareaname'] != null) { ?>
        <?php include '../../templates/preview_tpl/mainarea_prev_tpl.html.php'; ?>
    <?php } ?>        
                            
    <!-- right sidebar -->
    <?php if ($clip['rightbarname'] != null) { ?>
        <?php include '../../templates/preview_tpl/rightsidebar_prev_tpl.html.php'; ?>
    <?php } ?>
                        
    <!-- footer -->    
    <?php if ($clip['footername'] != null) { ?>
        <?php include '../../templates/preview_tpl/footer_prev_tpl.html.php'; ?>
    <?php } ?>
    
            
    <!-- code foot -->
    <?php include '../../templates/preview_tpl/codefoot_prev_tpl.html.php'; ?>
            

<?php endforeach; ?>