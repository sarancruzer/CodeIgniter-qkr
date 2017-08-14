<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Edit Financial Adviser</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                         <?php 
                                if($this->session->flashdata('success')){
                                ?>
                                <div class="alert alert-success alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" 
                                  aria-hidden="true">
                                  &times;
                               </button>
                              <?php echo $this->session->flashdata('success');?>
                               </div>
                               <?php }elseif($this->session->flashdata('failure')){ ?>
                               <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" 
                                  aria-hidden="true">
                                  &times;
                               </button>
                               <?php echo $this->session->flashdata('failure');?>
                               </div>
                               <?php } ?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Edit Financial Adviser</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <!-- start form for validation -->
                                    <form method="POST" role="form" id="editlawyer" action="<?php echo base_url();?>admin/editlawyer">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>First Name <span class="required red">*</span></label>
                                    <input type="text" name="editfirstname" value="<?php echo $lawyers[0]['firstname'];?>" class="form-control">
                                    <input type="hidden" name="editid" value="<?php echo $lawyers[0]['id'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Middle Name </label>
                                    <input type="text" name="editmiddlename" value="<?php echo $lawyers[0]['middlename'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Last Name <span class="required red">*</span></label>
                                    <input type="text" name="editlastname" value="<?php echo $lawyers[0]['lastname'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Company Name <span class="required red">*</span></label>
                                    <input type="text" name="editcompanyname" value="<?php echo $lawyers[0]['company_name'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Company FCA Number <span class="required red">*</span></label>
                                    <input type="text" name="editcompanyfca"  value="<?php echo $lawyers[0]['FCA_company_no'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Email <span class="required red">*</span></label>
                                    <input type="text" name="editemail" id="editemail" value="<?php echo $lawyers[0]['email'];?>" class="form-control">
                                    <input type="hidden" name="old_email" id="old_email" value="<?php echo $lawyers[0]['email'];?>" class="form-control">
                                    <ul></ul>  
                                    <label>Address 1 <span class="required red">*</span></label>
                                    <input type="text" name="editaddress1" value="<?php echo $lawyers[0]['address1'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Address 2</label>
                                    <input type="text" name="editaddress2" value="<?php echo $lawyers[0]['address2'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Address 3</label>
                                    <input type="text" name="editaddress3" value="<?php echo $lawyers[0]['address3'];?>" class="form-control">
                                    <ul></ul>
                                    <label>City <span class="required red">*</span></label>
                                    <input type="text" name="editcity" value="<?php echo $lawyers[0]['city'];?>" class="form-control">
                                    <ul></ul>
                                    <label>County <span class="required red">*</span></label>
                                    <select class="form-control" name="editcounty" id="editcounty">
                                                    <option value="">--Select--</option>
                                                    <?php if(!empty($getcounties)) { 
                                                      foreach ($getcounties as $counties) {
                                                        ?>
                                                    <option value="<?php echo $counties['id'];?>" <?php if($lawyers[0]['county']==$counties['id']) { echo "selected";}?>><?php echo $counties['name'];?></option>
                                                    <?php } } ?>
                                    </select>
                                    <ul></ul>
                                    <label>Postcode <span class="required red">*</span></label>
                                    <input type="text" name="editpostcode" value="<?php echo $lawyers[0]['postcode'];?>"  class="form-control">
                                    <ul></ul>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>About Company <span class="required red">*</span></label>
                                    <textarea name="editabout_company" class="form-control"><?php echo $lawyers[0]['about_company'];?></textarea>
                                    <ul></ul>                        
                                    <label>Office Phone Number <span class="required red">*</span></label>
                                    <input type="text" name="editoffice_no" value="<?php echo $lawyers[0]['phone_no_office'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Direct Phone Number <span class="required red">*</span></label>
                                    <input type="text" name="editdirect_no" value="<?php echo $lawyers[0]['phone_no_direct'];?>" class="form-control">
                                    <ul></ul>
                                    <label>Website</label>
                                    <input type="text" name="editwebsite" value="<?php echo $lawyers[0]['website'];?>" class="form-control">
                                    <ul></ul>
                                    <label> Free Consultation <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="editconsultation" id="consultationS" value="1" <?php if($lawyers[0]['free_consultation']==1) { echo "checked='checked'";}?> /> Yes
                                            <input type="radio" class="flat" name="editconsultation" id="consultationN" value="0" <?php if($lawyers[0]['free_consultation']==0) { echo "checked='checked'";}?> /> No
                                    </p>
                                    <label for="consultation" class="error"></label>
                                    <ul></ul>
                                    
                                    <label> Independent or Restricted <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="editindependent" id="independentS" value="1" <?php if($lawyers[0]['independent_or_restricted']==1) { echo "checked='checked'";}?>  /> Yes
                                            <input type="radio" class="flat" name="editindependent" id="independentN" value="0" <?php if($lawyers[0]['independent_or_restricted']==0) { echo "checked='checked'";}?>  /> No
                                    </p>
                                    <label for="independent" class="error"></label>
                                    <ul></ul>
                                    <label>Disciplinary History <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="editdisciplinary" id="disciplinaryS" value="1" <?php if($lawyers[0]['disciplinary_history']==1) { echo "checked='checked'";}?>  /> Yes
                                            <input type="radio" class="flat" name="editdisciplinary" id="disciplinaryN" value="0" <?php if($lawyers[0]['disciplinary_history']==0) { echo "checked='checked'";}?> /> No
                                    </p>
                                    <label for="disciplinary" class="error"></label>
                                    <ul></ul>
                                    <label>Assets Under Advisory <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="editassetsadvisory" id="assetsadvisoryS" value="1" <?php if($lawyers[0]['assets_under_advisory']==1) { echo "checked='checked'";}?> /> Yes
                                            <input type="radio" class="flat" name="editassetsadvisory" id="assetsadvisoryN" value="0" <?php if($lawyers[0]['assets_under_advisory']==0) { echo "checked='checked'";}?>/> No
                                    </p>
                                    <label for="assetsadvisory" class="error"></label>
                                    <ul></ul>
                                    <label>Advisory Discretionary <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="editdiscretionary" id="discretionaryS" value="1" <?php if($lawyers[0]['advisory_discretionary']==1) { echo "checked='checked'";}?> /> Yes
                                            <input type="radio" class="flat" name="editdiscretionary" id="discretionaryN" value="0" <?php if($lawyers[0]['advisory_discretionary']==0) { echo "checked='checked'";}?>/> No
                                    </p>
                                    <label for="discretionary" class="error"></label>
                                    <ul></ul>
                                    <label>Status <span class="required red">*</span></label>
                                    <select class="form-control" name="editstatus" id="editstatus">
                                                    <option value="">--Select--</option>
                                                    <option value="1" <?php if($lawyers[0]['is_active']==1){ echo "selected='selected'";}?> >Active</option>
                                                    <option value="0" <?php if($lawyers[0]['is_active']==0){ echo "selected='selected'";}?> >Inactive</option>
                                    </select>
                                    <label for="editstatus" class="error"></label>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-lg-12">
                                    <button class="btn btn-default" type="reset">Reset</button>
                                    <input type="submit" class="btn btn-success" name="submit" value="Submit">
                                    </div>
                                            
                                </form>
                                    <!-- end form for validations -->

                                </div>
                            </div>
                           <script type="text/javascript" >
$(document).ready(function () {
$.validator.addMethod( //override email with django email validator regex - fringe cases: "user@admin.state.in..us" or "name@website.a"
        'emailid',
        function(value, element){
            return this.optional(element) || /(^[-!#$%&'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
        },
        'Please enter valid email id'
    );
  $('#editlawyer').validate({
    rules: {
      editfirstname: 
      {
        required:true,
      },
      editlastname: 
      {
        required:true,
      },
      editemail: 
      {
        required:true,
        emailid:true,
        remote: {
        param: {
            url: "<?php echo base_url('admin/verifylawemail');?>",
            type: "post",
            data: {
            insustrial: $( "#editemail" ).val()
               },
                 },
     
              depends: function() {
                return $("#editemail").val() !== $('#old_email').val();
              }
          },
      },
      editcompanyname: 
      {
        required:true,
      },
      editabout_company: 
      {
        required:true,
      },
      editoffice_no: 
      {
        required:true,
        number:true,
      },
      editdirect_no: 
      {
        required:true,
        number:true,
      },
      editwebsite: 
      {
        url:true,
      },
      editaddress1: 
      {
        required:true,
      },
      editcompanyfca: 
      {
        required:true,
      },
      editconsultation: 
      {
        required:true,
      },
      editindependent: 
      {
        required:true,
      },
      editdisciplinary: 
      {
        required:true,
      },
      editassetsadvisory: 
      {
        required:true,
      },
      editdiscretionary: 
      {
        required:true,
      },
      editcity: 
      {
        required:true,
      },
      editcounty: 
      {
        required:true,
      },
      editpostcode: 
      {
        required:true,
        number:true,
      },
      editstatus: 
      {
        required:true,
      },
    },
    messages: {
      editfirstname: 
      {
        required:"Please enter a first name",
      },
      editlastname: 
      {
        required:"Please enter a last name",
      },
      editemail: 
      {
        required:"Please enter a email",
        emailid:"Please enter a valid email",
        remote:"Email already used",
      },
      editcompanyname: 
      {
        required:"Please enter a company name",
      },
      editabout_company: 
      {
        required:"Please enter a about company",
      },
      editoffice_no: 
      {
        required:"Please enter a office phone number",
        number:"Numbers only allowed",
      },
      editdirect_no: 
      {
        required:"Please enter a direct phone number",
        number:"Numbers only allowed",
      },
      editwebsite: 
      {
        required:"Please enter valid url",
      },
      editaddress1: 
      {
        required:"Please enter a address1",
      },
      editcompanyfca: 
      {
        required:"Please enter a company FCA number",
      },
      editconsultation: 
      {
        required:"Please checked free consultation ",
      },
      editindependent: 
      {
        required:"Please checked independent or restricted",
      },
      editdisciplinary: 
      {
        required:"Please checked disciplinary history ",
      },
      editassetsadvisory: 
      {
        required:"Please checked assets under advisory",
      },
      editdiscretionary: 
      {
        required:"Please checked advisory discretionary",
      },
      editcity: 
      {
        required:"Please enter a city",
      },
      editcounty: 
      {
        required:"Please select a county",
      },
      editpostcode: 
      {
        required:"Please enter a postcode",
        number:"Numbers only allowed",
      },
      editstatus: 
      {
        required:"Please select a status",
      },
    }
  });
});
</script>
                    </div>
                </div>
            </div>
        </div>

