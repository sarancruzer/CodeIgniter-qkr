<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript" src="<?php echo base_url();?>src/js/jRate.min.js"></script>
<script type="text/javascript">
    $(function () {
      var array = ['','Poor','Fair','Average','Good','Excellent'];
      var overall = $("#jRate").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
                endColor: "#FE9A23",
        width: 15,
        height: 15,
        shapeGap: '5px',
        precision: 1,
        onChange: function(rating) {
          $("#overall_rating").val(rating);
          $("#jrate_tip").text(array[rating]);
        },
        onSet: function(rating) {
          $("#overall_rating").val(rating);
          $("#jrate_tip").text(array[rating]);
          if(rating != 0)
            $("#overall_rating-error").hide();
        }
      });
      var trustworthy = $("#jtrust").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
                endColor: "#FE9A23",
        width: 15,
        height: 15,
        shapeGap: '5px',
        precision: 1,
        shape:'CIRCLE',
        onChange: function(rating) {
          $("#trust_rating").val(rating);
          $("#jtrust_tip").text(array[rating]);
        },
        onSet: function(rating) {
          $("#trust_rating").val(rating);
          $("#jtrust_tip").text(array[rating]);
        }
      });
      var responsive = $("#jresponse").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
                endColor: "#FE9A23",
        width: 15,
        height: 15,
        shapeGap: '5px',
        precision: 1,
        shape:'CIRCLE',
        onChange: function(rating) {
          $("#response_rating").val(rating);
          $("#jresponse_tip").text(array[rating]);
        },
        onSet: function(rating) {
          $("#response_rating").val(rating);
          $("#jresponse_tip").text(array[rating]);
        }
      });
      var knowledge = $("#jknowledge").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
                endColor: "#FE9A23",
        width: 15,
        height: 15,
        shapeGap: '5px',
        precision: 1,
        shape:'CIRCLE',
        onChange: function(rating) {
          $("#knowledge_rating").val(rating);
          $("#jknowledge_tip").text(array[rating]);
        },
        onSet: function(rating) {
          $("#knowledge_rating").val(rating);
          $("#jknowledge_tip").text(array[rating]);
        }
      });
      var responsive = $("#jinformed").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
                endColor: "#FE9A23",
        width: 15,
        height: 15,
        shapeGap: '5px',
        precision: 1,
        shape:'CIRCLE',
        onChange: function(rating) {
          $("#informed_rating").val(rating);
          $("#jinformed_tip").text(array[rating]);
        },
        onSet: function(rating) {
          $("#informed_rating").val(rating);
          $("#jinformed_tip").text(array[rating]);
        }
      });
      
      
        //toolitup.setRating(3);        
  
 });
$(document).ready(function(){
   $.validator.addMethod("notEqualTozero", function(value,element) {
    console.log(value);
    if(value === '0')
      return false;
    else
      return true;
     }, "This field is required");

         $("#review").validate({
          ignore: [],
          rules :{
              'overall_rating':{required:true,notEqualTozero:true},
              'review_title':{required:true},
              'review_body':{required:true}
              
          }
    });

    $('#review_body').keyup(function() {
        var max_length = $(this).attr('data-maxlength');
        var text_length = $(this).val().length;
        var text_remaining = max_length - text_length;
        var counter_id = $(this).attr('data-counter-id');
        if(text_remaining < 0)
        {
            this.value = this.value.substring(0, max_length);
            $('#'+counter_id).text(0);
            return false;
        }
        $('#'+counter_id).text(text_remaining);
    });

    $('input:radio[name="review_anonymous"]').change(
    function(){
        if (this.checked && this.value == '1') {
            $("#display_name_block").hide();
        }
        else{
          $("#display_name_block").show();
        }
    });

});
  </script>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<!-- main content container -->


<section class="sec-tp">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="#">Review a Lawyer</a></li>      
          <li><a href="#"><?php echo $this->my_quickr_model->get_name_by_id($adviser_id);?></a></li>
          <li><a href="#">Client Reviews</a></li>                    
          <li class="active">A Write a Review</li>
        </ol>
      </div>
    </div>
  </div>
</section>



<div class="container">
	<div class="row">
           <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">                              
                <div class="reviw-page-header">
                	<h1>Review <?php echo ucwords($this->my_quickr_model->get_name_by_id($adviser_id));?></h1>
                </div>   
                <form method="post" action="<?php echo site_url('my_quickr/save_review');?>" class="new_review" id="review" name="review">             
                <div class="rating-lst">
                	<ul>
                    	<li><p>
                        <span class="rate-lft">
                        <strong>Overall rating</strong> 
                        </span>
                        <span class="rate-right" id="jRate" style="height:50px;width: 200px;"></span>
                        <input type="hidden" value="" class="form_control" name="overall_rating" id="overall_rating">
                       <span id="jrate_tip"></span>
                      </p></li> 
                      <li><p>
                        <span class="rate-lft">Trustworthy</span>
                        <span class="rate-right" id="jtrust" style="height:50px;width: 200px;"></span>
                        <input type="hidden" value="" name="trust_rating" id="trust_rating">
                        <span id="jtrust_tip"></span>
                      </p></li> 
                      <li><p>
                        <span class="rate-lft">Responsive</span>
                        <span class="rate-right" id="jresponse" style="height:50px;width: 200px;"></span>
                        <input type="hidden" value="" name="response_rating" id="response_rating">
                        <span id="jresponse_tip"></span>
                      </p></li> 
                      <li><p>
                        <span class="rate-lft">Knowledgeable</span>
                        <span class="rate-right" id="jknowledge" style="height:50px;width: 200px;"></span>
                        <input type="hidden" value="" name="knowledge_rating" id="knowledge_rating">
                        <span id="jknowledge_tip"></span>
                      </p></li> 
                      <li><p>
                        <span class="rate-lft">Kept me informed </span>
                        <span class="rate-right" id="jinformed" style="height:50px;width: 200px;"></span>
                        <input type="hidden" value="" name="informed_rating" id="informed_rating">
                        <span id="jinformed_tip"></span>
                      </p></li>             
                    </ul>                	
                </div>  
                
                
                <div class="enter-title">
                <p>Enter a title for your review </p>             
                  <input type="text" name="review_title" id="review_title" width="250px" value="" placeholder="">              
                </div>
                
                
                <div class="enter-reviw">
                <p>Enter your review       
                <span class="help-block pull-right">(<span id="review_counter">4000</span> Characters Remaining)</span></p>        
               <textarea id="review_body" name="review_body" rows="5" data-maxlength="4000" data-counter-id="review_counter" placeholder=""></textarea>
              
                </div>
                
               <div class="recomend-lawyer">
               <p>Would you recommend this lawyer ? </p>
               	<label class="radio-inline">
                <input type="radio" checked="checked" value="1" id="review_recommended_true" name="review_recommended"> Yes
              </label>
              <label class="radio-inline">
                <input type="radio" value="0" id="review_recommended_false" name="review_recommended"> No
              </label>

               </div> 
               
               
               <div class="recomend-lawyer">              
               	<label class="radio-inline">
                <input type="radio" checked="checked" value="0" id="review_anonymous_false" name="review_anonymous"> Show your first name
              </label>
              <label class="radio-inline">
                <input type="radio" value="1" id="review_anonymous_true" name="review_anonymous"> Post your review anonymously
              </label>

               </div>
               
               
               
               <div class="ur-frst-name" id="display_name_block">
                <div class="form-group">
                  <label for="exampleInputEmail1">Your first name</label>
                  <input type="text" class="form-control" id="review_display_name" name="review_display_name" value="<?php echo ucfirst($display_name);?>">
                </div>
               </div>
                <div class="form-group">
                <input type="hidden" id="adviser_id" name="adviser_id" value="<?php echo $adviser_id;?>" class="hidden">
                <input type="hidden" id="client_id" name="client_id" value="<?php echo $user_id;?>" class="hidden">
                <input type="hidden" id="client_email" name="client_email" value="<?php echo $user_email;?>" class="hidden">
                <input type="submit" class="btn btn-primary" value="Submit" name="commit">
                </div>
                 <p>Sed tempus tincidunt purus nec dignissim. Maecenas mattis at eros sed tincidunt. Sed tempus tincidunt purus nec dignissim. Maecenas mattis at eros sed tincidunt. Sed tempus tincidunt purus nec dignissim. Maecenas mattis at eros sed tincidunt. </p>
               
                </form> 
                                                
           		</div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         		<div class="reviw-page-rgt">
                	<h1>Quickr Profile You Are Reviewing</h1>
                    <div class="prof-reviwing">
                  	<div class="pr-lft"><img src="images/reviewpage-pro-pic.jpg"></div>
                    <div class="pr-rgt">
                    	<p><?php echo ucwords($this->my_quickr_model->get_name_by_id($adviser_id));?></p>
                        <p>Test</p>
                        <p>Test, AL 45435</p>
                        <p>Licensed for 16 years</p>
                    </div>
                    
                    </div>
                    
                      <a class="btn btn-primary" href="#">Go back to <?php echo ucwords($this->my_quickr_model->get_by_id('users','firstname',$adviser_id));?>'s profile</a>
                  
                </div> 
                
                <div class="reviw-page-guidelines">
                	
                <h1>Review Guidelines</h1>
                 
                <ul>
                	<li><p><strong>Sed tempus tincidunt</strong> purus nec dignissim. Maecenas mattis at eros sed tincidunt. </p> </li>
                    <li><p><strong>Sed tempus tincidunt</strong> purus nec dignissim. Maecenas mattis at eros sed tincidunt. </p> </li>
                    <li><p><strong>Sed tempus tincidunt</strong> purus nec dignissim. Maecenas mattis at eros sed tincidunt.</p> </li>
                   
                
                </ul>
                <a class="btn btn-primary" href="#">Read more about community guidelines</a>
                
                
                             
                </div>
                              
           </div>       
    </div>  
</div>
<!-- main content container -->