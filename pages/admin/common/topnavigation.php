
            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url();?>assets/images/img.jpg" alt=""><?php if($this->session->userdata['username']!='') {  echo ucfirst(@$this->session->userdata['username']); } ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                   <!-- <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>-->
                                    <!--<li>
                                        <a href="javascript:;" data-target=".changing" data-toggle="modal">Change Password</a>
                                    </li>-->
                                    <li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                          <!--  <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>-->

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->
         <!--   <div class="modal fade changing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
            </div>
             <form method="POST" id="changeform" name="changeform" action="<?php echo base_url();?>admin/changepassword" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label>Old Password  <span class="required red">*</span></label>    
                  <input type="password" name="choldpass" id="choldpass" class="form-control"/>
                   <label for="choldpass" class="error" id="error" style="display:none"></label>
                   </div>
                  <ul></ul>
                   <div class="form-group">
                <label>New Password <span class="required red">*</span></label>    
                    <input type="hidden" name="id" id="id" value="<?php echo @$this->session->userdata['admin_id']; ?>" class="form-control" />  
                   <input type="password" name="chpass" id="chpass" class="form-control" autocomplete="off" tabindex="1"/>
                  
                   <label for="editname" class="error" id="error" style="display:none"></label>
                   </div>
                <ul></ul> 
                <div class="form-group">
                <label>Confirm Password <span class="required red">*</span></label>    
                  <input type="password" name="chconpass" id="chconpass" class="form-control"/>
                   <label for="chconpass" class="error" id="error" style="display:none"></label>
                   </div>
                  <ul></ul>
                   </div>
            </div>  
            <div class="clearfix"></div>     
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
             </form>
        </div>
    </div>
</div>
<script type="text/javascript" >
$(document).ready(function () {
  $('#changeform').validate({
    rules: {
      choldpass: {
        required:true,
       },
       chpass: {
        required:true,
         },
        chconpass: {
        required:true,
         equalTo:'#chpass',
         },
    },
    messages: {
       choldpass: {
        required:"Please enter a old password",
       },
       chpass: {
        required:"Please enter a password",
        },
        chconpass: {
        required:"Please enter a confirm password",
        equalTo:"Did not match password",
        },
    }
  });
  
});
</script>-->