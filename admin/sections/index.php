<?php

/*
 * SECTIONS FACTORY for a submitted CLIP (:clip_id) in a given SESSION
 * 
 * CRUD FOR HEADERS, LEFTSIDEBARS, MAINS, RIGHTSIDEBARS AND FOOTERS
 * 
 */

include_once '../includes/magicquotes.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . /includes/magicquotes.inc.php';

/*
 * if type = header & action = create
 *      header = 'header name', '<header code>', :clip_id
 *      add to sectionsArray[0]
 *      save header into DB table header
 *      -- save sectionsArray into table clip column sections ? --
 */

/*
 * if type = header & action = update
 *      header = 'header name', '<header code>' WHERE clipid = :clip_id
 *      add to sectionsArray[0]
 *      update header into DB table header 
 */

/*
 * if type = header & action = delete
 *      header = 'header name', '<header code>' WHERE clipid = :clip_id
 *      remove from sectionsArray[0]
 *      delete header from DB table header 
 */

/*
 *  SAME FOR OTHER SECTIONS
 * 
 *  PRINCIPLE : sectionsArray positions -- BY CONVENTION
 *              HEADER    => [0]
 *              LEFTBAR   => [1]
 *              MAIN      => [2]
 *              RIGHTBAR  => [3]
 *              FOOTER    => [4]
 */

?>


