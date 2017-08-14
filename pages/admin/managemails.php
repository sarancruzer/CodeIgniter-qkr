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
                            <h3>Manage Emails</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Manage Emails</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br>
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
                                    <form class="form-horizontal form-label-left" name="mailsetting" id="mailsetting"  method="POST" action="<?php echo base_url();?>admin/managemails">

                                        <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Template <span class="required red">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="mailtemp" id="mailtemp">
                                                    <option value="">--Select--</option>
                                                    <?php if(!empty($managemails))
                                                    {
                                                        foreach($managemails as $mail)
                                                        {
                                                        ?>
                                                    <option value="<?php echo $mail['id'];?>"><?php echo $mail['template'];?></option>
                                                    <?php } }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                            <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Subject <span class="required red">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" name="mailsubject" id="mailsubject" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle-name">Content</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            
                                               <textarea name="mail_content" id="mail_content" class="form-control"></textarea>
                                             
                                            </div>
                                        </div>
                                        
                                       
                                       <div class="clearfix"></div>
                                        <div class="form-group col-lg-12">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-success" type="submit" id="submit" name="submit" value="submit">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

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
        height: "400px",
        plugins: [
                    "bootstrap" 
                    ],
        toolbar: "bootstrap", 
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,autosave",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing:false,
        

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
<script type="text/javascript">
$(document).ready(function() {
    $('#mailtemp').on('change', function() {
        var changeid=$('#mailtemp').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/changecontent",
      dataType:'json',
      data: {mailid:changeid},
        success: function(msg)
          {             
            tinyMCE.get('mail_content').setContent(msg.mailcontent);
            $('#mailsubject').val(msg.mailsubject);
            $('#mailsetting').find('input, textarea, select').removeClass('error'); 
        
        validator =  $("#mailsetting").validate();
        validator.resetForm();
                      }  
       });
       });
    $('#mailsetting').validate({
     ignore: [],
    rules: {
       mailtemp: {
            required: true,
               },
       mailsubject: {
            required: true,
               },
       
        },
              
    messages: {
           mailtemp: {
            required: "Please select mail template",
                  },
           mailsubject: {
            required: "Please select mail subject",
                  },
            
             }
    });
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
  