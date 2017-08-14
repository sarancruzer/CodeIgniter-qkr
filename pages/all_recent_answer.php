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
<body>
<?php include 'header.php' ?>
<!-- main content container -->
<div class="clearfix"></div>

<?php echo $this->load->view('search_form');?>
    
    <section class="rla-outer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">                
                <h3>Recent Answers</h3>
                    <ul class="recnt-list-item">
                        <?php
                        foreach($recent_answers as $recent)
                        {
                        ?>
                        <li>
                            <div class="row recent-ans-lft">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="answered-profile">
                                        <figure><img src="<?php echo base_url();?>src/images/answered-profile.jpg"></figure>
                                        <p>Answered by</p>
                                        <p><a href="#" class="btn-link" target="_blank"><?php echo $this->my_quickr_model->get_name_by_id($recent['adviser_id']);?></a></p>
                                        <p class="time"><?php echo $this->my_quickr_model->time_cal(strtotime($recent['answered_date']));?></p>
                                    
                                    </div>                       
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="answered-profile-rgt">
                                        <p class="quest"><a href="<?php echo site_url('legal-answer/'.$recent['quest_id']);?>" ><?php echo $recent['subject'];?></a></p>                      
                                        <p class="asked-plce">Asked in <?php echo $recent['location'];?></p>
                                    </div>
                                </div>                  
                            </div>
                        </li> 
                        <?php } ?>                        
                                    
                    </ul>  
                    <?php echo $this->pagination->create_links(); ?>
                               
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="row ask-a-lawyer">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ask-a-lawyer">
                            <h2>Ask a Adviser</h2>
                            <p>Get free answers from experienced financial advisers.</p>
                            
                               <form name="questions" id="questions" method="post" action="<?php echo site_url('my_quickr/ask_question');?>">
                                <div class="form-group">
                                    <label for="subject">Your question</label>
                                    <p class="help-block pull-right">(<span id="question_form_subject_counter">128</span> Characters Remaining)</p>
                                    <textarea class="form-control" name="quest" id="quest" rows="5" data-maxlength="128" data-counter-id="question_form_subject_counter" placeholder="e.g., Do I need a real estate attorney?"><?php if(isset($question[0]['subject'])) echo $question[0]['subject'];?></textarea>
                                </div>
                                <div class="remain_form">
                                <div class="form-group" >
                                    <label for="subject">Add Details</label>
                                    <p class="help-block pull-right">(<span id="question_form_body_counter">800</span> Characters Remaining)</p>
                                    <textarea class="form-control" name="quest_detail" id="quest_detail" rows="5" data-maxlength="800" data-counter-id="question_form_body_counter" placeholder="Include background information that will enable lawyers to answer your question."><?php if(isset($question[0]['detail'])) echo $question[0]['detail'];?></textarea>
                                </div>
                                
                                <div class="form-group" >
                                    <label for="subject">City and County</label>
                                    <input type="text" class="form-control" autocomplete="off" name="city_state" id="city_state" value="<?php if(isset($question[0]['location'])) echo $question[0]['location'];?>" placeholder="eg:Los Angeles, CA">
                                </div>
                                <div id="display"></div>
                                
                                <div class="form-group"> <span class="label label-danger">* All fields required</span> </div>
                                <input type="hidden" class="form-control" name="quest_id" id="quest_id" value="<?php if(isset($question[0]['id'])) echo $question[0]['id'];?>">
                                <input type="submit" class="btn btn-primary" value="Preview" name="commit">
                                <a class="btn btn-link" id="cancel_quest">Cancel</a>
                                </div>
                                <button class="btn btn-primary ask-nw-btn askbtn" type="button">Ask now !</button>
                              </form>
                              <P class="ans-this-week"><span><?php echo $answer_count;?></span> answers this week</P>
                              <P class="ans-this-week"><span><?php echo $adviser_count;?></span> professionals answering</P>
                            
                        </div>           
                    </div> 
                    <!-- <section style="margin-top:20px;"></section> -->
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tp-constributors">                
                <h3>This Week's Top Contributors</h3>
                    <ul class="contrbtr-detail">
                        <li>
                        <div class="tp-con-inner">
                        <div class="prior">1</div>
                        <figure><img src="<?php echo base_url();?>src/images/answered-profile.png"></figure>
                        <div class="contrptr-info">
                            <P class="con-nme"><a href="#">Christian Lassen</a></P>
                            <p class="con-depart">Personal Injury Lawyer</p>
                            <p class="con-lvl"><span><img src="<?php echo base_url();?>src/images/leaf-yellow.png"></span>Contributor Level 20</p>  
                        </div>
                    </div>
                        </li>
                        
                        <li>
                        <div class="tp-con-inner">
                        <div class="prior">2</div>
                        <figure><img src="<?php echo base_url();?>src/images/answered-profile.png"></figure>
                        <div class="contrptr-info">
                            <P class="con-nme"><a href="#">Christian Lassen</a></P>
                            <p class="con-depart">Personal Injury Lawyer</p>
                            <p class="con-lvl"><span><img src="<?php echo base_url();?>src/images/leaf-yellow.png"></span>Contributor Level 20</p>  
                        </div>
                    </div>
                        </li>
                        
                        <li>
                        <div class="tp-con-inner">
                        <div class="prior">3</div>
                        <figure><img src="<?php echo base_url();?>src/images/answered-profile.png"></figure>
                        <div class="contrptr-info">
                            <P class="con-nme"><a href="#">Christian Lassen</a></P>
                            <p class="con-depart">Personal Injury Lawyer</p>
                            <p class="con-lvl"><span><img src="<?php echo base_url();?>src/images/leaf-yellow.png"></span>Contributor Level 20</p>  
                        </div>
                    </div>
                        </li>                                    
                    
                    </ul>               
                    
                    <button type="button" class="btn btn-primary ask-nw-btn">View all adviser on the leaderboard</button>           
                </div>
                    </div>
                </div>
                
               
            </div>        
        </div>    
    </section>