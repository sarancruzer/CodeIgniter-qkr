<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<div class="clearfix"></div>

<section class="form-container">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12">
        <h3 class="o-title">Add a photo or video to your profile</h3>        
          <div class="form-group">
            <label class="radio-inline">
              <input type="radio" name="photo_source" id="inlineRadio1" value="computer" checked>
              Photo from computer </label>
            <label class="radio-inline">
              <input type="radio" name="photo_source" id="inlineRadio2" value="web">
              Photo from Web </label>
            <label class="radio-inline">
              <input type="radio" name="photo_source" id="inlineRadio3" value="video">
              Video from Web </label>
          </div>
          <form class="form cust-forms" id="comp_form" method="post" action="<?php echo site_url('media'); ?>">
          <div class="form-group">
            <div class="field">              
              <p class="help-block no-mrg-btm">File Name (JPG, GIF or PNG)</p>
              <div class="error"></div>
              <input type="file" name="image">
            </div> 
          </div>
          <button type="submit" class="btn btn-primary" name="photo">Upload</button>
          <button type="button" class="btn btn-default">Cancel</button>
          </form>
          <form class="form cust-forms" id="web_form" method="post" action="<?php echo site_url('media'); ?>">
          <div class="form-group">
            <div class="field">
              <p class="help-block no-mrg-btm">Enter your photo url</p>
              <div class="error"></div>
              <input type="text" name="photo_url" class="form-control">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="web">Save</button>
          <button type="button" class="btn btn-default">Cancel</button>
          </form>
          <form class="form cust-forms" id="video_form" method="post" action="<?php echo site_url('media'); ?>">
          <div class="form-group">
            <div class="field">
              <p class="help-block no-mrg-btm">Enter youtube or vimeo url</p>
              <div class="error"></div>
              <input type="text" name="video_url" class="form-control">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="video">Save</button>
          <button type="button" class="btn btn-default">Cancel</button>
          </form>

      </div>
    </div>
  </div>
</section>

<script>
$('#inlineRadio1').change(function(){ if($(this).is(':checked')){ $('#web_form').hide(); $('#video_form').hide(); $('#comp_form').show(); } });
$('#inlineRadio2').change(function(){ if($(this).is(':checked')){ $('#web_form').show(); $('#video_form').hide(); $('#comp_form').hide(); } });
$('#inlineRadio3').change(function(){ if($(this).is(':checked')){ $('#web_form').hide(); $('#video_form').show(); $('#comp_form').hide(); } });
</script>

<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>
