<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo @$title;?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                       <!-- <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentellela Alela!</span></a>-->
                        <a href="<?php echo base_url();?>admin/dashboard" class="site_title"><?php if($this->session->userdata['shortlogo']!='') {  ?><img src="<?php echo base_url();?>uploads/baseinfo/<?php echo $this->session->userdata['shortlogo']; ?>"><?php } if($this->session->userdata['companyname']!='') {  ?><span><?php echo $this->session->userdata['companyname']; ?></span><?php }?></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo base_url();?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php if($this->session->userdata['username']!='') {  echo ucfirst(@$this->session->userdata['username']); }?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <?php $this->load->view('admin/common/sidemenu');?>

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                       <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>-->
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <?php $this->load->view('admin/common/topnavigation')?>

           <?php  $this->load->view($page);?>
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo base_url();?>assets/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo base_url();?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url();?>assets/js/icheck/icheck.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/custom.js"></script>
     <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/additional-methods.js"></script>
    <!-- moris js 
    <script src="<?php echo base_url();?>assets/js/moris/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/js/moris/morris.js"></script>
    <script src="<?php echo base_url();?>assets/js/moris/example.js"></script>
    -->

</body>

</html>
<style type="text/css">
label.error {
    color: #FF0000 !important;
    font-weight: lighter !important;
    padding: 2px 0;
}
</style>