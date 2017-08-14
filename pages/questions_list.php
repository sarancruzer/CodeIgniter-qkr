<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>

<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>

<!-- main content container -->
<div class="container">
  <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="ed-profi">
                  <p><a href="#">My QuickR </a> > <a href="#">My Questions</a></p>                                  
                </div>
           </div>                  
    </div>  
</div>
<div class="container">
  <div class="row prof-info">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <div class="sa-header">
        <h1>My Questions</h1>
      </div>
      <div class="sa-lst">
      <?php
        if(!empty($questions)){
          foreach($questions as $quest) {?>
            <ul>
              <li style="position:relative;">
                <h3 ><a href="<?php echo site_url('legal-answer/'.$quest['id']);?>"><?php echo $quest['subject'];?></a></h3>
                <p>Asked in <?php echo $quest['location'];?>, <?php echo $this->my_quickr_model->time_cal(strtotime($quest['submitted_date']));?>.</p> 
              </li> 
            </ul>
            <?php } 
            }
            else {
            ?>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ans-quest-txt">
                  <p class="post_info">You haven't asked any questions yet.</p>
                  <p class="post_info">Get free answers from experienced lawyers. </p>
                  <a class="btn btn-warning" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a question</a>
                </div>
              </div>
            </div>
            <?php } ?> 
        </div>
    </div> <!-- left column end -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="sa-rgt">
        <h1>Ask a Question</h1>
        <p>Ask free answers from experienced financial advicers </p>
        <a class="btn btn-warning" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a question</a>
      </div> 
                
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
  </div> <!-- main row end -->  
</div>
<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->




</body>
</html>
