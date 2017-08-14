<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#forgot_from").validate({
			rules : {'email':true,required:true}
		})
	});
</script>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<div class="container">
    <section class="grid-area">
        <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('Success') != '') { ?>
		        <div class="row">
		          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
		            <div role="alert" class="alert alert-success alert-dismissible fade in">
		              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
		              <?php echo $this->session->flashdata('Success');?> 
		             </div>
		          </div>
		        </div>
		        <?php } ?>
		        <?php if($this->session->flashdata('Failure') != '') { ?>
		        <div class="row">
		          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
		            <div role="alert" class="alert alert-danger alert-dismissible fade in">
		              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
		              <?php echo $this->session->flashdata('Failure');?> 
		             </div>
		          </div>
		        </div>
		        <?php } ?>
            	<form name="forgot_from" id="forgot_from" action="<?php echo site_url('account/forgot_password'); ?>"  method="post">
					<ul class="signin">           
					    <li>
					      	<div class="form-group">
					        	<label>Email <span class="required">*</span></label>
					        		<input type="Email" name="email" id="email" class="suffix-long" placeholder="Email" />
					        </div>
					    </li> 
					    <li>
					     	<input type="hidden" id="return_url" name="return_url" value="<?php echo $referer_rul;?>">
					     	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Send"/>
					    </li> 
                    </ul>
				</form>
            </div>
        </div>
    </section>
</div>
<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>				    	