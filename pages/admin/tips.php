<style type="text/css">
.defaultSkin .mceStatusbar
{
  height:32px;
}
</style>
<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Tips</h3>
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
                                    <h2>Add Tips</h2>
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
                                   <form method="POST" role="form" id="tipsform" action="<?php echo base_url();?>admin/addtips" enctype="multipart/form-data">
                                  <!-- <?php echo form_open_multipart('admin/addcounty');?>-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Topic <span class="required red">*</span></label>
                                        <select class="form-control" name="topic[]" id="topic[]" multiple="multiple">
                                            <option value="">--Select--</option>
                                            <?php if(!empty($topics)) {
                                              
                                              foreach ($topics as $topic) {
                                                if($topic['is_active']==1){
                                              ?>
                                            <option value="<?php echo $topic['id'];?>"><?php echo $topic['name'];?></option>
                                            <?php }} }?>
                                        </select>
                                        <ul></ul>
                                        <label>Title <span class="required red">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control">
                                        <ul></ul>
                                        <label>Description </label>
                                        <textarea name="description" id="description" rows="3" class="form-control" class="textInMce"></textarea>
                                        <ul></ul>
                                        </div>        
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Template Type <span class="required red">*</span></label>
                                         <select class="form-control" name="template" id="template">
                                                    <option value="">--Select--</option>
                                                    <option value="1" >List</option>
                                                    <option value="2" >Video</option>
                                        </select>
                                        <ul></ul>
                                        <div id="temptype" style="display:none;">
                                        <label>Video URL <span class="required red">*</span></label>
                                        <input type="text" name="videourl" id="videourl" class="form-control">
                                        <ul></ul>
                                        </div>
                                        <label>Rating <span class="required red">*</span></label>
                                        <input type="text" name="rating" class="form-control">
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
                                    <h2>Manage Tips</h2>
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
                               
                                    <form action="<?php echo base_url();?>admin/managetips" method="GET">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 ">
                                    <div class="form-group col-lg-4 pull-right">
                                <select class="form-control" name="temp" id="temp">
                                                    <option value="">-Template-</option>
                                                    <option value="1" <?php if(($temp!='')&& ($temp==1)){ echo "selected='selected'";}?>>List</option>
                                                    <option value="2" <?php if(($temp!='')&& ($temp==2)){ echo "selected='selected'";}?>>Video</option>
                                                </select>
                                                </div>
                                    <div class="form-group col-lg-4 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 <div class="input-group col-lg-4 pull-right">
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
                                                <th class="column-title">Title </th>
                                                <th class="column-title">Description </th>
                                                <th class="column-title">Template Type </th>
                                                <th class="column-title">Rating </th>
                                                <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            
                            if(!empty($managetips)) {
                                foreach ($managetips as $tips) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $tips['title'];?></td>
                                                <td class=" "><?php echo htmlspecialchars_decode($tips['description'],ENT_QUOTES);?></td>
                                                <td class=" "><?php if($tips['template_type']=='1'){ echo "List";} else { echo "Video";}?></td>
                                                <td class=" "><?php echo $tips['rating'];?></td>
                                                <td class=" "><?php if($tips['status']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $tips['tipsid'];?>" data-row-edittopic="<?php echo $tips['topic'];?>" data-row-edittitle="<?php echo $tips['title'];?>" data-row-editdescription="<?php echo $tips['description'];?>" data-row-edittemplate="<?php echo $tips['template_type'];?>" data-row-editvideourl="<?php echo $tips['video_url'];?>" data-row-editrating="<?php echo $tips['rating'];?>" data-row-editstatus="<?php echo $tips['status'];?>" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $tips['tipsid'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel2">Edit Tips</h4>
            </div>
             <form method="POST" id="edittipsform" name="edittipsform" action="<?php echo base_url();?>admin/edittips?q=<?php echo @$q?>&stat=<?php echo @$stat?>&temp=<?php echo @$temp?>&paginate=<?php echo @$paginate?>" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <label>Topics <span class="required red">*</span></label>
                <select class="form-control" name="edittopic[]" id="edittopic" multiple="multiple">
                    <option value="">--Select--</option>
                    <?php if(!empty($topics)) {
                      foreach ($topics as $topic) {
                      ?>
                    <option value="<?php echo $topic['id'];?>"><?php echo $topic['name'];?></option>
                    <?php } }?>
                </select>
                </div>
                   <ul></ul>
                
                   <div class="form-group">
                <label>Title <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="edittitle" id="edittitle" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_title" id="old_title" class="form-control" />
                   <label for="edittitle" class="error" id="error" style="display:none"></label>
                   </div>
                <ul></ul>  
                <div class="form-group">
                <label>Description  </label>    
                  <textarea name="editdescription"id="editdescription" class="form-control"></textarea>  
                   <label for="editdescription" class="error" id="error" style="display:none"></label>
                   </div>
                 <div class="form-group">
                 <label>Template Type <span class="required red">*</span></label>
                   <select name="edittemplate" id="edittemplate" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >List</option>                 
                    <option value="2">Video</option>                 
                                   
                   </select>
                   <label for="edittemplate" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                    
                   <div class="form-group">
                <div id="edittemp">
                <label>Video URL <span class="required red">*</span></label>    
                  <input type="text" name="editvideourl" id="editvideourl" class="form-control"/>
                   <label for="editlat" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
                   </div>
                   <div class="form-group">
                <label>Rating  <span class="required red">*</span></label>    
                  <input type="text" name="editrating" id="editrating" class="form-control"/>
                   <label for="editrating" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
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
            <h4 class="modal-title" id="myModalLabel2">Delete Tips</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletetips?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&temp=<?php echo @$temp;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this tips</h5>
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
  $('#tipsform').validate({
    rules: {
        'topic[]':
        {
        required:true,
        },
        title:
        {
        required:true,
        },
        /*cityname: {
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
         },*/
        description:
        {
        required:true,
        desc:true,
        },
        template:
        {
        required:true,
        },
       videourl: {
         required:{
             depends: function(element) {
                    return $("#template").val()!=1;
                },
          },
        url:true,
         },
        rating: {
        required:true,
        range: [1, 5],
         },
    },
    messages: {
        'topic[]': 
        {
        required:"Please select a topic",
        },
        title: 
        {
        required:"Please enter a title",
        },
      /* cityname: {
        required:"Please enter a city name",
        remote:"City name already used",
       },*/
       description: {
        required:"Please enter a description",
        },
        template: 
        {
        required:"Please select a template type",
        },
        videourl: 
        {
        required:"Please enter a video URL",
        url:"Please enter valid URL",
        },
        rating: 
        {
        required:"Please enter a rating",
        range:"Please enter a value between 1 to 5",
        },
    }
  });
  $('#edittipsform').validate({
    rules: {
        'edittopic[]':
        {
        required:true,
        },
        edittitle:
        {
        required:true,
        },
        /*cityname: {
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
         },*/
        editdescription:
        {
        required:true,
        },
        edittemplate:
        {
        required:true,
        },
        editvideourl: 
        {
         required:{
             depends: function(element) {
                    return $("#edittemplate").val()!=1;
                },
          },
        url:true,
         },
        editrating: 
        {
        required:true,
        range: [1, 5],
         },
        editstatus: 
        {
        required:true,
         },
    },
    messages: {
        'edittopic[]': 
        {
        required:"Please select a topic",
        },
        edittitle: 
        {
        required:"Please enter a title",
        },
      /* cityname: {
        required:"Please enter a city name",
        remote:"City name already used",
       },*/
        editdescription: {
        required:"Please enter a description",
        },
        edittemplate: 
        {
        required:"Please select a template type",
        },
        editvideourl: 
        {
        required:"Please enter a video URL",
        url:"Please enter valid URL",
        },
        editrating: 
        {
        required:"Please enter a rating",
        range:"Please enter a value between 1 to 5",
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
      $( "#template" ).change(function() {
var tempval=$('#template').val();
if(tempval==2)
{
  $('#temptype').show();
}
else
{
  $('#temptype').hide();
}
});
$( "#edittemplate" ).change(function() {
var tempval=$('#edittemplate').val();
if(tempval==2)
{
  $('#edittemp').show();
}
else
{
  $('#edittemp').hide();
}
});
        $(".edit").on('click', function(){
          var validator = $( "#edittipsform" ).validate();
          validator.resetForm();
          var edittopic='';
         var id = $(this).data('row-id');
          edittopic = $(this).data('row-edittopic');
         var edittitle = $(this).data('row-edittitle');
         var editdescription = $(this).data('row-editdescription');
         var edittemplate = $(this).data('row-edittemplate');
         var editvideourl = $(this).data('row-editvideourl');
         var editrating = $(this).data('row-editrating');
         var editstatus = $(this).data('row-editstatus');
             
         $('#id').val(id);
          $('#edittitle').val(edittitle);
           $('#old_title').val(edittitle);
           $('#editdescription').val(editdescription);
           $('#edittemplate').val(edittemplate);
           $('#editvideourl').val(editvideourl);
           $('#editrating').val(editrating);
           var edittopicres = edittopic.toString().split(",");
           //$('#edittopic option').val(edittopicres);
           var htmlchars=editdescription;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/htmlchars",
      //dataType:'json',
      data: {htmlchars:htmlchars},
        success: function(msg)
          {             
            tinyMCE.get('editdescription').setContent(msg);
                      }  
       });
           if(edittemplate==2)
           {
           $('#edittemp').show();
           }
           else
           {
            $('#edittemp').hide();
           }
          $.each(edittopicres, function(i,e){
    $("#edittopic option[value='" + e + "']").prop("selected", true);
;
});
          $("#edittopic option[value='']").prop("selected", false);
          $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
          $('#edittitle').val('');
           $('#old_title').val('');
           $('#editdescription').val('');
           $('#edittemplate').val('');
           $('#editvideourl').val('');
           $('#editrating').val('');
           $('#edittopic').val('');
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
 <script type="text/javascript" src="<?php echo base_url();?>assets/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        width : "100%",
        height: "200px",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,autosave",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsize",
        theme_advanced_buttons2 : "selectcut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
        
        /*theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",*/
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        

        // Example content CSS (should be your site CSS)
        content_css : "<?php echo base_url();?>assets/examples/css/content.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "<?php echo base_url();?>assets/examples/lists/template_list.js",
        external_link_list_url : "<?php echo base_url();?>assets/examples/lists/link_list.js",
        external_image_list_url : "<?php echo base_url();?>assets/examples/lists/image_list.js",
        media_external_list_url : "<?php echo base_url();?>assets/examples/lists/media_list.js",

        // Style formats
        style_formats : [
            {title : 'Bold text', inline : 'b'},
            {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
            {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
            {title : 'Example 1', inline : 'span', classes : 'example1'},
            {title : 'Example 2', inline : 'span', classes : 'example2'},
            {title : 'Table styles'},
            {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
        ],
    });

</script>
<style type="text/css">
        .mceToolbar * {
    white-space: normal !important;
}
.mceToolbar tr,
.mceToolbar td {
    float:left !important;
}

       </style>
