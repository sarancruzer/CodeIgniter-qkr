
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                      <!--  <li><a href="<?php echo base_url();?>admin/managecountry">Manage Country</a>
                                        </li>-->
                                        <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
                                        </li>
                                        <!--<li><a href="<?php echo base_url();?>admin/managepractice">Second</a>
                                        </li>-->
                                    </ul>
                                </li>
                                <?php
                                //$arr1=array_intersect(array("1","18","2","3","4","5","6","19","7","8","9"),explode(",",$this->session->userdata['permissionid']));
                                ?>
                                <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <?php if(in_array("1",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/baseinfo">Basic Information</a>
                                        </li>
                                        <?php } if(in_array("18",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/adminusers">Manage Admin Users</a>
                                        </li>
                                        <?php } if(in_array("2",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managecountry">Manage Country</a>
                                        </li>
                                        <?php } if(in_array("3",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managecounties">Manage Counties</a>
                                        </li>
                                        <?php } if(in_array("4",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managecities">Manage Cities</a>
                                        </li>
                                        <?php } if(in_array("5",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/languages">Manage Languages</a>
                                        </li>
                                        <?php } if(in_array("6",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/feetypes">Manage Fee Types</a>
                                        </li>
                                        <?php } if(in_array("19",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/paymenttypes">Manage Payment Types</a>
                                        </li>
                                        <?php } if(in_array("7",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managemails">Manage Emails</a>
                                        </li>
                                        <?php } if(in_array("8",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managepractice">Manage Practice Area</a>
                                        </li>
                                        <?php } if(in_array("9",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managetopics">Manage Topics</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php //} ?>

                                <?php //if(in_array(array("10,11,12,13,14"),explode(",",$this->session->userdata['permissionid']))){?>
                                <li><a><i class="fa fa-legal"></i> Manage Adviser <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <?php if(in_array("10",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/addlawyer">Add Financial Adviser</a>
                                        </li>
                                        <?php } if(in_array("11",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/masterlawyers">Master Financial Adviser</a>
                                        </li>
                                        <?php } if(in_array("12",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/manageregusers">Manage Registered Users</a>
                                        </li>
                                        <?php } if(in_array("13",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/manageusers">Manage Users</a>
                                        </li>
                                        <?php } if(in_array("14",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/reviews">Manage Reviews</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php //} ?>
                                <?php //if(in_array(array("15","16","17"),explode(",",$this->session->userdata['permissionid']))){?>
                                <li><a><i class="fa fa-hand-o-right"></i> Question and Answer <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                      <!--  <li><a href="<?php echo base_url();?>admin/managecountry">Manage Country</a>
                                        </li>-->
                                        <?php if(in_array("15",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/clientquestions">Manage Questions</a>
                                        </li>
                                        <?php } if(in_array("16",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/answers">Manage Answer</a>
                                        </li>
                                        <?php } if(in_array("17",explode(",",$this->session->userdata['permissionid']))){?>
                                        <li><a href="<?php echo base_url();?>admin/managetips">Manage Tips</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php //} ?>
                                </ul>
                                </div>
                          <!--  <div class="menu_section">
                            <h3>Adviser Management</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-legal"></i> Manage Adviser <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url();?>admin/addlawyer">Add Financial Adviser</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>admin/masterlawyers">Master Financial Adviser</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>admin/manageregusers">Manage Registered Users</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>admin/manageusers">Manage Users</a>
                                        </li>
                                    </ul>
                                </li>
                                <!--<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="form.html">General Form</a>
                                        </li>
                                        <li><a href="form_advanced.html">Advanced Components</a>
                                        </li>
                                        <li><a href="form_validation.html">Form Validation</a>
                                        </li>
                                        <li><a href="form_wizards.html">Form Wizard</a>
                                        </li>
                                        <li><a href="form_upload.html">Form Upload</a>
                                        </li>
                                        <li><a href="form_buttons.html">Form Buttons</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="general_elements.html">General Elements</a>
                                        </li>
                                        <li><a href="media_gallery.html">Media Gallery</a>
                                        </li>
                                        <li><a href="typography.html">Typography</a>
                                        </li>
                                        <li><a href="icons.html">Icons</a>
                                        </li>
                                        <li><a href="glyphicons.html">Glyphicons</a>
                                        </li>
                                        <li><a href="widgets.html">Widgets</a>
                                        </li>
                                        <li><a href="invoice.html">Invoice</a>
                                        </li>
                                        <li><a href="inbox.html">Inbox</a>
                                        </li>
                                        <li><a href="calender.html">Calender</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="tables.html">Tables</a>
                                        </li>
                                        <li><a href="tables_dynamic.html">Table Dynamic</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="chartjs.html">Chart JS</a>
                                        </li>
                                        <li><a href="chartjs2.html">Chart JS2</a>
                                        </li>
                                        <li><a href="morisjs.html">Moris JS</a>
                                        </li>
                                        <li><a href="echarts.html">ECharts </a>
                                        </li>
                                        <li><a href="other_charts.html">Other Charts </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>-->
                       <!-- <div class="menu_section">
                            <h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="e_commerce.html">E-commerce</a>
                                        </li>
                                        <li><a href="projects.html">Projects</a>
                                        </li>
                                        <li><a href="project_detail.html">Project Detail</a>
                                        </li>
                                        <li><a href="contacts.html">Contacts</a>
                                        </li>
                                        <li><a href="profile.html">Profile</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="page_404.html">404 Error</a>
                                        </li>
                                        <li><a href="page_500.html">500 Error</a>
                                        </li>
                                        <li><a href="plain_page.html">Plain Page</a>
                                        </li>
                                        <li><a href="login.html">Login Page</a>
                                        </li>
                                        <li><a href="pricing_tables.html">Pricing Tables</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                                </li>
                            </ul>
                        </div>-->

                    </div>
                    <!-- /sidebar menu -->