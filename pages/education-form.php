        <?php echo form_open('profile/education', array('class'=>'education_form')) ?>
          <div class="form-group">
            <label>University <span class="required">*</span></label>
            <div class="field university"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="University" name="university">
            </div>
          </div>
          <?php if(count($educations) == 0) { ?>
          <div class="education_fields"> 
          <?php } ?>
          <div class="form-group">
            <label>Major <span class="required">*</span></label>
            <div class="field major"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Major" name="major">
            </div>
          </div>
          <div class="form-group">
            <label>Degree <span class="required">*</span></label>
            <div class="field degree"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Degree" name="degree">
            </div>
          </div>
          <div class="form-group">
            <label>Year <span class="required">*</span></label>
            <div class="field year"> 
              <div class="error"></div>
              <select class="form-control" name="year">
                <option>Select Year</option>
                <?php foreach(range(1900,date('Y')) as $year){ ?>
                <option><?php echo $year ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary edu_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          <?php if(count($educations) == 0) { ?>
          </div>
          <?php } ?>          
        </form>

