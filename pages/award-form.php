        <?php echo form_open('profile/award', array('class'=>'award_form')) ?>
          <div class="form-group">
            <label>Award name <span class="required">*</span></label>
            <div class="field award_name"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Award name" name="award_name">
            </div>
          </div>
          <?php if(count($awards) == 0) { ?>
          <div class="award_fields"> 
          <?php } ?>
          <div class="form-group">
            <label>Grantor <span class="required">*</span></label>
            <div class="field grantor"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Grantor" name="grantor">
            </div>
          </div>
          <div class="form-group">
            <label>Date granted <span class="required">*</span></label>
            <div class="field date_granted"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Date granted" name="date_granted">
            </div>
          </div>
          <button type="submit" class="btn btn-primary award_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          <?php if(count($awards) == 0) { ?>
          </div>
          <?php } ?>          
        </form>
        <script>$(function(){ $('.award_form input[name=date_granted]').datepicker(); });</script>
