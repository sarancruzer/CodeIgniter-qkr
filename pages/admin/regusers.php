<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Registered Users</h3>
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
                                    <h2>Manage Registered Users</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               <div class="x_content">
                              
                               <div class="clearfix"></div>
                                <div class="row">
                                <!--<form class="form-inline" action="<?php echo base_url();?>admin/managepractice" method="GET">
                                <select class="form-control col-lg-3" name="status" id="status">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                 <div class="input-group col-lg-3 col-md-4 col-sm-4 col-xs-12 pull-right col-lg-offset-9 col-md-offset-8 col-sm-offset-8">
                                                    <input type="text" value="<?php echo @$q;?>" id="q" name="q" class="form-control">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-primary" href="#" type="submit">
                                                    <i class="fa fa-search"></i>
                                                    </button>
                                             
                                        </span>
                                    </div>
                                    </form>-->
                                    <form action="<?php echo base_url();?>admin/manageregusers" method="GET">
                                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-5 ">
                                   <!-- <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="advis" id="advis">
                                                    <option value="">Advisor</option>
                                                    <option value="1" <?php if(($advis!='')&& ($advis==1)){ echo "selected='selected'";}?>>Yes</option>
                                                    <option value="0" <?php if(($advis!='')&& ($advis==0)){ echo "selected='selected'";}?>>No</option>
                                                </select>
                                                </div>-->
                                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="verf" id="verf">
                                                    <option value="">Verification</option>
                                                    <option value="1" <?php if(($verf!='')&& ($verf==1)){ echo "selected='selected'";}?>>Yes</option>
                                                    <option value="0" <?php if(($verf!='')&& ($verf==0)){ echo "selected='selected'";}?>>No</option>
                                                </select>
                                                </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 <div class="input-group col-lg-5 col-md-6 col-sm-6 col-xs-12 pull-right">
                                                    <input type="text" value="<?php echo @$q;?>" id="q" name="q" class="form-control">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-primary" href="#" type="submit">
                                                    <i class="fa fa-search"></i>
                                                    </button>
                                             
                                        </span>
                                    </div>
                                    </div>
                                    </form>
                                    </div>
                                    <div class="row">
                                    <div class="table-responsive">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">S.No </th>
                                                <th class="column-title">Email </th>
                                               <!-- <th class="column-title">Firm Name </th>-->
                                                <th class="column-title">Financial Adviser </th>
                                                <th class="column-title">Verification </th>
                                                <th class="column-title">Status </th>
                                                <th width="210px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($users)) {
                                foreach ($users as $user) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $user['email'];?></td>
                                                <!--<td class=" "><?php echo $user['firm_name'];?></td>-->
                                                <td class=" "><?php if($user['is_fa']=='1'){ echo "Yes";} else { echo "No";}?></td>
                                                <td class=" "><?php if($user['is_verified']=='1'){ echo "Verified";} else { echo "Not Verified";}?></td>
                                                 <td class=" "><?php if($user['is_blocked']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $user['id'];?>" data-row-email="<?php echo $user['email'];?>"
                                                data-row-fname="<?php echo $user['firstname'];?>"
                                                data-row-mname="<?php echo $user['middlename'];?>"
                                                data-row-lname="<?php echo $user['lastname'];?>"
                                                data-row-lname="<?php echo $user['displayname'];?>"
                                                data-row-status="<?php echo $user['is_blocked'];?>" 
                                                data-row-verification="<?php echo $user['is_verified'];?>" 
                                                data-row-adviser="<?php echo $user['is_fa'];?>"
                                                data-row-address1="<?php echo $user['address1'];?>"
                                                data-row-address2="<?php echo $user['address2'];?>"
                                                data-row-address3="<?php echo $user['address3'];?>"
                                                data-row-disciplinary="<?php echo $user['disciplinary_history'];?>"
                                                data-row-city="<?php echo $user['name'];?>"
                                                data-row-postcode="<?php echo $user['postcode'];?>"
                                                data-row-phone_number="<?php echo $user['phone_number'];?>"
                                                data-row-controlled_function="<?php echo @$user['controlled_function'];?>"
                                                data-row-start_date="<?php echo @$user['start_date'];?>"
                                                data-row-end_date="<?php echo @$user['end_date'];?>"
                                                data-target=".viewing" data-toggle="modal" class="btn btn-info view">View</a>                              
                                                <a data-row-id="<?php echo $user['userid'];?>" data-row-editemail="<?php echo $user['email'];?>" data-row-editstatus="<?php echo $user['is_blocked'];?>" data-row-editverification="<?php echo $user['is_verified'];?>" data-row-adviser="<?php echo $user['is_fa'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $user['userid'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
                                                </td>
                                            </tr>
                            <?php } } else {
                                ?>
                                <tr class="even pointer">
                                <td colspan="6">No Record Found!</td>
                                </tr>
                                <?php  }   ?>              
                                               
                                                                                        
                                            </tbody>
                                    </table>
                                        </div>
                                        <?php echo $links;?>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade viewing" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Registered User Details</h4>
                                            </div>
                                            <div class="modal-body">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">
                                                 <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <table>
                                               <tr><td width="40%">
                                             <label>Email</label>
                                             </td><td>
                                             <span id="email"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label>First Name</label>
                                             </td><td>
                                             <span id="fname"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label>Middle Name</label>
                                             </td><td>
                                             <span id="mname"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Last Name</label>
                                             </td><td>
                                             <span id="lname"></span>
                                               </td></tr>
                                               <tr><td>
                                              <tr><td>
                                             <label>Phone Number</label>
                                             </td><td>
                                             <span id="phone_number"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Address1</label>
                                             </td><td>
                                             <span id="address1"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Address2</label>
                                             </td><td>
                                             <span id="address2"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Address3</label>
                                             </td><td>
                                             <span id="address3"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Disciplinary History</label>
                                             </td><td>
                                             <span id="disciplinary"></span>
                                               </td></tr>
                                               </table>
                                               </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <table>
                                               <tr><td width="40%">
                                             <label>City</label>
                                             </td><td>
                                             <span id="city"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label>Postcode</label>
                                             </td><td>
                                             <span id="postcode"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Controlled Function</label>
                                             </td><td>
                                             <span id="controlled_function"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Firm Name</label>
                                             </td><td>
                                             <span id="firm_name"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >Start Date</label>
                                             </td><td>
                                             <span id="start_date"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label >End Date</label>
                                             </td><td>
                                             <span id="end_date"></span>
                                               </td></tr>
                                               <tr><td>
                                             <label>Adviser</label>
                                             </td><td>
                                             <span id="adviserR"></span>
                                             </td></tr>
                                              <tr><td>
                                             <label >Verification</label>
                                             </td><td>
                                             <span id="verification"></span>
                                               </td></tr>
                                                <tr><td>
                                             <label >Status</label>
                                             </td><td>
                                             <span id="status"></span>
                                               </td></tr>
                                               </table>
                                               </div>
                                               </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

<div class="modal fade editing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit Registered Users</h4>
            </div>
             <form method="POST" id="edituser" name="edituser" action="<?php echo base_url();?>admin/editreguser?q=<?php echo @$q?>&stat=<?php echo @$stat?>&verf=<?php echo @$verf;?>&adviser=<?php echo @$adviser;?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group">
                <label>Email </label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editemail" id="editemail" class="form-control" autocomplete="off" tabindex="1" readonly="readonly" />
                   </div>
                <br>   
                <div class="form-group">
                 <label>Financial Adviser <span class="required red">*</span></label>
                   <select name="adviser" id="adviser" class="form-control" placeholder="">
                    <option value="">--Select--</option>
                    <option value="1" >Yes</option>                 
                    <option value="0">No</option>                 
                                   
                   </select>
                   <label for="adviser" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                  <div class="form-group">
                 <label>Verification <span class="required red">*</span></label>
                   <select name="editverification" id="editverification" class="form-control" placeholder="">
                    <option value="">--Select--</option>
                    <option value="1" >Yes</option>                 
                    <option value="0">No</option>                 
                                   
                   </select>
                   <label for="editverification" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                <div class="clearfix"></div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="editstatus" id="editstatus" class="form-control" placeholder="">
                    <option value="">--Select--</option>
                    <option value="1" >Active</option>                 
                    <option value="0">Inactive</option>                 
                                   
                   </select>
                   <label for="editstatus" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
            </div>       
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" style="margin-top:-4px;">Save</button>
            </div>
             </form>
        </div>
    </div>
</div>

<div class="modal fade deleting" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Delete Registered Users</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletereguser?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this registered users</h5>
            <input type="hidden" name="deleteid" id="deleteid" class="form-control" />  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" style="margin-top:-4px;">Ok</button>
        </div>

    </div>
</div>
</div>

<script type="text/javascript" >
$(document).ready(function () {

  $('#edituser').validate({
    rules: {
      adviser: 
      {
        required:true,
      },
      editverification: 
      {
        required:true,
      },
      editstatus: 
      {
        required:true,
      },
    },
    messages: {
       adviser: {
        required:"Please select a financial adviser",        
       },
       editverification: {
        required:"Please select a verification",
        },
        editstatus: {
        required:"Please enter a status",
        },
    }
  });
});
</script>
<script>
    $(document).ready(function() {
        $(".edit").on('click', function(){
            var validator = $("#edituser").validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editemail = $(this).data('row-editemail');
         var adviser = $(this).data('row-adviser');
         var editverification = $(this).data('row-editverification');
         var editstatus = $(this).data('row-editstatus');
          
         $('#id').val(id);
          $('#editemail').val(editemail);
          $('[name=adviser] option').filter(function() {
          return ($(this).val() == adviser); //To select Blue
    }).prop('selected', true);
           $('[name=editverification] option').filter(function() {
          return ($(this).val() == editverification); //To select Blue
    }).prop('selected', true);
     
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#editemail').val('');
         $('#adviser').val('');
         $('#editverification').val('');
         $('#editstatus').val('');
    });
     $(".view").on('click', function(){
         var id = $(this).data('row-id');
         var email = $(this).data('row-email');
         var fname = $(this).data('row-fname');
         var mname = $(this).data('row-mname');
         var lname = $(this).data('row-lname');
         var address1 = $(this).data('row-address1');
         var address2 = $(this).data('row-address2');
         var address3 = $(this).data('row-address3');
         var disciplinary = $(this).data('row-disciplinary');
         var city = $(this).data('row-city');
         var postcode = $(this).data('row-postcode');
         var phone_number = $(this).data('row-phone_number');
         var controlled_function = $(this).data('row-controlled_function');
         var firm_name = $(this).data('row-firm_name');
         var start_date = $(this).data('row-start_date');
         var end_date = $(this).data('row-end_date');
         var adviser = $(this).data('row-adviser');
         var verification = $(this).data('row-verification');
         var status = $(this).data('row-status');
          if(adviser==1)  
          {
            adviserR='Yes';
          }
          else
          {
            adviserR='No';
          }
          if(verification==1)  
          {
            verificationR='Yes';
          }
          else
          {
            verificationR='No';
          }
          if(status==1)  
          {
            statusR='Yes';
          }
          else
          {
            statusR='No';
          }
         //$('#id').val(id);
          $('#email').text(email);
          $('#adviserR').text(adviserR);
          $('#fname').text(fname);
          $('#mname').text(mname);
          $('#lname').text(lname);
          $('#address1').text(address1);
          $('#address2').text(address2);
          $('#address3').text(address3);
          $('#disciplinary').text(disciplinary);
          $('#city').text(city);
          $('#postcode').text(postcode);
          $('#phone_number').text(phone_number);
          $('#controlled_function').text(controlled_function);
          $('#firm_name').text(firm_name);
          $('#start_date').text(start_date);
          $('#end_date').text(end_date);
          $('#verification').text(verificationR);
          $('#status').text(statusR);
         
     });
$('.viewing').on('hidden.bs.modal', function () {
          $('#email').text('');
          $('#adviserR').text('');
          $('#fname').text('');
          $('#mname').text('');
          $('#lname').text('');
          $('#address1').text('');
          $('#address2').text('');
          $('#address3').text('');
          $('#disciplinary').text('');
          $('#city').text('');
          $('#postcode').text('');
          $('#phone_number').text('');
          $('#controlled_function').text('');
          $('#firm_name').text('');
          $('#start_date').text('');
          $('#end_date').text('');
          $('#verification').text('');
          $('#status').text('');
    });
    $(".delete").on('click', function(){
         var id = $(this).data('row-id');
         $('#deleteid').val(id);
     });

    $('.deleting').on('hidden.bs.modal', function () {
        $('#deleteid').val('');
    });
    
});
   

</script>