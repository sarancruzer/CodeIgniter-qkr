<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Practice Area</h3>
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
                                    <h2>Add Practice Area</h2>
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
                                    <form method="POST" role="form" id="areaform" action="<?php echo base_url();?>admin/addarea">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Practice Area <span class="required red">*</span></label>
                                        <input type="text" name="area" class="form-control">
                                        <ul></ul>
                                                <label>Status <span class="required red">*</span></label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                <label>Description <span class="required red">*</span></label>
                                                <textarea name="description" class="form-control"></textarea>
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <br>
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
                                    <h2>Manage Practice Area</h2>
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
                                    <form action="<?php echo base_url();?>admin/managepractice" method="GET">
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
                                                <th class="column-title">Practice Area </th>
                                                <th class="column-title">Description </th>
                                                <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($managepractice)) {
                                foreach ($managepractice as $practice) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $practice['area'];?></td>
                                                <td class=" "><?php echo $practice['description'];?></td>
                                                 <td class=" "><?php if($practice['is_active']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $practice['id'];?>" data-row-editarea="<?php echo $practice['area'];?>" data-row-editstatus="<?php echo $practice['is_active'];?>" data-row-editdesc="<?php echo $practice['description'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $practice['id'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel2">Edit Practice Area</h4>
            </div>
             <form method="POST" id="editareaform" name="editareaform" action="<?php echo base_url();?>admin/editarea?q=<?php echo @$q?>&stat=<?php echo @$stat?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group">
                <label>Practice Area<span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editarea" id="editarea" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_area" id="old_area" class="form-control" />
                   <label for="editarea" class="error" id="error" style="display:none"></label>
                   </div>
                <br>   
                <div class="form-group">
                <label>Description <span class="required red">*</span></label>    
                  <textarea name="editdescription"id="editdescription" class="form-control"></textarea>  
                   <label for="editdescription" class="error" id="error" style="display:none"></label>
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
            <h4 class="modal-title" id="myModalLabel2">Delete Practice Area</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletearea?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this practice area</h5>
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

  $('#areaform').validate({
    rules: {
      area: {
        required:true,
        remote: {
            url: "<?php echo base_url('admin/verifyarea');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#area").val()
           // },
            },
       },
       },
       description: {
        required:true,
         },
        status: {
        required:true,
         },
    },
    messages: {
       area: {
        required:"Please enter a practice area",
        remote:"Practice area already used",
       },
       description: {
        required:"Please enter a description",
        },
        status: {
        required:"Please select a status",
        },
    }
  });
  $('#editareaform').validate({
    rules: {
      editarea: {
        required:true,
         remote: {
        param: {
            url: "<?php echo base_url('admin/verifyarea');?>",
            type: "post",
            data: {
            insustrial: $( "#editarea" ).val()
               },
                 },
     
              depends: function() {
                return $("#editarea").val() !== $('#old_area').val();
              }
          },
       },
       editdescription: {
        required:true,
         },
        editstatus: {
        required:true,
         },
    },
    messages: {
       editarea: {
        required:"Please enter a practice area",
        remote:"Practice area already used",
       },
       editdescription: {
        required:"Please enter a description",
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
          var validator = $("#editareaform").validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editarea = $(this).data('row-editarea');
         var editdesc = $(this).data('row-editdesc');
         var editstatus = $(this).data('row-editstatus');
              
         $('#id').val(id);
          $('#editarea').val(editarea);
           $('#old_area').val(editarea);
           $('#editdescription').val(editdesc);
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#editarea').val('');
          $('#old_area').val('');
          $('#editdescription').val('');
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