<?php

include_once '../../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

/* * ******** CREATE NEW CLIP AND RELATED SECTIONS ********** */

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
                isLoop = "true",
                singleClip = "true"';

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

    while ($row = $result->fetch()) {
        $sectiontypes[] = array(
            'id' => $row['id'],
            'sectiontypename' => $row['sectiontypename'],
            'sectiontypecode' => $row['sectiontypecode']
        );
    }

    // CREATE RELATED SECTIONS 
    /*
      foreach ($sectiontypes[] as $row) {

      $name = $sectiontypes['sectiontypename'];

      if ($name == 'Header') {
      $headername = $name . " " . $lastclipid;
      }
      else if ($name == 'Left sidebar') {
      $leftbarname = $name . " " . $lastclipid;
      }
      else if ($name == 'Main area') {
      $mainname = $name . " " . $lastclipid;
      }
      else if ($name == 'Right sidebar') {
      $rightbarname = $name . " " . $lastclipid;
      }
      else if ($name == 'Footer') {
      $footername = $name . " " . $lastclipid;
      }

      } */

    foreach ($cliplayouts as $row) {

        if ($row['cliplayoutname'] == '2 Sidebars') {
            $layoutsections[] = array(
                'header' => $sectiontypes[0]['id'],
                'leftbar' => $sectiontypes[1]['id'],
                'mainarea' => $sectiontypes[2]['id'],
                'rightbar' => $sectiontypes[3]['id'],
                'footer' => $sectiontypes[4]['id']
            );
            
        } else if ($row['cliplayoutname'] == 'Left sidebar') {
            $layoutsections[] = array(
                'header' => $sectiontypes[0]['id'],
                'leftbar' => $sectiontypes[1]['id'],
                'mainarea' => $sectiontypes[2]['id'],
                'footer' => $sectiontypes[4]['id']
            );
        } else if ($row['cliplayoutname'] == 'Main area') {
            $layoutsections[] = array(
                'header' => $sectiontypes[0]['id'],
                'mainarea' => $sectiontypes[2]['id'],
                'footer' => $sectiontypes[4]['id']
            );
        }
        if ($row['cliplayoutname'] == 'Right sidebar') {
            $layoutsections[] = array(
                'header' => $sectiontypes[0]['id'],
                'mainarea' => $sectiontypes[2]['id'],
                'rightbar' => $sectiontypes[3]['id'],
                'footer' => $sectiontypes[4]['id']
            );
        }
    }

    foreach ($layoutsections as $layoutsection) {

        try {
            $sql = 'INSERT into section SET
                        sectionname = :sectionname,
                        sectioncode = :sectiontypecode,
                        sectiontypeid = :sectiontypeid,
                        clipid = :clipid';

            $s = $pdo->prepare($sql);
            
            $s->bindValue(':sectionname', $sectiontypes['sectiontypename'] . " " . $lastclipid);
            $s->bindValue(':sectiontypecode', $sectiontypes['sectiontypecode']);
            $s->bindValue(':sectiontypeid', $layoutsection);
            $s->bindValue(':clipid', $lastclipid);
            $s->execute();
            
        } catch (PDOException $error) {
            $error = $error->getMessage();   //getTraceAsString();   //'Error creating the new clip!';
            include '../../includes/error.html.php';
            exit();
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
