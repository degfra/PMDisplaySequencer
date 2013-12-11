</div><!-- container -->

         
        <input type="submit" name="action" value="Update" 
		style=" position: absolute; left: 1000px; top: 680px;"/> <!-- onClick="javascript: updateClip()" -->
	<input type="submit" name="action" value="Preview" 
		style=" position: absolute; left: 1000px; top: 730px;"/> <!-- onClick="javascript: previewClip()" -->
        
        <label for='cliplayout' name="cliplayout" 
               style=" position: absolute; left: 970px; top: 120px; 
                        font-size: 80%;" >Chose another layout :</label>
        <select name="cliplayout" id="cliplayout" style="width: 200px; 
                position: absolute; left: 970px; top: 140px; font-size: 80%;">
                    <option value="<?php echo $_POST['cliplayout_id']; ?>">Keep this layout</option>
                    <?php foreach ($cliplayouts as $cliplayout): ?>
                        <option value="<?php htmlout($cliplayout['id']); ?>"><?php htmlout($cliplayout['cliplayoutname']); ?></option>
                    <?php endforeach; ?>
                </select> 
        
        <label for='backgroundColor' name="backgroundColor" 
               style=" position: absolute; left: 970px; top: 180px; 
                        font-size: 80%;" >Choose the background color :</label>
	<input name="backgroundColor" class="color" value="<?php echo $clip['clipbackgroundcolor'];?>"
				style=" position: absolute; left: 970px; top: 200px;" />
        <input type="hidden" id="clip_id" name="clip_id" value="<?php echo $clip['id']; ?>" />
        <input type="hidden" id="cliplayout_id" name="cliplayout_id" value="<?php echo $_POST['cliplayout_id']; ?>" />
        <input type="hidden" id="sequence_id" name="sequence_id" value="<?php echo $_POST['sequence_id']; ?>" />
        <input type="hidden" id="singleClip" name="singleClip" value="<?php echo $_POST['singleClip']; ?>" />
        
    </form>

	<div style=" font-size: 80%; position: absolute; left: 970px; top: 240px;" >
                <!--
		<strong>Typographie : style CSS de bloc obligatoire</strong><br>
			font-size: 100%;  <br><br>
		<strong>Typographie : exemples de remplacement de la taille</strong><br>
			font-size: 140%;  <br>
			font-size: 70%;  <br><br>
		-->
                
                <input type="button" 
                       onclick="PopupCenter('../../filegator/', 'myPop1',900,700);"
                       value="Upload media via FileGator"/>
                
                 <!--          window.focus();'
                           value="Upload media via FileGator" />
                "PopupCenter('../../filegator/', 'myPop1',400,400);" href="javascript:void(0);
                ../../filegator/ -->
                
                
                <!--<strong><a href='javascript:window.open("../../filegator/");
                           window.focus();'>Upload media via FileGator</a></strong><br>  
                <form action="" method="POST" enctype="multipart/form-data"
                      style=" position: absolute; top: 365px;">
                    <input type="file" name="image"/>
                    <input type="submit"/>
                </form> -->
                <br>
		<strong>Set animation effects : <br>(Create a div first <br> and choose these as CSS class)</strong><br>
			animated fadeInLeftBig <br>
			animated fadeInRightBig <br>
			animated bounceInLeft <br>
			animated bounceInRight <br>
			animated bounceInDown <br>
			animated bounceOutDown <br>
			animated fadeIn <br>
			animated rollIn <br>
			animated rollOut <br>
			animated rotateInDownLeft <br>
			animated rotateOutDownRight <br>
			animated tada <br>
			animated pulse <br>
			animated wobble <br> <br>

		<strong>Set animation delay : <br>(CSS Style : in seconds)</strong><br>
			-moz-animation-duration: 3s; <br>
			animation-delay: 1.5s; <br><br>
               
                <p style=" position: absolute; top: 450px;"><strong>1.  </trong></p>
                
                <p style=" position: absolute; top: 500px;"><strong>2.  </trong></p>

               <input type="button" value="Return to Clips Management" 
						style=" position: absolute;top: 540px;"
						onClick="javascript: location='../clips/'"/>
		
	</div>

	<div id="sharedPath" ></div>
	
	<script type="text/javascript">
	//<![CDATA[

		// Create all editor instances at the end of the page, so we are sure
		// that the "bottomSpace" div is available in the DOM (IE issue).
                // 
                // Turn off automatic editor creation first.
                CKEDITOR.disableAutoInline = true;
    
                if (document.getElementById( 'headerEditor' )) {
                CKEDITOR.inline( 'headerEditor',
                            {
                                filebrowserBrowseUrl: '../../filegator/index.php',
                                
                                
                                // Removes the maximize plugin as it's not usable
				// in a shared toolbar.
                                extraPlugins: 'sharedspace',
                                // Removes the resizer as it's not usable in a
				// shared elements path.
                                removePlugins : 'floatingspace,resize',

                                sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath'
				}
                            }
				
                            );
                }
		
                if (document.getElementById( 'leftSidebarEditor' )) {
                CKEDITOR.inline( 'leftSidebarEditor',
                            {
                                filebrowserBrowseUrl: '../../filegator/index.php',
                                
                                
                                extraPlugins: 'sharedspace',
                                removePlugins : 'maximize,resize',
				
				sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath'
				}
                            }

                            );
                }

		if (document.getElementById( 'mainEditor' )) {
                CKEDITOR.inline( 'mainEditor',
                            {
                                filebrowserBrowseUrl: '../../filegator/index.php',
                                
                                
                                extraPlugins: 'sharedspace',
                                removePlugins : 'maximize,resize',
				
				sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath'
				}
                            }
			
                            );
                }
		
		if (document.getElementById( 'rightSidebarEditor' )) {
                CKEDITOR.inline( 'rightSidebarEditor',
                            {
                                filebrowserBrowseUrl: '../../filegator/index.php',
                                
                                
                                extraPlugins: 'sharedspace',
                                removePlugins : 'floatingspace,resize',
				
				sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath'
				}
                            }
			
                            );
                }

		if (document.getElementById( 'footerEditor' )) {
                CKEDITOR.inline( 'footerEditor',
                            {
                                filebrowserBrowseUrl: '../../filegator/index.php',
                                
                                
                                extraPlugins: 'sharedspace',
                                removePlugins : 'floatingspace,resize',
				
					sharedSpaces :
					{
						top : 'sharedToolbar',
						bottom : 'sharedPath'
					}
                            }	
			
                            );
                }
                                
	//]]>
	</script>
	
		
	<!-- JS
	================================================== -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='javascripts/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<script src="../../js/app.js"></script>
	
<!-- End Document
================================================== -->
</body>
</html>