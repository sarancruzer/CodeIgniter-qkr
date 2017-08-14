<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>

<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<div class="container">
  <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="ed-profi">
                  <p><a href="#">My QuickR </a> > <a href="#">Saved advice</a></p>                                  
                </div>
           </div>                  
    </div>  
</div>

<!-- main content container -->
<div class="container">
  <div class="row prof-info">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <?php if($this->session->flashdata('Success') != '') { ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
            <div role="alert" class="alert alert-success alert-dismissible fade in">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
              <?php echo $this->session->flashdata('Success');?> 
             </div>
          </div>
        </div>
      <?php } ?>
      <?php if($this->session->flashdata('Failure') != '') { ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert-section">
            <div role="alert" class="alert alert-danger alert-dismissible fade in">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
              <?php echo $this->session->flashdata('Failure');?> 
             </div>
          </div>
        </div>
      <?php } ?>
      <div class="sa-header">
        <h1>Saved Advice</h1>
      </div> 
      <div class="sa-lst">
        <?php if(!empty($questions)){ 
            foreach($questions as $quest) {
          ?>
              <ul>
                <li style="position:relative;">
                  <h3><a href="<?php echo site_url('my_quickr/legal_answers/'.$quest['id']);?>"><?php echo $quest['subject'];?></a></h3>
                  <p>Asked in <?php echo $quest['location'];?>, <?php echo $this->my_quickr_model->time_cal(strtotime($quest['submitted_date']));?>.</p>
                  <div class="sa-rmv-lnk">
                    <button class="btn" type="button" onclick="window.location = '<?php echo site_url('my_quickr/remove_advice/'.$quest['sid']);?>';">Remove</button>
                   <!--  <a class="btn" href="<?php echo site_url('my_quickr/remove_advice/'.$quest['sid']);?>" id="remove_quest" data-savedid = "<?php echo $quest['sid'];?>">Remove</a> -->
                  </div>                             
                </li> 
              </ul>
        <?php } } else {
            ?>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ans-quest-txt">
                  <p class="post_info">You have no saved advice.</p>
                  <p class="post_info">Get free financial advice from Quickr's knowledgebase. </p>
                  <a class="btn-warning" href="<?php echo site_url('free-financial-adive');?>">Find financial information</a>
                </div>
              </div>
            </div>
            <?php } ?>
      </div>
    </div> <!-- left column end -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <?php if($user['is_fa'] == 1) {?>
      <div class="sa-rgt">
        <h1>Your quickr contributions</h1>
        <p><span><img src="images/leaf-pic.jpg"></span>Contributor level 1</p>
        <p>0 answers, 0 legal guides</p>
        <ul>
          <li><a href="#">Publish a video legal guide</a></li>
          <li><a href="#">Publish a video legal guide</a></li>                        
        </ul>
        <div class=""><button class="btn" type="button">View all my guides</button></div> 
      </div> 
      <?php } else if($user['is_fa'] == 0) {?>
      <div class="sa-rgt">
        <h1>Ask a Question</h1>
        <p>Ask free answers from experienced financial advicers </p>
        <a class="btn btn-warning" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a question</a>
      </div>
      <?php } ?>
                
      <div class="rlf-info">
        <h1>Related Information</h1>
          <?php
          foreach ($recent_questions as $recent) {
           ?>
           <div class="ri-inner">
              <p><a href="<?php echo site_url('legal-answer/'.$recent['id']);?>"><?php echo $recent['subject'];?></a></p>
              <p>Asked in <?php echo $recent['location'];?> | <?php echo $recent['total_answers'];?> adviser answers</p>  
           </div> 
           <?php
          }
          ?>           
      </div>
                              
    </div> <!-- side bar end -->
  </div> <!-- Main row end -->
  
</div>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
