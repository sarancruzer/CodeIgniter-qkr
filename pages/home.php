<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cleartype" content="on">
<!-- Responsive and mobile friendly stuff -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<title>QuickR</title>
<link href="<?php echo base_url() ?>src/css/bootstrap.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>src/css/site.css">
<link href="<?php echo base_url() ?>src/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript --> 
<script src="<?php echo base_url() ?>src/js/bootstrap.min.js"></script> 
<!-- Plugin JavaScript --> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
<script src="<?php echo base_url() ?>src/js/classie.js"></script> 
</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="#page-top">QuickR</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="hidden"> <a href="#page-top"></a> </li>
                <?php if(!$this->session->has_userdata('logged_in')) { ?>
            	<li><a href="<?php echo site_url('free-financial-advice') ?>" class="page-scroll">Research Financial Advice </a></li>
                <li><a href="<?php echo site_url('ask-a-financial-adviser') ?>" class="page-scroll">Ask a Financial Adviser</a></li>
                <li><a href="#" class="page-scroll">Talk to a Financial Adviser</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>" class="page-scroll">Find a Financial Adviser</a></li>
                <?php } else { 
                $user = $this->session->userdata('logged_in');                         
                if($user['is_fa'] == 1) {  ?>
            	<li><a href="<?php echo site_url('answer') ?>" class="page-scroll">Answer Questions</a></li>
                <li><a href="<?php echo site_url('dashboard') ?>" class="page-scroll">Dashboard</a></li>
                <li><a href="<?php echo site_url('profile') ?>" class="page-scroll">Profile</a></li>
                <li><a href="<?php echo site_url('analytics') ?>" class="page-scroll">Analytics</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>" class="page-scroll">Find a Financial Adviser</a></li>
                <?php } else if($user['is_fa'] == 0) { ?>
            	<li><a href="<?php echo site_url('free-financial-advice') ?>" class="page-scroll">Research Financial Advice </a></li>
                <li><a href="<?php echo site_url('ask-a-financial-adviser') ?>" class="page-scroll">Ask a Financial Adviser</a></li>
                <li><a href="#" class="page-scroll">Talk to a Financial Adviser</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>" class="page-scroll">Find a Financial Adviser</a></li>                      
                <?php }} ?>
      </ul>

<?php if($this->session->has_userdata('logged_in')) { ?>
<div class="nav navbar-right">
  <ul class="nav navbar-nav navbar-right">
    <li class="Link">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>
<span class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="#">You have no new notifications</a></li>           
      </ul>
    </li>
    <li class="Link">
    <?php 

    $user = $this->session->userdata('logged_in');
    $arr = explode('@',$user['email']);
    if($user['displayname'] != '')
      $name = $user['displayname'];
    else if($user['firstname'] != '')
    {
      $name = $user['firstname'];
      if($user['lastname'] != '')
        $name .= ' '.$user['lastname'];
    }
    else
      $name = $arr[0];

    ?>          
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name ?><span class="caret"></span></a>
      <ul class="dropdown-menu">
         <li><a href="<?php echo site_url('my_quickr/questions/'.$user['id']); ?>">My Questions</a></li>
         <li><a href="<?php echo site_url('my_quickr/reviews'); ?>">Reviews by me</a></li>
         <li><a href="<?php echo site_url('my_quickr/advice'); ?>">Saved Advice</a></li>
         <li role="separator" class="divider"></li>
         <li><a href="<?php echo site_url('account/settings'); ?>">Account Settings</a></li>
         <li role="separator" class="divider"></li>
         <li><a href="<?php echo site_url('account/logout'); ?>">Sign out</a></li>           
       </ul>
     </li>
   </ul>      
</div>
<?php } else { ?>
      <div class="navbar-form navbar-right">
        <a class="btn btn-custom" href="<?php echo site_url('account/login');?>">Sign In</a>
      </div>
<?php } ?>



    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- Header -->
<header>
  <div class="container">
    <div class="intro-text">
      <div class="intro-lead-in">All people are equal</div>
      <div class="intro-heading">A Good attorney is what makes a difference.</div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box1 text-left">
        <h1>Q&amp;A</h1>
        <h2>Post a question</h2>
        <p>Free answers from experienced finance advisers</p>
        <p><a href="<?php echo site_url('ask-a-financial-adviser');?>"><i class="fa fa-pencil"></i> Ask a Financial adviser</a></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box2 text-left">
        <h1>adviser</h1>
        <h2>Talk directly to a Financial adviser</h2>
        <p>Advice from a top-reviewed financial adviser in one affordable phone call.</p>
        <p><a href="#"><i class="fa fa-user"></i> Get Legal Help</a></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box3 text-left">
        <h1>Directory</h1>
        <h2>Search adviser profiles</h2>
        <p>Local financial adviser listings with reviews and ratings.</p>
        <p><a href="#"><i class="fa fa-search"></i> Find your financial adviser</a></p>
      </div>
    </div>
  </div>
</header>

<!-- Section -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-text">
        <p>Last month, the attorneys at Avvo helped millions of people<br>
          make smarter, more confident legal decisions.<br>
          <strong>Today it's your turn.</strong></p>
      </div>
    </div>
  </div>
</section>

<section class="home-links-section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flinks-box">
            	<h3>Research financial topics</h3>
                <ul>
                  <?php
                  foreach($topics as $topic){?>
                  <li><a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic["name"]));?>"><?php echo $topic["name"];?></a></li>
                  <?php } ?>
                	<!-- <li><a href="#">Affect of tickets on driving record</a></li>
                    <li><a href="#">Criminal defense</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                    <li><a href="#">Arrest for criminal charges</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li> -->
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flinks-box">
            	<h3>Research legal topics</h3>
                 <ul>
                	<li><a href="#">Affect of tickets on driving record</a></li>
                    <li><a href="#">Criminal defense</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                    <li><a href="#">Arrest for criminal charges</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flinks-box">
            	<h3>Research legal topics</h3>
                 <ul>
                	<li><a href="#">Affect of tickets on driving record</a></li>
                    <li><a href="#">Criminal defense</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                    <li><a href="#">Arrest for criminal charges</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 flinks-box">
            	<h3>Research legal topics</h3>
                 <ul>
                	<li><a href="#">Affect of tickets on driving record</a></li>
                    <li><a href="#">Criminal defense</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                    <li><a href="#">Arrest for criminal charges</a></li>
                    <li><a href="#">Employment</a></li>
                    <li><a href="#">Medical malpractice</a></li>
                    <li><a href="#">Renting a house or apartment</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="twitter-block">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            </div>
        </div>
    </div>
</section>

<footer>
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            	<p>Copyright &copy; 2015 quickr. All Rights Reserved | <a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="#">Disclaimer</a></p>
                <p><a href="#"><img src="<?php echo base_url() ?>src/images/fb.png"></a> <a href="#"><img src="<?php echo base_url() ?>src/images/tw.png"></a> <a href="#"><img src="<?php echo base_url() ?>src/images/in.png"></a></p>
            </div>
        </div>
    </div>
</footer>
<script src="<?php echo base_url() ?>src/js/cbpAnimatedHeader.js"></script> 
<!-- Custom Theme JavaScript --> 
<script src="<?php echo base_url() ?>src/js/agency.js"></script>
</body>
</html>
