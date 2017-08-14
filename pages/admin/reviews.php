 <!-- page content -->
            <div class="right_col" role="main">
                <div class="content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage Reviews</h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="row" >
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
                                   
                                <div class="clearfix"></div>
                                
                   
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Manage Reviews</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                 
                                <div class="x_content">
                                <div class="row">
                                <form method="GET" action="<?php echo base_url();?>admin/reviews">
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 ">
                                    <div class="form-group col-lg-6 pull-right">
                                <select class="form-control" name="stat" id="stat">
                                                    <option value="">--Status--</option>
                                                    <option value="1" <?php if(isset($stat) && ($stat==1)){ echo "selected='selected'";}?>>Approved</option>
                                                    <option value="0" <?php if(isset($stat) && ($stat==0) && ($stat!='')){ echo "selected='selected'";}?>>Default</option>
                                                    <option value="-1" <?php if(isset($stat) && ($stat==-1)){ echo "selected='selected'";}?>>Deny</option>
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
                                                <th class="column-title" width="30px">S.No </th>
                                                <th class="column-title">Title</th>
                                                <th class="column-title">Review</th>
                                                <th class="column-title">Reviewed By</th>
                                                <th class="column-title">Rating</th>
                                                <th class="column-title" width="110px">Status </th>
                                                <th class="column-title" width="150px" >Action </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if(!empty($clientreviews))
                            {
                                
                                foreach ($clientreviews as $reviews) {
                                  ?>
                                            <tr class="even pointer">
                                                <td><?php echo ++$offset;?></td>
                                                <td><?php echo $reviews['title'];?></td>
                                                <td style="word-wrap: break-word"><?php echo $reviews['review'];?></td>
                                                <td><?php echo $reviews['email'];?></td>
                                                <td><?php echo $reviews['overall_rating'];?></td>
                                                <td><?php if($reviews['status']=='1'){ echo "Approved";} if($reviews['status']=='0') { echo "Default";} if($reviews['status']=='-1') { echo "Deny";}?></td>
                                                <td>
                                                <a class="btn btn-primary edit" data-toggle="modal" data-target=".editing" 
                                                data-row-id='<?php echo $reviews['id']; ?>'
                                                data-row-title='<?php echo $reviews['title']; ?>'
                                                data-row-rating='<?php echo $reviews['overall_rating']; ?>'
                                                data-row-status='<?php echo $reviews['status']; ?>'    
                                                >Edit</a>                              
                                                <a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleting"  data-row-id='<?php echo $reviews['id']; ?>'>Delete</a>
                                                </td>
                                            </tr>
                                            <?php  }  }
                                            else {?>
                                            <tr class="even pointer">
                                                <td class=" " colspan="7" >No Records Found!</td>
                                                </tr>
                                                <?php  } ?>
                                            
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
            <!-- /page content -->
<script type="text/javascript" >
$(document).ready(function () {
   $('#editform').validate({
    rules: {
      rating: {
        required:true,
        range: [1, 5],
       },
       
       status: {
        required:true,
       },
    },
    messages: {
       rating: {
        required:"Please enter a rating",
        range:"Please enter a value between 1 to 5",
       },
        status: {
        required:"Please select status",
       }
    }
  });
});
</script>

<div class="modal fade editing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Edit Review</h4>
            </div>
             <form method="POST" id="editform" name="editform" action="<?php echo base_url();?>admin/editreview?q=<?php echo @$q;?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
            <div class="modal-body">
                <div class="form-group">
                <label>Title </label>    
                    <input type="hidden" name="id" id="id" class="form-control" />  
                   <input type="text" name="title" id="title" class="form-control" autocomplete="off" tabindex="1" readonly="readonly" />
                   
                   </div>
                <br>   
                <div class="clearfix"></div>
                <div class="form-group">
                <label>Rating <span class="required red">*</span></label> 
                   <input type="text" name="rating" id="rating" class="form-control" autocomplete="off" tabindex="1" />
                   <label for="rating" class="error" id="error" style="display:none"></label>
                   </div>
                <br>   
                <div class="clearfix"></div>
                 <div class="form-group">
                 <label>Status <span class="required red">*</span></label>
                   <select name="status" id="status" class="form-control" placeholder="">
                    <option value="" selected>--Select--</option>
                    <option value="1" >Approved</option>                 
                    <option value="0">Default</option>                 
                    <option value="-1">Deny</option>               
                   </select>
                   <label for="status" class="error" id="error" style="display:none"></label>
                   </div>
                   <ul></ul>
            </div>       
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" style="margin-top:-4px;">Save</button>
            </div>
             </form>
        </div>
    </div>
</div>

<div class="modal fade deleting" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Delete Review</h4>
        </div>
        <form method="POST" action="<?php echo base_url();?>admin/deletereview?q=<?php echo @$q?>&stat=<?php echo @$stat;?>&paginate=<?php echo @$paginate?>">
        <div class="modal-body">
            <h5>Do you want to delete in this review</h5>
            <input type="hidden" name="deleteid" id="deleteid" class="form-control" />  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" style="margin-top:-4px;">Ok</button>
        </div>

    </div>
</div>
</div>
<!-- /modals -->
<script>
    $(document).ready(function() {
        $(".edit").on('click', function(){
          var validator = $( "#editform" ).validate();
          validator.resetForm();
         var id = $(this).data('row-id');
         var title = $(this).data('row-title');
         var rating = $(this).data('row-rating');
         var status = $(this).data('row-status');
              
         $('#id').val(id);
          $('#title').val(title);
           $('#rating').val(rating);
          $('[name=status] option').filter(function() {
          return ($(this).val() == status); //To select Blue
    }).prop('selected', true);
     });

    $('.editing').on('hidden.bs.modal', function () {
        $('#id').val('');
         $('#title').val('');
          $('#rating').val('');
         $('#status').val('');
    });
    $(".delete").on('click', function(){
         var id = $(this).data('row-id');
         $('#deleteid').val(id);
     });

    $('.deleting').on('hidden.bs.modal', function () {
        $('#deleteid').val('');
    });
    
});
   

</script>