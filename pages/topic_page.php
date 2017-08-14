<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<!-- main content container -->
<div class="clearfix"></div>

<?php echo $this->load->view('search_form');?>
    
  <section class="topic-pge-hedr">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h1><?php  echo $topic['name'];?></h1>
                <p><?php  echo $topic['description'];?> </p>
            
            </div>        
        </div>    
    </div>  
  </section>  
  
  
  
  <section class="topic-related">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h2>Topic related to <?php  echo strtolower($topic['name']);?></h2>
                <div class="tp-rlted-btn">
                <?php 
                foreach($related_topic as $rtopic)
                {
                    ?>
                    <a class="btn btn-primary" href="<?php echo site_url('topic/'.str_replace(" ","-",$rtopic["name"]));?>"  type="button"><?php echo $rtopic["name"];?></a>
                    <?php
                }
                if(!$topic['is_parent'])
                {
                    $parent = $this->topic_model->get_parent($topic['id']);
                    $parent_name = $this->my_quickr_model->get_by_id('topics','name',$parent);
                    ?>
                    <a class="btn btn-primary" href="<?php echo site_url('topic/'.str_replace(" ","-",$parent_name));?>"  type="button"><?php echo $parent_name;?></a>
                    <?php
                }
                ?>
                </div>           
            </div>        
        </div>
    </div>  
  </section>
  
  
  
  <section class="cmmn-question">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <h2>Common questions about <?php  echo strtolower($topic['name']);?></h2>
         </div>
        </div>
    
    	<div class="row">
       
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">            	
                <?php
                   $i = 1;
                   foreach($common_questions as $common)
                    {
                        if($i%2 != 0)
                        {
                            ?>
                            <p><a href="<?php echo site_url('legal-answer/'.$common['id']);?>"><?php echo $common['subject'];?></a></p>
                            <?php
                        }
                        $i=$i+1;
                     ?>         
                    
                <?php } ?>
                </div>        
           	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<?php
               $i = 1;
               foreach($common_questions as $common)
                {
                    if($i%2 == 0)
                    {
                        ?>
                        <p><a href="<?php echo site_url('legal-answer/'.$common['id']);?>"><?php echo $common['subject'];?></a></p>
                        <?php
                    }
                    $i=$i+1;
                 ?>         
                
                <?php } ?>
            </div>        
        </div>    
    </div> 
  </section>
    
    
    
    <section class="top-tips">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <h2>Top tips from advisers</h2>
         </div>
        </div>
    
    	<div class="row">       
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">            	
                <?php
                   $i = 1;
                   foreach($tips as $tip)
                    {
                        if($i%2 != 0)
                        {
                            ?>
                            <p><a href="<?php echo site_url('guides/'.str_replace(" ","-",$tip['title']));?>"><?php echo $tip['title'];?></a></p>
                            <?php
                        }
                        $i=$i+1;
                     ?>         
                    
                <?php } ?>
            </div>        
           	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<?php
                   $i = 1;
                   foreach($tips as $tip)
                    {
                        if($i%2 == 0)
                        {
                            ?>
                            <p><a href="<?php echo site_url('guides/'.str_replace(" ","-",$tip['title']));?>"><?php echo $tip['title'];?></a></p>
                            <?php
                        }
                        $i=$i+1;
                     ?>         
                    
                <?php } ?>
            </div>        
        </div>    
    </div> 
  </section>
  
  
  
  <section class="rcent-ask-quest">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <h2>Recently asked questions</h2>
         </div>
        </div>
    
    	<div class="row">       
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">   
               <?php
               $i = 1;
               foreach($recent_questions as $question)
                {
                    if($i%2 != 0)
                    {
                        ?>
                        <p><a href="<?php echo site_url('legal-answer/'.$question['id']);?>"><?php echo $question['subject'];?></a></p>
                        <?php
                    }
                    $i=$i+1;
                 ?>        	
                
                <?php } ?>
                </div>        
           	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<?php
               $i = 1;
               foreach($recent_questions as $question)
                {
                    if($i%2 == 0)
                    {
                        ?>
                        <p><a href="<?php echo site_url('legal-answer/'.$question['id']);?>"><?php echo $question['subject'];?></a></p>
                        <?php
                    }
                    $i=$i+1;
                 ?>         
                
                <?php } ?>
            </div>        
        </div>    
    </div> 
  </section>
  
  
  <!-- <section class="recomm-article">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <h2>Recommended articles</h2>
         </div>
        </div>
    
    	<div class="row">       
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">            	
                <p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
                <p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
                <p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
                </div>        
           	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
                <p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
                <p><a href="javascript:;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a> </p>
            </div>        
        </div>    
    </div> 
  </section> -->
  
<section class="see-all-advis-btn">
<div class="container">	
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
          <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('topic/'.str_replace(" ","-",$topic['name']).'/advice');?>">See all advice on <?php  echo strtolower($topic['name']);?></a>        
        </div>
    </div>
</div>
</section>  



<section class="cant-fnd-lookn">
	<div class="container">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        	<h2>Can't find what you looking for ?</h2>
        </div>
    </div>
    
    	<div class="row">
        	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center buplic-frum ">
            <p>Post a free question on our public forum.</p>
             <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a Questions</a>  
            
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 or-circle">
          <p>Or</p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center raview-rate">
             <p>Search for lawyers by reviews and ratings</p>
              <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('find-a-financial-adviser');?>">Find a Lawyer</a>  
            </div>
        </div>
    </div>
</section>

<section class="view-lwyrs-tp-city">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            	<div class="cty-colmn">
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                </div>
            </div>  
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            	<div class="cty-colmn">
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                </div>
            </div>  
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            	<div class="cty-colmn">
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                </div>
            </div>  
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            	<div class="cty-colmn">
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                    <a style="display:block" href="javascript:;">Atlanta</a>
                </div>
            </div>       
        </div>    
    </div>
</section>
<!-- main content container -->

<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>

