<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
    $(document).ready(function(){

	    $('#publish_quest').validate({
	        rules:{
	            'category[]':{required:true}
	        }
	    });

	    $('.account_block').click(function(){
            
	    	if($(this).val() == "create")
	    	{
	    		$("#register_block").show();
	    		$("#login_block").hide();
	    	}
	    	if($(this).val() == "signin")
	    	{
	    		$("#register_block").hide();
	    		$("#login_block").show();
	    	}

	    });
       
        $('#register_submit').click(function(){
		    $('#signin_form').validate({
		        rules:{
		            'email':{required:true,email:true},
		            'password':{required:true,minlength:6},
		            'confirm':{required:true,equalTo: "#password"}
		        }
		    });

		    if($("#signin_form").valid())
		    	$("#signin_form").submit();
	    });

	    $("#login_submit").click(function(){

		    $("#login_form").validate({
		    	'email':{required:true,email:true},
		        'password':{required:true}
		    });

		    if($("#login_form").valid())
		    	$("#login_form").submit();

	    });

    });
</script>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<!-- main content container -->

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
                <div class="overview">
                    <h3> Review your question </h3>
                    <div class="ov-container">
                       <div class="ovc-frst"><P>Your question</P></div>
                        <div class="ovc-second"> 
                           <p><?php echo $question[0]['subject'];?></p>                                         
                        </div> 
                    </div>  
                    <div class="ov-container">
                       <div class="ovc-frst"><P>Details</P></div>
                        <div class="ovc-second"> 
                            <p><?php echo $question[0]['detail'];?></p>                                         
                        </div> 
                    </div>  
                    <div class="ov-container">
                       <div class="ovc-frst"><P>City and State</P></div>
                        <div class="ovc-second"> 
                            <p><?php echo $question[0]['location'];?></p>                                         
                        </div> 
                    </div> 
                </div>     
                
                <?php if($question[0]['status'] == '-1') {?>
                <form name="update" id="update" method="post" action="<?php echo site_url('ask-a-financial-adviser');?>" class="form cust-forms">
                <div class="form-group"><input type="hidden" name="q_id" id="q_id" value="<?php echo $question[0]['id'];?>"></div>
                <input type="submit" class="btn btn-info" value="Edit" name="update">
                </form>
                <?php } ?>
                
            </div>
        </div> 
    </section>
    <?php if($question[0]['status'] == '-1' && $this->session->has_userdata('logged_in')) {?>
    <section class="grid-area">
        <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3> Categorize your question </h3>
                <hr/>
                <form name="publish_quest" id="publish_quest" method="post" action="<?php echo site_url('legal-question-preview/'.$question[0]['id']);?>">
                    <div class="form-group">
                      <p class="help-block">Selecting relevant topics helps direct your question to the right professionals.</p>
                      <?php foreach($sp_area as $area) {?>
                        <div class="checkbox">
                        <label><input type="checkbox" name="category[]" id="category_<?php echo $area['id'];?>" value="<?php echo $area['id'];?>"><?php echo $area['name'];?> </label>
                        </div>
                      <?php } ?>
                    </div>
                    <input type="hidden" name="quest_id" id="quest_id" value="<?php echo $question[0]['id'];?>">
                    <input type="submit" class="btn btn-primary" value="Publish" name="publish">
                </form>
            </div>
        </div> 
    </section>
    <?php } ?>
    <?php if(!$this->session->has_userdata('logged_in')) {?>
    <section class="grid-area">
      	<div class="row">
      	  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      	  	    <h3> Sign in with Quickr </h3>
                <hr/>
      	  		<div class="signin-txt form-group">
		          	<div class="signin-socio">
				        <a class="fb" href="#"><i class="fa fa-facebook"></i> facebook</a>
				        <a class="tw" href="#"><i class="fa fa-twitter"></i> Twitter</a>
				        <a class="goo" href="#"><i class="fa fa-google"> Google</i></a>
				        <a class="linkin" href="#"><i class="fa fa-linkedin"></i> Linkedin</a>
		          	</div>
		            <p>QuickR will never post any activity on your social networks without your permission</p>
		            <p><span> Or</span> </p>

		            <div class="form-group" style="margin-top:10px">
			            <label class="radio-inline">
			              <input type="radio" name="account_block"  class="account_block" id="create" value="create" checked="checked">
			              Create Account </label>
			            <label class="radio-inline">
			              <input type="radio" name="account_block" class="account_block" id="signin" value="signin">
			              I have an Quickr Account </label>
			        </div>
                    <div id="register_block">
				        <form name="signin_form" id="signin_form" action="<?php echo site_url('account/register'); ?>" method="post">
						<ul class="signin">  
	    					<li>
	    					    <div class="form-group">
	        					<label>First name</label>
	        					<input type="text" name="firstname" id="firstname" class="suffix-long" placeholder="First name" value=""/>
	       						</div>
	   						</li> 

	   						<li>
	    					    <div class="form-group">
	        					<label>Email Address <span class="required"> *</span></label>
	        					<input type="email" name="email" id="email" class="suffix-long" placeholder="Email Address" value=""/>
	       						</div>
	   						</li>

	   						<li>
	    					    <div class="form-group">
	        					<label>Password (must be atleast six characters)<span class="required"> *</span></label>
	        					<input type="password" name="password" id="password" class="suffix-long" placeholder="Password" value=""/>
	       						</div>
	   						</li>

	   						<li>
	    					    <div class="form-group">
	        					<label>Confirm password<span class="required"> *</span></label>
	        					<input type="password" name="confirm" id="confirm" class="suffix-long" placeholder="Confirm password" value=""/>
	       						</div>
	   						</li>
	         				<li> 
						    	<p>I understand and agree that by clicking "Accept terms and continue" I am indicating that I have read and accept the <a href="">QuickR Terms of Use.</a></P>
						    </li>
						    <li>
						        <input type="hidden" id="return_url" name="return_url" value="<?php echo current_url();?>">
						        <input type="button" name="register_submit" id="register_submit" class="btn btn-primary" value="Accept terms and continue" />       
						    </li>   
						    <li>
						      <p>See our <a href="">Privacy Policy</a> for information on how we collect, use, and share information you provide to us.</p>
						    </li>
						</ul>
						</form>
					</div> <!-- register block close -->

				    <div id="login_block" style="display:none">
				    	<form name="login_form" id="login_form" action="<?php echo site_url('account/login'); ?>"  method="post">
					      	<ul class="signin">           
					      		<li>
					      			<div class="form-group">
					        			<label>Email <span class="required">*</span></label>
					        			<input type="Email" name="email" id="email" class="suffix-long" placeholder="Email" />
					        		</div>
					      		</li> 
					      		<li>
					      			<div class="form-group">
					        			<label>Password <span class="required">*</span></label>
					                    <input type="password" name="password" id="password" class="suffix-long" placeholder="Password" />
					        		</div>
					      		</li> 

					      		<li>
					      			<p >
					      			<a class="btn-link" href="<?php echo site_url('account/forgot_password') ?>">I forgot my password</a> 
					      			</p> 	
					     		</li>        
					               
					     		<li>
					     			<input type="hidden" id="return_url" name="return_url" value="<?php echo current_url();?>">
					     			<input type="button" name="login_submit" id="login_submit" class="btn btn-primary" value="Login"/>
					     		</li> 


					      	</ul>
					    </form>
					    
				    </div>
		        </div>
      	  	</div>
      	</div>
    </section>
    <?php } ?>
</div>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
