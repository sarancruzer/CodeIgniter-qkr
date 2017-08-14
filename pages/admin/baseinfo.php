<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Basic Information</h3>
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
                                    <h2>Basic Information</h2>
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
                                    <form method="POST" role="form" id="baseinfoform" action="<?php echo base_url();?>admin/editbaseinfo" enctype="multipart/form-data">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>Admin Email <span class="required red">*</span></label>
                                    <input type="text" name="adminemail" class="form-control" value="<?php echo @$baseinfo[0]['adminmail'];?>" >
                                    <input type="hidden" name="id" class="form-control" value="<?php echo @$baseinfo[0]['id'];?>" >
                                    <ul></ul>
                                    <label>Company name <span class="required red">*</span></label>
                                    <input type="text" name="companyname" class="form-control" value="<?php echo @$baseinfo[0]['companyname'];?>">
                                    <ul></ul>        
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <label>Short Logo <small> (For admin panel. It should be white)</small></label>
                                    <input type="file" name="shortlogo">
                                    <input type="hidden" name="old_shortlogo" value="<?php echo @$baseinfo[0]['shortlogo'];?>">
                                    <span><a href="<?php echo base_url();?>uploads/baseinfo/<?php echo @$baseinfo[0]['shortlogo'];?>" target="_blank"><?php echo @$baseinfo[0]['shortlogo'];?></a></span>
                                    <ul></ul>
                                    <label>Login Page Logo<small> (It must consist Logo and company name)</small></label>
                                    <input type="file" name="loginlogo" >
                                    <input type="hidden" name="old_loginlogo" value="<?php echo @$baseinfo[0]['loginlogo'];?>" >
                                    <span><a href="<?php echo base_url();?>uploads/baseinfo/<?php echo @$baseinfo[0]['loginlogo'];?>" target="_blank"><?php echo @$baseinfo[0]['loginlogo'];?></a></span>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                                    </div>
                                    </div>
                                                
                                    </form>
                                    <!-- end form for validations -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
<script type="text/javascript" >
$(document).ready(function () {
  $.validator.addMethod( //override email with django email validator regex - fringe cases: "user@admin.state.in..us" or "name@website.a"
        'emailid',
        function(value, element){
            return this.optional(element) || /(^[-!#$%&'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
        },
        'Please enter valid email'
    );
$('#baseinfoform').validate({
    rules: {
        adminemail:
        {
        required:true,
        emailid:true,
        },
        companyname:
        {
        required:true,
        },
    },
    messages: {
        adminemail: 
        {
        required:"Please enter a admin email",
        },
       
       companyname: {
        required:"Please enter a company name",
        },
    }
  });
});
</script>