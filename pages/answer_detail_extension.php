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
</style>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if(!empty($related_topic)){
        	  $rand_topics = array_rand($related_topic, 2);
        	  ?>
               <div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 relted-topics">
                    <h2>Related Topics</h2>                    
                    </div>
                    <?php 
                    $l = 0;
                    foreach($rand_topics as $rand)
                    { 
                    	$where = "FIND_IN_SET('".$rand."', topic)";
                    	if($l != 0)
                    	 $where .= " and NOT FIND_IN_SET('".$rand_topics[0]."',topic)";
                    	
                    	$record = $this->my_quickr_model->select_from('tips','*',$where,array('posted_date'=>'desc'),5);
                    	$where_topic = array('id'=>$rand);
                        $topic_detail = $this->my_quickr_model->select_from('topics','id,name',$where_topic);
                        $l = $l+1;
                        if(!empty($record))
                        {
                        ?>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class="row">
		                        	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 crminl-defnse">
		                         		<h2><?php echo $topic_detail[0]['name'];?></h2>
		                         		<p><?php echo $topic_detail[0]['description'];?></p>
		                         	</div>                        	
		                        </div>
		                       
		                    	<div class="row">  
		                    	                     
		                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">                        	                  
		  								<img src="<?php echo base_url();?>src/images/attorney-pic.jpg">                       		
		                            </div> 
		                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 crminl-defnse">  
		                            	<h3><?php echo $record[0]['title'];?> - 
		                                <span>Written by adviser <a href="#"><?php echo $this->my_quickr_model->get_name_by_id($record[0]['user_id']);?></a></span>
		                                </h3>                      	                    
		  								<p><?php echo substr($record[0]['description'],0,150);?>... <a href="<?php echo site_url('guides/'.str_replace(" ","-",$record[0]['title']));?>">more</a></p>
		                            </div> 
		                           
		                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">                        	                    
		  								<ul class="crmnl-defnse-lst">
		  								<?php
		  								    $k=0;
		                    	   			foreach($record as $row){
		                    	   	         if($k != 0){ ?>
		                                	<li><a href="<?php echo site_url('guides/'.str_replace(" ","-",$row['title']));?>"><?php echo $row['title'];?> - <?php echo Date('M d, Y', strtotime($row['posted_date']));?></a></li>
		                                    
		                                    <?php } $k= $k+1;}?>
		                                </ul>            		
		                            </div>                                              
		                        </div>                  
		                    </div> 

                    <div class="more-on-criminal-btn text-center">  
                     	 <a class="btn btn-primary " href="<?php echo site_url('topic/'.str_replace(" ","-",$topic_detail[0]['name']));?>">More on <?php echo $topic_detail[0]['name'];?>  </a>
                    </div> 
                    <?php } }?>                       
                </div>  
                        
                <div class="row">	
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <!-- <div>
  <input type="checkbox" class="read-more-state" id="post-1" />

  <p class="read-more-wrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <span class="read-more-target">Libero fuga facilis vel consectetur quos sapiente deleniti eveniet dolores tempore eos deserunt officia quis ab? Excepturi vero tempore minus beatae voluptatem!</span></p>
  
  <label for="post-1" class="read-more-trigger"></label>
  </div> -->
                        <div class="cont-fnd-what-lukng">
                            <h2>Can't find what you're looking for? Ask a financial adviser</h2>
                            <p> Get free advice from experienced financial advisers</p>
                            <form name="questions" id="questions" method="post" action="<?php echo site_url('my_quickr/ask_question');?>">
		                        <div class="form-group">
		                            <label for="subject">Your question</label>
		                            <p class="help-block pull-right">(<span id="question_form_subject_counter">128</span> Characters Remaining)</p>
		                            <textarea class="form-control" style="width: 773px;!important" name="quest" id="quest" rows="5" data-maxlength="128" data-counter-id="question_form_subject_counter" placeholder="e.g., Do I need a real estate attorney?"><?php if(isset($question[0]['subject'])) echo $question[0]['subject'];?></textarea>
		                        </div>
		                        <div class="remain_form">
		                        <div class="form-group" >
		                            <label for="subject">Add Details</label>
		                            <p class="help-block pull-right">(<span id="question_form_body_counter">800</span> Characters Remaining)</p>
		                            <textarea class="form-control" style="width: 773px;!important" name="quest_detail" id="quest_detail" rows="5" data-maxlength="800" data-counter-id="question_form_body_counter" placeholder="Include background information that will enable lawyers to answer your question."><?php if(isset($question[0]['detail'])) echo $question[0]['detail'];?></textarea>
		                        </div>
		                        
		                        <div class="form-group" >
		                            <label for="subject">City and County</label>
		                            <input type="text" class="form-control" autocomplete="off" name="city_state" id="city_state" value="<?php if(isset($question[0]['location'])) echo $question[0]['location'];?>" placeholder="eg:Los Angeles, CA">
		                        </div>
		                        <div id="display"></div>
		                        
		                        <div class="form-group"> <span class="label label-danger">* All fields required</span> </div>
		                        <input type="hidden" class="form-control" name="quest_id" id="quest_id" value="<?php if(isset($question[0]['id'])) echo $question[0]['id'];?>">
		                        <input type="submit" class="btn btn-primary" style="margin:10px 0px 15px 0px;" value="Preview" name="commit">
		                        <a class="btn btn-link" id="cancel_quest">Cancel</a>
		                        </div>
		                        <button class="btn btn-primary ask-nw-btn askbtn" type="button">Ask now !</button>
		                      </form>
                            <p><?php echo $answer_count;?> answers this week</p>
                            <p><?php echo $adviser_count;?> attorneys answering</p>
                        </div>
                    </div>                        
                </div>
            
              <?php
         } ?>
        </div>
    </div>
</div>