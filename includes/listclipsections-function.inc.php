<?php

function listclipsections($lastclipid, $cliplayouts) {
    
    include 'db.inc.php';
    
     global  $cliplayouts;

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
              
                if ($_POST['action'] == 'Create'){
                    
                  $sql = 'INSERT INTO section SET
                  sectiontypeid = :sectiontypeid,
                  sectionname = :sectionname,
                  sectioncode = :sectiontypecode,

                  clipid = :clipid';
                  
                } else if ($_POST['action'] == 'Update') {
                    
                    $sql = 'UPDATE section SET
                  sectiontypeid = :sectiontypeid,
                  sectionname = :sectionname,
                  sectioncode = :sectiontypecode,

                  clipid = :clipid';
                    
                }

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

}