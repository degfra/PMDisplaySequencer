<?php include '../../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->
    <head>

        <!-- Basic Page Needs
  ================================================== -->
        <meta charset="utf-8" />
        <title>Edit : <?php echo $clip['clipname']; ?></title>
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Mobile Specific Metas
  ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <!-- JS
  ================================================== -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="../../js/modernizr.js"></script>
        <script src="../../js/ckeditor/ckeditor.js"></script>
        <script src="../../js/jscolor/jscolor.js"></script>
        

        <script type="text/javascript">
            
            function previewClip() {
                
                window.open("?clip_id=<?php echo $clip['id']; ?>&action=Preview");
                window.focus();

            }
            /*
            function updateClip() {
                
                window.open("?clip_id=<?php echo $clip['id']; ?>&action=Update");
                window.focus();

            }*/
        </script>

        <!-- CSS
  ==================================================  -->
        <link rel="stylesheet" href="../../css/animate.min.css">
        <link rel="stylesheet" href="../../css/base.css">
        <link rel="stylesheet" href="../../css/skeleton_2sidebars_1920.css">
        <?php echo $clip['cliplayoutcssref']; ?>


    </head>
    <!-- <body scroll="no" style="overflow: hidden" leftmargin="0" topmargin="0"
            rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">  -->
    <body>

        <!-- Primary Page Layout
        ================================================== -->

        <!-- This <div> holds alert messages to be display in the sample page. -->
        <div id="alerts">
            <noscript>
            <p>
                <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
                support, like yours, you should still see the contents (HTML data) and you should
                be able to edit it normally, without a rich editor interface.
            </p>
            </noscript>
        </div>
        <div id="sharedToolbar"></div>

        <!-- <form  action="?Update" method="post"> -->
        <form  action="" method="get">

            <div class="container">