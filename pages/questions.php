<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript">
$(document).ready(function() {
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
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<!-- main content container -->

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 endorse">
            <h3> Get free advice from experienced financial advisers</h3>
            <form name="questions" id="questions" method="post" action="<?php echo site_url('my_quickr/ask_question');?>">
            <div class="form-group">
                <label for="subject">Enter your question</label>
                <p class="help-block pull-right">(<span id="question_form_subject_counter">128</span> Characters Remaining)</p>
                <textarea class="form-control" name="quest" id="quest" rows="5" data-maxlength="128" data-counter-id="question_form_subject_counter" placeholder="e.g., Do I need a real estate attorney?"><?php if(isset($question[0]['subject'])) echo $question[0]['subject'];?></textarea>
            </div>
            
            <div class="form-group">
                <label for="subject">Add Details</label>
                <p class="help-block pull-right">(<span id="question_form_body_counter">800</span> Characters Remaining)</p>
                <textarea class="form-control" name="quest_detail" id="quest_detail" rows="5" data-maxlength="800" data-counter-id="question_form_body_counter" placeholder="Include background information that will enable lawyers to answer your question."><?php if(isset($question[0]['detail'])) echo $question[0]['detail'];?></textarea>
            </div>
            
            <div class="form-group">
                <label for="subject">City and County</label>
                <input type="text" class="form-control" name="city_state" id="city_state" value="<?php if(isset($question[0]['location'])) echo $question[0]['location'];?>" placeholder="eg:Los Angeles, CA">
            </div>
            <div id="display"></div>
            <div class="form-group"> <span class="label label-danger">* All fields required</span> </div>
            <input type="hidden" class="form-control" name="quest_id" id="quest_id" value="<?php if(isset($question[0]['id'])) echo $question[0]['id'];?>">
            <input type="submit" class="btn btn-primary" value="Preview your question" name="commit">
          </form>
        </div>
    </div>  
</div>
 <section class="brws-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 endorse">
                <h3>We may already have your answer</h3>
                <p>Search our existing financial advice community for your issue.</p>
                    <div class="row">                        
                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 brws-lgl-topics">
                            <ul class="topics">
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
                    <a class="btn btn-primary ask-nw-btn" href="<?php echo site_url('topics/all_topics/a');?>">See all legal topics</a>             
                 </div>            
                
        </div>
    </section>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
 