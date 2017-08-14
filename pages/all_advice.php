<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<!-- main content container -->
<div class="clearfix"></div>
<!-- main content container -->
<div class="clearfix"></div>

<section class="sec-tp">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="#">Legal Advice</a></li>
          <li class="active"> Advice on  <?php echo str_replace('-'," " ,$arg_topic);?></li>
        </ol>
      </div>
    </div>
  </div>
</section>



<section class="mini-search">
  <div class="container mini-search-width">    
    <div class="row">
      <?php
    $topic_name = $location ='';

    if($this->session->has_userdata('search_by_topic'))
            {
                $search_session = $this->session->userdata('search_by_topic');
                $topic_name = $search_session['topicname'];
                $location = $search_session['location'];
            }
    ?>
    
      <form name="search_topic_form" id="search_topic_form" method="post" action="<?php echo site_url('search');?>">
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
          <div class="form-group">
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
                  <input type="text" class="form-control" name="topic_name" id="topic_name"  placeholder="Legal Topic" value="<?php echo $topic_name;?>" /></li>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <div class="form-group">
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                  <input type="text" class="form-control" name="city_county" id="city_county" placeholder="City, County" value="<?php echo $location;?>" />
             </div>
          </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-12">

            <input type="submit" name="search_submit" id="search_submit" value="Search" class="btn btn-blue btn-block" />                  
        </div>
        </form>
    </div>
  </div>
</section>



<section class="advice-page">
  <div class="container">    
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="">Recent Advice about  <?php echo str_replace('-'," " ,$arg_topic);?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <?php if(!empty($related_topic)){?>
        <div class="rel-topic-filters">
          <h2 class="o-title">Related Topics</h2>
          	<ul class="rel-topics">
            <?php 
             foreach($related_topic as $related){?>
             <li><a href="<?php echo site_url('topic/'.str_replace(" ","-",$related["name"]));?>"><?php echo $related["name"];?></a></li>
             <?php } ?>
            	
               
            </ul>  
        </div> 
        <?php } ?>
        
        <div class="resorce-lgl-help">
          <h2 class="o-title">Resources for Legal Help</h2>
          <ul class="lgl-hlp-lst">
          	<li><a href="#">Search Advisers profiles</a></li>
            <li><a href="#">Talk to a Adviser</a></li>           
          </ul>        
        </div>      
      </div>
      
      
      <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">       	
      	<div class="filt-by-con-outer">      
       <p class="headr"><span>Filter by :</span> <a class="active" href="<?php echo site_url('topic/'.$arg_topic.'/advice');?>">Everything</a> | <a href="<?php echo site_url('topic/'.$arg_topic.'/advice/?type=guide');?>">Guides</a> | <a href="<?php echo site_url('topic/'.$arg_topic.'/advice/?type=question');?>"> Q&A </a></p>
       <ul class="fbycon-lst">
            <?php foreach($list_data as $data){
              
              if($data['type'] == 'question') {$link = site_url('legal-answer/'.$data['id']); $next_content = 'Asked in '.$data['posted_in'].' - '. $data['total_answer'].' Advisers Answer'; }
              if($data['type'] == 'tips') {$link = site_url('guides/'.str_replace(" ","-",$data['title'])); $next_content = 'Posted by Adviser '.$this->my_quickr_model->get_name_by_id($data['posted_in']);}
                ?>
            <li>
            	<div class="lst-item">
                	<p><a href="<?php echo $link;?>"> <?php echo $data['title'];?></a></p>
                    <p><?php echo $next_content;?></p>
                </div>
            </li>
            <?php } ?>
            
       </ul>     
       <?php echo $this->pagination->create_links(); ?>  
       </div>     </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      	<div class="row">
      	<div class="advice-ask-lawyer">
        	<h2>Ask a Financial Adviser</h2>
            <p>Get free answers from experienced advisers.</p>
            <ul class="advice-ask-lst">
                <li>It's FREE</li>
                <li>It's easy</li>
                <li>It's anonymous</li>                          
            </ul>  
            <a href="<?php echo site_url('ask-a-financial-adviser');?>" class="btn btn-blue btn-sm">Ask a financial adviser </a>     
            <p> <span><?php echo $answer_count;?> </span> answers this week</p>
            <p><span><?php echo $adviser_count;?> </span> Financial Adviser answers this week</p>   
        </div> 
        </div>      
                    
      </div>
    </div>
  </div>
</section>



<section class="link-section mrg-tp-30">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2 class="n-title">Legal Advice By State</h2>
      </div>
    </div>
  </div>
  <div class="container links-four">
    <div class="row">
      <div class="col-lg-3 col-md-2 col-sm-3 col-xs-12">
        <ul class="anc-link">
          <li><a href="#">California</a></li>
          <li><a href="#">New York</a></li>
          <li><a href="#">Florida</a></li>
         
        </ul>
        <div class="anc-button-section"> <a href="#" class="btn btn-blue btn-sm"> See all states </a> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <ul class="anc-link">
          <li><a href="#">Georgia</a></li>
          <li><a href="#">Pennsylvania</a></li>
         
        </ul>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <ul class="anc-link">
          <li><a href="#">Pennsylvania</a></li>
          <li><a href="#">Pennsylvania</a></li>
         
        </ul>
      </div>
      <div class="col-lg-3 col-md-2 col-sm-3 col-xs-12">
        <ul class="anc-link">
          <li><a href="#">Pennsylvania</a></li>
          <li><a href="#">Pennsylvania</a></li>
        
        </ul>
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