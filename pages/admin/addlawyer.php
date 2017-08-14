<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add Financial Adviser</h3>
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
                                    <h2>Add Financial Adviser</h2>
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
                                    <form method="POST" role="form" id="addlawyer" action="<?php echo base_url();?>admin/addlawyer">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>First Name <span class="required red">*</span></label>
                                    <input type="text" name="firstname" class="form-control">
                                    <ul></ul>
                                    <label>Middle Name </label>
                                    <input type="text" name="middlename" class="form-control">
                                    <ul></ul>
                                    <label>Last Name <span class="required red">*</span></label>
                                    <input type="text" name="lastname" class="form-control">
                                    <ul></ul>
                                    <label>Company Name <span class="required red">*</span></label>
                                    <input type="text" name="companyname" class="form-control">
                                    <ul></ul>
                                    <label>Company FCA Number <span class="required red">*</span></label>
                                    <input type="text" name="companyfca" class="form-control">
                                    <ul></ul>
                                    <label>Email <span class="required red">*</span></label>
                                    <input type="text" name="email" class="form-control">
                                    <ul></ul>  
                                    <label>Address 1 <span class="required red">*</span></label>
                                    <input type="text" name="address1" class="form-control">
                                    <ul></ul>
                                    <label>Address 2</label>
                                    <input type="text" name="address2" class="form-control">
                                    <ul></ul>
                                    <label>Address 3</label>
                                    <input type="text" name="address3" class="form-control">
                                    <ul></ul>
                                    <label>City <span class="required red">*</span></label>
                                    <input type="text" name="city" class="form-control">
                                    <ul></ul>
                                    <label>County <span class="required red">*</span></label>
                                    <select class="form-control" name="county" id="county">
                                                    <option value="">--Select--</option>
                                                    <?php if(!empty($getcounties)) { 
                                                      foreach ($getcounties as $counties) {
                                                        if($counties['is_active']==1) {
                                                        ?>
                                                    <option value="<?php echo $counties['id'];?>"><?php echo $counties['name'];?></option>
                                                    <?php } } } ?>
                                    </select>
                                    <ul></ul>
                                    <label>Postcode <span class="required red">*</span></label>
                                    <input type="text" name="postcode" class="form-control">
                                    <ul></ul>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>About Company <span class="required red">*</span></label>
                                    <textarea name="about_company" class="form-control"></textarea>
                                    <ul></ul>                        
                                    <label>Office Phone Number <span class="required red">*</span></label>
                                    <input type="text" name="office_no" class="form-control">
                                    <ul></ul>
                                    <label>Direct Phone Number <span class="required red">*</span></label>
                                    <input type="text" name="direct_no" class="form-control">
                                    <ul></ul>
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control">
                                    <ul></ul>
                                    
                                    <label> Free Consultation <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="consultation" id="consultationS" value="1" checked="" /> Yes
                                            <input type="radio" class="flat" name="consultation" id="consultationN" value="0" /> No
                                    </p>
                                    <label for="consultation" class="error"></label>
                                    <ul></ul>
                                    <label> Independent or Restricted <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="independent" id="independentS" value="1" checked="" /> Yes
                                            <input type="radio" class="flat" name="independent" id="independentN" value="0" /> No
                                    </p>
                                    <label for="independent" class="error"></label>
                                    <ul></ul>
                                    <label>Disciplinary History <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="disciplinary" id="disciplinaryS" value="1" checked="" /> Yes
                                            <input type="radio" class="flat" name="disciplinary" id="disciplinaryN" value="0" /> No
                                    </p>
                                    <label for="disciplinary" class="error"></label>
                                    <ul></ul>
                                    <label>Assets Under Advisory <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="assetsadvisory" id="assetsadvisoryS" value="1" checked="" /> Yes
                                            <input type="radio" class="flat" name="assetsadvisory" id="assetsadvisoryN" value="0" /> No
                                    </p>
                                    <label for="assetsadvisory" class="error"></label>
                                    <ul></ul>
                                    <label>Advisory Discretionary <span class="required red">*</span></label>
                                    <p>
                                            <input type="radio" class="flat" name="discretionary" id="discretionaryS" value="1" checked="" /> Yes
                                            <input type="radio" class="flat" name="discretionary" id="discretionaryN" value="0" /> No
                                    </p>
                                    <label for="discretionary" class="error"></label>
                                    <ul></ul>
                                     <label>Status <span class="required red">*</span></label>
                                    <select class="form-control" name="status" id="status">
                                                    <option value="">--Select--</option>
                                                    <option value="1" >Active</option>
                                                    <option value="0" >Inactive</option>
                                                </select>
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
  $('#addlawyer').validate({
    rules: {
      firstname: 
      {
        required:true,
      },
      lastname: 
      {
        required:true,
      },
      email: 
      {
        required:true,
        emailid:true,
        remote: {
            url: "<?php echo base_url('admin/verifylawemail');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#email").val()
           // },
            },
       },
      },
      companyname: 
      {
        required:true,
      },
      about_company: 
      {
        required:true,
      },
      office_no: 
      {
        required:true,
        number:true,
      },
      direct_no: 
      {
        required:true,
        number:true,
      },
      website: 
      {
        url:true,
      },
      address1: 
      {
        required:true,
      },
      companyfca: 
      {
        required:true,
      },
      consultation: 
      {
        required:true,
      },
      independent: 
      {
        required:true,
      },
      disciplinary: 
      {
        required:true,
      },
      assetsadvisory: 
      {
        required:true,
      },
      discretionary: 
      {
        required:true,
      },
      city: 
      {
        required:true,
      },
      
      county: 
      {
        required:true,
      },
      postcode: 
      {
        required:true,
        number:true,
      },
      status: 
      {
        required:true,
      },
    },
    messages: {
      firstname: 
      {
        required:"Please enter a first name",
      },
      lastname: 
      {
        required:"Please enter a last name",
      },
      email: 
      {
        required:"Please enter a email",
        emailid:"Please enter a valid email",
        remote:"Email already used",
      },
      companyname: 
      {
        required:"Please enter a company name",
      },
      about_company: 
      {
        required:"Please enter a about company",
      },
      office_no: 
      {
        required:"Please enter a office phone number",
        number:"Numbers only allowed",
      },
      direct_no: 
      {
        required:"Please enter a direct phone number",
        number:"Numbers only allowed",
      },
      website: 
      {
        required:"Please enter valid url",
      },
      address1: 
      {
        required:"Please enter a address1",
      },
      companyfca: 
      {
        required:"Please enter a company FCA number",
      },
      consultation: 
      {
        required:"Please checked free consultation ",
      },
      independent: 
      {
        required:"Please checked independent or restricted",
      },
      disciplinary: 
      {
        required:"Please checked disciplinary history ",
      },
      assetsadvisory: 
      {
        required:"Please checked assets under advisory",
      },
      discretionary: 
      {
        required:"Please checked advisory discretionary",
      },
      city: 
      {
        required:"Please enter a city",
      },
      county: 
      {
        required:"Please select a county",
      },
      postcode: 
      {
        required:"Please enter a postcode",
        number:"Numbers only allowed",
      },
      status: 
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

