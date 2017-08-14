<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
$(document).ready(function() {

    $('.remain_form').hide();
    $('#cancel_quest').click(function(){
        $('.remain_form').hide();
        $('.askbtn').show();
    });
    $('#quest').on('focus',function(){
        $('.remain_form').show();
        $('.askbtn').hide();
    });
    $('.askbtn').click(function(){
        $('.remain_form').show();
        $('.askbtn').hide();
    });
    $("textarea").each(function(){
        var max_length = $(this).attr('data-maxlength');
        var text_length = $(this).val().length;
        var text_remaining = max_length - text_length;
        var counter_id = $(this).attr('data-counter-id');
         
        if(text_remaining < 0)
        {
            this.value = this.value.substring(0, max_length);
            $('#'+counter_id).text(0);
            return false;
        }
        $('#'+counter_id).text(text_remaining);
    });
    $('textarea').keyup(function() {
        var max_length = $(this).attr('data-maxlength');
        var text_length = $(this).val().length;
        var text_remaining = max_length - text_length;
        var counter_id = $(this).attr('data-counter-id');
        if(text_remaining < 0)
        {
            this.value = this.value.substring(0, max_length);
            $('#'+counter_id).text(0);
            return false;
        }
        $('#'+counter_id).text(text_remaining);
    });

    $("#questions").validate({
        rules :{
            'quest':{required:true},
            'quest_detail':{required:true},
            'city_state':{required:true}
        }
    });

    $("#city_state").keyup(function() {
        var city = $('#city_state').val();
        if(city=="" && city.length <= 3)
        {
          $("#display").html("");
        }
        else
        {
            $.ajax({
            type: "POST",
            url: '<?php echo site_url("my_quickr/city_suggest");?>',
            data: {city:city },
            success: function(html){
                
                $("#display").html(html).show();
            }
            });
        }
    });

    $('.tagclick').click(function(){
       
        var newtopic = $(this).attr('data-topic');
        var newlocation = $(this).attr('data-location');
        $('#topic_name').val(newtopic);
        $("#city_county").val(newlocation);
        $('#search_topic_form').submit();
    });

   $('.topiccheck').click(function(){
      
      var output = jQuery.map($(':checkbox[name="topicid[]"]:checked'), function (n, i) {
          return n.value;
      }).join(',');

      $('#tag').val(output);
       setTimeout(function () {
        $("#tag_form").submit();
    }, 1000);
      
  });

   $('.apply').click(function(){
      
      var output = jQuery.map($(':checkbox[name="mtopicid[]"]:checked'), function (n, i) {
          return n.value;
      }).join(',');

      $('#tag').val(output);
      
      $("#tag_form").submit();
    
      
  });

    $('.text-meta').click(function(){
      var otherdiv = $(this).attr('data-other-content-id');
      var curdiv =$(this).attr('data-my-content-id');
      $('#'+otherdiv).show();
      $('#'+curdiv).hide();
    });
    
});
function fill(Value)
    {
        $('#city_state').val(Value);
        $('#display').hide();
    }

</script>
<style type="text/css">
    #display ul {margin: -7px 20px 20px 0 !important;}
    textarea {color:black !important;}
    .tag {padding: 0 5px !important;border-radius: 8px !important;}
    .btn-link{color:#777777!important}
</style>
<body>
<?php include 'header.php' ?>

<!-- main content container -->
<div class="clearfix"></div>

<?php $this->load->view('search_form');?>
<section class="sec-tp">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('free-financial-advice');?>">Financial Advice</a></li>    
          <?php
          $topic_name = '';
          if($this->session->has_userdata('search_by_topic')){
            $topic = $this->session->userdata('search_by_topic');
            $topic_name = $topic['topicname'];
          }

          ?>               
          <li class="active"> Financial Advice on <?php echo $topic_name;?> </li>
        </ol>
      </div>
    </div>
  </div>
</section>

<div class="container">
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
<?php if($this->session->flashdata('failure') != '') { ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
      <div role="alert" class="alert alert-danger alert-dismissible fade in">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
          <?php echo $this->session->flashdata('failure');?> 
      </div>
    </div>
  </div>
<?php unset($_SESSION['failure']); } ?>
</div>


<?php if($search_result != '') {?> 
<section class="living-will">
  <div class="container"> 

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="">Legal Advice for “<?php echo $topic_name;?>” — <span><?php echo $result_count;?> results</span></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <div class="filters">
          <h2 class="o-title">Topics</h2>
          <?php
          if(isset($_GET['tag']))
          $tagids = explode(',',$_GET['tag']);
          foreach($topics as $topic){
            ?>
            <div class="checkbox">
            <label>
              <input class="topiccheck" type="checkbox" name="topicid[]" id="topic_<?php echo $topic['id'];?>" value="<?php echo $topic['id'];?>" <?php if(isset($tagids) && in_array($topic['id'], $tagids)) echo 'checked="checked"';?>>
              <?php echo $topic['name'];?> </label>
            </div>
            <?php
          }
          ?>
          
         
          <p>
          <a class="btn btn-link" data-toggle="modal" data-target="#topicModal">All Topics</a>
          
          </p>
        </div>  
      </div>
      
      
      <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12"> 
      	<ul class="lwp-mid-contnt">
        <?php foreach($search_result as $result){?>
    	  <li><div class="lw-contnt">
        	<p><a href="<?php echo site_url('legal-answer/'.$result['id']);?>"><?php echo $result['subject'];?> </a></p>
            <p>Asked in <?php echo $result['location'];?> - <?php echo $this->my_quickr_model->time_cal(strtotime($result['submitted_date']));?>.</p>
            <p>
            	<a href="#"><img src="images/1254346_1291128771.jpg"></a>
                <a href="#"><img src="images/1254346_1291128771.jpg"></a>
                <a href="#"><img src="images/1254346_1291128771.jpg"></a>
                <a href="#"><img src="images/1254346_1291128771.jpg"></a>
                <a href="#"><img src="images/1254346_1291128771.jpg"></a>
                <span><?php echo $result['total_answers'];?> Adviser answers</span>
            </p>   
             <div class="clearfix"></div> 
              <div class="execution-will-button" id="tags_cutoff_<?php echo $result['id'];?>"> 
                 <?php
                        $topic = explode(',',$result['topic']);
                        $category = explode(',', $result['category']);
                        $topics_array = array_filter(array_merge($topic,$category));
                        if(!empty($topics))
                        {
                            $i = 1;
                            foreach($topics_array as $topic)
                            {
                              
                                $topic_name =  $this->my_quickr_model->get_by_id('topics','name',$topic);
                                
                                if($i == 4){?>
                                <a  class="text-meta btn btn-link" data-my-content-id="tags_cutoff_<?php echo $result['id'];?>" data-other-content-id="tags_full_<?php echo $result['id'];?>"> - more</a>
                                <?php
                                  break;
                                }
                                ?>
                                <!--href="<?php //echo site_url('search/index/'.str_replace(" ","-",$topic_name));?>"-->
                                <a class="btn btn-info btn-sm tag tagclick" data-topic = "<?php echo $topic_name;?>" data-location="<?php echo $location;?>"  ><?php echo $topic_name;?></a>
                                
                                <?php
                                $i = $i+1;
                            }
                            //echo "<a class='btn-primary' style='padding:3px;margin-right:5px'>".implode('</a><a class=" btn-primary" style="padding:3px;margin-right:5px">', $topic_name)."</a>";
                        }
                        ?>
                 
              </div>

              <div class="execution-will-button" id="tags_full_<?php echo $result['id'];?>" style="display:none"> 
                 <?php
                        $topic = explode(',',$result['topic']);
                        $category = explode(',', $result['category']);
                        $topics_array = array_filter(array_merge($topic,$category));
                        if(!empty($topics))
                        {
                            
                            foreach($topics_array as $topic)
                            {
                              
                                $topic_name =  $this->my_quickr_model->get_by_id('topics','name',$topic);
                                
                               ?>
                                <!--href="<?php //echo site_url('search/index/'.str_replace(" ","-",$topic_name));?>"-->
                                <a class="btn btn-info btn-sm tag tagclick" data-topic = "<?php echo $topic_name;?>" data-location="<?php echo $location;?>"  ><?php echo $topic_name;?></a>
                                
                                <?php
                                
                            }
                            ?>
                            <a  class="text-meta btn btn-link" data-my-content-id="tags_full_<?php echo $result['id'];?>" data-other-content-id="tags_cutoff_<?php echo $result['id'];?>"> - less</a>
                            <?php
                            //echo "<a class='btn-primary' style='padding:3px;margin-right:5px'>".implode('</a><a class=" btn-primary" style="padding:3px;margin-right:5px">', $topic_name)."</a>";
                        }
                        ?>
                 
              </div>

           </div></li> 
           <?php } ?>
        <form name="tag_form" id="tag_form" method="get" action="<?php echo site_url('search');?>">
        <input type="hidden" name="tag" id="tag" value="">
        </form>
        </ul>
        <?php echo $this->pagination->create_links(); ?>
        
       
        
        
       <div class="row">	
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lw-page">
                            	<div class="what-lukng-for">
                            	<?php $this->load->view('question_post_form');?>
                            </div>
                            </div>                        
                        </div>
        
        
        
               	       
       
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      	<div class="row">
      	<div class="lw-ask-lawyer">
        	<h2>Ask a lawyer</h2>
            <p>Get free answers from experienced attorneys.</p>
            <a href="<?php echo site_url('ask-a-financial-adviser');?>" class="btn btn-primary btn-sm">Ask a questions </a>        
        </div> 
        </div> 
        
        <div class="row">
        	<div class="fnd-lwyer">
        	<h2>Find Wills Lawyers</h2>
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
           <p><a href="#">Atlanta</a> <span>(99)</span></p>
            </div>       
        </div>
        </div>            
      </div>
    </div>
  </div>
</section>
<?php } else {?>
<div class="container">
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"> 
<div class="row">
<?php $this->load->view('question_post_form');?>
</div>
</div>
</div>  
<?php } ?> 
<!-- main content container -->
<div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="Topic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">All Topics</h4>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="loginForm" method="post" class="form-horizontal">
                   <div class="row">                        
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 brws-lgl-topics">
                            <ul class="topics">
                            <?php
                            $li_per_column = floor(count($topics)/3);
                            $lipercol = $li_per_column;
                            $total_rows = count($topics);
                            $remain_rows = ($total_rows-($li_per_column*3));
                            $no_column = 3;
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
                                <li>
                                <!-- <a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic["name"]));?>"><?php echo $topic["name"];?></a> -->
                                <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="mtopicid[]" id="mtopic_<?php echo $topic['id'];?>" value="<?php echo $topic['id'];?>" <?php if(isset($tagids) && in_array($topic['id'], $tagids)) echo 'checked="checked"';?>>
                                  <?php echo $topic['name'];?> </label>
                                </div>
                                </li>
                               <?php
                               $count = $count+1;
                               
                               if($count == $li_per_column && $col_count != $no_column)
                               {
                                  $count = 0;

                                  ?>
                                  </ul>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 brws-lgl-topics">
                                  <ul class="topics">

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
                                                                            
                     </div> </div>
                     <hr/>
                     <div class="form-group">
                        
                            <button type="button" class="btn btn-primary apply" style="float:right">Apply</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>