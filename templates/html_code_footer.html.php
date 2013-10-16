</div><!-- container -->
	
	<input type="submit" value="1. Appliquer les changements" style=" position: absolute; left: 970px; top: 120px;"/>
	<input type="button" value="2. Aperçu du Clip" 
						style=" position: absolute; left: 970px; top: 160px;"
						onClick="javascript: previewClip()"/>
	<!--
        <form:label  path="backgroundColor" style=" position: absolute; left: 970px; top: 230px; font-size: 100%;" >Choisir la couleur de fond :</form:label>
	<form:input path="backgroundColor" class="color" value="${backgroundColor}"
				style=" position: absolute; left: 970px; top: 250px;" />
        -->	
 
	</form:form>
	
        <!--
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
			animation-delay: 1.5s; <br><br>
			
		<strong>Vidéos : <br>
			Bouton Source : coller le code embed Youtube
			et appondre à l'Url l'attribut :</strong><br>
			?&amp;autoplay=1 <strong> et supprimer le tag p</strong>
		
	</div>
	-->
        
	<div id="sharedPath" />
	
	<script type="text/javascript">
	//<![CDATA[

		// Create all editor instances at the end of the page, so we are sure
		// that the "bottomSpace" div is available in the DOM (IE issue).

		CKEDITOR.replace( 'headerEditor',
			{
				sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath'
				},

				// Removes the maximize plugin as it's not usable
				// in a shared toolbar.
				// Removes the resizer as it's not usable in a
				// shared elements path.
				removePlugins : 'maximize,resize',
				height : '20'
			} );

		CKEDITOR.replace( 'mainEditor',
			{
				sharedSpaces :
				{
					top : 'sharedToolbar',
					bottom : 'sharedPath',
				},

				// Removes the maximize plugin as it's not usable
				// in a shared toolbar.
				removePlugins : 'maximize',
				height : '605'
			} );
		
		CKEDITOR.replace( 'footerEditor',
				{
					sharedSpaces :
					{
						top : 'sharedToolbar',
						bottom : 'sharedPath',
					},

					// Removes the maximize plugin as it's not usable
					// in a shared toolbar.
					removePlugins : 'maximize',
					height : '20'
				} );
	//]]>
	</script>
	
	
		
	<!-- JS
	================================================== -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='javascripts/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<script src="resources/css/js/app.js"></script>
	
<!-- End Document
================================================== -->
</body>
</html>