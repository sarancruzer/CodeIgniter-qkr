<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<!-- main content container -->

<div class="container-fluid">
	<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="crt-prof-txt">    
                <h1>Enter your financial advisory license information</h1>
                <p>After QuickR confirms your license status, your profile will be included in our
            directory and search results.</p>
                <div class="alert alert-info"><strong>Note :</strong> After QuickR confirms your license status, your profile will be included in our
            directory and search results.</div>
		</div>
<?php echo form_open('add-fa-profile'); ?>
<ul class="crt-profile">
    <li>
        <label>First Name <span class="required">*</span></label>
        <div class="field">
            <?php echo form_error('fa[firstname]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[firstname]" class="suffix-long" placeholder="First name" value="<?php echo set_value('fa[firstname]'); ?>" />
        </div>
    </li>
    <li>
        <label>Middle name </label>
        <div class="field">
            <?php echo form_error('fa[middlename]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[middlename]" class="suffix-long" placeholder="Middle name" value="<?php echo set_value('fa[middlename]'); ?>"/>
        </div>
    </li>
    <li>
        <label>Last name <span class="required">*</span></label>
        <div class="field">
            <?php echo form_error('fa[lastname]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[lastname]" class="suffix-long" placeholder="Last name" value="<?php echo set_value('fa[lastname]'); ?>" />
        </div>
    </li>
    <li>
        <label>Company address line 1 <span class="required">*</span></label>
        <div class="field">
            <?php echo form_error('fa[address1]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[address1]" class="suffix-long" placeholder="Company address line 1" value="<?php echo set_value('fa[address1]'); ?>"/>
        </div>
    </li>
    <li>
        <label>Company address line 2 </label>
        <div class="field">
            <?php echo form_error('fa[address2]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[address2]" class="suffix-long" placeholder="Company address line 2" value="<?php echo set_value('fa[address2]'); ?>"/>
        </div>
    </li>
    <li>
        <label>Company address line 3 </label>
        <div class="field">
            <?php echo form_error('fa[address3]', '<div class="error">', '</div>'); ?>
            <input type="text" name="fa[address3]" class="suffix-long" placeholder="Company address line 3" value="<?php echo set_value('fa[address3]'); ?>"/>
        </div>
    </li>
    <li>
        <div class="cty">
            <label>City<span class="required">*</span></label><br>
            <div class="field">
                <?php echo form_error('fa[city]', '<div class="error">', '</div>'); ?>
                <input type="text" name="fa[city]" class="field-long" placeholder="City" value="<?php echo set_value('fa[city]'); ?>"/>
            </div>
        </div>
        <div class="state">
            <label>County<span class="required">*</span></label><br>
            <div class="field">
              <?php echo form_error('fa[county]', '<div class="error">', '</div>'); ?>
              <select name="fa[county]" class="field-select">
                <option>Select county</option>
                <?php foreach($counties as $county) { ?>
                <option value="<?php echo $county['id'] ?>"><?php echo $county['name'] ?></option>
                <?php } ?> 
              </select>
            </div>
        </div>
    </li>
    
    <li>
        <div class="zip">
            <label>Postal code</label><br>
            <div class="field">
                <?php echo form_error('fa[postalcode]', '<div class="error">', '</div>'); ?>
                <input type="text" name="fa[postalcode]" class="field-long" placeholder="Postal code" value="<?php echo set_value('fa[postalcode]'); ?>"/>
            </div>
        </div>
        <div class="phone-num">
            <label>Phone Number<span class="required">*</span></label><br>
            <div class="field">
                <?php echo form_error('fa[phonenumber]', '<div class="error">', '</div>'); ?>
                <input type="text" name="fa[phonenumber]" class="field-long" placeholder="Phone Number" value="<?php echo set_value('fa[phonenumber]'); ?>"/>
            </div>
        </div>
    </li> 
    
    <li>            
        <legend><b>Licence Details</b></legend>
    </li>
    <li>
        <div class="function">     
            <label>Controlled function <span class="required">*</span></label>        
            <div class="field">
                <?php echo form_error('controller_function', '<div class="error">', '</div>'); ?>
                <select name="controlled_function" class="field-select">
                    <option value="Alabama">Alabama</option>
                    <option value="Newyork">Newyork</option>
                    <option value="Boston">Boston</option>
                </select>
            </div>
        </div> 
        <div class="firm">
            <label>Firm name<span class="required">*</span></label>
            <div class="field">
                <?php echo form_error('firmname', '<div class="error">', '</div>'); ?>
                <input type="text" name="firmname" class="field-long" placeholder="Firm name" />
            </div>
        </div>
    </li>
    <li>
        <div class="start-date">
            <label>License start date<span class="required">*</span></label>
            <div class="field">
                <?php echo form_error('startdate', '<div class="error">', '</div>'); ?>
                <input type="text" name="startdate" class="field-long" placeholder="MM/DD/YYYY" />
            </div>
        </div>
        <div class="end-date">
            <label>License end date<span class="required">*</span></label>
            <div class="field">
                <?php echo form_error('enddate', '<div class="error">', '</div>'); ?>
                <input type="text" name="enddate" class="field-long" placeholder="MM/DD/YYYY" />
            </div>
        </div>
    </li>
    <li>
    	<div class="ldr-radio">
            <label>Verify disciplinary history</label>
            <div class="field">
              <?php echo form_error('fa[disciplinary]', '<div class="error">', '</div>'); ?>
              <input type="radio" name="fa[disciplinary]" value="0"> I have never been sanctioned by a licensing authority.
              <br>
              <input type="radio" name="fa[disciplinary]" value="1"> I have been sanctioned by a licensing authority.
            </div>
        </div>    
    </li> 
    <li>
<div class="crt-prof-txt">
<p>QucikR verifies and updated records of final discipline in most jurisdictions.<br>If your licensing records reflect the imposition of discipline, select the "I have been sanctioned by a state licensing authority" option above.</p>
<P>Licensed in other states? <a href="">Add another license</a></P>
<h2>Sign in to QuickR</h2>
<div class="signin-socio">
          <a class="fb" href="/auth/facebook"><i class="fa fa-facebook"></i> facebook</a>
          <a class="tw" href="/auth/twitter"><i class="fa fa-twitter"></i> Twitter</a>
          <a class="goo" href="/auth/google"><i class="fa fa-google"> Google</i></a>
          <a class="linkin" href="/auth/linkedin"><i class="fa fa-linkedin"></i> Linkedin</a>
          </div>
<p>QuickR will never post any activity on your social networks without your permission</p>
</div>
    </li>
    <li>
    	<div class="signin-radio">
            <label>Or</label>
            <div class="field">
            <?php echo form_error('have_acc', '<div class="error">', '</div>'); ?>
            <input type="radio" name="have_acc" value="0"<?php if($sltd_frm == '0') echo ' checked' ?>> Create an account - more.&nbsp;            
            <input type="radio" name="have_acc" value="1"<?php if($sltd_frm == '1') echo ' checked' ?>> I have a QuickR account
            </div>
     </div>    
    </li>
</ul>
<ul class="crt-profile" id="register-form"<?php if($sltd_frm == '1') { ?> style="display:none"<?php } ?>>
    <li>
        <label>Email</label>
        <div class="field">
            <?php echo form_error('register[email]', '<div class="error">', '</div>'); ?>        
            <input type="Email" name="register[email]" class="suffix-long" placeholder="Email" value="<?php echo set_value('register[email]'); ?>"/>
        </div>
    </li> 
    <li>
        <label>Password (atleast must be 10 characters)</label>
        <div class="field">
            <?php echo form_error('register[password]', '<div class="error">', '</div>'); ?>        
            <input type="password" name="register[password]" class="suffix-long" placeholder="Password" />
        </div>
    </li> 
    <li>
        <label>Confirm Password </label>
        <div class="field">
            <?php echo form_error('register[confirm]', '<div class="error">', '</div>'); ?>        
            <input type="password" name="register[confirm]" class="suffix-long" placeholder="Confirm password" />
        </div>
    </li>
    <li>
    	<img src="<?php echo base_url();?>src/images/confirm-iimg.jpg">
    </li>
    <li>
        <label>Enter the Verification Code (Not Casesensitive) </label>
        <div class="field">
            <?php echo form_error('captcha', '<div class="error">', '</div>'); ?>        
            <input type="text" name="captcha" class="suffix-long" placeholder="Enter Code" />
        </div>
    </li> 
</ul>

<ul class="signin" id="signin-form"<?php if($sltd_frm == '0') { ?> style="display:none"<?php } ?>>  
    <li>
        <label>Email address<span class="required">*</span></label>
        <div class="field">
        <?php if($has_error) { ?><div class="error">Email / Password invalid.</div><?php } ?>
        <?php echo form_error('signin[email]', '<div class="error">', '</div>'); ?>
        <input type="text" name="signin[email]" class="suffix-long" placeholder="Email address" value="<?php echo set_value('signin[email]'); ?>"/>
        </div>
    </li>     
    <li>
        <label>Password <span class="required"> *</span></label>
        <div class="field">
        <?php echo form_error('signin[password]', '<div class="error">', '</div>'); ?>
        <input type="password" name="signin[password]" class="suffix-long" placeholder="Password"/>
        </div>
    </li> 
    <li><a href="<?php echo base_url() ?>account/forgot_password">I forgot my password.</a></li>     
</ul>

<ul class="crt-profile">
    <li><p>I Understand and agree that by clicking "Accept terms and continue" I am indicating that i have read and accept the QuickR Terms of Use.</p>
    </li>
    <li>
        <input type="submit" value="Accept terms and continue"/>
        <input type="button" value="Cancel" />
    </li>
</ul>
</form>

<div class="crt-prof-txt"><p>See our Privacy Policy for information on how we collect, use, and share
information you provide to us.</p></div>
  	 	
    </div>    
    </div>   
    
</div>
<!-- main content container -->
<script>
 $('input[name=have_acc]').change(function(){ var sltd = $('input[name=have_acc]:checked').val(); if(sltd == '0'){ $('#register-form').show(); $('#signin-form').hide(); } else if(sltd == '1'){ $('#register-form').hide(); $('#signin-form').show(); } });
</script>

<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->
</body>
</html>
