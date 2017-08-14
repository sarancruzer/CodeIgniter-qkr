        <?php echo form_open('profile/licenses', array('class'=>'license_form')) ?>          
          <input type="hidden" name="id" value="<?php echo $license['id'] ?>"/>
          <div class="form-group">
            <label>Controlled function <span class="required">*</span></label>
            <div class="field controlled_function"> 
              <div class="error"></div>
              <select class="form-control" name="controlled_function">
                <option>Select</option>
                <?php foreach($controlled_functions as $function){ ?>
                <option value="<?php echo $function['id'] ?>"<?php if($function['name'] == $license['controlled_function']) echo ' selected' ?>><?php echo $function['name'] ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Firm name <span class="required">*</span></label>
            <div class="field firm_name"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Firm name" name="firm_name" value="<?php echo $license['firm_name'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Start Date <span class="required">*</span></label>
            <div class="field start_date"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Start date" name="start_date" value="<?php echo date('m/d/Y',strtotime($license['start_date'])) ?>">
            </div>
          </div>
          <div class="form-group">
            <label>End Date <span class="required">*</span></label>
            <div class="field end_date"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="End date" name="end_date" value="<?php echo date('m/d/Y',strtotime($license['end_date'])) ?>">
            </div>
          </div>
          <button type="submit" class="btn btn-primary license_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
        </form>
        <script>$(function(){ $('.license_form input[name=start_date]').datepicker(); $('.license_form input[name=end_date]').datepicker(); });</script>
