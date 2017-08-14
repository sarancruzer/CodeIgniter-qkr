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

<section class="sec-tp">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="#">Legal Advice</a></li>                   
          <li class="active">All Topics</li>
        </ol>
      </div>
    </div>
  </div>
</section>


<section class="mini-search">
  <div class="container mini-search-width">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="m-title">All Legal Topics</h1>
        <h3 class="o-title">Search for a legal topic</h3>
      </div>
    </div>
    
     <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-info we-hv-lot-topics">
        	<div class="whlt-lft">
            	<figure><img src="<?php echo base_url();?>src/images/bulb-img.png"></figure>
            </div>
            <div class="whlt-rgt">
            	<h2>We have lot of topics</h2>
                <p>A bankruptcy attorney can help you manage personal or business debts you are unable to pay. Bankruptcy laws allow people and businesses to (1) get a “fresh start” by relieving most debts; and (2) repay the money owed to all creditors as fairly as possible</p>
            </div>
        </div>
      </div>
    </div>
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




<section class="brwse-alphabet">
	<div class="container">
		<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<h2>Browse Alphabetically</h2>            
            </div>                    
        </div>        
    </div>
</section>



<section class="brwse-inner-contnt">
<div class="container">
    
 		<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mrt-bottom">
            	<p class="alphe-ltrs">#
                <?php
                foreach(range('A','Z') as $letter)
                {?>
                   <a  href="<?php echo site_url('topics/all_topics/'.strtolower($letter));?>" class="<?php echo $class = ($this->uri->segment('3') == strtolower($letter))?'active':'';?>"><?php echo $letter;?></a>
                <?php }?>
                </p>            
            </div>    
            
            
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brwse-lnks " id="topics_block">
                    <ul class="anc-link no-pad">

                     <?php
                            $li_per_column = floor(count($topics)/4);
                            $lipercol = $li_per_column;
                            $total_rows = count($topics);
                            $remain_rows = ($total_rows-($li_per_column*4));
                            $no_column = 4;
                            $count = 0;
                            $col_count = 1;
                            
                            foreach($topics as $topic){
                               if($count == 0)
                               {
                                  switch ($col_count) {
                                    case '1':{
                                      if($remain_rows >= 1)
                                        $li_per_column = $li_per_column+1;
                                      else
                                        $li_per_column = $lipercol;
                                      
                                      break;
                                    }
                                    case '2':{
                                      
                                      $li_per_column = $lipercol;
                                      if($remain_rows >1 && $remain_rows >= 2 )
                                        $li_per_column = $li_per_column+1;
                                      else
                                        $li_per_column = $lipercol;
                                      break;
                                    }
                                      case '3':{
                                        $li_per_column = $lipercol;
                                      if($remain_rows >1 && $remain_rows >= 3)
                                        $li_per_column = $li_per_column+1;
                                      else
                                        $li_per_column = $lipercol;
                                      break;
                                     }
                                    
                                    default:
                                      $li_per_column = $lipercol;
                                      break;
                                  }
                               }
                               
                               ?>
                                <li><a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic["name"]));?>"><?php echo $topic["name"];?></a></li>
                               <?php
                               $count = $count+1;
                               
                               if($count == $li_per_column && $col_count != $no_column)
                               {

                                  $count = 0;

                                  ?>
                                  </ul>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brwse-lnks ">
                                  <ul class="anc-link no-pad">

                                  <?php
                                  $col_count = $col_count+1;
                               }
                               else if($col_count == $no_column && $total_rows == 0)
                               {
                                 ?>
                                 </ul>
                                  </div>
                                 <?php
                               }
                               $total_rows = $total_rows-1;
                            }
                            ?>
          <!-- <li><a href="#">Bankruptcy &amp; Debt</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Civil Rights</a></li>
          <li><a href="#">Criminal Defense</a></li>
          <li><a href="#">Speeding &amp; Traffic Ticket</a></li>
        </ul>     
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brwse-lnks ">
                    <ul class="anc-link no-pad">
          <li><a href="#">Bankruptcy &amp; Debt</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Civil Rights</a></li>
          <li><a href="#">Criminal Defense</a></li>
          <li><a href="#">Speeding &amp; Traffic Ticket</a></li>
        </ul>    
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brwse-lnks ">
                   <ul class="anc-link no-pad">
          <li><a href="#">Bankruptcy &amp; Debt</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Civil Rights</a></li>
          <li><a href="#">Criminal Defense</a></li>
          <li><a href="#">Speeding &amp; Traffic Ticket</a></li>
        </ul>    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brwse-lnks ">
                   <ul class="anc-link no-pad">
          <li><a href="#">Bankruptcy &amp; Debt</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Civil Rights</a></li>
          <li><a href="#">Criminal Defense</a></li>
          <li><a href="#">Speeding &amp; Traffic Ticket</a></li>
        </ul>  
                </div> -->
          
                            
        </div>        
    </div>
</section>
<!-- main content container -->
<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>