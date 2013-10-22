

<label for='clipname' style=' position: relative; left: 102%; top: -25%;' >Saisir le nom du Clip :</label>
<input type='text' name='clipname' style=' position: relative; left: 102%; top: -23%'/>
<input type='submit' value='Sauvegarder le Clip' style=' position: relative; left: 102%; top: -20%;'/>
<!---->	
</div><!--container-->

<input id='clipDuration' type='hidden' value="<?php htmlout($clip['clipDurationInSeconds']); ?>" />
<input id='clipOrderNumber'type="hidden" value="<?php htmlout($clip['clipOrderNumber']); ?>" />
<input id='nextClipUri'type="hidden" value="<?php htmlout($clip['nextClipUri']); ?>" />


</form>

<script type="text/javascript">
    var count = document.clipForm.clipDuration.value;
    countDown();
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