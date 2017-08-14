<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Users</h3>
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
                                    <h2>Manage Users</h2>
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
                                
                                    <form action="<?php echo base_url();?>admin/manageusers" method="GET">
                                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-5 ">
                                    
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
                                                <th class="column-title">Name </th>
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
                                                <td class=" "><?php echo $user['firstname'].' '.$user['lastname'];?></td>
                                                <td class=" "><?php if($user['is_verified']=='1'){ echo "Verified";} else { echo "Not Verified";}?></td>
                                                 <td class=" "><?php if($user['is_blocked']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                                            
                                                <a data-row-id="<?php echo $user['id'];?>" data-row-editemail="<?php echo $user['email'];?>" data-row-editstatus="<?php echo $user['is_blocked'];?>" data-row-editadviser="<?php echo $user['is_fa'];?>" data-row-editverification="<?php echo $user['is_verified'];?>" data-row-adviser="<?php echo $user['is_fa'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $user['id'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit Users</h4>
            </div>
             <form method="POST" id="edituser" name="edituser" action="<?php echo base_url();?>admin/edituser?q=<?php echo @$q?>&stat=<?php echo @$stat?>&verf=<?php echo @$verf;?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group">
                <label>Email </label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editemail" id="editemail" class="form-control" autocomplete="off" tabindex="1" readonly="readonly" />
                   </div>
                <br>   
                <div class="form-group">
                 <label>Financial Adviser <span class="required red">*</span></label>
                   <select name="editadviser" id="editadviser" class="form-control" placeholder="">
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
            <h4 class="modal-title" id="myModalLabel2">Delete Users</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deleteuser?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this users</h5>
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
      editadviser:
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
       editadviser: {
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
         var editadviser = $(this).data('row-editadviser');
         var editverification = $(this).data('row-editverification');
         var editstatus = $(this).data('row-editstatus');
          
         $('#id').val(id);
          $('#editemail').val(editemail);
          $('[name=editadviser] option').filter(function() {
          return ($(this).val() == editadviser); //To select Blue
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
          $('#editverification').val('');
         $('#editverification').val('');
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