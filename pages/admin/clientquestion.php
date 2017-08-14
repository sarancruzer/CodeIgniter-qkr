<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Client Questions</h3>
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
                                    <h2>Manage Client Questions</h2>
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
                                
                                    <form action="<?php echo base_url();?>admin/clientquestions" method="GET">
                                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col-lg-offset-3 pull-right">
                                     <div class="form-group col-lg-3 col-md-6 col-sm-6 pull-right">
                                <select class="form-control" name="unrd" id="unrd">
                                                    <option value="">Question</option>
                                                    <option value="1" <?php if(($unrd!='')&& ($unrd==1)){ echo "selected='selected'";}?>>Answered</option>
                                                    <option value="2" <?php if(($unrd!='')&& ($unrd==2)){ echo "selected='selected'";}?>>Unanswered</option>
                                                </select>
                                                </div>
                                     <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="comm" id="comm">
                                                    <option value="">Common Question</option>
                                                    <option value="1" <?php if(($comm!='')&& ($comm==1)){ echo "selected='selected'";}?>>Yes</option>
                                                    <option value="0" <?php if(($comm!='')&& ($comm==0)){ echo "selected='selected'";}?>>No</option>
                                                </select>
                                                </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 <div class="input-group col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
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
                                      <?php if(!empty($clientquest))
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
                                               <p> <?php echo $quest['detail'];?></p>
                                               <div class="col-lg-12">
                                               <div class="col-lg-6">
                                               <div class="byline">
                                              <span><?php echo date('D-M-Y',strtotime($quest['submitted_date']));?></span>                                              
                                              </div>
                                              </div>
                                              <div class="pull-right"><a class="btn btn-default add" href="<?php echo base_url();?>admin/setting/<?php echo @$quest['questid'];?>?q=<?php @$_GET['q'];?>&stat=<?php echo @$_GET['stat'];?>&comm=<?php echo @$_GET['comm'];?>&unrd=<?php echo @$_GET['unrd'];?>&paginate=<?php echo @$_GET['paginate'];?>" >Setting</a></div>
                                              
                                              </div>
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
       function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);

    
    
});
   

</script>
