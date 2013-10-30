<?php foreach ($clips as $clip): ?>
      
    <!-- code head -->
    <?php include '../../templates/edit_tpl/codehead_edit_tpl.html.php'; ?>
            

    <!-- header -->
    <?php if ($clip['headername'] != null) { ?>
        <?php include '../../templates/edit_tpl/header_edit_tpl.html.php'; ?>
    <?php } ?>
                        
    <!-- left sidebar -->
    <?php if ($clip['leftbarname'] != null) { ?>
        <?php include '../../templates/edit_tpl/leftsidebar_edit_tpl.html.php'; ?>
    <?php } ?>

    <!-- main content area -->
    <?php if ($clip['mainareaname'] != null) { ?>
        <?php include '../../templates/edit_tpl/mainarea_edit_tpl.html.php'; ?>
    <?php } ?>        
                            
    <!-- right sidebar -->
    <?php if ($clip['rightbarname'] != null) { ?>
        <?php include '../../templates/edit_tpl/rightsidebar_edit_tpl.html.php'; ?>
    <?php } ?>
                        
    <!-- footer -->    
    <?php if ($clip['footername'] != null) { ?>
        <?php include '../../templates/edit_tpl/footer_edit_tpl.html.php'; ?>
    <?php } ?>
    
            
    <!-- code foot -->
    <?php include '../../templates/edit_tpl/codefoot_edit_tpl.html.php'; ?>
            

<?php endforeach; ?>