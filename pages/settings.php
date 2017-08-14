<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#display_edit").click(function(){
             $("#display_block").hide();
             $("#display_block_edit").show();
             $("#display_edit").hide();
		});
		$("#display_cancel").click(function(){
             $("#display_block").show();
             $("#display_block_edit").hide();
             $("#display_edit").show();
		});
		$("#email_edit").click(function(){
             $("#email_block").hide();
             $("#email_block_edit").show();
             $("#email_edit").hide();
		});
		$("#email_cancel").click(function(){
             $("#email_block").show();
             $("#email_block_edit").hide();
             $("#email_edit").show();
		});
		$("#password_edit").click(function(){
             $("#password_block").hide();
             $("#password_block_edit").show();
             $("#password_edit").hide();
		});
		$("#password_cancel").click(function(){
             $("#password_block").show();
             $("#password_block_edit").hide();
             $("#password_edit").show();
		});
		

		$(".submit").click(function(){
            var value = $(this).prev().find('input').val();
            var field = $(this).prev().find('input').attr('id');
            var user_id = $("#user_id").val();
            var parent_div = $("#"+field).closest("div").parent().attr("id");
            var disp_block = parent_div.replace("_edit", "");
            var edit_key = disp_block.replace("_block","_edit");
            $.ajax({
            type:'POST',
            dataType:'json',
            data:{field:field,user_id:user_id,value:value},
            url:'<?php echo site_url("account/update_settings");?>',
            success:function(response){
                if(response == 1)
                    $("#"+field).val(value);
                    $("#"+disp_block).find('p').text(value);
                    $("#"+disp_block).show();
                    $("#"+parent_div).hide();
                    $("#"+edit_key).show();
               }
            });   
        
		});

		$("#password_submit").click(function(){
			var old_password = $("#old_password").val();
			var db_password = $("#old_db_password").val();
			var password = $("#password").val();
			var new_password = $("#new_password").val();
			var user_id = $("#user_id").val();
            var error = 1;
			if(password !== new_password)
				$('#pass_error').html("password and confirm password must be equal").css('color','red');
            else{
            	$('#pass_error').html('');
            	error = 0;
            }
            if(error == 0)
            {
            	$.ajax({
		            type:'POST',
		            dataType:'json',
		            data:{field:'password',user_id:user_id,value:password,old_password:old_password,db_password:db_password},
		            url:'<?php echo site_url("account/update_settings");?>',
		            success:function(response){
		                if(response == '-1'){
		                   $("#password_block").hide();
			               $("#password_block_edit").show();
			               $("#password_edit").hide();
                           $('#pass_error').html("Old password was wrong").css('color','red');
		               }
		               else if(response == 1)
		               {
		               	  $('#pass_error').html("");
		               	  $("#password_block").show();
			               $("#password_block_edit").hide();
			               $("#password_edit").show();
		               	  $("#pass_mess").html('Password Changed successfuly').css('color','green');
		               	  window.location.reload();
		               }
		            }
		            });  
            }
		});

	});
</script>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<!-- main content container -->
<div class="container">
    <div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    <h1>Account Settings</h1>
		    <ul class="setmenu right-aligned">
				<li><a href="<?php echo site_url('account/notifications');?>">Email preferences</a></li>
				<li class="active"><a href="<?php echo site_url('account/settings');?>">General</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<h4>Display Name</h4>
	    	<div class="form-group">
	    		<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_detail[0]['id'];?>">
	     	</div>
	    	<div class="row">
	    		<div id="display_block" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    			<p><?php echo $user_detail[0]['displayname'];?></p>
	    		</div>
	    		<div id="display_block_edit" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none">
	    			<div class="form-group">
	    				<input type="text" class="form-control" name="displayname" id="displayname" value="<?php echo $user_detail[0]['displayname'];?>">
	    			</div>
	    			<input type="button" name="submit" class="btn btn-primary submit" id="display_submit" value="submit">
                	<input type="button" name="cancel" class="btn btn-default" id="display_cancel" value="cancel">
	    		</div>
	    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	     			<div><a id="display_edit" href="#" class="btn-link">Edit</a></div>
	     		</div>
	    	</div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<h4>Email</h4>
	    	<div class="row">
	    		<div id="email_block" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    			<p><?php echo $user_detail[0]['email'];?></p>
	    		</div>
	    		<div id="email_block_edit" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none">
	    			<div class="form-group">
	    				<input type="text" class="form-control" name="email" id="email" value="<?php echo $user_detail[0]['email'];?>">
	    			</div>
	    			<input type="button" name="submit" class="btn btn-primary submit" id="email_submit" value="submit">
                	<input type="button" name="cancel" class="btn btn-default" id="email_cancel" value="cancel">
	    		</div>
	    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	     			<div><a id="email_edit" href="#" class="btn-link">Edit</a></div>
	     		</div>
	    	</div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<h4>Password</h4>
	    	<div class="row">
	    		<div id="password_block" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    			<div id="pass_mess"></div>
	    			<p>***</p>
	    		</div>
	    		<div id="password_block_edit" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none">
	    			<div class="form-group">
	    				<label>Old Password</label>
			     	    <input class="form-control" type="password" name="old_password" id="old_password" value="">
			     	    <input class="form-control" type="hidden" name="old_db_password" id="old_db_password" value="<?php echo $user_detail[0]['password'];?>">
			     		<label>New Password</label>
			     		<input class="form-control" type="password" name="password" id="password" value="">  
			     		<label>Confirm Password</label>
			     		<input class="form-control" type="password" name="new_password" id="new_password" value="">   
			     	    <div id="pass_error"></div>
	    			</div>
	    			<input type="button" name="submit" class="btn btn-primary" id="password_submit" value="submit">
                <input type="button" name="cancel" class="btn btn-default" id="password_cancel" value="cancel">
	    		</div>
	    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	     			<div><a id="password_edit" href="#" class="btn-link">Edit</a></div>
	     		</div>
	    	</div>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	<h4>Social Account</h4>
	    	<?php if(!$user_detail[0]['has_facebook_link']) { ?>
	    	<p class="media-box">
	    	<img width="20px" class="media-image" src="<?php echo base_url();?>src/images/facebook.png" alt="Fb">
	    	<?php echo "Facebook is not linked with your Avvo account. " ?>
	    	<a href="#" style="color:#006699">Link</a> 
	    	</p> 
	    	<?php } ?>  
	    	<?php if(!$user_detail[0]['has_twitter_link']) { ?>
	    	<p class="media-box">
	    	<img width="20px" class="media-image" src="<?php echo base_url();?>src/images/twitter.png" alt="Tw">
	    	<?php echo "Twitter is not linked with your Avvo account. " ?>
	    	<a href="#" style="color:#006699">Link</a> 
	    	</p> 
	    	<?php } ?>  
	    	<?php if(!$user_detail[0]['has_linkedin_link']) { ?>
	    	<p class="media-box">
	    	<img width="20px" class="media-image" src="<?php echo base_url();?>src/images/linkedin.png" alt="LI">
	    	<?php echo "Linked In is not linked with your Avvo account. " ?>
	    	<a href="#" style="color:#006699">Link</a> 
	    	</p> 
	    	<?php } ?>  
	    	<?php if(!$user_detail[0]['has_google_link']) { ?>
	    	<p class="media-box">
	    	<img width="20px" class="media-image" src="<?php echo base_url();?>src/images/google.png" alt="G+">
	    	<?php echo "Google is not linked with your Avvo account. " ?>
	    	<a href="#" style="color:#006699">Link</a> 
	    	</p> 
	    	<?php } ?>
	    </div>
	</div>
</div>

<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
