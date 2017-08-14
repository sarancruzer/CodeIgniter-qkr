<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#add_information").click(function(){
            
            $("#addInfo").show();
            $("#add_information").hide();
            $("#additional_info").focus();
        });

        $("#cancel").click(function(){
            $("#addInfo").hide();
            $("#add_information").show();
        });

        $("#edit").click(function(){
            $("#editaddInfo").show();
            $("#info_block").hide();
        });
        $("#edit_cancel").click(function(){
            $("#editaddInfo").hide();
            $("#info_block").show();
        });

        $("#answer_question").click(function(){

            $.ajax({
            type:'POST',
            dataType:'text',
            async: false,
            url:'<?php echo site_url("my_quickr/adviser_valid_check");?>',
            success:function(response){
                if(response == '1')
                {
                    $("#answer_input").show();
                    $("#answer_question").hide();
                }
                else
                {
                    window.location.reload();
                }

            }
            
            });
            
        });
        $("#answer_cancel").click(function(){
            $("#answer_input").hide();
            $("#answer_question").show();
        });

        $("#submit").click(function(){
            var add_info = $("#additional_info").val();
            var quest_id = $("#quest_id").val();
            $.ajax({
            type:'POST',
            dataType:'json',
            data:{info:add_info,id:quest_id},
            url:'<?php echo site_url("my_quickr/add_additional_info");?>',
            success:function(response){
                if(response == 1)
                    window.location.reload();
               }
            });          
        });

        $("#answer_submit").click(function(){
            var answer = $("#answer").val();
            var quest_id = $("#quest_id").val();
            var response = '';
            $.ajax({
            type:'POST',
            dataType:'json',
            data:{answer:answer,id:quest_id},
            url:'<?php echo site_url("my_quickr/add_answer");?>',
            success:function(response){
                if(response == 1)
                    window.location.reload();
                
               }
            });          
        });

        $('.qflag_anchor').click(function(){
           
            var div_content = $("#question_flag_popup").html();
           $(this).popover({
                title: "Flag as objectionable",
                content: div_content, 
                trigger: 'manual',
                html:true
            }).click(function(){
                 $(this).popover('show');
            });
        });

        $('body').on('click','a.question_cancel',function(){
            $('.qflag_anchor').popover('hide');
        });

        $('body').on('click','a.question_flag_object',function(){
            var quest_id = $(this).attr('data-queid');
            
            $.ajax({
            type:'POST',
            dataType:'text',
            async: false,
            data:{quest_id:quest_id},
            url:'<?php echo site_url("my_quickr/flag_question");?>',
            success:function(response){
                if(response)
                {
                    $('.qflag_anchor').popover('hide');
                    $('#quest_fag').html('<a class="pointer"> <i class="fa fa-flag" style="color:red"></i> Flagged</a>');
                }

            }
            
            });

        });

        $('.add_category').click(function(){
             $('#category_div').show();
             $('#tag_list').hide();
        });
        $('#tag_cancel').click(function(){
            $('#category_div').hide();
             $('#tag_list').show();
        });

        $('#tag_add').click(function(){
            var values = new Array();
            $.each($("input[name='tags[]']:checked"), function() {
              values.push($(this).val());
            });
            values.join(',');
            var quest_id = $('#cquest_id').val();
            if(values.length !== 0){
                $.ajax({
                type:'POST',
                dataType:'json',
                data:{tags:values,quest_id:quest_id},
                url:'<?php echo site_url("my_quickr/add_tags");?>',
                success:function(response){
                    if(response.status == 1)
                    {
                        window.location.reload();
                        // $('#category_div').hide();
                        // $('#tag_list').html(response.content);
                        // $("#tag_list").show();
                    }

                }
                
                });
            }
        });

        $('.delete_tag').click(function(){
            var id= $(this).attr('data-id');
            var quest_id = $('#cquest_id').val();
             $.ajax({
                type:'POST',
                dataType:'json',
                data:{id:id,quest_id:quest_id},
                url:'<?php echo site_url("my_quickr/delete_tags");?>',
                success:function(response){
                    if(response)
                    {
                        window.location.reload();
                    }

                }
                
                });
        });

    });
</script>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<?php echo $this->load->view('search_form');?>

<?php
if($this->session->has_userdata('logged_in')){?>
<section class="look-attorney">
<div class="container">
    <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="la-lnk">
                    <p><a href="<?php echo site_url('answer');?>">Questions & Answers </a> > <a href="#"> <?php echo $this->my_quickr_model->limit_text($questions[0]['subject'],5);?></a></p>
                 </div>
           </div>                 
    </div>  
</div>
</section>
<?php } ?>
<!-- main content container -->
<section>
<div class="container">

    <div class="row" >
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
        <?php if($this->session->flashdata('Failure') != '') { ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
            <div role="alert" class="alert alert-danger alert-dismissible fade in">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
              <?php echo $this->session->flashdata('Failure');?> 
             </div>
          </div>
        </div>
        <?php } ?>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="lukin-contain">
                        <div class="lkin-top">
                            <div class="lkin-head">
                                <h1><?php echo $questions[0]['subject'];?></h1>
                            </div>
                            <?php if($user['is_fa'] == 1) {?>
                            <div class="ans-points" style="float: right;!important">
                                <p>O answer points</p>
                                <p><a href="#">O answer points</a></p>
                            </div> 
                            <?php } ?>                    
                        </div>
                        <div class="clearfix"></div>                
                        <p>Asked about <?php echo $this->my_quickr_model->time_cal(strtotime($questions[0]['submitted_date']));?> - <?php echo $questions[0]['location'];?> 
                            <?php if($this->session->has_userdata('logged_in')) {
                                $userid = $this->session->userdata('logged_in'); ?>
                            <span id="quest_fag">
                                <?php
                                $qwhere = array(
                                'quest_id' => $questions[0]['id'],
                                'flag' => 1,
                                'user_id' => $user['id']
                                );
                                
                            $qflag = $this->my_quickr_model->select_from('question_flag','id',$qwhere);
                            if(empty($qflag)){ ?>
                                <a class="qflag_anchor pointer"> <i class="fa fa-flag"></i> Flag</a>
                            <?php } else {?>
                                <span><a><i class="fa fa-flag pointer" style="color:red"></i> Flagged</a></span>
                            <?php } ?>
                            </span>
                            <?php } ?>
                        </p>
                        <div id="question_flag_popup" style="display:none" >
                            <p> If you feel this violates our <a target="_blank" href="#">Community Guidelines</a>, confirm your objection below. </p> 
                            <br/> 
                            <div style="padding-bottom:3px"> 
                              <a class="btn btn-warning question_flag_object" data-queid="<?php echo $questions[0]['id'];?>" >I object!</a>  <a class="btn btn-default question_cancel" >Cancel</a> 
                            </div>
                        </div>
                        <?php if($user['is_fa'] == 1) {?>
                        <p>Practice area : <?php 
                           $areas = explode(',' ,$questions[0]['topic']);
                           foreach($areas as $area)
                            {
                               $area_name[] = $this->my_quickr_model->get_by_id('topics','name',$area);
                            }
                            echo "<span style='margin-right:5px'><a class='btn btn-info'>".implode('</a></span><span style="margin-right:5px"><a class="btn btn-info">', $area_name)."</a></span>";
                            ?>
                        </p> 
                         
                        <div class="add-btn">
                            <div id="tag_list">
                            <?php 
                                if(empty($questions[0]['category'])){
                            ?>
                                Tags:
                             <?php } else {
                                $tags = explode(',',$questions[0]['category']);
                                foreach($tags as $tag)
                                    {
                                        $tag_name =  $this->my_quickr_model->get_by_id('topics','name',$tag);
                                        $html .= "<span class='btn-tag btn-blue' type='button'>".$tag_name."<span class='badge'><a class='delete_tag' data-id='".$tag."' style=\"color:#fff\">X</a></span></span>";
                                    }
                               // echo "<button class='btn-tag btn-blue' type='button'>".implode('<span class="badge">X</span></button><button class="btn-tag btn-blue" type="button">', $tag_name)."<span class='badge'>X</span></button>";
                                   echo $html;
                            ?>             
                            <?php }?>
                            - <a class="add_category btn-link">Edit</a>
                            </div>
                            </p> 
                            <div id="category_div" style="padding:10px;border:1px solid green;display:none">
                              <?php
                                if(!empty($questions[0]['topic']))
                                {
                                    $mtopic = explode(',',$questions[0]['topic']);
                                    
                                    foreach($mtopic as $major)
                                    {
                                       
                                        $result = $this->my_quickr_model->select_from('topics_mapping','child',array('parent'=>$major));

                                        foreach ($result as $value) {
                                            $tagsarray[] = $value;
                                        }
                                        
                                    }
                               
                                    ?>
                                    <div class="form-group">
                                    <?php foreach($tagsarray as $cate)
                                    {
                                        $child_name =  $this->my_quickr_model->get_by_id('topics','name',$cate['child']);
                                        ?>
                                        <div class="checkbox">
                                        <label><input type="checkbox" <?php if(in_array($cate['child'],explode(',',$questions[0]['category']))){ echo 'checked="checked"';}?>  name="tags[]" id="tag_<?php echo $cate['child'];?>" value="<?php echo $cate['child'];?>"><?php echo $child_name;?></label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <input type="hidden" name="cquest_id" id="cquest_id" value="<?php echo $questions[0]['id'];?>">
                                    <input type="button" class="btn btn-primary" name="tag_add" id="tag_add" value="Add">
                                    <input type="button" class="btn btn-default" name="tag_cancel" id="tag_cancel" value="Cancel">
                                    <?php
                                }
                              ?>
                            </div>
                        </div> 
                        <?php } ?> 
                        <?php if(!$this->session->has_userdata('logged_in')){?>
                        <p>Filed Under :
                        <?php
                        $topic = explode(',',$questions[0]['topic']);
                        $category = explode(',', $questions[0]['category']);
                        $topics = array_filter(array_merge($topic,$category));
                        if(!empty($topics))
                        {
                            
                            foreach($topics as $topic)
                            {
                                $topic_name =  $this->my_quickr_model->get_by_id('topics','name',$topic);
                                ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('topic/'.str_replace(" ","-",$topic_name));?>" target="_blank" ><?php echo $topic_name;?></a>
                                <?php
                            }
                            //echo "<a class='btn-primary' style='padding:3px;margin-right:5px'>".implode('</a><a class=" btn-primary" style="padding:3px;margin-right:5px">', $topic_name)."</a>";
                        }
                        ?>
                        </p>
                        <?php } ?>               
                        <p> <?php echo $questions[0]['detail'];?></p>
                        <?php if($questions[0]['add_info'] != ''){?> 
                        <div class="add-btn">
                            <div class="row" id="info_block">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pro-p-box">
                                   <p> <?php echo $questions[0]['add_info'];?>  
                                   <?php if($this->session->has_userdata('logged_in') && $questions[0]['client_id'] == $userid['id']){?>
                                  - <a id="edit" href="#" class="btn-link">Edit</a></p>
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($this->session->has_userdata('logged_in') && $questions[0]['add_info'] == '') {
                               
                        if($questions[0]['client_id'] == $userid['id']){?>  
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a id="add_information" href="#" class="btn-link">Add Additional Information</a>
                                </div>
                            </div>
                            <div class="row" id="addInfo" style="display:none">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="subject">Additional Information</label>
                                        <textarea class="form-control" name="additional_info" id="additional_info" rows="5"></textarea>
                                        <input type="hidden" name="quest_id" id="quest_id" value="<?php echo $questions[0]['id'];?>">
                                    </div>

                                    <input type="button" name="submit" class="btn btn-primary" id="submit" value="submit">
                                    <input type="button" name="cancel" class="btn btn-default" id="cancel" value="cancel">
                                 </div>
                            </div>
                  
                        <?php } } if($questions[0]['add_info'] != ''){ ?>
                            <div class="row" id="editaddInfo" style="display:none">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="subject">Additional Information</label>
                                            <textarea class="form-control" name="additional_info" id="additional_info" rows="5"><?php echo $questions[0]['add_info'];?></textarea>
                                            <input type="hidden" name="quest_id" id="quest_id" value="<?php echo $questions[0]['id'];?>">
                                    </div>
                                    <input type="button" name="submit" class="btn btn-primary" id="submit" value="submit">
                                    <input type="button" name="cancel" class="btn btn-default" id="edit_cancel" value="cancel">
                                </div>
                            </div>
                        <?php } ?>
                
                        <?php if($user['is_fa'] == 1){
                            
                            if($remaining_time->d <= 7) {?>
                                <div class="ans-btn">
                                    <button id="answer_question" class="btn" type="button">Answer this question</button>
                                    This questions is open to new answers for
                                    <?php if($remaining_time->d != 7) 
                                       echo (7-$remaining_time->d ). ' days';
                                      else if($remaining_time->h != 0)
                                        echo $remaining_time->h.' hours';
                                      else if($remaining_time->i != 0)
                                        echo $remaining_time->i.' minutes';
                                      else if($remaining_time->s != 0)
                                        echo $remaining_time->s.' seconds';
                                    ?>
                                </div>
                            <?php } else {?>
                                <button class="btn" type="button">Closed</button>
                            <?php } ?>

                        <div class="ans-btn" id="answer_input" style="display:none">
                            <div class="form-group">
                                <label for="subject">Answer this question</label>
                                <textarea class="form-control" name="answer" id="answer" rows="5"></textarea>
                                <input type="hidden" name="quest_id" id="quest_id" value="<?php echo $questions[0]['id'];?>">
                            </div>
                            <input type="button" name="submit" class="btn btn-primary" id="answer_submit" value="submit">
                            <input type="button" name="cancel" class="btn btn-default" id="answer_cancel" value="cancel">
                        </div>
                        <?php } ?>
               
                        <div class="lukin-save" style="margin-top:10px;">
                            <?
                            if($this->session->has_userdata('logged_in') && $questions[0]['client_id'] == $userid['id']) { ?>
                                <a href="<?php echo site_url('my_quickr/advice');?>" class="btn btn-default" >Saved</a>
                            <?php } else if($this->session->has_userdata('logged_in') && isset($saved_quest) && !in_array($questions[0]['id'], $saved_quest)){?>
                                <a href="<?php echo site_url('my_quickr/save_advice/'.$questions[0]['id'].'/'.$userid['id']);?>" class="btn btn-primary" >Save</a>
                            <?php  } else if($this->session->has_userdata('logged_in') && isset($saved_quest) && in_array($questions[0]['id'], $saved_quest)) { ?>
                                    <a href="<?php echo site_url('my_quickr/advice/');?>" class="btn btn-default" >Saved</a>
                            <?php }?>
                            <!-- <button class="btn" type="button">Save</button>  -->
                        </div>
                    </div> <!-- lukin container end -->
                </div> <!-- column end -->
            </div> <!-- row end -->
         
            <!-- Answer block -->
            <?php

            if($this->session->has_userdata('logged_in')){
                $this->load->view('answers_list_lawyer');
            }
            else {
                ?>
                <hr style="border:1px solid #000">
                <?php
                $this->load->view('answer_list_client');
             }?>
            <!-- Answer block end -->
        </div> <!-- left column end -->
        <!--Side bar -->
        <?php
        
        if($user['is_fa'] === '1'){
            $this->load->view('answer_page_sidebar_fa');
        }
        else if($user['is_fa'] === '0'){
            $this->load->view('answer_page_sidebar_client');
        
        }?>
        <!-- side bar end -->
    </div> <!-- main row end -->  
    <?php
    if(!$this->session->has_userdata('logged_in'))
    {
        if(!empty($related_topic )){
        ?>
        <section class="cmmn-question">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Related Topics </h2>
                    </div>
                </div>
            
                <div class="row">
               
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">              
                        <?php

                           $i = 1;
                           foreach($related_topic as $topic)
                            {
                                if($i%2 != 0)
                                {
                                    ?>
                                    <p><a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic['name']));?>"><?php echo $topic['name'];?></a></p>
                                    <?php
                                }
                                $i=$i+1;
                             ?>         
                            
                        <?php } ?>
                        </div>        
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php
                       $i = 1;
                       foreach($related_topic as $topic)
                        {
                            if($i%2 == 0)
                            {
                                ?>
                                <p><a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic['name']));?>"><?php echo $topic['name'];?></a></p>
                                <?php
                            }
                            $i=$i+1;
                         ?>         
                        
                        <?php } ?>
                    </div>        
                </div>    
            </div> 
        </section>
        <?php }
        if(!empty($related_tips)){ 
        ?>
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
                           foreach($related_tips as $tip)
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
                           foreach($related_tips as $tip)
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
        <?php } 
        if(!empty($others_asking)){?>
        <section class="rcent-ask-quest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <h2>What others are asking</h2>
                 </div>
                </div>
            
                <div class="row">       
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">   
                       <?php
                       $i = 1;
                       foreach($others_asking as $question)
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
                       foreach($others_asking as $question)
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
          <?php } ?>

          <section class="cant-fnd-lookn" style="border-top:3px solid #000">
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

        <section class="brws-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2>Browse across common financial topics</h2>
                    <div class="row">                        
                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brws-lgl-topics">
                            <ul class="topics">
                            <?php
                            
                            $li_per_column = floor(count($alltopics)/4);
                            $lipercol = $li_per_column;
                            $total_rows = count($alltopics);

                            $remain_rows = ($total_rows-($li_per_column*4));
                            
                            $no_column = 4;
                            $count = 0;
                            $col_count = 1;
                            foreach($alltopics as $topic){
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
                                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brws-lgl-topics">
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
                    <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('topics/all_topics/a');?>">See all financial topics</a>             
                 </div>            
                      
            </div>  
        
    </section>
        <?php
    }
    else if($user['is_fa'] === '0'){
        $this->load->view('answer_detail_extension');
    }
    ?>
</div>
<!-- main content container -->
</section>

<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
