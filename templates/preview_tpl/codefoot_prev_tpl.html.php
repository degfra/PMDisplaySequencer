

<input type='hidden' name='clipname' value="<?php htmlout($clip['clipname']); ?>" style=' position: relative; left: 102%; top: -23%'/>
<input name='clipDuration' type='hidden' value="<?php htmlout($clip['clipDurationInSeconds']); ?>" />
<input name='clipOrderNumber'type="hidden" value="<?php htmlout($clip['clipOrderNumber']); ?>" />
<input name='nextClipUri'type="hidden" value="<?php htmlout($clip['nextClipUri']); ?>" />
<input type="hidden" id="clip_id" name="clip_id" value="<?php echo $clip['id']; ?>" />

<input type='submit' value="Next_Clip" style=' position: relative; left: 102%; top: -30%; '/>	
</form>

</div><!--container-->

<div style=" font-size: 100%; position: absolute; left: 970px; top: 600px;" >
    Your update is saved automatically.<br>
    Total duration : <?php htmlout($clip['clipDurationInSeconds']); ?> seconds
    <br> <br>
    Press F11 for FULL SCREEN
</div>

<script type="text/javascript">
    var count = document.clipPreviewForm.clipDuration.value;
    countDown();
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