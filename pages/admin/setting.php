<?php error_reporting(0);?>
<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Question Setting</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div>Question:</div>
                    <p class="text-info">
                    <label><?php echo @$clientquest[0]['subject'];?></label>
                    </p>
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
                                    <h2>Common Question Setting</h2>
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
                                    <form method="POST" role="form" id="commonform" action="<?php echo base_url();?>admin/commonsetting/<?php echo $paginate; ?>?q=<?php echo @$_GET['q'];?>&stat=<?php echo @$_GET['stat']; ?>&comm=<?php echo @$_GET['comm']; ?>&unrd=<?php echo @$_GET['unrd']; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        
                                        
                                        <input type="hidden" name="commonquestid" id="commonquestid" value="<?php echo @$clientquest[0]['commonquestid']?>" >
                                        <input type="hidden" name="questid" id="questid" value="<?php echo $questid;?>" >
                                                <!--<select class="form-control" name="common_quest" id="common_quest">
                                                    <option value="">--Select--</option>
                                                    <option value="1"<?php if(!empty($clientquest[0]['commonquestid'])){ echo "selected";}?>>Yes</option>
                                                    <option value="0"<?php if(empty($clientquest[0]['commonquestid'])){ echo "selected";}?>>No</option>
                                                </select>-->
                                       <label>Common Question </label>
                                        
                                        <div id="com">
                                                <input type="radio" name="common_quest" id="common_questS" value="1" <?php if(!empty($clientquest[0]['commonquestid'])) { echo "checked='checked'";}?>  /> Yes
                                                <input type="radio" name="common_quest" id="common_questN" value="0" <?php if(empty($clientquest[0]['commonquestid'])) { echo "checked='checked'";}?>  /> No
                                       
                                        </div>
                                        <ul></ul>
                                        
                                                <div id="settopic" style="display:<?php if(!empty($clientquest[0]['commonquestid'])){ echo 'block';} else { echo 'none'; }?>">
                                                <label>Topic </label>
                                                <select class="form-control" name="topic[]" id="topic" multiple="multiple">
                                                    <option value="">--Select--</option>
                                                    <?php if(!empty($topics)) {
                                                      $topicin=array();
                                                      if(!empty($clientquest[0]['topics_tagged']))
                                                      {
                                                        $topicin=explode(',',$clientquest[0]['topics_tagged']);
                                                        
                                                      }
                                                  foreach ($topics as $topic) {
                                                  ?>
                                                    <option value="<?php echo $topic['id'];?>"<?php if(in_array($topic['id'], $topicin)){ echo "selected";}?>><?php echo $topic['name'];?></option>
                                                    <?php  } }?>
                                                </select>
                                                <ul></ul>
                                                </div>
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
                                    <h2>Question Status Setting</h2>
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
                                    <form method="POST" role="form" id="settingform" action="<?php echo base_url();?>admin/editsetting/<?php echo $paginate; ?>?q=<?php echo @$_GET['q'];?>&stat=<?php echo @$_GET['stat']; ?>&comm=<?php echo @$_GET['comm']; ?>&unrd=<?php echo @$_GET['unrd']; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            
                                      <?php if(!empty($flag))
                                      {?>
                                      <label>Flag:<small><?php echo count($flag);?></small></label>
                                      <ul></ul>
                                      <?php } ?>
                                      <input type="hidden" name="qid" id="qid" value="<?php echo $questid;?>" >
                                       <label>Status <span class="required red">*</span></label>
                                      <p>
                                              <input type="radio" name="status" id="statusS" value="1" <?php if($clientquest[0]['status']==1) { echo "checked='checked'";}?>  /> Yes
                                              <input type="radio" name="status" id="statusN" value="0" <?php if($clientquest[0]['status']==0) { echo "checked='checked'";}?>  /> No
                                     
                                      </p>
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
                                    <h2>Answer Review</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                              <div class="x_content">
                              <ul class="list-unstyled timeline">
                              <?php 
                              if(!empty($questans))
                              {
                                $i=1;
                               // var_dump($questans);
                                foreach ($questans as $ans) {
                              ?>
                              <li>
                              <div class="block">
                              <div class="tags">
                              <a class="tag" href="" style="text-decoration:none">
                              <span>Answer <?php echo ' '.$i;?></span>
                              </a>
                              </div>
                              <div class="block_content">
                              <div class="excerpt">
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
                              <p class='text-left'><?php echo $commen['comment'];?></p>
                              <?php } } else { ?><p class='text-left'>No Comments</p><?php } ?>">comment:<?php echo @$ans['comment'];?></a></label>
                              <label style="margin-left:7px;margin-right:7px;">Flag:<?php echo @$ans['flag'];?></label>
                              <input type="hidden" name="Aid<?php echo $i;?>" id="Aid<?php echo $i;?>" value="<?php echo @$ans['ansid'];?>" >
                               <input type="radio" name="Astatus<?php echo $i;?>" id="AstatusS<?php echo $i;?>" value="1" onclick="myPublish(<?php echo $i;?>)"  <?php if($ans['Astatus']==1) { echo "checked='checked'";}?>  /> Published
                               <input type="radio" name="Astatus<?php echo $i;?>" id="AstatusN<?php echo $i;?>" value="0" onclick="myPublish(<?php echo $i;?>)" <?php if($ans['Astatus']==0) { echo "checked='checked'";}?>  /> Unpublished
                               </div>
                              </div>
                              </div>
                              </li>
                              <?php 
                              $i++;
                              }
                               }?>
                              </ul>
                              </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


<script type="text/javascript" >

$(document).ready(function () {
   $('[data-toggle="tooltip"]').tooltip(); 
   $("#com input[name='common_quest']").click(function(){
    
        var parent=$('input:radio[name=common_quest]:checked').val();
        if(parent==1)
        {
        $('#settopic').show();
        }
        else
        {
          $('#settopic').hide();
        }
      });
  $('#settingform').validate({
    rules: {
        status: {
        required:true,
         },
    },
    messages: {
        status: {
        required:"Please select a status",
        },
    }
  });
 
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

