<header>
<div class="container-fluid">
	<div class="row hd-top top-header">
    	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 logo">

        	<a href="<?php echo site_url();?>"><img src="<?php echo base_url();?>/src/images/com-logo.png"></a>

        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
        	<ul class="menu">

            	<!-- <li><a href="<?php echo site_url('my_quickr/ask_question');?>">For Legal Advice </a></li>
                <li><a href="#">For Financial Advice</a></li>
                <li><a href="#">Others</a></li> -->

                <?php if(!$this->session->has_userdata('logged_in')) { ?>
            	<li><a href="<?php echo site_url('free-financial-advice') ?>">Research Financial Advice </a></li>
                <li><a href="<?php echo site_url('ask-a-financial-adviser') ?>">Ask a Financial Adviser</a></li>
                <li><a href="#">Talk to a Financial Adviser</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>">Find a Financial Adviser</a></li>
                <?php } else { 
                $user = $this->session->userdata('logged_in');                         
                if($user['is_fa'] == 1) {  ?>
            	<li><a href="<?php echo site_url('answer') ?>">Answer Questions</a></li>
                <li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                <li><a href="<?php echo site_url('profile/edit') ?>">Profile</a></li>
                <li><a href="<?php echo site_url('analytics') ?>">Analytics</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>">Find a Financial Adviser</a></li>
                <?php } else if($user['is_fa'] == 0) { ?>

            	<li><a href="<?php echo site_url('free-financial-advice') ?>">Research Financial Advice </a></li>
                <li><a href="<?php echo site_url('ask-a-financial-adviser') ?>">Ask a Financial Adviser</a></li>
                <li><a href="#">Talk to a Financial Adviser</a></li>
                <li><a href="<?php echo site_url('find-a-financial-adviser') ?>">Find a Financial Adviser</a></li>                      

                <?php }} ?>

            </ul>
        </div>

<?php if($this->session->has_userdata('logged_in')) { ?>
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
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
         <?php
         if($user['is_fa'] == 1) { 
          ?>
           <li><a href="<?php echo site_url('my_quickr/saved_subscription/'.$user['id']); ?>">Q&A Subscriptions</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="<?php echo site_url('profile/edit'); ?>">Edit Profile</a></li>
           <li><a href="<?php echo site_url('profile/reviews'); ?>">Reviews for me</a></li>
           <li role="separator" class="divider"></li>
           <?php if(isset($saved_quest) && !empty($saved_quest)) {?>
           <li><a href="<?php echo site_url('my_quickr/advice'); ?>">Saved Advice</a></li>
           <li role="separator" class="divider"></li>
           <?php } ?>
           <li><a href="<?php echo site_url('account/settings'); ?>">Account Settings</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="<?php echo site_url('account/logout'); ?>">Sign out</a></li>   
          <?php
          }
          else if($user['is_fa'] == 0) { ?>
           <li><a href="<?php echo site_url('my_quickr/questions/'.$user['id']); ?>">My Questions</a></li>
           <li><a href="<?php echo site_url('my_quickr/reviews'); ?>">Reviews by me</a></li>
           <li><a href="<?php echo site_url('my_quickr/advice'); ?>">Saved Advice</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="<?php echo site_url('account/settings'); ?>">Account Settings</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="<?php echo site_url('account/logout'); ?>">Sign out</a></li>           
          <?php } ?>
       </ul>
     </li>
   </ul>      
</div>
<?php } else { ?>
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 signin">
<a href="<?php echo site_url('account/login') ?>">Sign in</a>
</div>    
<?php } ?>
</div>    
  <div class="row hd-btm">    	
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<nav class="navbar navbar-default">
  <div class="container-fluid">   
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">About Quickr  <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Leadership </a></li>
        <li><a href="#">Team </a></li>
        <li><a href="#">Support </a></li>
        <li><a href="#">Review your Advisor</a></li>   
        <li><a href="#">Careers </a></li>     
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        </div>            
    </div>    
</div>
</header>
