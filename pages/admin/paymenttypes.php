 <!-- page content -->
            <div class="right_col" role="main">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Payment Types</h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="row" >
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
                                            <h2>Add Payment Type</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                        <form class="form-inline" id="addpay" method="POST" action="<?php echo base_url();?>admin/addpaytype">
                                        <div class="form-group">
                                            <label for="fee">Payment Type <span class="required red">*</span></label>
                                             
                                            <input type="text" placeholder=" " class="form-control" name="paytype" id="paytype">
                                            
                                             <button class="btn btn-default" type="submit" style="margin-top:5px;">Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                
                                <div class="clearfix"></div>
                                
                   
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Manage Payment Types</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                 
                                <div class="x_content">
                                
                               
                                 
                                <div class="row">
                                <form method="GET" action="<?php echo base_url();?>admin/paymenttypes">
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 ">
                                    <div class="form-group col-lg-6 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if($stat=='1'){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if($stat=='0'){ echo "selected='selected'";}?>>Inactive</option>
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
                                                <th class="column-title" width="30px">S.No </th>
                                                <th class="column-title">Payment Type </th>
                                                <th class="column-title" width="110px">Status </th>
                                                <th class="column-title" width="150px" >Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($paytypes))
                            {
                                
                                foreach ($paytypes as $pay) {
                                  ?>
                                            <tr class="even pointer">
                                                <td><?php echo ++$offset;?></td>
                                                <td style="word-wrap: break-word"><?php echo $pay['type'];?></td>
                                                <td><?php if($pay['status']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td>
                                                <a class="btn btn-primary edit" data-toggle="modal" data-target=".editing" 
                                                data-row-id='<?php echo $pay['id']; ?>'
                                                data-row-editpaytype='<?php echo $pay['type']; ?>'
                                                data-row-status='<?php echo $pay['status']; ?>'    
                                                >Edit</a>                              
                                                <a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleting"  data-row-id="<?php echo $pay['id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php  }  }
                                            else {?>
                                            <tr class="even pointer">
                                                <td class=" " colspan="4" >No Records Found!</td>
                                                </tr>
                                                <?php  } ?>
                                            
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
             <!-- footer content 
                <footer>
                    <div class="">
                        <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                            <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>-->
                <!-- /footer content -->

            </div>
            <!-- /page content -->
<script type="text/javascript" >
$(document).ready(function () {

  $('#addpay').validate({
    rules: {
      paytype: {
        required:true,
        remote: {
            url: "<?php echo base_url('admin/verifypaytype');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#paytype").val()
           // },
            },
       },
       },
    },
    messages: {
       paytype: {
        required:"Please enter a payment type",
        remote:"Payment type already used",
       },
    }
  });

   $('#editform').validate({
    rules: {
      editpaytype: {
        required:true,
        remote: {
        param: {
            url: "<?php echo base_url('admin/verifypaytype');?>",
            type: "post",
            data: {
            fee: $("#editpaytype").val()
               },
                 },
     
              depends: function() {
                return $("#editpaytype").val() !== $('#old_paytype').val();
              }
          },
       },
       status: {
        required:true,
       },
    },
    messages: {
       editpaytype: {
        required:"Please enter a payment type",
        remote:"Payment type already used",
       },
        status: {
        required:"Please select status",
       }
    }
  });
});
</script>

<div class="modal fade editing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit Payment Type</h4>
            </div>
             <form method="POST" id="editform" name="editform" action="<?php echo base_url();?>admin/editpaytype?q=<?php echo @$q;?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group">
                <label>Payment Type <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editpaytype" id="editpaytype" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_paytype" id="old_paytype" class="form-control" />
                   <label for="editpaytype" class="error" id="error" style="display:none"></label>
                   </div>
                <br>   
                <div class="clearfix"></div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="status" id="status" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >Active</option>                 
                    <option value="0">Inactive</option>                 
                                   
                   </select>
                   <label for="status" class="error" id="error" style="display:none"></label>
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
            <h4 class="modal-title" id="myModalLabel2">Delete payment Type</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletepaytype?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this payment type</h5>
            <input type="hidden" name="deleteid" id="deleteid" class="form-control" />  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" style="margin-top:-4px;">Ok</button>
        </div>

    </div>
</div>
</div>
<!-- /modals -->
<script>
    $(document).ready(function() {
        $(".edit").on('click', function(){
          var validator = $( "#editform" ).validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editpaytype = $(this).data('row-editpaytype');
         var status = $(this).data('row-status');
              
         $('#id').val(id);
          $('#editpaytype').val(editpaytype);
           $('#old_paytype').val(editpaytype);
          $('[name=status] option').filter(function() {
          return ($(this).val() == status); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#editpaytype').val('');
          $('#old_paytype').val('');
         $('#status').val('');
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