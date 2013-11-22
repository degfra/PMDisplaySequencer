<?php

 include 'db.inc.php';
    
    global  $clips;

function displayNextClip() {
    
    if ($_POST['nextClipId'] == 0) {        // $_POST['singleClip'] || 
    
        $clips[] = array(
            'clipid' => $_POST['clip_id'],
            'cliplayoutcssref' => $_POST['cliplayoutcssref'],
            'clipname' => $_POST['clipname'],
            'clipDurationInSeconds' => $_POST['clipDuration'],
        );
        
        if ($_POST['updated']) { 
            include '../../templates/preview_tpl/endofeditpreview.html.php';
            exit();
        } 
        else {
            include '../../templates/preview_tpl/endofclippreview.html.php';
            exit();
        }
  
    } else {
                
        exposeClipWithSections();
        
        include '../../templates/preview_tpl/clippreview_styled.html.php';
        exit();
    }
    
}

