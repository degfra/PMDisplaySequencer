<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

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
                'mainareasection' => 'mainarea',
                'rightbarsection' => 'rightbar',
                'footersection' => 'footer'
            );
        }
        if ($cliplayout['cliplayoutname'] == 'Left sidebar') {
            $layoutsections[] = array(
                'headersection' => 'header',
                'leftbarsection' => 'leftbar',
                'mainareasection' => 'mainarea',
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
                'mainareasection' => 'mainarea',
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
                if ($layoutsection['mainareasection'] != null) {
                    
                    $s->bindValue(':sectiontypeid', $mainsectiontypeid);
                    $s->bindValue(':sectionname', $mainsectionname);
                    $s->bindValue(':sectiontypecode', $mainsectioncode);

                    $s->bindValue(':clipid', $lastclipid);

                    $s->execute();
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

/* * ******** PREVIEW CLIP ********** */

if (isset($_GET['action']) and $_GET['action'] == 'Preview') {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    try {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypecode,
                cliplayout.id, cliplayout.cliplayoutcssref,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            WHERE clip.id = :clip_id'
        ;

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_GET['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
        include 'error.html.php';
        exit();
    }


    foreach ($s as $row) {

        if ($row['sectiontypename'] == 'codehead') {
            $codehead = $row['sectioncode'];
        }

        if ($row['sectiontypename'] == 'Header') {
            $headercode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Left sidebar') {
            $leftbarcode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Main area') {
            $mainareacode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Right sidebar') {
            $rightbarcode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Footer') {
            $footercode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'codefoot') {
            $codefoot = $row['sectioncode'];
        }
    }

    $previewedclips[] = array(
        'id' => $row['id'],
        'clipname' => $row['clipname'],
        'cliplayoutcssref' => $row['cliplayoutcssref'],
        'clipDurationInSeconds' => $row['clipDurationInSeconds'],
        'clipOrderNumber' => $row['clipOrderNumber'],
        'nextClipUri' => $row['nextClipUri'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],
        'codehead' => $codehead,
        'headercode' => $headercode,
        'leftbarcode' => $leftbarcode,
        'mainareacode' => $mainareacode,
        'rightbarcode' => $rightbarcode,
        'footercode' => $footercode,
        'codefoot' => $codefoot
    );

    //include 'clippreview.html.php';
    include 'clippreview_styled.html.php';
    exit();
}


/* * ******** EDIT CLIP ********** */

if (isset($_GET['action']) and $_GET['action'] == 'Edit') {
    include '../../includes/db.inc.php';
    // include $_SERVER['DOCUMENT_ROOT'] .'/includes/db.inc.php';

    try {
        $sql = 'SELECT 
                section.sectioncode, 
                sectiontype.id, sectiontype.sectiontypename, sectiontype.sectiontypecode,
                cliplayout.id, cliplayout.cliplayoutcssref,
                clip.*
                            FROM clip
                            JOIN section ON clip.id = section.clipid
                            JOIN sectiontype ON sectiontype.id = section.sectiontypeid
                            JOIN cliplayout ON cliplayout.id = clip.cliplayoutid
                            WHERE clip.id = :clip_id'
        ;

        $s = $pdo->prepare($sql);
        $s->bindValue(':clip_id', $_GET['clip_id']);
        $s->execute();
    } catch (PDOException $error) {
        $error = $error->getMessage();   //getTraceAsString();   //'Error removing joke from categories!';
        include 'error.html.php';
        exit();
    }


    foreach ($s as $row) {

        if ($row['sectiontypename'] == 'codehead') {
            $codehead = $row['sectioncode'];
        }

        if ($row['sectiontypename'] == 'Header') {
            $headercode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Left sidebar') {
            $leftbarcode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Main area') {
            $mainareacode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Right sidebar') {
            $rightbarcode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'Footer') {
            $footercode = $row['sectioncode'];
        } else if ($row['sectiontypename'] == 'codefoot') {
            $codefoot = $row['sectioncode'];
        }
    }

    $previewedclips[] = array(
        'id' => $row['id'],
        'clipname' => $row['clipname'],
        'cliplayoutcssref' => $row['cliplayoutcssref'],
        'clipDurationInSeconds' => $row['clipDurationInSeconds'],
        'clipOrderNumber' => $row['clipOrderNumber'],
        'nextClipUri' => $row['nextClipUri'],
        'clipbackgroundcolor' => $row['clipbackgroundcolor'],
        'codehead' => $codehead,
        'headercode' => $headercode,
        'leftbarcode' => $leftbarcode,
        'mainareacode' => $mainareacode,
        'rightbarcode' => $rightbarcode,
        'footercode' => $footercode,
        'codefoot' => $codefoot
    );

    include 'clipedit.html.php';
    exit();
}

/* * ************** UDATE CLIP AND RELATED SECTIONS ****************** */


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
