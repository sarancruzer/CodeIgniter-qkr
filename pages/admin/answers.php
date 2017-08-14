<?php error_reporting(0);
?>
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
                            <h3>Manage Answers</h3>
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
                                    <h2>Manage Answers</h2>
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
                                
                                    <form action="<?php echo base_url();?>admin/answers" method="GET">
                                    <div class="col-lg-7 col-md-10 col-sm-10 col-xs-12 col-lg-offset-5 col-md-offset-2 col-sm-offset-2 pull-right">
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
                                <select class="form-control" name="unrd" id="unrd">
                                                    <option value="">Question</option>
                                                    <option value="1" <?php if(($unrd!='')&& ($unrd==1)){ echo "selected='selected'";}?>>Answered</option>
                                                    <option value="2" <?php if(($unrd!='')&& ($unrd==2)){ echo "selected='selected'";}?>>Unanswered</option>
                                                </select>
                                                </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">Question Status</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 <div class="input-group col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
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
                                      <div class="panel-group" id="accordion">
                                      <?php 
                                      if(!empty($clientquest))
                                      {$i=1;
                                        foreach ($clientquest as $key=>$quest) {
                                        
                                        ?>
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title accordian-text">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>">
                                                 <?php echo $quest['subject'];?>
                                                </a>

                                                <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                                
                                              </h4>
                                            </div>
                                            
                                            <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
                                            
                                              <div class="panel-body">
                                              <label>Description:</label>
                                               <p> <?php echo $quest['detail'];?></p>
                                                
                              <ul class="list-unstyled timeline">
                               
                               <?php 
                               if(!empty($questans))
                               {
                                $j=1;
                               foreach ($questans as $ans) {
                               if($quest['id']==$ans['quest_id'])
                               {?>
                              <li>
                              <div class="block">
                              <div class="tags">
                              <a class="tag" href="" style="text-decoration:none">
                              <span>Answer <?php echo $j;?></span>
                              </a>
                              </div>
                              <div class="block_content">
                              <div class="excerpt" style="word-break: break-all;">
                              <?php echo @$ans['answer'];?>
                              
                              </div>
                              <div class="inline">
                              <div class="byline">
                              <span><?php echo date('m-d-Y',strtotime($ans['answered_date']));?></span>
                              by
                              <a style="text-decoration:none"><?php echo @$ans['email'];?></a>
                              </div>
                              <label style="margin-left:7px;margin-right:7px;">Marked as Help:<?php echo @$ans['helpmark'];?></label>
                              <label style="margin-left:7px;margin-right:7px;">Best Mark:<?php echo @$ans['bestmark'];?></label>
                              <label style="margin-left:7px;margin-right:7px;">Agree:<?php echo @$ans['agree'];?></label>
                              <?php
                              if(!empty($ans['answerid']))  
                              {
                              $options['table']='quset_additional_process';
                              $options['key']=' where comment!="NULL" and answer_id='.@$ans['answerid'];
                              $comment=admin_model::getRecord(@$options);
                              }
                              ?>
                              <label style="margin-left:7px;margin-right:7px;">
                              <a href="#" data-toggle="tooltip" data-placement="top" data-html="true" title="
                              <?php if(!empty($comment)){ foreach ($comment as $commen) { ?>
                              <p class='text-left'><?php echo @$commen['comment'];?></p>
                              <?php } } else { ?><p class='text-left'>No Comments</p><?php } ?>">comment:<?php echo @$ans['comment'];?></a></label>
                              <label style="margin-left:7px;margin-right:7px;">Flag:<?php echo @$ans['flag'];?></label>
                              <input type="hidden" name="Aid<?php echo $i.$j;?>" id="Aid<?php echo $i.$j;?>" value="<?php echo @$ans['ansid'];?>" >
                               <input type="radio" name="Astatus<?php echo $i.$j;?>" id="AstatusS<?php echo $i.$j;?>" value="1" onclick="myPublish(<?php echo $i.$j;?>)"  <?php if($ans['Astatus']==1) { echo "checked='checked'";}?>  /> Published
                               <input type="radio" name="Astatus<?php echo $i.$j;?>" id="AstatusN<?php echo $i.$j;?>" value="0" onclick="myPublish(<?php echo $i.$j;?>)" <?php if($ans['Astatus']==0) { echo "checked='checked'";}?>  /> Unpublished
                               </div>
                              </div>
                              </div>
                              </li>
                              <?php $j++; }  } }?>
                              </ul>
                             

                                               <!--<div class="col-lg-12">
                                               <div class="col-lg-6">
                                               <div class="byline">
                                              <span><?php echo date('D-M-Y',strtotime($quest['submitted_date']));?></span>                                              
                                              </div>
                                              </div>

                                              <div class="pull-right"><a href="<?php echo base_url();?>admin/setting/<?php echo @$quest['id'];?>?q=<?php @$_GET['q'];?>&stat=<?php echo @$_GET['stat'];?>&paginate=<?php echo @$_GET['paginate'];?>" >Setting</a></div>
                                              
                                              </div>
                                              <div class="clearfix"></div>
                                              </div>-->
                                               <div class="pull-right"><a data-row-id="<?php echo $quest['id'];?>" data-row-detail="<?php echo $quest['detail'];?>" data-row-subject="<?php echo $quest['subject'];?>"  data-target=".adding" data-toggle="modal" class="btn btn-default add">Add Answer</a></div>
                                               <div class="clearfix"></div>
                                              </div>                
                                            </div>
                                          </div>
                                          <?php $i++; } }
                                          else
                                          {
                                          ?>
                                          <div class="panel panel-default">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">
                                                No Record Found!
                                              </h4>
                                            </div>
                                            </div>
                                          <?php }?>
                                          
                                        </div>
                                        <?php echo $links;?>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
       $('[data-toggle="tooltip"]').tooltip(); 
       function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);

    
    
});
  function myPublish(id)
{
var status=$('input:radio[name=Astatus'+id+']:checked').val();
var Aid=$('#Aid'+id).val();
$.ajax({
      type: "POST",
      url: "<?php echo base_url();?>admin/published",
        data: {Aid:Aid,status:status},
        success: function(msg)
          {
          //  $("#afflist").unmask();
           // $("#oncounty1").html(msg);
           }  
       });

} 

</script>
<script type="text/javascript">
   $(document).ready(function() {
        $(".add").on('click', function(){
          var validator = $( "#answerform" ).validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var subject = $(this).data('row-subject');
         var detail = $(this).data('row-detail');
          
         $('#id').val(id);
          $('#subject').text(subject);
           $('#detail').text(detail);
     });

    $('.adding').on('hidden.bs.modal', function () {
        $('#id').val('');
          $('#subject').text('');
           $('#detail').text('');
    });
  });
</script>
<div class="modal fade adding" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Add Answer</h4>
            </div>
             <form method="POST" id="answerform" name="answerform" action="<?php echo base_url();?>admin/addanswer?q=<?php echo @$q;?>&stat=<?php echo @$stat;?>&unrd=<?php echo @$unrd;?>&paginate=<?php echo @$paginate;?>" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input id="id" name="id" type="hidden">
                <div class="form-group">
                <label>Subject</label> 
                <p id="subject"></p>
                </div>
                <div class="form-group">
                <label>Description</label>  
                <p id="detail"></p> 
                </div>
                <div class="form-group">
                <label>Answer <span class="required red">*</span></label>    
                  <textarea name="answer"id="answer" class="form-control"></textarea>  
                   <label for="answer" class="error" id="error" style="display:none"></label>
                   </div> 
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
<script type="text/javascript" >
$(document).ready(function () {
   $('#answerform').validate({
    rules: {
       answer: {
        required:true,
       },
    },
    messages: {
        answer: {
        required:"Please enter a answer",
       }
    }
  });
});
</script>
