<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form name="loginform" id="loginform" method="POST" action="<?php echo base_url();?>admin/login" >
                        <h1>Login Form</h1>
                         <?php 
             			if($this->session->flashdata('success')){
             			?>
             			<div class="alert alert-success alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
					  <?php echo $this->session->flashdata('success');?>
					   </div>
					   <?php }elseif($this->session->flashdata('failure')){ ?>
                       <div class="alert alert-danger alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
					   <?php echo $this->session->flashdata('failure');?>
					   </div>
					   <?php } ?>
                        <div>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>
                        </div>
                        <div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                        </div>
                        <div>
                           <button class="btn btn-default btn-sm" type="submit">Log in</button>
                          <!--  <a class="btn btn-default btn-lg submit" href="index.html">Log in</a>
                            <a class="reset_pass" href="#">Lost your password?</a>-->
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                          <!--  <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />-->
                            <div>
                                <h1><!--<i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!!-->
                                <!--<img src="<?php echo base_url(); ?>assets/images/com-logo.png">  </h1> --> 
                                <?php if(!empty($baseinfo[0]['loginlogo'])){?>
                                <img src="<?php echo base_url(); ?>uploads/baseinfo/<?php echo $baseinfo[0]['loginlogo'];?>">  
                                <?php } ?>
                                </h1> 
                                <p>©2015 All Rights Reserved. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>
<style type="text/css">
/*input.error {
    color: #FF0000 !important;
    font-weight: lighter !important;
    background-color:#FFE6E6 !important;

   
}*/
.error{
    color:red;
    display:block; //to show error message in new line
}
label.error {
    color: #FF0000 !important;
    font-weight: lighter !important;
    text-align: left;
   
    /*color:red;*/
    display:block; //to show error message in new line 
}

</style>
<script type="text/javascript" >
$(document).ready(function () {

  $('#loginform').validate({
    rules: {
      username: {
        required:true,
       },
        password: {
        required:true,
       },
    },
    messages: {
       username: {
        required:"Please enter a Username",
       },

        password: {
        required:"Please enter a Password",
       }
    }
  });
});
</script>
