        <?php echo form_open('profile/education', array('class'=>'education_form')) ?>
          <input type="hidden" name="id" value="<?php echo $education['id'] ?>"/>
          <div class="form-group">
            <label>University <span class="required">*</span></label>
            <div class="field university"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="University" name="university" value="<?php echo $education['university'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Major <span class="required">*</span></label>
            <div class="field major"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Major" name="major" value="<?php echo $education['major'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Degree <span class="required">*</span></label>
            <div class="field degree"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Degree" name="degree" value="<?php echo $education['degree'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Year <span class="required">*</span></label>
            <div class="field year"> 
              <div class="error"></div>
              <select class="form-control" name="year">
                <option>Select Year</option>
                <?php foreach(range(1900,date('Y')) as $year){ ?>
                <option value="<?php echo $year ?>"<?php if($year == $education['year']) echo ' selected' ?>><?php echo $year ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary edu_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
        </form>

