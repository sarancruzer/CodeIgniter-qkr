<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 endorse">
        <h3>Recommendations from fellow advisors help build client</h3>
        <?php form_open('profile/request_reviews') ?>
          <div class="form-group">
            <label for="email">Your email address</label>
            <input type="email" class="form-control" id="email" placeholder="">
          </div>
          <div class="form-group">
            <label for="emailone">Email address (50 emails max)</label>
            <p class="help-block">Duis eu ipsum id nisl scelerisque rutrum at rhoncus ante. Aenean convallis tortor eget lorem facilisis posuere</p>
            <textarea class="form-control" id="emailone"></textarea>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" placeholder="">
          </div>
          <div class="form-group">
            <label for="personal">Personal Message</label>
            <p class="help-block">Duis eu ipsum id nisl scelerisque rutrum at rhoncus ante. Aenean convallis tortor eget lorem facilisis posuere</p>
            <p class="help-block pull-right">(3580 Characters Remaining)</p>
            <textarea class="form-control" id="personal" rows="8"></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="">
                Send me a copy of this email </label>
            </div>
          </div>
          <div class="form-group"> <span class="label label-danger">* All fields required</span> </div>
          <button type="submit" class="btn btn-primary">Send endorsement request</button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
