<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Cities</h3>
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
                                    <h2>Add City</h2>
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
                                   <form method="POST" role="form" id="cityform" action="<?php echo base_url();?>admin/addcity" enctype="multipart/form-data">
                                  <!-- <?php echo form_open_multipart('admin/addcounty');?>-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Country Name <span class="required red">*</span></label>
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
                                        <div id="oncounty1">
                                        <select class="form-control" name="county" id="county">
                                            <option value="">--Select--</option>
                                            
                                        </select>
                                        </div>
                                        <ul></ul>
                                        <label>City Name <span class="required red">*</span></label>
                                        <input type="text" name="cityname" id="cityname" class="form-control">
                                        <ul></ul>
                                        <label>Latitude <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>  
                                        <input type="text" name="latitude" class="form-control">
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
                                        <input type="file" name="cityimage">
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
                                    <h2>Manage Cities</h2>
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
                               
                                    <form action="<?php echo base_url();?>admin/managecities" method="GET">
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
                                                <th class="column-title">City Name </th>
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
                            
                            if(!empty($managecities)) {
                                foreach ($managecities as $cities) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $cities['city'];?></td>
                                                <td class=" "><?php echo $cities['countyname'];?></td>
                                                <td class=" "><?php echo $cities['country'];?></td>
                                                <td class=" "><?php echo $cities['city_latitude'];?></td>
                                                <td class=" "><?php echo $cities['city_longitude'];?></td>
                                                <td class=" "><?php echo $cities['city_description'];?></td>
                                                 <td class=" "><?php if($cities['city_active']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $cities['cityid'];?>" data-row-editcounty="<?php echo $cities['countyid'];?>" data-row-editcityname="<?php echo $cities['city'];?>" data-row-editcountry="<?php echo $cities['countryid'];?>" data-row-editlat="<?php echo $cities['city_latitude'];?>" data-row-editlong="<?php echo $cities['city_longitude'];?>" data-row-editdesc="<?php echo $cities['city_description'];?>" data-row-editimage="<?php echo $cities['city_image'];?>" data-row-editstatus="<?php echo $cities['city_active'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $cities['cityid'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel2">Edit City</h4>
            </div>
             <form method="POST" id="editcityform" name="editcityform" action="<?php echo base_url();?>admin/editcity?q=<?php echo @$q?>&stat=<?php echo @$stat?>&paginate=<?php echo @$paginate?>" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <label>Country Name<span class="required red">*</span></label>
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
                <label>County Name<span class="required red">*</span></label>
                <div id="oncounty2">
                <select class="form-control" name="editcounty" id="editcounty">
                    <option value="">--Select--</option>
                    
                </select>
                </div>
                </div>
                   <br>
                   <div class="form-group">
                <label>City Name <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editcityname" id="editcityname" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_name" id="old_name" class="form-control" />
                   <label for="editcityname" class="error" id="error" style="display:none"></label>
                   </div>
                <br>   
                <div class="form-group">
                <label>Latitude  <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>   
                  <input type="text" name="editlat" id="editlat" class="form-control"/>
                   <label for="editlat" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                <div class="form-group">
                <label>Longitude  <span class="required red">*</span></label> <small>(Eg: 98.7812)</small>     
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
                   <input type="file" name="editcityimage" id="editcityimage" />
                  <span id="editimage"></span>
                  <input type="hidden" name="old_image" id="old_image">
                   <label for="editcityimage" class="error" id="error" style="display:none"></label>
                    <br>
                </div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="editstatus" id="editstatus" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >Active</option>                 
                    <option value="0">Inactive</option>                 
                                   
                   </select>
                   <label for="editstatus" class="error" id="error" style="display:none"></label>
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
            <h4 class="modal-title" id="myModalLabel2">Delete City</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletecity?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this city</h5>
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
   
  $("#country").change(function(){
      $('#error').hide();
    //  $("#afflist").mask("Please Wait...");

      var country=$('#country').val();
      var name='county';
      $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/onloadgetcounty",
        data: {county:country,name:name},
        success: function(msg)
          {
          //  $("#afflist").unmask();
            $("#oncounty1").html(msg);
           }  
       });
       
  });
  $("#editcountry").change(function(){
      $('#error').hide();
    //  $("#afflist").mask("Please Wait...");

      var country=$('#editcountry').val();
      var name='editcounty';
      $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/onloadgetcounty",
        data: {county:country,name:name},
        success: function(msg)
          {
          //  $("#afflist").unmask();
            $("#oncounty2").html(msg);
           }  
       });
       
  });
 $.validator.addMethod('mappoint', function (value) { 
    return /^[-]?((\d+)|(\d+\.\d+)|(\.\d+))$/.test(value); 
});
  $('#cityform').validate({
    rules: {
        country:
        {
        required:true,
        },
        county:
        {
        required:true,
        },
        cityname: {
          required:true,
          remote: {
              url: "<?php echo base_url('admin/verifycity');?>",
              type: "post",
              data: {
             // staff: function() {
              val: $("#cityname").val()
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
        cityimage: {
        required:true,
        extension:"jpg|jpeg|png|gif",
         },
    },
    messages: {
        country: 
        {
        required:"Please select a country name",
        },
        county: 
        {
        required:"Please select a county name",
        },
       cityname: {
        required:"Please enter a city name",
        remote:"City name already used",
       },
       latitude: {
        required:"Please enter a latitude",
        mappoint:"Please enter a valid latitude",
        },
        longitude: 
        {
        required:"Please enter a longitude",
        mappoint:"Please enter a valid longitude"
        },
        description: 
        {
        required:"Please enter a description",
        },
        cityimage: 
        {
        required:"Please select a image",
        extension:"Only jpeg,jpg,png,gif file format allowed",
        },
    }
  });
  $('#editcityform').validate({
    rules: {
        editcountry:
        {
        required:true,
        },
        editcounty:
        {
        required:true,
        },
        editcityname: {
          required:true,
          remote: {
          param: {
            url: "<?php echo base_url('admin/verifycity');?>",
            type: "post",
            data: {
                   insustrial: $( "#editcityname" ).val()
                  },
               },
     
              depends: function() {
                return $("#editcityname").val() !== $('#old_name').val();
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
        required:"Please select a country name",
        },
        editcounty: 
        {
        required:"Please select a county name",
        },
       editcityname: {
        required:"Please enter a city name",
        remote:"County name already used",
       },
       editlat: {
        required:"Please enter a latitude",
        mappoint:"Please enter a valid latitude",
        },
        editlong: 
        {
        required:"Please enter a longitude",
        mappoint:"Please enter a valid longitude",
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
          var validator = $( "#editcityform" ).validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var editcityname = $(this).data('row-editcityname');
         var editcountry = $(this).data('row-editcountry');
         var editcounty = $(this).data('row-editcounty');
         var editlat = $(this).data('row-editlat');
         var editlong = $(this).data('row-editlong');
         var editdesc = $(this).data('row-editdesc');
         var editimage = $(this).data('row-editimage');
         var editstatus = $(this).data('row-editstatus');
           
         $('#id').val(id);
          $('#editcityname').val(editcityname);
           $('#old_name').val(editcityname);
           $('#editlat').val(editlat);
           $('#editlong').val(editlong);
           $('#editdesc').val(editdesc);
           $('#editimage').text(editimage);
           $('#old_image').val(editimage);
           var country=editcountry;
      var name='editcounty';
      var eselect=editcounty;
      $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/onloadgetcounty",
        data: {county:country,name:name,eselect:eselect},
        success: function(msg)
          {
          //  $("#afflist").unmask();
            $("#oncounty2").html(msg);
           }  
       });
      //alert(editcounty);
           $('[name=editcountry] option').filter(function() {
          return ($(this).val() == editcountry); //To select Blue
    }).prop('selected', true);
            $('[name=editcounty] option').filter(function() {
          return ($(this).val() == editcounty); //To select Blue
    }).prop('selected', true);
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#editcityname').val('');
           $('#old_name').val('');
           $('#editlat').val('');
           $('#editlong').val('');
           $('#editdesc').val('');
           $('#editimage').text('');
           $('#old_image').val('');
           $('#editcountry').val('');
           $('#editcounty').val('');
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