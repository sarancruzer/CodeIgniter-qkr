<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
$(document).ready(function(){
    $('.vote').click(function(){
       
        var id = $(this).attr('data-id');
        var value = $(this).attr('data-value');
        $.ajax({
            type:'POST',
            dataType:'html',
            data:{id:id,value:value},
            url:'<?php echo site_url("topics/vote_tips");?>',
            success:function(data){
                if(data)
                {
                    $("#voting").hide();
                    $('#thank_vote').show();
                }
            }
        });
    });
});
</script>
<body>
<?php include 'header.php' ?>
<!-- main content container -->
<div class="clearfix"></div>

<?php echo $this->load->view('search_form');?>

<section class="tips-page">	
	<article class="tp-header">
    <div class="container">
		<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h1><?php echo $tips['title'];?></h1>  
                <p>Posterd on <?php echo date('m d,Y',strtotime($tips['posted_date']));?> by <?php echo $this->my_quickr_model->get_name_by_id($tips['user_id']);?></p> 
                <p>Filed under :
                <?php
                $topics = explode(',',$tips['topic']);
                if(!empty($topics))
                    {
                        foreach($topics as $topic)
                            {
                                $topic_name =  $this->my_quickr_model->get_by_id('topics','name',$topic);
                                ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('topic/'.str_replace(" ","-",$topic_name));?>" target="_blank" ><?php echo $topic_name;?></a>
                                <?php
                            }
                           // echo "<a class='btn-primary' style='padding:3px;margin-right:5px'>".implode('</a><a class=" btn-primary" style="padding:3px;margin-right:5px">', $topic_name)."</a>";
                    }?>
                </p>         
            </div>        
        </div>    
    </div>
    </article>
    
    
    <article class="tp-inner-contnt">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            	<?php if($tips['template_type'] == 1) {?>
                <div class="txt-contnt">
                	<p><?php echo $tips['description'];?></p>
                </div>
                <?php } else{ ?>
                
                <iframe width="680" height="500" src="<?php echo $tips['video_url'];?>" frameborder="0" allowfullscreen></iframe>
                <div class="txt-contnt">
                    <p><?php echo $tips['description'];?></p>
                </div>
                <?php } ?>

                <!-- <div class="txt-contnt">
                	<h2>The Right to be Free from Seizure</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, </p> 
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into.</p> 
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting. </p>               
                </div>        -->        
                
                
                <div class="auth-of-guide">
                	<h2>Author of this Guide</h2>
                	<div class="aog-lft">
                    <figure><img src="<?php echo base_url();?>src/images/answered-profile.jpg"></figure>
                    </div>
                    <div class="aog-rgt">
                    	<h3><?php echo $this->my_quickr_model->get_name_by_id($tips['user_id']);?></h3>
                        <p>Criminal Defense Attorney</p>
                        <p><i class="fa fa-map-marker"></i> Perambur, Chennai</p>
                    </div>
                </div>
                
                <?php
                if($this->session->has_userdata('logged_in')){
                    $user = $this->session->userdata('logged_in');
                    $user_id = $user['id'];
                    
                    if($user_id != $tips['user_id'])
                    {
                ?>
                <div class="ths-guide-hlpful">
                  
                	<h2>Was this guide helpful ?</h2>
                    <div id="voting" <?php if(isset($vote) && !empty($vote)) echo 'style="display:none"';?>>
                	<button type="button" class="btn btn-primary btn-sm vote" data-id="<?php echo $tips['id'];?>" data-value="1">Yes</button>
                    <button type="button" class="btn btn-primary btn-sm vote" data-id="<?php echo $tips['id'];?>" data-value="0">No</button>                    
                    </div>
                    <div id="thank_vote" <?php if(isset($vote) && !empty($vote)) echo 'style="display:block"'; else echo 'style="display:none"';?>>
                    <p>Thank you for your feedback!</p>
                    </div>
                </div>
                <?php } } ?>          
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            	<div class="sponrd-lstings">
                	<p>Sponsored Listings</p>
                    <ul class="sponsr-profle">
                    	<li>
                        	<div class="sp-contain">
                            	<div class="sp-con-lft">
                                	<figure><img src="<?php echo base_url();?>src/images/answered-profile.png"></figure>
                                </div>
                                <div class="sp-con-rgt">
                                	<h3>Rampraksad</h3>
                                    <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <span>122 Client Reviews</span></p>
                                    <p><a href="#">10.0</a> Quickr Rating</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <p class="pro-links">
                                    	<a href="#">Email</a>
                                        <a href="#">Website</a>
                                        <a href="#">Profile</a>
                                    </p>
									<p class="contct-numb"><a href="#">45784568654</a></p>
                                </div>
                            </div>
                        </li>  
                        
                        <li>
                        	<div class="sp-contain">
                            	<div class="sp-con-lft">
                                	<figure><img src="<?php echo base_url();?>src/images/answered-profile.png"></figure>
                                </div>
                                <div class="sp-con-rgt">
                                	<h3>Rampraksad</h3>
                                    <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <span>122 Client Reviews</span></p>
                                    <p><a href="javascript:;">10.0</a> Quickr Rating</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <p class="pro-links">
                                    	<a href="javascript:;">Email</a>
                                        <a href="javascript:;">Website</a>
                                        <a href="javascript:;">Profile</a>
                                    </p>
									<p class="contct-numb"><a href="#">45784568654</a></p>
                                </div>
                            </div>
                        </li>                                             
                    </ul>                
                </div>           
            		
            </div>
        </div>
    </div>
    </article>
    
    
    <article class="top-tips-frm-attorney">
    	<div class="container">
        
        <div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Top tips from advisers</h3>            
                </div>                
            </div>
        
        	<div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php
                       $i = 1;
                       foreach($related_tips as $tips)
                        {
                            if($i%2 != 0)
                            {
                                ?>
                                <p><a href="<?php echo site_url('guides/'.str_replace(" ","-",$tips['title']));?>"><?php echo $tips['title'];?></a></p>
                                <?php
                            }
                            $i=$i+1;
                         ?>         
                        
                    <?php } ?>            
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">              
                    <?php
                       $i = 1;
                       foreach($related_tips as $tips)
                        {
                            if($i%2 == 0)
                            {
                                ?>
                                <p><a href="<?php echo site_url('guides/'.str_replace(" ","-",$tips['title']));?>"><?php echo $tips['title'];?></a></p>
                                <?php
                            }
                            $i=$i+1;
                         ?>         
                        
                    <?php } ?>               
                </div>
            </div>        	
        </div>    
    </article>
    
    
    
    
    
    
    
    <article class="tp-cant-fnd-lookn">
	<div class="container">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        	<h2>Can't find what you looking for ?</h2>
        </div>
    </div>
    
    	<div class="row">
        	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center tp-buplic-frum">
            <p>Post a free question on our public forum.</p>
             <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a Questions</a>  
            
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 or-circle">
          <p>Or</p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center tp-raview-rate">
             <p>Search for lawyers by reviews and ratings</p>
              <a href="<?php echo site_url('find-a-financial-adviser');?>" class="btn btn-primary ask-nw-btn">Find a Lawyer</a>  
            </div>
        </div>
    </div>
</article>
     
</section>

<!-- main content container -->

<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>