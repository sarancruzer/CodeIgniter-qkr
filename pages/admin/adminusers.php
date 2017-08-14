<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Admin Users</h3>
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
                                    <h2>Add Admin User</h2>
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
                                    <form method="POST" role="form" id="adminform" action="<?php echo base_url();?>admin/addadminuser">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>User Name <span class="required red">*</span></label>
                                        <input type="text" name="username" class="form-control">
                                        <ul></ul>
                                        <label>Password <span class="required red">*</span></label>
                                        <input type="password" name="pass" id="pass" class="form-control">
                                        <ul></ul>
                                        <label>Confirm Password <span class="required red">*</span></label>
                                        <input type="password" name="confpass" id="confpass" class="form-control">
                                        <ul></ul>
                                                
                                        <div class="clearfix"></div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Email id <span class="required red">*</span></label>
                                        <input type="text" name="email" class="form-control">
                                        <ul></ul>
                                        <label>Permissions </label>
                                        <select class="form-control" name="permission[]" id="permission" multiple="multiple">
                                            <option value="">--Select--</option>
                                            <?php 
                                            if(!empty($permissions))
                                            {
                                            foreach ($permissions as $perm) {
                                              ?>
                                            <option value="<?php echo $perm['id']?>"><?php echo $perm['name']?></option>
                                            <?php } } ?>
                                        </select>
                                        <ul></ul>
                                        
                                        </div>
                                        <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                        </div>
                                                
                                    </form>
                                    <!-- end form for validations -->

                                </div>
                            </div>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Manage Admin Users</h2>
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
                                
                                    <form action="<?php echo base_url();?>admin/adminusers" method="GET">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 ">
                                    <div class="form-group col-lg-6 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 <div class="input-group col-lg-6 pull-right">
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
                                                <th class="column-title">User Name </th>
                                                <th class="column-title">Email </th>
                                                <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($adminusers)) {
                                foreach ($adminusers as $admin) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $admin['admin_username'];?></td>
                                                <td class=" "><?php echo $admin['email'];?></td>
                                                 <td class=" "><?php if($admin['is_active']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $admin['admin_id'];?>" data-row-editusername="<?php echo $admin['admin_username'];?>" data-row-editstatus="<?php echo $admin['is_active'];?>" data-row-editemail="<?php echo $admin['email'];?>" data-row-editpermission="<?php echo $admin['permissionid'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $admin['admin_id'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
                                                </td>
                                            </tr>
                            <?php } } else {
                                ?>
                                <tr class="even pointer">
                                <td colspan="5">No Record Found!</td>
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
<div class="modal fade editing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit Admin User</h4>
            </div>
             <form method="POST" id="editform" name="editform" action="<?php echo base_url();?>admin/editadminuser?q=<?php echo @$q?>&stat=<?php echo @$stat?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                <label>User Name <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editusername" id="editusername" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_username" id="old_username" class="form-control" />
                   <label for="editusername" class="error" id="error" style="display:none"></label>
                   </div>
                <br>  
                <div style="border:1px solid #d7deff; margin:-9px; padding:8px;" > 
                <div class="form-group">
                <label>Password </label> <span>(Optional Reset Password)</span>   
                 <input type="password" name="editpass" id="editpass" class="form-control"/>
                   <label for="editpass" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                <div class="clearfix"></div>
                <div class="form-group">
                <label>Confirm Password </label>    
                  <input type="password" name="editconpass" id="editconpass" class="form-control"/>
                   <label for="editconpass" class="error" id="error" style="display:none"></label>
                   </div>
                   </div>
                   <br>
                   <div class="form-group">
                <label>Email id <span class="required red">*</span></label>    
                 <input type="text" name="editemail" id="editemail" class="form-control"/>
                  <input type="hidden" name="old_email" id="old_email" class="form-control"/>
                   <label for="editemail" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                  
                <div class="clearfix"></div>
                </div>
                <div class="col-lg-6 col-xs-12">
                <div class="clearfix"></div>
                <div class="form-group">
                  <label>Permissions </label>
                  <select class="form-control" name="editpermission[]" id="editpermission" multiple="multiple">
                      <option value="">--Select--</option>
                      <?php 
                      if(!empty($permissions))
                      {
                      foreach ($permissions as $perm) {
                        ?>
                      <option value="<?php echo $perm['id']?>"><?php echo $perm['name']?></option>
                      <?php } } ?>
                  </select>
                   <label for="editpermission" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                   <div class="clearfix"></div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="editstatus" id="editstatus" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >Active</option>                 
                    <option value="0">Inactive</option>                 
                                   
                   </select>
                   <label for="editstatus" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
                   </div>
                   <div class="clearfix"></div>
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
            <h4 class="modal-title" id="myModalLabel2">Delete Admin User</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deleteadminuser?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this admin user</h5>
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
$.validator.addMethod( //override email with django email validator regex - fringe cases: "user@admin.state.in..us" or "name@website.a"
        'emailid',
        function(value, element){
            return this.optional(element) || /(^[-!#$%&'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
        },
        'Please enter valid email id'
    );
  $('#adminform').validate({
    rules: {
      username: {
        required:true,
        remote: {
            url: "<?php echo base_url('admin/verifyadminuser');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#username").val()
           // },
            },
       },
       },
       pass: {
        required:true,
        minlength: 5,
         },
        confpass: {
        required:true,
         equalTo:'#pass',
         minlength: 5,
         },
         email: {
        required:true,
        emailid:true,
        remote: {
            url: "<?php echo base_url('admin/verifyadminemail');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#email").val()
           // },
            },
       },
         },
        
    },
    messages: {
       username: {
        required:"Please enter a user name",
        remote:"Username already used",
       },
       pass: {
        required:"Please enter a password",
        minlength:"Please enter at least 5 characters",
        },
        confpass: {
        required:"Please enter a confirm password",
        equalTo:"Did not match password",
        minlength:"Please enter at least 5 characters",
        },
        email: {
        required:"Please enter a email id",
        emailid:"Please enter valid email id",
        remote:"Email id already used in QuickR"
        },
        
    }
  });
   $('#editform').validate({
    rules: {
      editusername: {
        required:true,
        remote: {
        param: {
            url: "<?php echo base_url('admin/verifyadminuser');?>",
            type: "post",
            data: {
            insustrial: $( "#editusername" ).val()
               },
                 },
     
              depends: function() {
                return $("#editusername").val() !== $('#old_username').val();
              }
          },
       },
        editpass: {
          required:{
             depends: function(element) {
                    return !!$("#editconpass").val();
                },
                
          },
		minlength:5,
         },
        editconpass: {
          required:{
             depends: function(element) {
                    return !!$("#editpass").val();
                },
                
          },
          minlength:5,
         equalTo:'#editpass',
         },
         editemail: {
        required:true,
        emailid:true,
        remote: {
        param: {
            url: "<?php echo base_url('admin/verifyadminemail');?>",
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
         editstatus: {
        required:true,
         },
    },
    messages: {
       editusername: {
        required:"Please enter a user name",
        remote:"Username already used",
       },
        editpass: {
        required:"Please enter a password",
        minlength:"Please enter at least 5 characters",
        },
        editconpass: {
        required:"Please enter a confirm password",
        equalTo:"Did not match password",
        minlength:"Please enter at least 5 characters",
        },
        editemail: {
        required:"Please enter a email id",
        emailid:"Please enter valid email id",
        remote:"Email id already used in QuickR"
        },
        editstatus: {
        required:"Please select a status",
        },
    }
  });
});
</script>
<script>
    $(document).ready(function() {
        $(".edit").on('click', function(){
          var validator = $("#editform").validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editusername = $(this).data('row-editusername');
         var editemail = $(this).data('row-editemail');
          var editpermission = $(this).data('row-editpermission');
         var editstatus = $(this).data('row-editstatus');
            
         $('#id').val(id);
          $('#editusername').val(editusername);
           $('#old_username').val(editusername);
           $('#old_email').val(editemail);
           $('#editemail').val(editemail);
          /* $('#editpermission').val(editpermission);*/
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
var editperm = editpermission.toString().split(",");
$.each(editperm, function(i,e){
    $("#editpermission option[value='" + e + "']").prop("selected", true);
});
    $("#editpermission option[value='']").prop("selected", false);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#editusername').val('');
          $('#old_username').val('');
          $('#old_email').val('');
          $('#editemail').val('');
           $('#editpermission').val('');
         $('#editstatus').val('');
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