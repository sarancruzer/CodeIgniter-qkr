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

    });
</script>
<style type="text/css">
    .ralign{
        float: right;
        margin: 33px 10px 0 0;
        padding: 2px;
    }
</style>
<div class="row rcent-anw">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Advisers Answers (<?php echo $this->my_quickr_model->get_count('legal_answers',array('quest_id'=>$questions[0]['id']));?>)</h2>  
            <?php
                if(!empty($answers)){
                    foreach ($answers as $answer) {
                    ?>
                        <div class="ra-contain">
                            <div class="rac-lft">            
                                <p>
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

                                    <p> <a  class="btn-default ralign read_more" data-id="<?php echo $answer['id'];?>" role="button">Read More</a></p>
                                    <?php } ?>
                                    </div>
                                    <div class="read_less_<?php echo $answer['id'];?>" style="display:none">
                                    <p><?php echo $answer['answer'];?></p>
                                    <p> <a class="btn-default ralign read_less" data-id="<?php echo $answer['id'];?>"  role="button">Read Less</a></p>
                                    </div>
                                </p>              
                            </div>
                            <div class="rac-rgt">
                                <img src="<?php echo base_url();?>src/images/recent-ans-pic.png">
                                <div class="rac-rgt-txt">
                                    <p>Answred by</p>
                                    <p><b><?php echo $this->my_quickr_model->get_name_by_id($answer['adviser_id']);?></b></p>
                                    <p><?php echo $this->my_quickr_model->time_cal(strtotime($answer['answered_date']));?></p>
                                </div>           
                            </div>
                        </div> 
            <?php } } ?>

            
     </div>
</div>
<!-- <div class="all-recent-advice"> 
    <a href="#">See all recent advice</a>
</div> -->