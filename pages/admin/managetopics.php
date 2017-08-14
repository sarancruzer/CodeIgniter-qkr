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
                            <h3>Manage Topics</h3>
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
                                    <h2>Add Topic</h2>
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
                                    <form method="POST" role="form" id="topicform" action="<?php echo base_url();?>admin/addtopic">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <label>Parent <span class="required red">*</span></label>
                                        <select class="form-control" name="parent" id="parent">
                                            <option value="">--Select--</option>
                                            <option value="1">Topic</option>
                                            <option value="0">Category</option>
                                        </select>
                                        <ul></ul>
                                        <div id="changetopic" style="display:none;">
                                        <label>Topic <span class="required red">*</span></label>
                                        <select class="form-control" name="topic" id="topic">
                                            <option value="">--Select--</option>
                                             <?php if(!empty($managetopics)) {
                                            foreach ($managetopics as $topics) {
                                              if(($topics['is_parent']==1) && ($topics['is_active']==1))
                                              {
                                               ?>
                                            <option value="<?php echo $topics['topicid'];?>"><?php echo $topics['name'];?></option>
                                            <?php 
                                            }
                                            }}?>
                                        </select>
                                        <ul></ul>
                                        </div>
                                        <label>Name <span class="required red">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                        <ul></ul>
                                        
                                        <label>Description </label>
                                        <textarea name="description" class="form-control"></textarea>
                                        <ul></ul>
                                        <!--<label>Related Topics</label>
                                        <select class="form-control" name="relatedtopic[]" id="relatedtopic" multiple="multiple">
                                            <option value="">--Select--</option>
                                            <?php if(!empty($managetopics)) {
                                            foreach ($managetopics as $topics) {
                                               ?>
                                            <option value="<?php echo $topics['id'];?>"><?php echo $topics['name'];?></option>
                                            <?php }}?>
                                           
                                        </select>
                                        <ul></ul>-->
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
                                    <h2>Manage Topics</h2>
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
                                
                                    <form action="<?php echo base_url();?>admin/managetopics" method="GET">
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
                                                <th class="column-title">Parent </th>
                                                <th class="column-title">Name </th>
                                                <th class="column-title">Description </th>
                                                <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($managetopics)) {
                                foreach ($managetopics as $topics) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php if(!empty($topics['is_parent'])){ echo "Topic"; } else{ echo "Category";}?></td>
                                                <td class=" "><?php echo $topics['name'];?></td>
                                                <td class=" "><?php echo word_limiter(htmlspecialchars_decode($topics['description'],ENT_QUOTES),7);?></td>
                                                 <td class=" "><?php if($topics['is_active']=='1'){ echo "Active";} else { echo "Inactive";}?></td>
                                                <td class=" last">
                                                <a data-row-id="<?php echo $topics['topicid'];?>" data-row-editname="<?php echo $topics['name'];?>" data-row-edittopic="<?php echo $topics['is_parent'];?>" data-row-mapid="<?php echo $topics['mapid'];?>"  data-row-mappingid="<?php echo $topics['mappingid'];?>" data-row-editstatus="<?php echo $topics['is_active'];?>" data-row-editdesc="" data-target=".editing" data-toggle="modal" class="btn btn-primary edit">Edit</a>                              
                                                <input type="hidden" id="desc_<?php echo $topics['topicid'];?>" value="<?php echo $topics['description'];?>"/>
                                                <a data-row-id="<?php echo $topics['topicid'];?>" data-row-mapid="<?php echo $topics['mapid'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel2">Edit Topic</h4>
            </div>
             <form method="POST" id="edittopicform" name="edittopicform" action="<?php echo base_url();?>admin/edittopic?q=<?php echo @$q?>&stat=<?php echo @$stat?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group col-lg-10">
                 <label>Parent <span class="required red">*</span></label>
                   <select class="form-control" name="editparent" id="editparent">
                        <option value="">--Select--</option>
                        <option value="1">Topic</option>
                        <option value="0">Category</option>
                    </select>
                   <label for="editparent" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
                   <div class="clearfix"></div>
                <div id="editchange" style="display:none;" >
                <div class="form-group col-lg-10">
                 <label>Topic <span class="required red">*</span></label>
                   <select class="form-control" name="edittopic" id="edittopic">
                      <option value="">--Select--</option>
                       <?php if(!empty($managetopics)) {
                      foreach ($managetopics as $topics) {
                        if($topics['is_parent']==1)
                        {
                         ?>
                      <option value="<?php echo $topics['topicid'];?>"><?php echo $topics['name'];?></option>
                      <?php 
                      }
                      }}?>
                  </select>
                   <label for="edittopic" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
                   </div>
                   <div class="clearfix"></div>
                <div class="form-group col-lg-10">
                <label>Name<span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="editname" id="editname" class="form-control" autocomplete="off" tabindex="1"/>
                   <input type="hidden" name="old_name" id="old_name" class="form-control" />
                   <input type="hidden" name="mapid" id="mapid" class="form-control" />

                   <label for="editname" class="error" id="error" style="display:none"></label>
                   </div>
                <br> 
                <div class="clearfix"></div>  
                <div class="form-group col-lg-10">
                <label>Description </label>    
                  <textarea name="editdescription"id="editdescription" class="form-control"></textarea>  
                   <label for="editdescription" class="error" id="error" style="display:none"></label>
                   </div>
                   <br>
                   <div class="clearfix"></div>
                <div class="clearfix col-lg-10">
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
            <div class="clearfix"></div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" style="margin-top:-4px;">Save</button>
            </div>
             </form>
        </div>
    </div>
</div>
</div>
<div class="modal fade deleting" tabindex="-2" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Delete Topic</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletetopic?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this topic</h5>
            <input type="hidden" name="deleteid" id="deleteid" class="form-control" />  
            <input type="hidden" name="deletemapid" id="deletemapid" class="form-control" />  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" style="margin-top:-4px;">Ok</button>
        </div>

    </div>
</div>
</div>

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
<script type="text/javascript" >
$(document).ready(function () {

  $('#topicform').validate({
    rules: {
      parent: 
        {
        required:true,
        },
      topic: 
      {
         required: { 
        depends: function(element){
            return ($("select[name=parent]").val() != "" &&  $("select[name=parent]").val() != 1)
        } 
      }, 
      },
      name: {
        required:true,
        remote: {
            url: "<?php echo base_url('admin/verifytopic');?>",
            type: "post",
            data: {
           // staff: function() {
            val: $("#name").val()
           // },
            },
       },
       },
       description: {
        required:true,
         },
       
    },
    messages: {
       parent: {
        required:"Please select a parent",
       },
       topic: {
        required:"Please select a topic",
       },
       name: {
        required:"Please enter a name",
        remote:"Topic already used",
       },
       description: {
        required:"Please enter a description",
        },
       
    }
  });
  $('#edittopicform').validate({
    rules: {
      editparent: 
        {
        required:true,
        },
      edittopic: 
      {
         required: { 
        depends: function(element){
            return ($("select[name=editparent]").val() != "" &&  $("select[name=editparent]").val() != 1)
        } 
      }, 
      },
      editname: {
        required:true,
       remote: {
        param: {
            url: "<?php echo base_url('admin/verifytopic');?>",
            type: "post",
            data: {
            insustrial: $( "#editname" ).val()
               },
                 },
     
              depends: function() {
                return $("#editname").val() !== $('#old_name').val();
              }
          },
       },
       editdescription: {
        required:true,
         },
        editstatus: 
        {
        required:true,
        },
       
    },
    messages: {
       editparent: {
        required:"Please select a parent",
       },
       edittopic: {
        required:"Please select a topic",
       },
       editname: {
        required:"Please enter a name",
        remote:"Topic already used",
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
      $( "#parent" ).change(function() {
        var parent=$('#parent').val();
        if(parent==0)
        {
        $('#changetopic').show();
        }
        else
        {
          $('#changetopic').hide();
        }
      });
      
      $( "#editparent" ).change(function() {
        var parent=$('#editparent').val();
        if(parent==0)
        {
        $('#editchange').show();
        //$("#editparent option[value='"+mappingid+"']").remove();
        }
        else
        {
          $('#editchange').hide();
        }
      });
        $(".edit").on('click', function(){
          var validator = $("#edittopicform").validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var edittopic = $(this).data('row-edittopic');
         var editname = $(this).data('row-editname');
         var mappingid = $(this).data('row-mappingid');
         var editdesc = $(this).data('row-editdesc');
         var editstatus = $(this).data('row-editstatus');
         var mapid = $(this).data('row-mapid');
         var lablename='#desc_'+id;
             description= $(lablename).val();
           
         $('#id').val(id);
          $('#editname').val(editname);
           $('#old_name').val(editname);
           $('#mapid').val(mapid);
           if(edittopic==0)
           {
            $('#editchange').show();
           }
           else
            {
              $('#editchange').hide();
            }
           var htmlchars=description;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/htmlchars",
      dataType:'json',
      data: {htmlchars:htmlchars},
        success: function(msg)
          {             
            tinyMCE.get('editdescription').setContent(msg.mailcontent);
                      }  
       });
            $('[name=editstatus] option').filter(function() {
          return ($(this).val() == editstatus); //To select Blue
    }).prop('selected', true);
            $('[name=editparent] option').filter(function() {
          return ($(this).val() == edittopic); //To select Blue
    }).prop('selected', true);
           tinyMCE.activeEditor.setContent(description);
          // $('#editdescription').val(editdesc);
          $('[name=edittopic] option').filter(function() {
          return ($(this).val() == mappingid); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#editname').val('');
          $('#old_name').val('');
          $('#editdescription').val('');
          $('#mapid').val('');
          $('#edittopic').val('');
          $('#editparent').val('');
         $('#editstatus').val('');
    });
    $(".delete").on('click', function(){
         var id = $(this).data('row-id');
         var mapid = $(this).data('row-mapid');
         $('#deleteid').val(id);
         $('#deletemapid').val(mapid);
     });

    /*$('.deleting').on('hidden.bs.modal', function () {
        $('#deleteid').val('');
        $('#mapid').val('');
    });*/
    
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