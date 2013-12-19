<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';
include_once '../../includes/exposeClipWithSections-function.inc.php';
include_once '../../includes/listclipsections-function.inc.php';

//global $clips;

/* * ********** CREATE NEW CLIP AND RELATED SECTIONS ********** */

if (isset($_POST['action']) and $_POST['action'] == 'Create') {

    include '../../includes/db.inc.php';
    //include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    // SAVE THE CONFIGURABLE CLIP ATTRIBUTES
    try {

        $sql = 'INSERT into clip SET
                clipname = :clipname,
                cliplayoutid = :cliplayoutid,
                clipbackgroundcolor = "#CCCCCC"';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clipname', $_POST['clipname']);
        $s->bindValue(':cliplayoutid', $_POST['cliplayout']);
        // $s->bindValue(':clipDuration', $_POST['clipDuration']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!';
        include '../../includes/error.html.php';
        exit();
    }

    $lastclipid = $pdo->lastInsertId();
    $defaultSequenceName = "Single Clip " . $lastclipid . " Sequence";

    // CREATE THE DEFAULT SEQUENCE FOR THIS NEW CLIP
    try {

        $sql = 'INSERT into sequence SET
                sequencename = :sequencename,
                sequenceupdated = 0,
                isLoop = 0,
                sequenceDurationInSeconds = 0';

        $s = $pdo->prepare($sql);
        $s->bindValue(':sequencename', $defaultSequenceName);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    $lastsequenceid = $pdo->lastInsertId();

    // CREATE THE SEQUENCECLIP ENTRY
    try {

        $sql = 'INSERT into sequenceclip SET
                sequenceid = :lastsequenceid,
                inSequenceClipId = :lastclipid,
                inSequenceNextClipId = 0,
                inSequenceClipOrderNumber = 1,
                inSequenceClipDurationInSeconds = 4,
                singleClipSequence = 1';

        $s = $pdo->prepare($sql);
        $s->bindValue(':lastsequenceid', $lastsequenceid);
        $s->bindValue(':lastclipid', $lastclipid);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    // FETCH THE TYPE OF CLIP LAYOUT
    try {
        $sql = 'SELECT 
                cliplayout.cliplayoutname,
                cliplayoutid 
                FROM clip
                JOIN cliplayout ON clip.cliplayoutid = cliplayout.id
                WHERE clip.id = :lastclipid';

        $s = $pdo->prepare($sql);
        $s->bindValue(':lastclipid', $lastclipid);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    foreach ($s as $row) {
        $cliplayouts[] = array(
            'cliplayoutname' => $row['cliplayoutname']
        );
    }

    // listclipsections($lastclipid, $cliplayouts);
    //  BUILD LIST OF SECTIONTYPES

    try {
        $result = $pdo->query('SELECT * FROM sectiontype');
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    // CREATE RELATED SECTIONS 

    foreach ($result as $sectiontype) {

        $name = $sectiontype['sectiontypename'];

        try {

            if ($name == 'Header') {
                $headersectiontypeid = $sectiontype['id'];
                $headersectionname = "Clip " . $lastclipid . " " . $name;
                $headersectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Left sidebar') {
                $leftbarsectiontypeid = $sectiontype['id'];
                $leftbarsectionname = "Clip " . $lastclipid . " " . $name;
                $leftbarsectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Main area') {
                $mainsectiontypeid = $sectiontype['id'];
                $mainsectionname = "Clip " . $lastclipid . " " . $name;
                $mainsectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Main area 1 sidebar') {
                $main1sectiontypeid = $sectiontype['id'];
                $main1sectionname = "Clip " . $lastclipid . " " . $name;
                $main1sectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Main area 2 sidebars') {
                $main2sectiontypeid = $sectiontype['id'];
                $main2sectionname = "Clip " . $lastclipid . " " . $name;
                $main2sectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Right sidebar') {
                $rightbarsectiontypeid = $sectiontype['id'];
                $rightbarsectionname = "Clip " . $lastclipid . " " . $name;
                $rightbarsectioncode = $sectiontype['sectiontypecode'];
            } else if ($name == 'Footer') {
                $footersectiontypeid = $sectiontype['id'];
                $footersectionname = "Clip " . $lastclipid . " " . $name;
                $footersectioncode = $sectiontype['sectiontypecode'];
            }
        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!'; //getMessage(); 
            include '../../includes/error.html.php';
            exit();
        }
    }

    foreach ($cliplayouts as $cliplayout) {

        if ($cliplayout['cliplayoutname'] == '2 Sidebars') {
            $layoutsections[] = array(
                'headersection' => 'header',
                'leftbarsection' => 'leftbar',
                'mainareasection' => 'mainarea_2_bars',
                'rightbarsection' => 'rightbar',
                'footersection' => 'footer'
            );
        }
        if ($cliplayout['cliplayoutname'] == 'Left sidebar') {
            $layoutsections[] = array(
                'headersection' => 'header',
                'leftbarsection' => 'leftbar',
                'mainareasection' => 'mainarea_1_bar',
                'rightbarsection' => null,
                'footersection' => 'footer'
            );
        }
        if ($cliplayout['cliplayoutname'] == 'Main area') {
            $layoutsections[] = array(
                'headersection' => 'header',
                'leftbarsection' => null,
                'mainareasection' => 'mainarea',
                'rightbarsection' => null,
                'footersection' => 'footer'
            );
        }
        if ($cliplayout['cliplayoutname'] == 'Right sidebar') {
            $layoutsections[] = array(
                'headersection' => 'header',
                'leftbarsection' => null,
                'mainareasection' => 'mainarea_1_bar',
                'rightbarsection' => 'rightbar',
                'footersection' => 'footer'
            );
        }

        foreach ($layoutsections as $layoutsection) {

            try {

                $sql = 'INSERT INTO section SET
                  sectiontypeid = :sectiontypeid,
                  sectionname = :sectionname,
                  sectioncode = :sectiontypecode,

                  clipid = :clipid';

                $s = $pdo->prepare($sql);

                if ($layoutsection['headersection'] != null) {

                    $s->bindValue(':sectiontypeid', $headersectiontypeid);
                    $s->bindValue(':sectionname', $headersectionname);
                    $s->bindValue(':sectiontypecode', $headersectioncode);

                    $s->bindValue(':clipid', $lastclipid);

                    $s->execute();
                }
                if ($layoutsection['leftbarsection'] != null) {

                    $s->bindValue(':sectiontypeid', $leftbarsectiontypeid);
                    $s->bindValue(':sectionname', $leftbarsectionname);
                    $s->bindValue(':sectiontypecode', $leftbarsectioncode);

                    $s->bindValue(':clipid', $lastclipid);

                    $s->execute();
                }
                if ($layoutsection['mainareasection'] != null) {
                    if ($layoutsection['mainareasection'] == 'mainarea') {

                        $s->bindValue(':sectiontypeid', $mainsectiontypeid);
                        $s->bindValue(':sectionname', $mainsectionname);
                        $s->bindValue(':sectiontypecode', $mainsectioncode);

                        $s->bindValue(':clipid', $lastclipid);

                        $s->execute();
                    } else if ($layoutsection['mainareasection'] == 'mainarea_1_bar') {

                        $s->bindValue(':sectiontypeid', $main1sectiontypeid);
                        $s->bindValue(':sectionname', $main1sectionname);
                        $s->bindValue(':sectiontypecode', $main1sectioncode);

                        $s->bindValue(':clipid', $lastclipid);

                        $s->execute();
                    } else if ($layoutsection['mainareasection'] == 'mainarea_2_bars') {

                        $s->bindValue(':sectiontypeid', $main2sectiontypeid);
                        $s->bindValue(':sectionname', $main2sectionname);
                        $s->bindValue(':sectiontypecode', $main2sectioncode);

                        $s->bindValue(':clipid', $lastclipid);

                        $s->execute();
                    }
                }
                if ($layoutsection['rightbarsection'] != null) {

                    $s->bindValue(':sectiontypeid', $rightbarsectiontypeid);
                    $s->bindValue(':sectionname', $rightbarsectionname);
                    $s->bindValue(':sectiontypecode', $rightbarsectioncode);

                    $s->bindValue(':clipid', $lastclipid);

                    $s->execute();
                }
                if ($layoutsection['footersection'] != null) {

                    $s->bindValue(':sectiontypeid', $footersectiontypeid);
                    $s->bindValue(':sectionname', $footersectionname);
                    $s->bindValue(':sectiontypecode', $footersectioncode);

                    $s->bindValue(':clipid', $lastclipid);

                    $s->execute();
                }
            } catch (PDOException $error) {
                $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!'; //getMessage(); 
                include '../../includes/error.html.php';
                exit();
            }
        }
    }


    header('Location: .');
    exit();
}

/* * ******** PREVIEW OR EDIT CLIP ********** */

//if (isset($_GET['action']) and ($_GET['action'] == 'Preview' || $_GET['action'] == 'Edit' )) {
if (isset($_POST['action']) and ($_POST['action'] == 'Preview' || $_POST['action'] == 'Edit' )) {
    include '../../includes/db.inc.php';
    //include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    $returntoeditorbutton = '<p><input type="button" style=" position: absolute; left: 970px; top: 700px; "
                          value="Return to the Clip Editor" 
                          onclick="javascript: history.back()"/></p>';

    $firstClipId = 0;
    $firstClipOrderNumber = 0;
    $sequenceId = 0;
    $singleClipSequence = 0;


    try {
        $result = $pdo->query('SELECT id, cliplayoutname FROM cliplayout');
    } catch (PDOException $error) {
        $error = 'Error fetching clip layouts from database!';
        include '../../includes/error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $cliplayouts[] = array(
            'id' => $row['id'],
            'cliplayoutname' => $row['cliplayoutname']
        );
    }


    exposeClipWithSections($firstClipId, $firstClipOrderNumber, $sequenceId, $singleClipSequence);

    if ($_POST['action'] == 'Preview' || $_GET['action'] == 'Quickpreview' ) {
        //include 'clippreview.html.php';
        include '../../templates/preview_tpl/clippreview_styled.html.php';
        exit();
    } else if ($_POST['action'] == 'Edit' || $_GET['?Edit']) {
        include '../../templates/edit_tpl/clipedit.html.php';
        exit();
    }
}

/********************* QuickPreview of clip in Popup ***************************/

//if (isset($_GET['action']) and $_GET['action'] == 'Quickpreview' ) {
if (isset($_POST['action']) and $_POST['action'] == 'Quickpreview' ) {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    $returntoeditorbutton = '<p><input type="button" style=" position: absolute; left: 970px; top: 700px; "
                          value="Close this preview window" 
                          onclick="javascript: window.close()"/></p>';
    
    $firstClipId = 0;
    $firstClipOrderNumber = 0;
    $sequenceId = 0;
    $singleClipSequence = 0;
    
   try {
        $result = $pdo->query('SELECT id, cliplayoutname FROM cliplayout');
    } catch (PDOException $error) {
        $error = 'Error fetching clip layouts from database!';
        include '../../includes/error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $cliplayouts[] = array(
            'id' => $row['id'],
            'cliplayoutname' => $row['cliplayoutname']
        );
    }

    exposeClipWithSections($firstClipId, $firstClipOrderNumber, $sequenceId, $singleClipSequence); 
    
    include '../../templates/preview_tpl/clippreview_styled.html.php';
    exit();
    
}


if (isset($_GET['Next_Clip'])) {

    /*     * ********* IF SINGLE CLIP ********* */

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
        } else {
            include '../../templates/preview_tpl/endofclippreview.html.php';
            exit();
        }
        
    /*     * ********* IF CLIP SEQUENCE ********* */
        
    } else {

        exposeClipWithSections();

        include '../../templates/preview_tpl/clippreview_styled.html.php';
        exit();
    }

}


/* * ************** UPDATE CLIP AND RELATED SECTIONS ****************** */

if (isset($_POST['action']) and $_POST['action'] == 'Update') {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    // UPDATE CLIP'S BACKGROUND COLOR AND CLIPLAYOUT TYPE (ID)
    $hexa = '#';
    $color = $_POST['backgroundColor'];
    $clipbackgroundcolor = $hexa . $color;

    if ($_POST['cliplayout'] != $_POST['cliplayout_id']) {
        $cliplayoutid = $_POST['cliplayout'];       // THE SUBMITTED NEW CLIPLAYOUT
    } else if ($_POST['cliplayout'] == $_POST['cliplayout_id']) {
        $cliplayoutid = $_POST['cliplayout_id'];    // THE CLIP'S ORIGINAL CLIPLAYOUT
    }

    try {

        $sql = 'UPDATE clip SET
                clipbackgroundcolor = :clipbackgroundcolor,
                cliplayoutid = :cliplayoutid,
                updated = 1
                WHERE clip.id = :clip_id';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clipbackgroundcolor', $clipbackgroundcolor);
        $s->bindValue(':cliplayoutid', $cliplayoutid);
        $s->bindValue(':clip_id', $_POST['clip_id']);

        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error updating clip attributes !';
        include '../../includes/error.html.php';
        exit();
    }

    $lastclipid = $_POST['clip_id'];
    // $cliplayoutid is in POST AND in SCOPE

    // FETCH THE ATTRIBUTES OF THE CLIPLAYOUT IN SCOPE
    try {
        $sql = 'SELECT 
                cliplayout.cliplayoutname,
                cliplayoutid 
                FROM clip
                JOIN cliplayout ON clip.cliplayoutid = cliplayout.id
                WHERE clip.id = :clip_id';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $lastclipid);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }

    foreach ($s as $row) {
        $cliplayouts[] = array(
            'cliplayoutname' => $row['cliplayoutname']
                //'cliplayoutid' => $row['cliplayoutid']
        );
    }

    // IF A NEW CLIP LAYOUT HAS BEEN SELECTED IN THE EDIT FORM :  ***********************************************

    if ($_POST['cliplayout'] != $_POST['cliplayout_id']) {

        // FIRST DELETE ALL THE EXISTING SECTIONS OF THE SUBMITTED CLIP

        try {
            $sql = 'DELETE FROM section 
                   WHERE clipid = :clip_id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':clip_id', $lastclipid);
            $s->execute();
        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
            include '../../includes/error.html.php';
            exit();
        }

        // THEN REBUILD THE CLIP SECTIONS ACCORDING TO THE NEW CLIP LAYOUT

        try {

            $sql = 'SELECT cliplayoutsectiontype.*,
                    sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypecode

                    FROM cliplayoutsectiontype
                    JOIN sectiontype ON sectiontype.id = cliplayoutsectiontype.sectiontypeid

                    WHERE cliplayoutid = :cliplayout_id';

            $s = $pdo->prepare($sql);
            $s->bindValue(':cliplayout_id', $cliplayoutid);
            $s->execute();
        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
            include '../../includes/error.html.php';
            exit();
        }

        // CREATE THE SECTION'S NAME AND SECTIONTYPE ID
        // UPDATE THE SECTION CODE WITH THE CONTENT OF THE SECTION EDITOR
        foreach ($s as $sectiontype) {

            $sectiontypename = $sectiontype['sectiontypename'];

            if ($sectiontypename == 'Header') {
                $headersectiontypeid = $sectiontype['id'];
                $headersectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $headersectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Left sidebar') {                
                $leftbarsectiontypeid = $sectiontype['id'];
                $leftbarsectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $leftbarsectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Main area') {
                $mainsectiontypeid = $sectiontype['id'];
                $mainsectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $mainsectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Main area 1 sidebar') {
                $main1sectiontypeid = $sectiontype['id'];
                $main1sectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $main1sectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Main area 2 sidebars') {
                $main2sectiontypeid = $sectiontype['id'];
                $main2sectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $main2sectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Right sidebar') {
                $rightbarsectiontypeid = $sectiontype['id'];
                $rightbarsectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $rightbarsectioncode = $sectiontype['sectiontypecode'];
                
            } else if ($sectiontypename == 'Footer') {
                $footersectiontypeid = $sectiontype['id'];
                $footersectionname = "Clip " . $lastclipid . " " . $sectiontypename;
                $footersectioncode = $sectiontype['sectiontypecode'];
            }
        }

        // DETERMINE THE SECTIONS OF THE SUBMITTED NEW CLIPLAYOUT
        foreach ($cliplayouts as $cliplayout) {

            if ($cliplayout['cliplayoutname'] == '2 Sidebars') {
                $layoutsections[] = array(
                    'headersection' => 'header',
                    'leftbarsection' => 'leftbar',
                    'mainareasection' => 'mainarea_2_bars',
                    'rightbarsection' => 'rightbar',
                    'footersection' => 'footer'
                );
            }
            if ($cliplayout['cliplayoutname'] == 'Left sidebar') {
                $layoutsections[] = array(
                    'headersection' => 'header',
                    'leftbarsection' => 'leftbar',
                    'mainareasection' => 'mainarea_1_bar',
                    'rightbarsection' => null,
                    'footersection' => 'footer'
                );
            }
            if ($cliplayout['cliplayoutname'] == 'Main area') {
                $layoutsections[] = array(
                    'headersection' => 'header',
                    'leftbarsection' => null,
                    'mainareasection' => 'mainarea',
                    'rightbarsection' => null,
                    'footersection' => 'footer'
                );
            }
            if ($cliplayout['cliplayoutname'] == 'Right sidebar') {
                $layoutsections[] = array(
                    'headersection' => 'header',
                    'leftbarsection' => null,
                    'mainareasection' => 'mainarea_1_bar',
                    'rightbarsection' => 'rightbar',
                    'footersection' => 'footer'
                );
            }

            // UPDATE THE SECTIONS OF THE NEW LAYOUT 
            // WITH THE UPDATED SECTIONCODE FROM THE EDIT FORM
            foreach ($layoutsections as $layoutsection) {

                try {

                    $sql = 'INSERT INTO section SET
                            sectiontypeid = :sectiontypeid,
                            sectionname = :sectionname,
                            sectioncode = :sectiontypecode,

                            clipid = :clipid';
                            // WHERE clipid = :clipid'; // sectiontypeid = :sectiontypeid,

                    $s = $pdo->prepare($sql);

                    if ($layoutsection['headersection'] != null) {

                        $s->bindValue(':sectiontypeid', $headersectiontypeid);
                        $s->bindValue(':sectionname', $headersectionname);
                        $s->bindValue(':sectiontypecode', $headersectioncode);
                        $s->bindValue(':clipid', $lastclipid);
                        $s->execute();
                    }

                    if ($layoutsection['leftbarsection'] != null) {

                        $s->bindValue(':sectiontypeid', $leftbarsectiontypeid);
                        $s->bindValue(':sectionname', $leftbarsectionname);
                        $s->bindValue(':sectiontypecode', $leftbarsectioncode);
                        $s->bindValue(':clipid', $lastclipid);
                        $s->execute();
                    }

                    if ($layoutsection['mainareasection'] != null) {
                        if ($layoutsection['mainareasection'] == 'mainarea') {

                            $s->bindValue(':sectiontypeid', $mainsectiontypeid);
                            $s->bindValue(':sectionname', $mainsectionname);
                            $s->bindValue(':sectiontypecode', $mainsectioncode);
                            $s->bindValue(':clipid', $lastclipid);
                            $s->execute();
                            
                        } else if ($layoutsection['mainareasection'] == 'mainarea_1_bar') {

                            $s->bindValue(':sectiontypeid', $main1sectiontypeid);
                            $s->bindValue(':sectionname', $main1sectionname);
                            $s->bindValue(':sectiontypecode', $main1sectioncode);
                            $s->bindValue(':clipid', $lastclipid);
                            $s->execute();
                            
                        } else if ($layoutsection['mainareasection'] == 'mainarea_2_bars') {

                            $s->bindValue(':sectiontypeid', $main2sectiontypeid);
                            $s->bindValue(':sectionname', $main2sectionname);
                            $s->bindValue(':sectiontypecode', $main2sectioncode);
                            $s->bindValue(':clipid', $lastclipid);
                            $s->execute();
                        }
                    }

                    if ($layoutsection['rightbarsection'] != null) {

                        $s->bindValue(':sectiontypeid', $rightbarsectiontypeid);
                        $s->bindValue(':sectionname', $rightbarsectionname);
                        $s->bindValue(':sectiontypecode', $rightbarsectioncode);
                        $s->bindValue(':clipid', $lastclipid);
                        $s->execute();
                    }

                    if ($layoutsection['footersection'] != null) {

                        $s->bindValue(':sectiontypeid', $footersectiontypeid);
                        $s->bindValue(':sectionname', $footersectionname);
                        $s->bindValue(':sectiontypecode', $footersectioncode);
                        $s->bindValue(':clipid', $lastclipid);
                        $s->execute();
                    } 
                    
                } catch (PDOException $error) {
                    $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!'; //getMessage(); 
                    include '../../includes/error.html.php';
                    exit();
                }
            }
        }
        
        $_POST['cliplayout_id'] = $cliplayoutid;
        
        unset($cliplayouts);
        
        try {
            $result = $pdo->query('SELECT id, cliplayoutname FROM cliplayout');
        } catch (PDOException $error) {
            $error = 'Error fetching clip layouts from database!';
            include '../../includes/error.html.php';
            exit();
        }
        
        foreach ($result as $row) {
            $cliplayouts[] = array(
                'id' => $row['id'],
                'cliplayoutname' => $row['cliplayoutname']
            );
        }

        // IF THE ORIGINAL CLIP LAYOUT IS KEPT AS IS IN THE EDIT FORM :********************************
        
    }

    // BUILD SUBMITTED CLIP'S LIST OF SECTIONS ? ? ?
    try {

        $sql = 'SELECT 
                section.id, section.sectionname,
                clip.clipname
                    FROM clip
                    JOIN section ON clip.id = section.clipid
                    WHERE clip.id = :clip_id';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }
    
    $newcontentcode = '<h4>New content here</h4>';

    foreach ($s as $clipsection) {

        try {
            $sql = 'UPDATE section SET 
                    sectioncode = :sectioncode
                    WHERE section.id = :sectionid';

            $st = $pdo->prepare($sql);

            if (strpos($clipsection['sectionname'], 'Header') !== FALSE) {
                $st->bindValue(':sectionid', $clipsection['id']);
                if ($_POST['headerEditor']) {
                    $st->bindValue(':sectioncode', $_POST['headerEditor']);
                } else {
                    $st->bindValue(':sectioncode',$newcontentcode); 
                }
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Left') !== FALSE) {
                $st->bindValue(':sectionid', $clipsection['id']);
                if ($_POST['leftSidebarEditor']) {
                    $st->bindValue(':sectioncode', $_POST['leftSidebarEditor']);
                } else {
                    $st->bindValue(':sectioncode', $newcontentcode);
                }
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Main') !== FALSE) {
                $st->bindValue(':sectionid', $clipsection['id']);
                if ($_POST['mainEditor']) {
                    $st->bindValue(':sectioncode', $_POST['mainEditor']);
                } else {
                    $st->bindValue(':sectioncode', $newcontentcode);
                }
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Right') !== FALSE) {
                $st->bindValue(':sectionid', $clipsection['id']);
                if ($_POST['rightSidebarEditor']) {
                    $st->bindValue(':sectioncode', $_POST['rightSidebarEditor']);
                } else {
                    $st->bindValue(':sectioncode', $newcontentcode);
                }
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Footer') !== FALSE) {
                $st->bindValue(':sectionid', $clipsection['id']);
                if ($_POST['footerEditor']) {
                    $st->bindValue(':sectioncode', $_POST['footerEditor']);
                } else {
                    $st->bindValue(':sectioncode', $newcontentcode);
                }   
                $st->execute();
            }
        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
            include '../../includes/error.html.php';
            exit();
        }
    }
    
    unset($cliplayouts);
    
    try {
            $result = $pdo->query('SELECT id, cliplayoutname FROM cliplayout');
        } catch (PDOException $error) {
            $error = 'Error fetching clip layouts from database!';
            include '../../includes/error.html.php';
            exit();
        }

        foreach ($result as $row) {
            $cliplayouts[] = array(
                'id' => $row['id'],
                'cliplayoutname' => $row['cliplayoutname']
            );
        }

    exposeClipWithSections($firstClipId, $firstClipOrderNumber, $sequenceId, $singleClipSequence);

    //header('Location: .');
    //exit();
    include '../../templates/edit_tpl/clipedit.html.php';
    exit();
}


/* * ************** SAVE CLIP NAME AND UPDATE STATUS ****************** */

if (isset($_POST['clipname'])) {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    // UPDATE CLIP'S NAME ANS UPDATED STATUS

    try {

        $sql = 'UPDATE clip SET
                clipname = :clipname,
                updated = 0
                WHERE clip.id = :clip_id';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clipname', $_POST['clipname']);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
        include '../../includes/error.html.php';
        exit();
    }
}

/* * ********* DELETE CLIP AND ALL IT'S SECTIONS ********** */

if (isset($_GET['action']) and $_GET['action'] == 'Delete') {
    include'../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';  

    /*     * ******** FIRST : DELETE ALL SECTIONS OF THIS CLIP ********** */

    try {
        $sql = 'DELETE FROM section WHERE clipid = :clip_id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_GET['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
        include '../../includes/error.html.php';
        exit();
    }

    /*     * ******** SECOND : DELETE THIS CLIP ********** */
    try {
        $sql = 'DELETE FROM clip WHERE id = :clip_id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_GET['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error deleting jokes!';
        include '../../includes/error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

/************************** UPLOAD IMAGE FILES ************************/

if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];   
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    $extensions = array("jpeg","jpg","png"); 		
    if(in_array($file_ext,$extensions )=== false){
     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152){
    $errors[]='File size must be excately 2 MB';
    }				
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"../../media/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
    
    include '../../templates/edit_tpl/clipedit.html.php';
    exit();   
}


/* * ************** DISPLAY CLIPS LIST **************** */

include '../../includes/db.inc.php';
// include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

try {
    $result = $pdo->query('SELECT id, cliplayoutname FROM cliplayout');
} catch (PDOException $error) {
    $error = 'Error fetching clip layouts from database!';
    include '../../includes/error.html.php';
    exit();
}

foreach ($result as $row) {
    $cliplayouts[] = array(
        'id' => $row['id'],
        'cliplayoutname' => $row['cliplayoutname']
    );
}

try {
    $result = $pdo->query('SELECT clip.*, 
                           sequenceclip.sequenceid, sequenceclip.singleClipSequence,
                           sequenceclip.inSequenceNextClipId
                           FROM clip
                           JOIN sequenceclip ON clip.id = sequenceclip.inSequenceClipId
                           WHERE sequenceclip.singleClipSequence = 1
                           GROUP BY clip.id'); // WHERE sequenceclip.singleClipSequence = 1
} catch (PDOException $error) {
    $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
    include '../../includes/error.html.php';
    exit();
}

while ($row = $result->fetch()) {
    $clips[] = array(
        'id' => $row['id'],
        'clipname' => $row['clipname'],
        'clipdate' => $row['clipdate'],
        'cliplayout_id' => $row['cliplayoutid'],
        'nextClipId' => $row['inSequenceNextClipId'],
        'sequence_id' => $row['sequenceid'],
        'singleClip' => $row['singleClipSequence']
    );
}

include 'cliplist.html.php';
exit();
?>
