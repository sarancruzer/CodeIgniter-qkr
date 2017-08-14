<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<!-- main content container -->
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="signin-txt">
	     <h1>Sign in</h1>
        <div class="signin-socio">
          <a class="fb" href="<?php echo site_url('auth/facebook') ?>"><i class="fa fa-facebook"></i> facebook</a>
          <a class="tw" href="<?php echo site_url('auth/twitter') ?>"><i class="fa fa-twitter"></i> Twitter</a>
          <a class="goo" href="<?php echo site_url('auth/google') ?>"><i class="fa fa-google"> Google</i></a>
          <a class="linkin" href="<?php echo site_url('auth/linkedin') ?>"><i class="fa fa-linkedin"></i> Linkedin</a>
        </div>
        <p>QuickR will never post any activity on your social networks without your permission</p>
        <p><span> Or, sign in with your existing QuickR account</span> </p>
        <p class="daccount"><a href="<?php echo site_url('account/register') ?>">Don't have an QuickR ? Register</a> </p>
      </div>

      <?php echo form_open('account/login'); ?>
      <ul class="signin">           
      <li>
        <label>Email <span class="required">*</span></label>
        <div class="field">
          <?php if($has_error) { ?><div class="error">Email / Password invalid.</div><?php } ?>
          <?php echo form_error('email', '<div class="error">', '</div>'); ?>
          <input type="Email" name="email" class="suffix-long" placeholder="Email" />
        </div>
      </li> 
      <li>
        <label>Password <span class="required">*</span></label>
        <div class="field">
          <?php echo form_error('password', '<div class="error">', '</div>'); ?>
          <input type="password" name="password" class="suffix-long" placeholder="Password" />
        </div>
      </li>         
      <li> <input type="checkbox" name="vehicle" value="Bike"> I Remember me</li>          
      <li><input type="submit" value="Submit"/></li>   
      </ul>
      </form>
      <div class="signin-txt">
        <p class="daccount"><a href="<?php echo site_url('account/forgot_password') ?>">Reset my password</a> </p>            
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="ru-lawyer-txt">
        <h1>Are you a Lawyer ?</h1>
        <p>If you are a lawyer, you can register while claiming your profile.(its all free !)</p>
        <ul>
          <li>Set yourself apart fromo your colleagues to attract new business</li>
          <li>Set yourself apart fromo your colleagues to attract new business</li>
          <li>Set yourself apart fromo your colleagues to attract new business</li>
        </ul>
        <div class="clm-pro-lnk"><a href="#">Claim your profile</a></div>           
      </div>
    </div>       
  </div>  
</div>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
