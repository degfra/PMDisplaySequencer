</div><!-- container -->
	
	<input type="submit" value="1. Appliquer les changements" style=" position: absolute; left: 970px; top: 120px;"/>
	<input type="button" value="2. Aperçu du Clip" 
						style=" position: absolute; left: 970px; top: 160px;"
						onClick="javascript: previewClip()"/>
        
	<label for='backgroundColor' name="backgroundColor" style=" position: absolute; left: 970px; top: 230px; font-size: 100%;" >Choisir la couleur de fond :</label>
	<input name="backgroundColor" class="color" value="<?php echo $clip['clipbackgroundcolor'];?>"
				style=" position: absolute; left: 970px; top: 250px;" />
	
	</form>

	<div style=" font-size: 100%; position: absolute; left: 970px; top: 300px;" >
	
		<strong>Typographie : style CSS de bloc obligatoire</strong><br>
			font-size: 100%;  <br><br>
		<strong>Typographie : exemples de remplacement de la taille</strong><br>
			font-size: 140%;  <br>
			font-size: 70%;  <br><br>
		
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
			animation-delay: 1.5s; <br>
		
	</div>

	<div id="sharedPath" ></div>
	
	<script type="text/javascript">
	//<![CDATA[

		// Create all editor instances at the end of the page, so we are sure
		// that the "bottomSpace" div is available in the DOM (IE issue).
                // 
                // Turn off automatic editor creation first.
                CKEDITOR.disableAutoInline = true;
    
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
                                
	//]]>
	</script>
	
		
	<!-- JS
	================================================== -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='javascripts/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<script src="../../css/js/app.js"></script>
	
<!-- End Document
================================================== -->
</body>
</html>