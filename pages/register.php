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
        <h1>New User Registration</h1>
          <div class="signin-socio">
          <a class="fb" href="<?php echo site_url('auth/facebook') ?>"><i class="fa fa-facebook"></i> facebook</a>
          <a class="tw" href="<?php echo site_url('auth/twitter') ?>"><i class="fa fa-twitter"></i> Twitter</a>
          <a class="goo" href="<?php echo site_url('auth/google') ?>"><i class="fa fa-google"> Google</i></a>
          <a class="linkin" href="<?php echo site_url('auth/linkedin')?>"><i class="fa fa-linkedin"></i> Linkedin</a>
          </div>
          <p>QuickR will never post any activity on your social networks without your permission</p>
          <p><span> Or, create a QuickR only account</span> </p>
          <p class="daccount"><a href="#">Already have an account? Sign in</a></p>
      </div>

<?php echo form_open('account/register'); ?>
<ul class="signin">  
    <li>
        <label>First name (optional)<span class=""></span></label>
        <div class="field">
        <?php echo form_error('firstname', '<div class="error">', '</div>'); ?>
        <input type="text" name="firstname" class="suffix-long" placeholder="First name" value="<?php echo set_value('firstname'); ?>"/>
        </div>
    </li> 
    <li>
        <label>Email address<span class="required">*</span></label>
        <div class="field">
        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
        <input type="text" name="email" class="suffix-long" placeholder="Email address" value="<?php echo set_value('email'); ?>"/>
        </div>
    </li>     
    <li>
        <label>Password (must be atleast six characters)<span class="required"> *</span></label>
        <div class="field">
        <?php echo form_error('password', '<div class="error">', '</div>'); ?>
        <input type="password" name="password" class="suffix-long" placeholder="Password" value="<?php echo set_value('password'); ?>"/>
        </div>
    </li> 
    <li>          
        <label>Confirm password<span class="required"> *</span></label>        
        <div class="error-field">
        <?php echo form_error('confirm', '<div class="error">', '</div>'); ?>
        <input type="password" name="confirm" class="suffix-long" placeholder="Confirm password" value="<?php echo set_value('confirm'); ?>"/>
        </div>
    </li>     
    <li> 
    <p>I understand and agree that by clicking "Accept terms and continue" I am indicating that I have read and accept the <a href="">QuickR Terms of Use.</a></P>
    </li>
    <li>
        <input type="submit" value="Accept terms and continue" />       
    </li>   
    <li>
      <p>See our <a href="">Privacy Policy</a> for information on how we collect, use, and share information you provide to us.</p>
    </li>
</ul>
</form>
    </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           		<div class="ru-lawyer-txt">
                <h1>Register with Quickr to</h1>
                <ul>
                	<li>Post reviews of Financial Advisers.</li>
                    <li>Save questions and articles in one place.</li>
                    <li>Get notified when your questions are answered.</li>
                </ul>                
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
