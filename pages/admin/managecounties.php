<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Counties</h3>
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
                                    <h2>Add County</h2>
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
                                   <form method="POST" role="form" id="countyform" action="<?php echo base_url();?>admin/addcounty" enctype="multipart/form-data">
                                  <!-- <?php echo form_open_multipart('admin/addcounty');?>-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Country <span class="required red">*</span></label>
                                        <select class="form-control" name="country" id="country">
                                            <option value="">--Select--</option>
                                            <?php if(!empty($countries)) {
                                              foreach ($countries as $country) {
                                              ?>
                                            <option value="<?php echo $country['id'];?>"><?php echo $country['country'];?></option>
                                            <?php } }?>
                                        </select>
                                        <ul></ul>
                                        <label>County Name <span class="required red">*</span></label>
                                        <input type="text" name="countyname" id="countyname" class="form-control">
                                        <ul></ul>
                                        <label>Latitude <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>  
                                        <input type="text" name="latitude" class="form-control ">
                                        <ul></ul>
                                        <label>Longitude <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>  
                                        <input type="text" name="longitude" class="form-control">
                                        <ul></ul>
                                        </div>        
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Description <span class="required red">*</span></label>
                                        <textarea name="description" rows="5" class="form-control"></textarea>
                                        <ul></ul>
                                        <label>Image <span class="required red">*</span></label>
                                        <input type="file" name="countyimage">
                                        <ul></ul>
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
                                    <h2>Manage Counties</h2>
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
                               
                                    <form action="<?php echo base_url();?>admin/managecounties" method="GET">
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
                                                <th class="column-title">County Name </th>
                                                <th class="column-title">Country Name </th>
                                                <th class="column-title">Latitude </th>
                                                 <th class="column-title">Longitude </th>
                                                  <th class="column-title">Description </th>
                                                  <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            if(!empty($managecounties)) {
                                foreach ($managecounties as $county) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $county['name'];?></td>
                                                <td class=" "><?php echo $county['country'];?></td>
                                                <td class=" "><?php echo $county['latitude'];?></td>
                                                <td class=" "><?php echo $county['longitude'];?></td>
                                                <td class=" "><?php echo $county['description'];?></td>
                                                 <td class=" "><?php if($county['isactive']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $county['countyid'];?>" data-row-editname="<?php echo $county['name'];?>" data-row-editcountry="<?php echo $county['countryid'];?>" data-row-editlat="<?php echo $county['latitude'];?>" data-row-editlong="<?php echo $county['longitude'];?>" data-row-editdesc="<?php echo $county['description'];?>" data-row-editimage="<?php echo $county['image'];?>" data-row-editstatus="<?php echo $county['isactive'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $county['countyid'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
                                                </td>
                                            </tr>
                            <?php } } else {
                                ?>
                                <tr class="even pointer">
                                <td colspan="8">No Record Found!</td>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit County</h4>
            </div>
             <form method="POST" id="editcountyform" name="editcountyform" action="<?php echo base_url();?>admin/editcounty?q=<?php echo @$q?>&stat=<?php echo @$stat?>&paginate=<?php echo @$paginate?>" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <label>Country <span class="required red">*</span></label>
                <select class="form-control" name="editcountry" id="editcountry">
                    <option value="">--Select--</option>
                    <?php if(!empty($countries)) {
                      foreach ($countries as $country) {
                      ?>
                    <option value="<?php echo $country['id'];?>"><?php echo $country['country'];?></option>
                    <?php } }?>
                </select>
                </div>
                   <br>
                   <div class="form-group">
                <label>County Name <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editname" id="editname" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_name" id="old_name" class="form-control" />
                   <label for="editname" class="error" id="error" style="display:none"></label>
                   </div>
                <br>   
                <div class="form-group">
                <label>Latitude  <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>     
                  <input type="text" name="editlat" id="editlat" class="form-control"/>
                   <label for="editlat" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                <div class="form-group">
                <label>Longitude  <span class="required red">*</span></label>  <small>(Eg: 98.7812)</small>  
                  <input type="text" name="editlong" id="editlong" class="form-control"/>
                   <label for="editlong" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group">
                <label>Description  <span class="required red">*</span></label>    
                  <textarea name="editdesc"id="editdesc" class="form-control"></textarea>  
                   <label for="editdesc" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                   <div class="form-group">
                <label>Image </label>    
                   <input type="file" name="editcountyimage" id="editcountyimage" />
                  <span id="editimage"></span>
                  <input type="hidden" name="old_image" id="old_image">
                   <label for="editcountyimage" class="error" id="error" style="display:none"></label>
                    <br>
                </div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="editstatus" id="editstatus" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >Active</option>                 
                    <option value="0">Inactive</option>                 
                                   
                   </select>
                   <label for="status" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                   </div>
            </div>  
            <div class="clearfix"></div>     
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
            <h4 class="modal-title" id="myModalLabel2">Delete County</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletecounty?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this county</h5>
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
$.validator.addMethod('mappoint', function (value) { 
    return /^[-]?((\d+)|(\d+\.\d+)|(\.\d+))$/.test(value); 
});
  $('#countyform').validate({
    rules: {
        country:
        {
        required:true,
        },
        countyname: {
          required:true,
          remote: {
              url: "<?php echo base_url('admin/verifycounty');?>",
              type: "post",
              data: {
             // staff: function() {
              val: $("#countyname").val()
             // },
              },
         },
         },
        latitude:
        {
        required:true,
        mappoint:true,
        },
        longitude:
        {
        required:true,
        mappoint:true,
        },
       description: {
        required:true,
         },
        countyimage: {
        required:true,
        extension:"jpg|jpeg|png|gif",
         },
    },
    messages: {
        country: 
        {
        required:"Please select a country",
        },
       countyname: {
        required:"Please enter a county name",
        remote:"County name already used",
       },
       latitude: {
        required:"Please enter a latitude",
        mappoint:"Please enter a valid latitude",
        },
        longitude: 
        {
        required:"Please enter a longitude",
        mappoint:"Please enter a valid longitude",
        },
        description: 
        {
        required:"Please enter a description",
        },
        countyimage: 
        {
        required:"Please select a image",
        extension:"Only jpeg,jpg,png,gif file format allowed",
        },
    }
  });
  $('#editcountyform').validate({
    rules: {
        editcountry:
        {
        required:true,
        },
        editname: {
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
        editlat:
        {
        required:true,
        mappoint:true,
        },
        editlong:
        {
        required:true,
        mappoint:true,
        },
       editdesc: {
        required:true,
         },
        editcountyimage: {
       
        extension:"jpg|jpeg|png|gif",
         },
        editstatus: {
        required:true,
         },
    },
    messages: {
        editcountry: 
        {
        required:"Please select a country",
        },
       editname: {
        required:"Please enter a county name",
        remote:"County name already used",
       },
       editlat: {
        required:"Please enter a latitude",
        mappoint:"Please enter a valid latitude",
        },
        editlong: 
        {
        required:"Please enter a longitude",
        mappoint:"Please enter a valid longitude"
        },
        editdesc: 
        {
        required:"Please enter a description",
        },
        editcountyimage: 
        {
        extension:"Only jpeg,jpg,png,gif file format allowed",
        },
        editstatus: 
        {
        required:"Please select a status",
        },
    }
  });
  
});
</script>
<script>
    $(document).ready(function() {
        $(".edit").on('click', function(){
          var validator = $( "#editcountyform" ).validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editname = $(this).data('row-editname');
         var editcountry = $(this).data('row-editcountry');
         var editlat = $(this).data('row-editlat');
         var editlong = $(this).data('row-editlong');
         var editdesc = $(this).data('row-editdesc');
         var editimage = $(this).data('row-editimage');
         var editstatus = $(this).data('row-editstatus');
              
         $('#id').val(id);
          $('#editname').val(editname);
           $('#old_name').val(editname);
           $('#editlat').val(editlat);
           $('#editlong').val(editlong);
           $('#editdesc').val(editdesc);
           $('#editimage').text(editimage);
           $('#old_image').val(editimage);
           $('[name=editcountry] option').filter(function() {
          return ($(this).val() == editcountry); //To select Blue
    }).prop('selected', true);
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
          $('#editname').val('');
           $('#old_name').val('');
           $('#editlat').val('');
           $('#editlong').val('');
           $('#editdesc').val('');
           $('#editimage').text('');
           $('#old_image').val('');
           $('#editcountry').val('');
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