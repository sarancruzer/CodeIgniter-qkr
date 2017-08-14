<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<div class="clearfix"></div>

<script src="<?php echo base_url() ?>src/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<section class="main-profile-edit">
  <div class="container prof-container-box">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="m-title"><?php echo ucwords($name) ?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
        <figure> <img class="img-circle img-thumbnail" src="<?php echo base_url() ?>src/images/profile-img.jpg"> </figure>
      </div>
      <div class="col-lg-9 col-sm-9 col-md-9 col-xs-8 pro-box-view">
        <div class="pro-top-control">
          <div class="pull-left pro-back"> <a href="#">Back to Profile</a> </div>
          <div class="pull-right pro-control"> <a href="#">Edit View</a> | <a href="#">Public View</a> </div>
          <div class="clearfix"></div>
        </div>
        <h2>Photos &amp; Videos - <span>Upload</span></h2>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <figure class="img-box"> <i class="fa fa-picture-o"></i> </figure>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pro-p-box">
            <p>Sed tempus tincidunt purus nec dignissim. Maecenas mattis at eros sed tincidunt. Etiam vel nisi mi. Phasellus tellus tortor, rutrum eu dolor non, eleifend facilisis est. Vestibulum eu ante eget erat sodales luctus sed sit amet diam. </p>
            <a href="<?php echo base_url() ?>profile/media" class="btn btn-primary">Add Photos &amp; Videos</a> </div>
        </div>
        <h2>About Me <span><a href="#" id="open_form"><i class="fa fa-pencil"></i></a></span></h2>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pro-p-box" id="aboutme_text">
            <p>Sed tempus tincidunt purus nec dignissim. Maecenas mattis at eros sed tincidunt. Etiam vel nisi mi. Phasellus tellus tortor, rutrum eu dolor non, eleifend facilisis est. Vestibulum eu ante eget erat sodales luctus sed sit amet diam. </p>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pro-p-box" id="aboutme_edit" style="display:none">
             <form id="aboutme_form">
                <div class="form-group">
                  <textarea id="aboutme_box" name="aboutme" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default cancel">Cancel</button>                
             </form>
          </div>      
        </div>
      </div>
    </div>
  </div>
</section>


<script>
$('#open_form').click(function(e) { e.preventDefault(); $('#aboutme_text').hide(); $('#aboutme_edit').show(); CKEDITOR.replace('aboutme_box'); });
$('#aboutme_form .cancel').click(function(){ $('#aboutme_text').show(); $('#aboutme_edit').hide(); });
</script>

<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>
