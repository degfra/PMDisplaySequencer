<?php include '../../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 	

<html lang="en"> <!--<![endif]-->
    <head>

        <!-- Basic Page Needs
  ================================================== -->
        <meta charset="utf-8" />
        <title>DS - Preview : <?php echo $clip['clipname'] ?></title>
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
        <script type="text/javascript" src="../../js/clipTimer.js"></script> 

        <script>
            
            function countDown() {
                if (count <= 0) {
                    document.clipPreviewForm.submit();
                } else {
                    count--;
                    //document.getElementById("timer").innerHTML = " Il reste : " + count
                    +" secondes. ";
                    setTimeout("countDown()", 1000);
                }
              
            }
            /*
            function returnToEditor() {
                
                //window.location.assign("?clip_id=<?php echo $_POST['clip_id']; ?>&action=Edit");
                history.back();

            } */
            
        </script>

        <!-- CSS
  ==================================================   -->
        <link rel="stylesheet" href="../../css/animate.min.css">
        <link rel="stylesheet" href="../../css/base.css">
        <link rel="stylesheet" href="../../css/skeleton_2sidebars_1920.css">
        <?php echo $clip['cliplayoutcssref']; ?>
        
        <!--<style> 
        div#div2
        {
        margin:100px;
        transform:scale(0.5, 0.5);
        -ms-transform:scale(0.5, 0.5); /* IE 9 */
        -webkit-transform:scale(0.5, 0.5); /* Safari and Chrome */
        }
        </style> -->
        


    </head>
    <body scroll="no" style="overflow: hidden; background-color: #fff;" leftmargin="0" topmargin="0"
          rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"
          style="background-color: #fff;">
        
        <!--<?php   if ($_POST['action'] == 'Quickpreview') {
        
                echo('<div id="div2">');
               }
        ?>-->

        <!-- Primary Page Layout
        ================================================== -->

        <form name="clipPreviewForm" action="?Next_Clip" method="post">

            <div class="container" style="background-color:<?php echo $clip['clipbackgroundcolor'];?>">  <!-- style="<?php echo $clip['clipbackgroundcolor']; ?> -->