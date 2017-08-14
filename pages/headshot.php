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
        <h3 class="o-title">Upload your photo</h3>        
          <p>Photo requirements: JPG, GIF, or PNG, maximum file size is 5MB</p>
          <form class="form cust-forms" id="headshot_form" action="<?php echo base_url() ?>profile/headshot" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <p class="help-block no-mrg-btm">File Name (JPG, GIF or PNG)</p>
            <div class="field profile_photo"> 
              <div class="error"><?php foreach($this->upload->error_msg as $err) { echo '<p>'.$err.'</p>'; } ?></div>
              <input type="file" name="profile_photo">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          </form>
      </div>
    </div>
  </div>
</section>

<script>
$('#headshot_form .cancel').click(function(){ window.location = '<?php echo base_url() ?>profile/edit'; });

</script>

<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>
