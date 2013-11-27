</div><!-- container -->

         
        <input type="submit" name="action" value="Update" 
		style=" position: absolute; left: 1000px; top: 680px;"/> <!-- onClick="javascript: updateClip()" -->
	<input type="submit" name="action" value="Preview" 
		style=" position: absolute; left: 1000px; top: 730px;"/> <!-- onClick="javascript: previewClip()" -->
        
        <label for='backgroundColor' name="backgroundColor" style=" position: absolute; left: 970px; top: 120px; font-size: 80%;" >Choisir la couleur de fond :</label>
	<input name="backgroundColor" class="color" value="<?php echo $clip['clipbackgroundcolor'];?>"
				style=" position: absolute; left: 970px; top: 140px;" />
        <input type="hidden" id="clip_id" name="clip_id" value="<?php echo $clip['id']; ?>" />
        <input type="hidden" id="sequence_id" name="sequence_id" value="<?php echo $_POST['sequence_id']; ?>" />
        <input type="hidden" id="singleClip" name="singleClip" value="<?php echo $_POST['singleClip']; ?>" />
        
    </form>

	<div style=" font-size: 80%; position: absolute; left: 970px; top: 200px;" >
                <!--
		<strong>Typographie : style CSS de bloc obligatoire</strong><br>
			font-size: 100%;  <br><br>
		<strong>Typographie : exemples de remplacement de la taille</strong><br>
			font-size: 140%;  <br>
			font-size: 70%;  <br><br>
		-->
		<strong>Effets d'animation : <br>(class CSS à configurer en dernier)</strong><br>
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

		<strong>Durée et délai d'animation : <br>(Style : en secondes)</strong><br>
			-moz-animation-duration: 3s; <br>
			animation-delay: 1.5s; <br><br>
               
                <p style=" position: absolute; top: 490px;"><strong>1.  </trong></p>
                
                <p style=" position: absolute; top: 540px;"><strong>2.  </trong></p>

               <input type="button" value="Return to Clips Management" 
						style=" position: absolute;top: 590px;"
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