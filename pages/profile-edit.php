<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<div class="clearfix"></div>

<!-- main content container -->

<section class="">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 three-box">         
        <div class="ed-profi">
          <p><a href="#">My QuickR </a> > <a href="<?php echo base_url() ?>profile/edit">Edit Profile</a></p> 
          <h1><?php echo ucwords($name) ?></h1>
          <?php if($fa_info[0]['alternate_name1'] != '') { 
             $alt_name = $fa_info[0]['alternate_name1']; 
             if($fa_info[0]['alternate_name2'] != '') { $alt_name .= ', '.$fa_info[0]['alternate_name2']; } ?>
             <p><a href="#" id="add_alternate">Also known as <?php echo $alt_name ?> <i id="alt_edit" class="fa fa-pencil"></i></a></p>
          <?php } else { ?> 
             <p><a href="#" id="add_alternate">Add alternate names</a></p>
          <?php } ?> 
        </div>

        <form id="alternate_name_form">
          <div class="form-group">
            <label>Alternate name <span class="required">*</span></label>
            <div class="field name1"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Alternate name" name="name1"<?php if($fa_info[0]['alternate_name1'] != '') echo ' value="'.$fa_info[0]['alternate_name1'].'"' ?>>
            </div>
          </div>
          <div class="form-group">
            <label>Alternate name <span class="required">*</span></label>
            <div class="field name2"> 
              <div class="error"></div>
              <input type="text" class="form-control" placeholder="Alternate name" name="name2"<?php if($fa_info[0]['alternate_name2'] != '') echo ' value="'.$fa_info[0]['alternate_name2'].'"' ?>>
            </div>
          </div>
          <button type="button" class="btn btn-primary alt_btn">Submit</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          <p>You can add up to two alternate names (e.g., a nickname or maiden name) to help clients find you. </p>
        </form>  
      </div>                  
    </div>  
  </div>
<script>
  $('#add_alternate').click(function(){ $(this).hide('fast'); $('#alternate_name_form').show('fast'); });
  $('#alternate_name_form .cancel').click(function(){ $('#add_alternate').show('fast'); $('#alternate_name_form').hide('fast'); });
  $('#alternate_name_form .alt_btn').click(function(){ 
    $.ajax({ type:'POST', dataType:'JSON', data: { name1:$('#alternate_name_form input[name=name1]').val(),name2:$('#alternate_name_form input[name=name2]').val() }, url: '<?php echo base_url().'profile/alternate_names'; ?>', success: function(res){ if(res.is_valid == true){ $('#alternate_name_form input[name=name1]').val(res.names.name1); $('#alternate_name_form input[name=name2]').val(res.names.name2); $('#add_alternate').show('fast'); $('#alternate_name_form').hide('fast'); $('#add_alternate').html('Also known as '+$('#alternate_name_form input[name=name1]').val()+', '+$('#alternate_name_form input[name=name2]').val()+' <i id="alt_edit" class="fa fa-pencil">'); } else { $.each(res.errors, function(fld, err){ $('.'+fld).addClass('field-error'); $('.'+fld+' .error').html(err); }); } } });
  });
</script>
</section>

  <div class="container">
    <div class="row prof-info">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">                              
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#edit_profile" aria-controls="home" role="tab" data-toggle="tab">Edit my profile</a></li>                  <li role="presentation"><a href="#view_profile" aria-controls="profile" role="tab" data-toggle="tab">View my profile</a></li>             
        </ul>
      <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="edit_profile">
            <div class="ep-tab">
              <div class="prof-pic"><img src="<?php if($fa_info[0]['profile_photo'] != '') { echo base_url().'uploads/profiles/'.$fa_info[0]['profile_photo'];  } else { echo base_url().'src/images/ed-pro-pic.jpg'; } ?>">
                <a href="<?php echo base_url().'profile/headshot' ?>">Upload Photo</a>
              </div>
              <div class="pf-rating"><img src="<?php echo base_url() ?>src/images/logo-rating.png">
                <p><a href="#">What is the QuickR Rating ?</a></p>
              </div>                            
              <div class="nt-rated">
                <p><img src="<?php echo base_url() ?>src/images/not-appli.jpg"></p>
                <p><img src="<?php echo base_url() ?>src/images/ld-bar.jpg"></p>
                <p>Not Rated</p>
              </div>
              <div class="clnt-rview">
                <div class="crtop">
                  <div class="crt-lft"><img src="<?php echo base_url() ?>src/images/man-icon.jpg"></div>
                  <div class="crt-rgt">
                    <p>Client Reviews</p>
                    <p>No reviews yet</p>
                    <p><a href="#">Request client reviews</a></p>
                  </div>
                </div>
                <div class="crbottom">
                <div class="crb-lft"><img src="<?php echo base_url() ?>src/images/leaf-icon.jpg"></div>
                <p><a href="#">Earn Contribution Points</a></p>
                <div class="crb-rgt">                                    	
                  <p>No reviews yet</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="view_profile">fgdfsfsdafsdfasdfasdfsdafsdafsda</div>                    
      </div> 
      <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      </script>	
      <div class="overview">
        <h1>Over View</h1>
      </div> 


<section class="form-flow">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 three-box">         
        <h3>Practice Areas </h3>
          <div>
                     <div id="piechart" style="width: 300px; height: 200px;"></div>
                     <p>Not accepting clients ?</p>
                     <p><a href="<?php base_url() ?>practice_areas">Edit your practice areas</a></p>
          </div>
      </div>
    </div>
  </div>   
</section>


<section class="form-flow">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 three-box">
        <h3>Fees &amp; payment types <span class="pull-right"><a href="#" class="btn btn-default btn-xs" id="add_payment">Select payment types</a> <a href="#" class="btn btn-default btn-xs" id="add_fee">Add fee type</a></span></h3>
        <div id="fee">
        <label>Fees</label>
        <p>None</p>
        </div>
        <form id="fee_form">
          <div class="form-group">
            <label for="">Fees <span>*Required</span></label>
            <p class="help-block">Add a billing type</p>
            <select class="form-control">
              <option value="0">Select </option>
              <?php foreach($fee_types as $fee_type) { ?>   
              <option value="<?php echo $fee_type['id'] ?>"><?php echo $fee_type['type'] ?></option>
              <?php } ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
        </form>
        <div id="payment">
        <label>Payment</label>
        <p>None</p>
        </div>
        <form id="payment_form">
          <div class="form-group">
            <label for="case">Payment Types</label>
            <?php foreach($payment_types as $payment_type) { ?>   
            <div class="checkbox"><label><input type="checkbox" value="<?php echo $payment_type['id'] ?>"><?php echo $payment_type['type'] ?></label></div>
            <?php } ?> 
          </div>
         
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
        </form>
        
        <h3>About Me<span class="pull-right"><a href="#" class="btn btn-default btn-xs">Add</a> </span></h3>
        <div class="alert alert-info">
        <strong>In leo lectus, luctus vel mi</strong><br> a, lacinia suscipit nisi. Praesent malesuada mi sed tincidunt dignissim. Vestibulum risus velit, maximus eget egestas vel, facilisis euismod urna.<br>
        <a href="<?php echo base_url() ?>profile/aboutme" class="btn btn-primary btn-xs">Add videos, Photos &amp; personal Message</a>
        </div>
      </div>
    </div>
  </div>
<script>
  $('#add_fee').click(function(e){ e.preventDefault(); $('#fee').hide(); $('#fee_form').show(); });
  $('#add_payment').click(function(e){ e.preventDefault(); $('#payment').hide(); $('#payment_form').show(); });
  $('#fee_form .cancel').click(function(){ $('#fee').show(); $('#fee_form').hide(); });
  $('#payment_form .cancel').click(function(){ $('#payment').show(); $('#payment_form').hide(); });
</script>
</section>


<section class="form-flow">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 three-box">
        <h3>Languages Spoken <span class="pull-right"><a class="btn btn-default btn-xs" id="add_language">Add</a></span></h3>
        <?php if(count($languages_spoken)) { ?>
        <div id="languages">
        <?php foreach($languages_spoken as $row) { ?>
        <p><?php echo $row['language'] ?> <i class="fa fa-trash"></i></p>
        <?php } ?> 
        </div>
        <?php } ?>
        <?php if(!count($languages_spoken)) { ?>
        <form id="language_form">
        <?php } else { ?>
        <form id="language_form" style="display:none">
        <?php } ?>        
          <div class="form-group">
            <label for="">Language <span>*Required</span></label>
            <select class="form-control">
              <option value="0">Select </option>
              <?php foreach($languages as $row) { ?>   
              <option value="<?php echo $row['id'] ?>"><?php echo $row['language'] ?></option>
              <?php } ?>
            </select>
          </div>
        <?php if(!count($languages_spoken)) { ?>
          <div style="display:none" id="language_buttons">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          </div>
          <script>$('#language_form select').focus(function(){ $('#language_buttons').show(); }); </script>
        <?php } else { ?>
          <div id="language_buttons">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default cancel">Cancel</button>
          </div>
        <?php } ?>
         
        </form>
      </div>
    </div>
  </div>
<script>
  $('#add_language').click(function(e){ e.preventDefault(); $('#languages').hide(); $('#language_form').show(); $('#language_buttons').show(); });
  $('#language_form .cancel').click(function(){ if($('#languages p').length == 0) { $('#language_buttons').hide(); } else { $('#languages').show(); $('#language_form').hide(); } });
</script>
</section>
                  
<section class="form-flow">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 three-box">
        <h3>Peer Endorsements<span class="pull-right"><a href="#" class="btn btn-default btn-xs">Request</a> </span></h3>
         <div class="alert alert-info">
        <strong>In leo lectus, luctus vel mi</strong><br> a, lacinia suscipit nisi. Praesent malesuada mi sed tincidunt dignissim. Vestibulum risus velit, maximus eget egestas vel, facilisis euismod urna.<br>
        <a href="<?php echo base_url() ?>profile/aboutme" class="btn btn-primary btn-xs">Request a peer endorsement</a>
        </div>

      </div>
    </div>
  </div>
</section>


<section class="form-flow">
  <div class="container">
    <div class="row" id="licenses">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flow-box">
        <h3>License<span class="pull-right"><a class="btn btn-default btn-xs" id="add_license">Add</a></span></h3>          
          <?php if(count($licenses)) { ?>
          <div id="license_list">
          <?php include 'license-table.php' ?>
          </div>
          <div id="license_form" style="display:none">  
<?php include 'license-form.php' ?>  
          </div>
          <?php } else { ?>
          <div id="license_list"></div>
          <div id="license_form">            
<?php include 'license-form.php' ?>  
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
<script>
$(document).on('focus','.license_form select', function(){  $(this).closest('.license_form').find('.license_fields').show('fast'); });
$(document).on('click','.license_form .cancel', function(){ $('#license_table').show(); if($('#license_table').length) { $('#license_form').hide(); } else { $(this).closest('.license_form').find('.license_fields').hide('fast'); } });
$(document).on('click','.license_form .license_btn', function(e){  $(this).closest('form').find('.field').removeClass('field-error'); e.preventDefault(); var data = $(this).closest('form').serialize();
  $.ajax({ type:'POST', dataType:'JSON', data: data, url: '<?php echo base_url().'profile/licenses'; ?>', success: function(res){ if(res.is_valid == true){ $('#license_list').html(res.html); $('#license_form').html(''); } else { $.each(res.errors, function(fld, err){ $('.'+fld).addClass('field-error'); $('.'+fld+' .error').html(err); }); } } });
});

$(document).on('click','#licenses #add_license', function(){ $('#license_form').show(); $('#license_table').hide();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/licenses'; ?>', success: function(res){ $('#license_form').html(res.html);$('#license_form form select').focus(); } });
});
$(document).on('click','#licenses #license_edit', function(){ $('#license_form').show(); $('#license_table').hide(); var id = $(this).closest('td').find('input[type=hidden]').val();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/licenses/edit/'; ?>'+id, success: function(res){ $('#license_form').html(res.html);$('#license_form form select').focus(); } });
});
</script>
</section>                  

<section class="form-flow">
  <div class="container">
    <div class="row" id="experiences">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flow-box">
        <h3>Work Experience<span class="pull-right"><a class="btn btn-default btn-xs" id="add_experience">Add</a></span></h3>          
          <?php if(count($experiences)) { ?>
          <div id="experience_list">
          <?php include 'experience-table.php' ?>
          </div>
          <div id="experience_form" style="display:none">  
<?php include 'experience-form.php' ?>  
          </div>
          <?php } else { ?>
          <div id="experience_list"></div>
          <div id="experience_form">            
<?php include 'experience-form.php' ?>  
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
<script>
$(document).on('focus','.experience_form input[name=title]', function(){  $(this).closest('.experience_form').find('.experience_fields').show('fast'); });
$(document).on('click','.experience_form .cancel', function(){ $('#experience_table').show(); if($('#experience_table').length) { $('#experience_form').hide(); } else { $(this).closest('.experience_form').find('.experience_fields').hide('fast'); } });
$(document).on('click','.experience_form .experience_btn', function(e){  $(this).closest('form').find('.field').removeClass('field-error'); e.preventDefault(); var data = $(this).closest('form').serialize();
  $.ajax({ type:'POST', dataType:'JSON', data: data, url: '<?php echo base_url().'profile/experiences'; ?>', success: function(res){ if(res.is_valid == true){ $('#experience_list').html(res.html); $('#experience_form').html(''); } else { $.each(res.errors, function(fld, err){ $('.'+fld).addClass('field-error'); $('.'+fld+' .error').html(err); }); } } });
});

$(document).on('click','#experiences #add_experience', function(){ $('#experience_form').show(); $('#experience_table').hide();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/experiences'; ?>', success: function(res){ $('#experience_form').html(res.html);$('#experience_form form input[name=title]').focus(); } });
});
$(document).on('click','#experiences #experience_edit', function(){ $('#experience_form').show(); $('#experience_table').hide(); var id = $(this).closest('td').find('input[type=hidden]').val();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/experiences/edit/'; ?>'+id, success: function(res){ $('#experience_form').html(res.html); $('#experience_form form input[name=title]').focus(); } });
});
</script>
</section>                  


<section class="form-flow">
  <div class="container">
    <div class="row" id="educations">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flow-box">
        <h3>Education<span class="pull-right"><a class="btn btn-default btn-xs" id="add_edu">Add</a></span></h3>          
          <?php if(count($educations)) { ?>
          <div id="edu_list">
          <?php include 'education-table.php' ?>
          </div>
          <div id="edu_form" style="display:none">  
<?php include 'education-form.php' ?>  
          </div>
          <?php } else { ?>
          <div id="edu_list"></div>
          <div id="edu_form">            
<?php include 'education-form.php' ?>  
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
<script>
$(document).on('focus','.education_form input[name=university]', function(){  $(this).closest('.education_form').find('.education_fields').show('fast'); });
$(document).on('click','.education_form .cancel', function(){ $('#edu_table').show(); if($('#edu_table').length) { $('#edu_form').hide(); } else { $(this).closest('.education_form').find('.education_fields').hide('fast'); } });
$(document).on('click','.education_form .edu_btn', function(e){  $(this).closest('form').find('.field').removeClass('field-error'); e.preventDefault(); var data = $(this).closest('form').serialize();
  $.ajax({ type:'POST', dataType:'JSON', data: data, url: '<?php echo base_url().'profile/educations'; ?>', success: function(res){ if(res.is_valid == true){ $('#edu_list').html(res.html); $('#edu_form').html(''); } else { $.each(res.errors, function(fld, err){ $('.'+fld).addClass('field-error'); $('.'+fld+' .error').html(err); }); } } });
});

$(document).on('click','#educations #add_edu', function(){ $('#edu_form').show(); $('#edu_table').hide();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/educations'; ?>', success: function(res){ $('#edu_form').html(res.html);$('#edu_form form input[name=university]').focus(); } });
});
$(document).on('click','#educations #edu_edit', function(){ $('#edu_form').show(); $('#edu_table').hide(); var id = $(this).closest('td').find('input[type=hidden]').val();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/educations/edit/'; ?>'+id, success: function(res){ $('#edu_form').html(res.html);$('#edu_form form input[name=university]').focus(); } });
});
</script>
</section>                  
                 


<section class="form-flow">
  <div class="container">
    <div class="row" id="awards">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flow-box">
        <h3>Awards<span class="pull-right"><a class="btn btn-default btn-xs" id="add_award">Add</a></span></h3>          
          <?php if(count($awards)) { ?>
          <div id="award_list">
          <?php include 'award-table.php' ?>
          </div>
          <div id="award_form" style="display:none">  
<?php include 'award-form.php' ?>  
          </div>
          <?php } else { ?>
          <div id="award_list"></div>
          <div id="award_form">            
<?php include 'award-form.php' ?>  
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
<script>
$(document).on('focus','.award_form input[name=award_name]', function(){ $(this).closest('.award_form').find('.award_fields').show('fast'); });
$(document).on('click','.award_form .cancel', function(){ $('#award_table').show(); if($('#award_table').length) { $('#award_form').hide(); } else { $(this).closest('.award_form').find('.award_fields').hide('fast'); } });
$(document).on('click','.award_form .award_btn', function(e){  $(this).closest('form').find('.field').removeClass('field-error'); e.preventDefault(); var data = $(this).closest('form').serialize();
  $.ajax({ type:'POST', dataType:'JSON', data: data, url: '<?php echo base_url().'profile/awards'; ?>', success: function(res){ if(res.is_valid == true){ $('#award_list').html(res.html); $('#award_form').html(''); } else { $.each(res.errors, function(fld, err){ $('.'+fld).addClass('field-error'); $('.'+fld+' .error').html(err); }); } } });
});

$(document).on('click','#awards #add_award', function(){ $('#award_form').show(); $('#award_table').hide();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/awards'; ?>', success: function(res){ $('#award_form').html(res.html);$('#award_form form input[name=award_name]').focus(); } });
});
$(document).on('click','#awards #award_edit', function(){ $('#award_form').show(); $('#award_table').hide(); var id = $(this).closest('td').find('input[type=hidden]').val();
  $.ajax({ type:'GET', dataType:'JSON', url: '<?php echo base_url().'profile/awards/edit/'; ?>'+id, success: function(res){ $('#award_form').html(res.html);$('#award_form form input[name=award_name]').focus(); } });
});
</script>
</section>                  




                  
                                                
           		</div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         		<div class="prof-complet">
                	<div style="background:#999; border-radius:5px; padding:15px;">sdfsadfsafsafsdfa</div>
                    <p><a href="#">Add a Headshot </a>to make your profile 19% complete</p>
                    <div class="pc-check-contain">
                        <form>
                        	<ul>
                            	<li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>
                                <li><input type="checkbox" name="vehicle" value="Bike"> <span> I Remember me</span></li>                               
                            </ul>               
                        </form>
                    </div>     
                </div>                
           </div>       
    </div>  
</div>

<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>
