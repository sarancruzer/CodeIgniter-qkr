<div role="main" class="right_col">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Master Financial Adviser</h3>
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
                                    <h2>Master Financial Adviser</h2>
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
                               <?php if(in_array("10",explode(",",$this->session->userdata['permissionid']))){?>
                               <div class="row pull-right">
                               <a class="btn btn-dark" href="<?php echo base_url();?>admin/addlawyer" type="button" style="margin-right:15px;">Add Financial Adviser</a>
                               </div>
                               <?php } ?>
                                <div class="row">
                                    <form action="<?php echo base_url();?>admin/masterlawyers" method="GET">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-lg-offset-6 ">
                                   
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(($stat!='')&& ($stat==1)){ echo "selected='selected'";}?>>Active</option>
                                                    <option value="0" <?php if(($stat!='')&& ($stat==0)){ echo "selected='selected'";}?>>Inactive</option>
                                                </select>
                                                </div>
                                 
                                 <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
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
                                                <th class="column-title">Name </th>
                                                <th class="column-title">Email </th>
                                                <th class="column-title">Company Name </th>
                                                <th class="column-title">Office Phone Number </th>
                                                <th class="column-title">Status </th>
                                                <th width="150px" class="column-title">Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($masterlawyers)) {
                                foreach ($masterlawyers as $lawyers) {
                                   ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo ++$offset;?></td>
                                                <td class=" "><?php echo $lawyers['firstname']." ".$lawyers['lastname'];?></td>
                                                <td class=" "><?php echo $lawyers['email'];?></td>
                                                <td class=" "><?php echo $lawyers['company_name'];?></td>
                                                <td class=" "><?php echo $lawyers['phone_no_office'];?></td>
                                                <td class=" "><?php if($lawyers['is_active']==1){ echo "Active";} else { echo "Inactive";} ?></td>
                                                <td class=" last">
                                                <a  href="<?php echo base_url();?>admin/editlawyer?edit=<?php echo $lawyers['id'];?>" class="btn btn-primary edit">Edit</a>                              
                                                <a data-row-id="<?php echo $lawyers['id'];?>" data-target=".deleting" data-toggle="modal" class="btn btn-danger btn-sm delete" href="#">Delete</a>
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


<div class="modal fade deleting" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Delete Financial Adviser</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletmasterlaw?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this financial adviser</h5>
            <input type="hidden" name="deleteid" id="deleteid" class="form-control" />  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" style="margin-top:-4px;">Ok</button>
        </div>

    </div>
</div>
</div>
<script>
    $(document).ready(function() {
$(".delete").on('click', function(){
         var id = $(this).data('row-id');
         $('#deleteid').val(id);
     });

    $('.deleting').on('hidden.bs.modal', function () {
        $('#deleteid').val('');
    });
    });
   

</script>
<!--
<style type="text/css">
  @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

  
  table, thead, tbody, th, td, tr { 
    display: block; 
  }
  
  
  thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  
  
  
  td { 
  
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    word-wrap:break-word;
  }
  
  td:before { 
   
    position: absolute;
    
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
  }
  
  
  td:nth-of-type(1):before { content: "S.No"; font-weight: bold;}
  td:nth-of-type(2):before { content: "Name"; font-weight: bold;}
  td:nth-of-type(3):before { content: "Email"; font-weight: bold;}
  td:nth-of-type(4):before { content: "Company Name"; font-weight: bold;}
  td:nth-of-type(5):before { content: "Office Phone Number"; font-weight: bold;}
  td:nth-of-type(6):before { content: "Status"; font-weight: bold;}
  td:nth-of-type(7):before { content: "Action"; font-weight: bold;}
  .table thead tr td, .table tbody tr td,{
    border-top: none;
     padding: 0px !important;
}
}
</style>-->