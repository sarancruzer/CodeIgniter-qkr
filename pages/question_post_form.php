<div class="cont-fnd-what-lukng">
  <h2>Can't find what you're looking for? Ask a financial adviser</h2>
  <p> Get free advice from experienced financial advisers</p>
  <form name="questions" id="questions" method="post" action="<?php echo site_url('my_quickr/ask_question');?>">
      <div class="form-group">
        <label for="subject">Your question</label>
        <p class="help-block pull-right">(<span id="question_form_subject_counter">128</span> Characters Remaining)</p>
        <textarea class="form-control"  name="quest" id="quest" rows="5" data-maxlength="128" data-counter-id="question_form_subject_counter" placeholder="e.g., Do I need a real estate attorney?"><?php if(isset($question[0]['subject'])) echo $question[0]['subject'];?></textarea>
      </div>
      <div class="remain_form">
        <div class="form-group" >
          <label for="subject">Add Details</label>
          <p class="help-block pull-right">(<span id="question_form_body_counter">800</span> Characters Remaining)</p>
          <textarea class="form-control"  name="quest_detail" id="quest_detail" rows="5" data-maxlength="800" data-counter-id="question_form_body_counter" placeholder="Include background information that will enable lawyers to answer your question."><?php if(isset($question[0]['detail'])) echo $question[0]['detail'];?></textarea>
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