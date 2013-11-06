<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';
include_once '../../includes/exposeClipWithSections-function.inc.php';

/* GLOBAL VARIABLES OF THIS CONTROLLER */

$s;
$clips;

/************ CREATE NEW CLIP AND RELATED SECTIONS ********** */

if (isset($_POST['action']) and $_POST['action'] == 'Add') {

    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    try {

        $sql = 'INSERT into clip SET
                clipname = :clipname,
                cliplayoutid = :cliplayoutid,
                clipbackgroundcolor = "#CCCCCC",
                clipDurationInSeconds = "4",
                clipOrderNumber = "1",
                isLoop = 1,
                singleClip = 1';

        $s = $pdo->prepare($sql);
        $s->bindValue(':clipname', $_POST['clipname']);
        $s->bindValue(':cliplayoutid', $_POST['cliplayout']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!';
        include '../../includes/error.html.php';
        exit();
    }

    $lastclipid = $pdo->lastInsertId();

    // FETCH THE TYPE OF LAYOUT
    try {
        $sql = 'SELECT 
                cliplayout.cliplayoutname,
                cliplayoutid FROM clip
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

    //include 'check_variables.html.php';
    //exit();

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

        //include 'check_variables.html.php';
        //exit();

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
                if ($layoutsection['mainareasection'] != null ) {
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
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    $returntoeditorbutton = '<p><input type="button" style=" position: absolute; left: 970px; top: 700px; "
                          value="Return to the Clip Editor" 
                          onclick="javascript: returnToEditor()"/></p>';
    
    try {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypewidth, sectiontype.sectiontypename, sectiontype.sectiontypecode,
                cliplayout.id, cliplayout.cliplayoutcssref,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            WHERE clip.id = :clip_id'
        ;

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
        include '../../includes/error.html.php';
        exit();
    } 

    exposeClipWithSections();

    if ($_POST['action'] == 'Preview') {
        //include 'clippreview.html.php';
        include '../../templates/preview_tpl/clippreview_styled.html.php';
        exit();
    }
    else if ($_POST['action'] == 'Edit') {
        include '../../templates/edit_tpl/clipedit.html.php';
        exit();
    }
}


if (isset($_GET['Next_Clip'])){
    
    /*********** IF SINGLE CLIP ***********/
    
    if ($_POST['singleClip']) { 
    
        $clips = array(
            'clipid' => $_POST['clip_id'],
            'cliplayoutcssref' => $_POST['cliplayoutcssref'],
            'clipname' => $_POST['clipname'],
            'clipduration' => $_POST['clipDuration'],
        );
        
        if ($_POST['updated']) { 
            include '../../templates/preview_tpl/endofeditpreview.html.php';
            exit();
        } 
        else {
            include '../../templates/preview_tpl/endofclippreview.html.php';
            exit();
        }
        
    }else {
                
        
        
    }
 
}


/* * ************** UPDATE CLIP AND RELATED SECTIONS ****************** */

if (isset($_POST['action']) and $_POST['action'] == 'Update') {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';
    
    // UPDATE CLIP'S BACKGROUND COLOR
    $hexa = '#';
    $color = $_POST['backgroundColor'];
    $clipbackgroundcolor = $hexa . $color;
    
    try {
        
        $sql = 'UPDATE clip SET
                clipbackgroundcolor = :clipbackgroundcolor,
                updated = 1
                WHERE clip.id = :clip_id';
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':clipbackgroundcolor', $clipbackgroundcolor);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        $s->execute();
        
    } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
            include '../../includes/error.html.php';
            exit();
    }
    
    // BUILD SUBMITTED CLIP'S LIST OF SECTIONS
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
    
    foreach ($s as $clipsection) {
        
       try {
            $sql = 'UPDATE section SET 
                    sectioncode = :sectioncode
                    WHERE section.id = :sectionid';

            $st = $pdo->prepare($sql);

            if (strpos($clipsection['sectionname'], 'Header') !== FALSE ) {               
                $st->bindValue(':sectionid', $clipsection['id']);
                $st->bindValue(':sectioncode', $_POST['headerEditor']);
                $st->execute();              
            } else if (strpos($clipsection['sectionname'], 'Left') !== FALSE ) {               
                $st->bindValue(':sectionid', $clipsection['id']);
                $st->bindValue(':sectioncode', $_POST['leftSidebarEditor']);
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Main') !== FALSE ) {               
                $st->bindValue(':sectionid', $clipsection['id']);
                $st->bindValue(':sectioncode', $_POST['mainEditor']);
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Right') !== FALSE ) {               
                $st->bindValue(':sectionid', $clipsection['id']);
                $st->bindValue(':sectioncode', $_POST['rightSidebarEditor']);
                $st->execute();
            } else if (strpos($clipsection['sectionname'], 'Footer') !== FALSE ) {               
                $st->bindValue(':sectionid', $clipsection['id']);
                $st->bindValue(':sectioncode', $_POST['footerEditor']);
                $st->execute();
            }

        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error fetching clip!';
            include '../../includes/error.html.php';
            exit();
        }
        
    }
    
    // FETCH ALL UPDATED SECTION CODES AND EXPOSE THEM TO REDISPLAY IN EDITOR
    try {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypewidth, sectiontype.sectiontypename, sectiontype.sectiontypecode,
                cliplayout.id, cliplayout.cliplayoutcssref,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            WHERE clip.id = :clip_id'
        ;

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_POST['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
        include '../../includes/error.html.php';
        exit();
    } 

    exposeClipWithSections();

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

/*********** DELETE CLIP AND ALL IT'S SECTIONS ***********/

if (isset($_GET['action']) and $_GET['action'] == 'Delete')
{
    include'../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';  
    
    /********** FIRST : DELETE ALL SECTIONS OF THIS CLIP ***********/
    
    try 
    {
       $sql = 'DELETE FROM section WHERE clipid = :clip_id';
       $s = $pdo->prepare($sql);
       $s->bindValue(':clip_id', $_GET['clip_id']);
       $s->execute();
    }
    catch (PDOException $error)
    {
       $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
       include 'error.html.php';
       exit(); 
    }
    
    /********** SECOND : DELETE THIS CLIP ***********/
    try 
    {
        $sql = 'DELETE FROM clip WHERE id = :clip_id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_GET['clip_id']);
        $s->execute();
    }
    catch (PDOException $error)
    {
       $error = $error->getMessage();   //getTraceAsString();   //'Error deleting jokes!';
       include 'error.html.php';
       exit(); 
    }
    
    header('Location: .');
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
    $result = $pdo->query('SELECT * FROM clip');
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
        'cliplayoutid' => $row['cliplayoutid']
    );
}

include 'cliplist.html.php';
exit();
?>
