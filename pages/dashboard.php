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
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           		<div class="ed-profi">
                	<p><a href="#">My QuickR </a> > <a href="#">Dashboard</a></p>                                  
                </div>
           </div>                  
    </div>  
</div>

<div class="container">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                              
                  <div class="db-header">
                	<h1>Ramprasad RS</h1>
                </div>    
           </div> 
    </div>
</div>



<div class="container">	 	 
	<div class="row db-user-stat">        
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                              
              <h2>Contributor level</h2>  
              <h3>1 point</h3>
              <p><span><img src="images/leaf-pic.jpg"></span> Contributo level</p>
              <p>Your are 15 points shy of the next level</p>
              <button class="btn" type="button">Answer Questions</button>  
           </div> 
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 analytics">                              
                 <h2>Analytics</h2> 
                 <p>No one has seen you on QuickR yet. Get noticed.</p>
                 <p>Get more insight with per-page analytics and view who is contacting you. <span> <a href="#">Learn more</a> </span></p>       
           </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 db-profile">                              
               <h2>Profile</h2>
               <div class="prfl-complet">Profile completeness...</div> 
               <p><span><a href="#">Add Media </a></span>to make your profile 19% complete</p>
               <p><a href="<?php echo base_url() ?>profile/edit">Go to profile</a></p>
               <p><a href="#">Request Client Reviews</a></p>     
           </div>                 
    </div>     
</div>


<div class="container">	 	 
	<div class="row db-user-bot">        
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                              
              <h2>Community Engagement</h2>  
             <div role="alert" class="alert alert-warning alert-dismissible fade in">
         	 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
          	Answering legal questions and publishing informative guides are great ways to display your professional approach as well as your legal
knowledge and experience.
   			 </div>
             <div class="comm-engage">	
                <ul>
                    <li><div class="numb">0</div>
                    <div class="ans-txt"> Legal Answers</div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Answers marked "I agree" by other lawyers</div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Legal Answers</div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Answers marked "I agree" by other lawyers</div></li>                                      
                </ul>    	
   			 </div>
             
             <div class="comm-engage">	
                <ul>
                    <li><div class="numb">0</div>
                    <div class="ans-txt"> Legal Answers</div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Legal Guides publishes<br>
					<a href="#">Write a legal guide</a></div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Legal Answers</div></li>
                    <li><div class="nums">0</div>
                    <div class="ans-txt"> Answers marked "I agree" by other lawyers</div></li>                                      
                </ul>    	
   			 </div>
             
             
             <div class="rp-activity">
             	<h2>Recent point activity</h2>  
                 <div role="alert" class="alert alert-warning alert-dismissible fade in">
                 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                Answering legal questions and publishing informative guides are great ways to display your professional approach as well as your legal
    knowledge and experience.
                 </div>
                 <p>You claimed your profile <span>+1pt</span></p>
                 <p class="seemore"><a href="#">See more</a></p>   
             </div>
             
             <div class="rp-activity">
             	<h2>Recent point activity</h2>  
                 <div role="alert" class="alert alert-warning alert-dismissible fade in">
                 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                Answering legal questions and publishing informative guides are great ways to display your professional approach as well as your legal
    knowledge and experience.
                 </div>
                 
                 <div class="comm-engage">	
                <ul>                   
                    <li><div class="numb">#2,618</div>
                    <div class="ans-txt"> Legal Guides publishes<br>
					<a href="#">View leaderboard</a></div></li>                                           
                </ul>    	
   			 </div>                
             </div>                 
           </div> 
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 qa-subscip">                              
                 <h2>Q & A subscription</h2> 
                 <p>No one has seen you on QuickR yet. Get noticed.</p>
                 <p><a href="#">Get more insight with per-page analytics</a> </p>           
           </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 add-ur-contnt">                                         
               <h2>Add your Quickr content to your site</h2>                               
               <p><a href="#">Go to profile</a></p>
               <p><a href="#">Request Client Reviews</a></p>     
           </div>                 
    </div>     
</div>

<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>
<!--footer ends here -->
</body>
</html>
