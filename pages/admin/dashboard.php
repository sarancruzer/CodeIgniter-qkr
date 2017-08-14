        <div role="main" class="right_col">
                <div class="row tile_count content">
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
                       </div>
     <div class="panel-group">
     <?php if(in_array("12",explode(",",$this->session->userdata['permissionid']))){?>
     <div class="col-lg-3 col-md-6 col-xs-12 pannel_bottom">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <div class="col-lg-3 col-md-3 col-xs-3">
              <i class="fa fa-users fa-5x"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-xs-9">
            <div class="pull-right"><h1><?php echo $regusers[0]['regusers'];?></h1> </div>
            <div class="clearfix"></div>
            <div class="pull-right">Registered Users</div>
           
          </div>
      </div>
      <div class="panel-footer"><a href="<?php echo base_url();?>admin/manageregusers" >View Details</a>
      <span class="pull-right">
        <i class="fa fa-arrow-circle-right"></i>
        </span></a>
      </div>
    </div>
    </div>
    <?php } ?>
    <?php if(in_array("13",explode(",",$this->session->userdata['permissionid']))){?>
    <div class="col-lg-3 col-md-6 col-xs-12 pannel_bottom">
    <div class="panel panel-yellow">
      <div class="panel-heading">
          <div class="col-lg-3 col-md-3 col-xs-9">
              <i class="fa fa-users fa-5x"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-xs-9">

            <div class="pull-right"><h1><?php echo $users[0]['users'];?></h1> </div>
            <div class="clearfix"></div>
            <div class="pull-right">End Users</div>
           
          </div>
      </div>
      <div class="panel-footer"><a href="<?php echo base_url();?>admin/manageusers" >View Details</a>
      <span class="pull-right">
        <i class="fa fa-arrow-circle-right"></i>
        </span></a>
      </div>
    </div>
    </div>
    <?php } ?>
    <?php if(in_array("14",explode(",",$this->session->userdata['permissionid']))){?>
     <div class="col-lg-3 col-md-6 col-xs-12 pannel_bottom">
    <div class="panel panel-pink">
      <div class="panel-heading">
          <div class="col-lg-3 col-md-3 col-xs-3">
              <i class="fa fa-check-square-o fa-5x"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-xs-9">

            <div class="pull-right"><h1><?php echo $reviews[0]['reviews'];?></h1> </div>
            <div class="clearfix"></div>
            <div class="pull-right">Reviews</div>
           <div class="clearfix"></div>
          </div>
      </div>
      <div class="panel-footer"><a href="<?php echo base_url();?>admin/reviews" >View Details</a>
      <span class="pull-right">
        <i class="fa fa-arrow-circle-right"></i>
        </span></a>
      </div>
    </div>
    </div>
    <?php } ?>
    <?php if(in_array("15",explode(",",$this->session->userdata['permissionid']))){?>
    <div class="col-lg-3 col-md-6 col-xs-12 pannel_bottom">
    <div class="panel panel-success">
      <div class="panel-heading">
          <div class="col-lg-3 col-md-3 col-xs-3">
              <i class="fa fa-question fa-5x"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-xs-9">

            <div class="pull-right"><h1><?php echo $unans[0]['unans'];?></h1> </div>
            <div class="clearfix"></div>
            <div class="pull-right">Unanswered Question</div>
           <div class="clearfix"></div>
          </div>
      </div>
      <div class="panel-footer"><a href="<?php echo base_url();?>admin/clientquestions?unrd=2" >View Details</a>
      <span class="pull-right">
        <i class="fa fa-arrow-circle-right"></i>
        </span></a>
      </div>
    </div>
    </div>
    <?php } ?>
    <?php if(in_array("17",explode(",",$this->session->userdata['permissionid']))){?>
    <div class="col-lg-3 col-md-6 col-xs-12 pannel_bottom">
    <div class="panel panel-blue">
      <div class="panel-heading">
          <div class="col-lg-3 col-md-3 col-xs-3">
              <i class="fa fa-gittip fa-5x"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-xs-9">

            <div class="pull-right"><h1><?php echo $tips[0]['tips'];?></h1> </div>
            <div class="clearfix"></div>
            <div class="pull-right">Tips</div>
           <div class="clearfix"></div>
          </div>
      </div>
      <div class="panel-footer"><a href="<?php echo base_url();?>admin/managetips" >View Details</a>
      <span class="pull-right">
        <i class="fa fa-arrow-circle-right"></i>
        </span></a>
      </div>
    </div>
    </div>
    <?php } ?>
    <?php if(empty($this->session->userdata['permissionid'])){?>
    <div class="col-lg-12 col-md-12 col-xs-12 pannel_bottom">
    <div class="panel panel-blue">
      <div class="panel-heading">
          <div class="col-lg-12 col-md-12 col-xs-12">
           <div class="text-center"><h2>You do not have any access permission!.</h2></div>
           <div class="clearfix"></div>
          </div>
      </div>
      <div class="panel-footer"><a href="#" >No Details</a>
      
      </div>
    </div>
    </div>
    <?php } ?>
  </div>

  </div>
</div>
<style type="text/css">
.panel
{
   height:auto;
}
.pannel_bottom
{
    margin-bottom: 20px;
}
.panel-heading
{
   height: 90px;
  
}
.panel-yellow {
    border-color: #f0ad4e;
}
.panel-yellow > .panel-heading {
    background-color: #f0ad4e;
    border-color: #f0ad4e;
    color: #fff;
}

.panel-success {
    border-color: #3c763d;
}
.panel-success > .panel-heading {
    background-color: #3c763d;
    border-color: #3c763d;
    color: #fff;
}
.panel-pink {
    border-color: #993399;
}
.panel-pink > .panel-heading {
    background-color: #993399;
    border-color: #993399;
    color: #fff;
}
.panel-blue {
    border-color: #6600CC;
}
.panel-blue > .panel-heading {
    background-color: #6600CC;
    border-color: #6600CC;
    color: #fff;
}

</style>