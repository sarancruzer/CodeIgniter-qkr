        <?php echo form_open('profile/experience', array('class'=>'experience_form')) ?>
          <input type="hidden" name="id" value="<?php echo $experience['id'] ?>"/>
          <div class="form-group">
            <label>Title <span class="required">*</span></label>
            <div class="field title"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $experience['title'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Company <span class="required">*</span></label>
            <div class="field company"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Company" name="company" value="<?php echo $experience['company'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>From <span class="required">*</span></label>
            <div class="field from"> 
              <div class="error"></div>
              <select class="form-control" name="from">
                <option>Select Year</option>
                <?php foreach(range(1900,date('Y')) as $year){ ?>
                <option value="<?php echo $year ?>"<?php if($year == $experience['from']) echo ' selected' ?>><?php echo $year ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>To <span class="required">*</span></label>
            <div class="field to"<?php if($experience['present']) echo 'style="display:none"' ?>> 
              <div class="error"></div>
              <select class="form-control" name="to">
                <option>Select Year</option>
                <?php foreach(range(1900,date('Y')) as $year){ ?>
                <option value="<?php echo $year ?>"<?php if($year == $experience['to']) echo ' selected' ?>><?php echo $year ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Present <span class="required">*</span></label>
            <div class="field present"> 
              <div class="error"></div>
              <input type="checkbox" class="form-control" name="present"<?php if($experience['present']) echo ' checked'?>>
            </div>
          </div>

          <button type="submit" class="btn btn-primary experience_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
        </form>
<script> $('.experience_form input[type=checkbox]').change(function(){ if($(this).is(':checked')) { $(this).closest('form').find('.to').hide(); } else { $(this).closest('form').find('.to').show(); } }); </script>
