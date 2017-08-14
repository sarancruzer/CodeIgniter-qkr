  
<script type="text/javascript">
    $(document).ready(function(){

        $(".read_more").click(function(){
              
              var current_div_class = $(this).closest('div').attr('class');
              var next_div_class = $(this).closest('div').next().attr('class');
                $('.'+current_div_class).hide();
                $('.'+next_div_class).show();
        });
        $('.read_less').click(function(){
            var current_div_class = $(this).closest('div').attr('class');
            var prev_div_class = $(this).closest('div').prev().attr('class');
                $('.'+current_div_class).hide();
                $('.'+prev_div_class).show();
        });
        $('body').on('click', 'a.helpful_anchor', function() {
        //$('.helpful_anchor').click(function(){
             
            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var id = ajax_call('helpful_mark',quest_id,answer_id,'insert','1');
            var helpvote = (Number($('#helpful_vote_'+answer_id+' li:first-child a').text())+Number(1));
            if(id != '')
            {
                $('#helpful_vote_'+answer_id).html('<li><a>'+helpvote+'</a></li><li><p>Helpful Vote</p> </li>');
                $('.'+span_class).html('Marked as helpful - <a  class="helpful_anchor_undo pointer" data-pid= '+id+'>undo</a>');
            }
        });
        $('body').on('click', 'a.helpful_anchor_undo', function() {
        //$('.helpful_anchor_undo').click(function(){
            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var record_id = $(this).attr('data-pid');
            ajax_call('id',quest_id,answer_id,'delete',record_id);
            var helpvote = (Number($('#helpful_vote_'+answer_id+' li:first-child a').text())-Number(1));
            if(helpvote > 0)
                $('#helpful_vote_'+answer_id).html('<li><a>'+helpvote+'</a></li><li><p>Helpful Vote</p> </li>');
            else
                $('#helpful_vote_'+answer_id).html('');
            $('.'+span_class).html('<a class="helpful_anchor pointer"><i class="fa fa-arrow-up"></i> Mark as helpful</a>');
        });

         $('body').on('click', 'a.agree_anchor', function() {
        //$('.helpful_anchor').click(function(){

            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var id = ajax_call('agree',quest_id,answer_id,'insert','1');
            var agreed = (Number($('#agreed_'+answer_id+' li:first-child a').text())+Number(1));
            if(id != '')
            {
             $('#agreed_'+answer_id).html('<li><a class="adviser_popup pointer" data-ansid="'+answer_id+'">'+agreed+'</a></li><li><p>Adviser Agrees</p> </li>');
             $('.'+span_class).html('Marked as agreed - <a  class="agree_anchor_undo pointer" data-pid= '+id+'>undo</a>');
            }
        });
        $('body').on('click', 'a.agree_anchor_undo', function() {
        //$('.helpful_anchor_undo').click(function(){
            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var record_id = $(this).attr('data-pid');
            ajax_call('id',quest_id,answer_id,'delete',record_id);
            $('.'+span_class).html('<a class="agree_anchor pointer"><i class="fa fa-user"></i> I agree</a>');
        });

        $('body').on('click', 'a.best_anchor', function() {
        //$('.helpful_anchor').click(function(){

            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var id = ajax_call('best_mark',quest_id,answer_id,'insert','1');
            
            if(id != '')
            {
              $('#best_answer_'+answer_id).html('<li><p>Best Answer chosen by asker</p> </li>');
              $('.'+span_class).html('Marked as Best Answer - <a  class="best_anchor_undo pointer" data-pid= '+id+'>undo</a>');
            }
        });

        $('body').on('click', 'a.best_anchor_undo', function() {
        //$('.helpful_anchor_undo').click(function(){
            var span_class = $(this).closest('span').attr('class');
            var quest_id = $(this).closest('span').attr('data-questid');
            var answer_id = $(this).closest('span').attr('data-ansid');
            var record_id = $(this).attr('data-pid');
            ajax_call('id',quest_id,answer_id,'delete',record_id);
            $('#best_answer_'+answer_id).html('');
            $('.'+span_class).html('<a class="best_anchor pointer"><i class="fa fa-thumbs-o-up"></i> Mark as Best</a>');
        });

        $('.comment_anchor').click(function(){
            var ans_id = $(this).attr('data-id');
            $('.post_comment_'+ans_id).toggle();
        });

        $('.cancel_comment').click(function(){
            var span = $(this).closest('span').attr('class');
            $('.'+span).toggle();

        });

        $('body').on('click','a.adviser_popup' ,function(){
           
           var ansid = $(this).attr('data-ansid');

           var div_content = $("#advisers_list_"+ansid).html();
           $(this).popover({
              title: "Advisers agreed with this answer <a style=\"float:right;color:black\" class=\"pointer\" onclick=\"$(\'.adviser_popup\').popover(\'hide\')\">x</a>",
              content: div_content, 
              html:true
           });
            $(this).popover('show');
        });

        $('.flag_anchor').click(function(){
            var ansid = $(this).attr('data-ansid');
            var div_content = $("#flag_popup_"+ansid).html();
           $(this).popover({
                title: "Flag as objectionable",
                content: div_content, 
                trigger: 'manual',
                html:true
            }); 
           $(this).popover('show');
            
        });

        $('body').on('click','a.flag_anchor_cancel',function(){
            $('.flag_anchor').popover('hide');
        });

        $('body').on('click','a.flag_anchor_object',function(){
            var ansid = $(this).attr('data-ansid');
            var queid = $(this).attr('data-queid');
            ajax_call('flag',queid,ansid,'insert',1);
            $("#flag_anchor_"+ansid).html('<a class="flag_anchor pointer" data-ansid="'+ansid+'"><i class="fa fa-flag" style="color:red"></i>  Flagged</a>');
            $('.flag_anchor').popover('destroy');
        });

        $('.comment_list').click(function(){
           var aid = $(this).attr('data-aid');
           $("#comment_list_"+aid).show();
        });


        $('.submit_comment').click(function(){
            var ansid = $(this).attr('data-ansid');
            var value = $('#comment_'+ansid).val();
            var quest = $('#quest_id_'+ansid).val();
            ajax_call('comment',quest,ansid,'insert',value);
            var span = $(this).closest('span').attr('class');
            $('.'+span).toggle();
            window.location.reload();
            scrollToElement(span);
        });

        $('.reload_list').click(function(){
              var ansid = $(this).attr('data-answid');
              var queid = $(this).attr('data-questid');
              
              $.ajax({
                type:'POST',
                dataType:'html',
                //async: false,
                data:{quest_id:queid,answer_id:ansid},
                url:'<?php echo site_url("my_quickr/comment_list");?>',
                success:function(data){
                if(data != '')
                    {
                        $(this).hide();
                        $('#comment_list_'+ansid).html(data);
                    }
                 }
                });
        });

    });
function scrollToElement(ele) {
    $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
}
function ajax_call(field,quest_id,answer_id,operation,value)
{   
    var response = $.ajax({
            type:'POST',
            dataType:'text',
            async: false,
            data:{field:field,quest_id:quest_id,answer_id:answer_id,operation:operation,value:value},
            url:'<?php echo site_url("my_quickr/quest_additional_process");?>',
            
            }).responseText;  
     return response;
}
</script>
<style type="text/css">
    .pointer{
        cursor: pointer;
    }
    .popover{
        width:400px;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                
        <div class="attorni-ans">
            <h1>Advisers Answers (<?php echo $this->my_quickr_model->get_count('legal_answers',array('quest_id'=>$questions[0]['id']));?>)</h1>
                <ul>
                <?php
                if(!empty($answers)){
                    foreach ($answers as $answer) {
                    ?>
                    <li>
                        <div class="aa-outer">
                            <div class="aa-lft" >
                                <ul class="section-one">
                                    <li><img src="<?php echo base_url();?>src/images/attorney-answ-pic.jpg"></li>
                                    <li><p>License</p> </li>
                                </ul>

                                <ul class="section-two" id="agreed_<?php echo $answer['id'];?>">
                                    <?php
                                    $gwhere = array(
                                            'quest_id' => $answer['quest_id'],
                                            'answer_id' => $answer['id'],
                                            'agree' => 1,
                                            'status' => 1);
                                    $agreed = $this->my_quickr_model->select_from('quset_additional_process','*',$gwhere);
                                    if(!empty($agreed)){ ?>
                                    <li><a class="adviser_popup pointer" data-ansid="<?php echo $answer['id'];?>"><?php echo $this->my_quickr_model->get_count('quset_additional_process',$gwhere);?></a></li>
                                    <li><p>Adviser Agrees</p> </li>
                                    
                                    <?php } ?>
                                </ul>
                                
                                <ul class="section-two" id="helpful_vote_<?php echo $answer['id'];?>">
                                    <?php
                                    $hwhere = array(
                                        'quest_id' => $answer['quest_id'],
                                        'answer_id' => $answer['id'],
                                        'helpful_mark' => 1,
                                        'status' => 1);
                                    $helpcount = $this->my_quickr_model->get_count('quset_additional_process',$hwhere);;
                                    if($helpcount){ ?>
                                    <li><a><?php echo $helpcount; ?></a></li>
                                    <li><p>Helpful Vote</p> </li>
                                    <?php } ?>
                                </ul>
                                
                                <ul class="section-three" id="best_answer_<?php echo $answer['id'];?>">
                                    <?php
                                    $bwhere = array(
                                            'quest_id' => $answer['quest_id'],
                                            'answer_id' => $answer['id'],
                                            'best_mark' => 1,
                                            'status' => 1);
                                    $bestcount = $this->my_quickr_model->get_count('quset_additional_process',$bwhere);;
                                    if($bestcount){ ?>                                     
                                    <li><p>Best Answer chosen by asker</p> </li>
                                    <?php } ?>
                                </ul>
                                
                            </div>

                            <?php if(!empty($agreed)){ ?>
                                <div id="advisers_list_<?php echo $answer['id'];?>" style="display:none">
                                     <?php
                                        foreach($agreed as $agree)
                                            {?>
                                                <div class="pop-activity">                   
                                                    <div class="pop-lft">
                                                        <img src="http://local.quickr.com/quickr/src/images/rdba-pic.jpg">
                                                    </div>
                                                    <div class="pop-rgt">
                                                        <p><a href="#" class="btn-link" target="_blank"><?php echo $this->my_quickr_model->get_name_by_id($agree['input_by']);?></a></p>
                                                        <p>Immigration Attorny - New york, NY</p>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            <?php } ?>
                                </div>
                                <?php } ?>


                            <div class="aa-contain">
                                <div class="aa-info">
                                    <div class="aa-pers-info">
                                        <figure class="pull-left">
                                            <img src="<?php echo base_url();?>src/images/attorney-pic.jpg">
                                        </figure>
                                        <h2><?php echo $this->my_quickr_model->get_name_by_id($answer['adviser_id']);?></h2>
                                        <p>Military Law Attorney - Tacoma, WA</p>
                                        <p><span><img src="<?php echo base_url();?>src/images/leaf-pic.jpg"></span>Contributor Level 14</p>                       
                                    </div>
                                    <div class="aa-cont-info">
                                        <div class="con-detail">
                                            <p>Contact this Lawyer</p>
                                            <p><a class="btn btn-default" href="#" role="button">Email</a>
                                            <a class="btn btn-default" href="#" role="button">Visit website</a></p>                    
                                        </div>
                                    </div>                                    
                                </div> 
                                            
                                <div class="aanswers">
                                    <?php if($this->session->has_userdata('logged_in')) {?>
                                    <p><?php echo 'Answered '.$this->my_quickr_model->time_cal(strtotime($answer['answered_date']));?></p>
                                    <?php } ?>
                                    <div class="read_more_<?php echo $answer['id'];?>">
                                    <p><?php 
                                    $string = strip_tags($answer['answer']);
                                    $true = 0;
                                    if (strlen($string) > 250) {
                                        $true =1;
                                        // truncate string
                                        $stringCut = substr($string, 0, 250);
                                        // make sure it ends in a word so assassinate doesn't become ass...
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                        }
                                    echo $string;
                                    ?></p>
                                    <?php if($true){?>
                                    <p> <a class="btn btn-default read_more" data-id="<?php echo $answer['id'];?>" role="button">Read More</a></p>
                                    <?php } ?>
                                    </div>
                                    <div class="read_less_<?php echo $answer['id'];?>" style="display:none">
                                    <p><?php echo $answer['answer'];?></p>
                                    <p> <a class="btn btn-default read_less" data-id="<?php echo $answer['id'];?>"  role="button">Read Less</a></p>
                                    </div>
                                </div>
                                            
                                <!-- <p> <a class="btn btn-default" href="#" role="button">Read More</a></p> -->
                                <p>
                                <?php $s_user = $this->session->userdata('logged_in');?>
                                <?php if($s_user['is_fa'] == 1){?>
                                <span class="agree_<?php echo $answer['id'];?>" data-ansid = "<?php echo $answer['id'];?>" data-questid ="<?php echo $answer['quest_id'];?>">
                                <?php
                                $awhere = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'agree' => 1,
                                    'status' => 1,
                                    'input_by' => $s_user['id']
                                    );
                                $agree = $this->my_quickr_model->select_from('quset_additional_process','id',$awhere);
                                if(!empty($agree)){
                                 ?>
                                   Marked as agreed - <a  class="agree_anchor_undo pointer" data-pid= '<?php echo $agree[0]['id'];?>'>undo</a> 
                                 <?php
                                 } else {
                                 ?>
                                    <a class="agree_anchor pointer"> <i class="fa fa-user"></i> I agree</a>
                                <?php } ?>
                                </span> <?php } else if($s_user['is_fa'] == 0) {
                                if($s_user['id'] == $questions[0]['client_id']) {?>
                                <span class="best_<?php echo $answer['id'];?>" data-ansid = "<?php echo $answer['id'];?>" data-questid="<?php echo $answer['quest_id'];?>">
                                <?php
                                $awhere = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'best_mark' => 1,
                                    'status' => 1,
                                    'input_by' => $s_user['id']
                                    );
                                $best = $this->my_quickr_model->select_from('quset_additional_process','id',$awhere);
                                if(!empty($best)){
                                 ?>
                                   Marked as Best Answer - <a  class="best_anchor_undo pointer" data-pid= '<?php echo $best[0]['id'];?>'>undo</a> 
                                 <?php
                                 }else {?>
                                    <a class="best_anchor pointer"><i class="fa fa-thumbs-o-up"></i> Mark as Best</a>
                                 <?php } ?>
                                </span> |
                                <?php } ?>
                                <span class="helpful_<?php echo $answer['id'];?>" data-ansid = "<?php echo $answer['id'];?>" data-questid ="<?php echo $answer['quest_id'];?>">
                                <?php
                                $where = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'helpful_mark' => 1,
                                    'status' => 1,
                                    'input_by' => $s_user['id']
                                    );
                                $helpful = $this->my_quickr_model->select_from('quset_additional_process','id',$where);
                                if(!empty($helpful))
                                {
                                    ?>
                                    Marked as helpful - <a  class="helpful_anchor_undo pointer" data-pid= '<?php echo $helpful[0]['id'];?>'>undo</a>
                                    <?php
                                }
                                else {
                                ?>
                                <a class="helpful_anchor pointer"><i class="fa fa-arrow-up"></i> Mark as helpful</a>
                                <?php } ?>
                                </span>
                                <?php } ?>|
                                
                                <?php 
                                if($s_user['id'] == $questions[0]['client_id'] || $s_user['is_fa'] == 1){?>
                                <span>
                                <a class="pointer comment_anchor" data-id="<?php echo $answer['id'];?>"><i class="fa fa-comments-o"></i> Comment</a>
                                </span>|
                                <?php } else {
                                    $cwhere = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'comment IS NOT NULL' => null,
                                    'status' => 1,
                                    );
                                    $count = $this->my_quickr_model->get_count('quset_additional_process',$cwhere);
                                if ($count) {
                                    ?>
                                        <span>
                                        <a class="pointer comment_list" data-aid="<?php echo $answer['id'];?>"><i class="fa fa-comments-o"></i> (<?php echo $count;?>)Comment</a>
                                        </span>|
                                    <?
                                } }?>

                                
                                <?php
                                $awhere = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'flag' => 1,
                                    'status' => 1,
                                    'input_by' => $s_user['id']
                                    );
                                $flag = $this->my_quickr_model->select_from('quset_additional_process','id',$awhere);
                                if(!empty($flag)){ ?>
                                <span><a><i class="fa fa-flag pointer" style="color:red"></i> Flagged</a></span>
                                <?php 
                                }
                                else
                                {?>
                                    <span id="flag_anchor_<?php echo $answer['id'];?>">
                                    <a class="flag_anchor" data-ansid="<?php echo $answer['id'];?>"><i class="fa fa-flag"></i>  Flag</a></span>
                                <?php } ?>
                                </p>
                                <span class="post_comment_<?php echo $answer['id'];?>" style="display:none">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" id="comment_<?php echo $answer['id'];?>" rows="3"></textarea>
                                            <input type="hidden" name="quest_id" id="quest_id_<?php echo $answer['id'];?>" value="<?php echo $answer['quest_id'];?>">
                                            <input type="hidden" name="answer_id" id="answer_id_<?php echo $answer['id'];?>" value="<?php echo $answer['id'];?>">
                                        </div>
                                            <input type="button" name="submit_comment" class="btn btn-primary submit_comment" data-ansid="<?php echo $answer['id'];?>" id="submit_comment" value="submit">
                                            <input type="button" name="cancel_comment" class="btn btn-default cancel_comment" id="cancel_comment" value="cancel">
                                </span>
                                <div id="comment_list_<?php echo $answer['id'];?>" <?php if($s_user['is_fa'] == 0){ echo 'style="display:none"';}?>>
                                <?php
                                $cwhere = array(
                                    'quest_id' => $answer['quest_id'],
                                    'answer_id' => $answer['id'],
                                    'comment IS NOT NULL' => null,
                                    'status' => 1,
                                    //'input_by' => $s_user['id']
                                    );
                                $order_by = array(
                                    'submitted_date' => 'desc'
                                    );
                                $comment = $this->my_quickr_model->select_from('quset_additional_process','*',$cwhere,$order_by,3);
                                if(!empty($comment)){

                                    $total_count = $this->my_quickr_model->get_count('quset_additional_process',$cwhere);
                                    if($total_count > 3)
                                       echo '<a class="pointer reload_list" data-questid="'.$answer['quest_id'].'" data-answid="'.$answer['id'].'">View ('.($total_count-3).') more Comments </a>';
                                    foreach($comment as $comm) {?>
                                        <span class="comment_list_<?php echo $answer['id'];?> " >
                                           <div class="rlb-activity">                   
                                                <div class="rlba-lft">
                                                <img src="http://local.quickr.com/quickr/src/images/rdba-pic.jpg">
                                                </div>
                                                <div class="rlba-rgt">
                                                    <p><?php echo $comm['comment'];?></p>
                                                    <p><?php echo 'Posted about '.$this->my_quickr_model->time_cal(strtotime($comm['submitted_date']));?>
                                                    by <span><?php echo $this->my_quickr_model->get_name_by_id($comm['input_by']);?></span> </p>
                                                </div>
                                            </div>
                                        </span>
                                <?php } } ?>
                                </div> <!-- comment list div ends -->
                                <div id="flag_popup_<?php echo $answer['id'];?>" style="display:none" >
                                <!-- <h2>Flag as objectionable</h2>  -->
                                <p> If you feel this violates our <a target="_blank" href="#">Community Guidelines</a>, confirm your objection below. </p> 
                                <br/> 
                                <div style="padding-bottom:3px"> 
                                  <a class="btn btn-warning flag_anchor_object" data-queid="<?php echo $answer['quest_id'];?>" data-ansid="<?php echo $answer['id']; ?>" >I object!</a>  <a class="btn btn-default flag_anchor_cancel" >Cancel</a> 
                                  </div>
                                </div>

                                

                            </div> 
                        </div>
                    </li>
                <?php } } ?>
                                             
                </ul>
                
        </div>
    </div>            
</div>  