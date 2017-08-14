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
            var value = $(this).parent().prev().find('input').val();
            var field = $(this).parent().prev().find('input').attr('id');
            var user_id = $("#user_id").val();
            var parent_div = $("#"+field).closest("div").parent().attr("id");
            var disp_block = parent_div.replace("_edit", "");
            $.ajax({
            type:'POST',
            dataType:'json',
            data:{field:field,user_id:user_id,value:value},
            url:'<?php echo site_url("account/update_settings");?>',
            success:function(response){
                if(response == 1)
                    $("#"+field).val(value);
                    $("#"+disp_block).find('div').text(value);
                    $("#"+disp_block).show();
                    $("#"+parent_div).hide();
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Account Settings</h1>
            <ul class="setmenu right-aligned">
        		<li class="active"><a href="<?php echo site_url('account/notifications');?>">Email preferences</a></li>
        		<li ><a href="<?php echo site_url('account/settings');?>">General</a></li>
        	</ul>
        </div>
    </div>
</div>
<div class="container">
    <form class="form cust-forms" name="notification" id="notification" method="post" action="<?php echo site_url('account/save_notifications');?>">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2>General Email</h2>
            
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                <section class="form-container">
                    <div class="form-group">
                        <i class="fa fa-tasks fa-2x pull-left"></i>
                        <div class="pull-left"><h3 class="m-title">Activity-Related Emails</h3></div>
                        <br/><br/>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="activity_mail" id="activity_mail" value="1" <?php if(isset($notifications[0]['activity_mail']) && $notifications[0]['activity_mail'] == 1)echo 'checked="checked"';?> >
                                Get activity-related emails. For example: if you ask a legal question, we'll follow up with a list of recommended attorneys in your area.
                            </label>
                        </div>
                    </div>

                    <div class="clearfix "></div>

                    <div class="form-group">
                        <i class="fa fa-bell-o fa-2x pull-left"></i>
                        <div class="pull-left"><h3 class="m-title">Quickr Announcements</h3></div>
                        <br/><br/>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="announcement" id="announcement" value="1" <?php if(isset($notifications[0]['announcement']) && $notifications[0]['announcement'] == 1)echo 'checked="checked"';?>>
                                Receive occasional announcements about special promotions and new features on the site.
                            </label>
                        </div>
                    </div>

                    <div class="clearfix "></div>

                    <div class="form-group">
                        <i class="fa fa-comment fa-2x pull-left"></i>
                        <div class="pull-left"><h3 class="m-title">Feed Back</h3></div>
                        <br/><br/>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="feedback" id="feedback" value="1" <?php if(isset($notifications[0]['feedback']) && $notifications[0]['feedback'] == 1)echo 'checked="checked"';?>>
                                Receive occasional surveys to let us know what you think of your Quickr experience.
                            </label>
                        </div>
                    </div>
                </section>

                <div class="clearfix "></div>

                <section class="form-container">
                    <div class="form-group">
                        <div ><h3 class="m-title">Survival Guides</h3>
                        
                        <p>Our survival guides are designed to help you navigate the legal waters for each of the topics listed below.</p>
                        </div>
                         <?php 
                         $survival= array();
                         
                         if(isset($notifications[0]['survival']) && $notifications[0]['survival'] != NULL)
                         { 
                            $survival = explode(',', $notifications[0]['survival']); 
                          }
                          
                           foreach($sp_area as $area) {
                            ?>
                            <div class="checkbox">
                            <label><input type="checkbox" name="survival[]" id="survival_<?php echo $area['id'];?>" value="<?php echo $area['id'];?>" <?php if(!empty($survival) && in_array($area['id'],$survival)) echo 'checked="checked"'; ?>><?php echo $area['name'];?> </label>
                            </div>
                      <?php  } ?>
                    </div>
                </section>

                <div class="clearfix "></div>

                <section class="form-container">
                    <div class="form-group">
                       
                        <h3 class="m-title">Quickr Q & A Forum</h3>
                        <h4>Answer Notifications</h4>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="answer_notifi" id="answer_notifi" value="1" <?php if(isset($notifications[0]['answer_nofitication']) && $notifications[0]['answer_nofitication'] == 1)echo 'checked="checked"';?>>
                                Get notified immediately when an attorney answers a question you posted.
                            </label>
                        </div>
                        <h4>Comment Replies</h4>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="comment_reply" id="comment_reply" value="1" <?php if(isset($notifications[0]['comment_replies']) && $notifications[0]['comment_replies'] == 1)echo 'checked="checked"';?>>
                                Receive notification when someone replies to your comments.
                                <input type="hidden" name="n_id" id="n_id" value="<?php if(isset($notifications[0]['id'])) echo $notifications[0]['id'];?>">
                            </label>
                        </div>
                    </div>
                </section>
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr class="hr-margin">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <p>Please Note: Even if you choose not to receive subscription emails from Avvo, you will still receive transactional, account-related, and customer care emails.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <p><a href="<?php echo site_url('account/remove_notification/'.$notifications[0]['id']);?>" id="unsubscribe" style="float:right;color:#006699">Unsubscribe from all subscription emails</a></p>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <input type="submit" name="submit" class="btn btn-primary" id="submit" value="submit">
            <input type="button" name="cancel" class="btn btn-default" id="cancel" value="cancel"> 
        </div>
    </div>
    </form>
</div>
   
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
