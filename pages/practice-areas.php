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

<section class="sec-tp">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="#">My Profile</a></li>
          <li><a href="#">Edit Profile</a></li>
          <li class="active">Practive Areas</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="grid-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 grid-box">
        <h2>Edit your practice Area(s) <span><a href="#">Back to Profile</a></span></h2>
        <div class="clearfix"></div>
        <a id="add1" class="btn btn-info add">Add a practice area</a>
        <div class="table-responsive">
        <div class="error col-lg-12 col-md-12 col-sm-12" id="error"></div>
        <table class="table table-striped text-center" id="areas_table">
          <thead>
            <tr>
              <th>Practice area</th>
              <th>% of practice</th>
              <th>Total years</th>
              <th>Total cases</th>
              <th>Practice area description</th>
            </tr>
          </thead>
          <tbody>
            <tr class="no-area">
              <td colspan="5">No Practice Area(s)<br>
                Phasellus sit amet neque at urna interdum viverra malesuada a velit.</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>Practice area total</th>
              <th colspan="4"><strong>0%</strong> Note: Maecenas mattis at eros sed tincidunt.</th>
            </tr>
          </tfoot>
        </table>
        </div>
        <a id="add2" class="btn btn-info">Add a practice area</a>
        <hr>
        <button type="submit" class="btn btn-primary" id="save">Save Changes</button>
        <button type="submit" class="btn btn-default">Cancel</button>
      </div>
    </div>
  </div>
</section>


<div id="areas_modal" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Add your practice area</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">Search for your practice area</div>
            <div class="col-md-6"><input type="text" name="search"/></div>
          </div>
          <div id="list">
          <?php 
              $prev = 'A';
              foreach($practice_areas as $area) {
              if(substr($area['area'],0,1) != strtoupper($prev))
              {
                 $char = substr($area['area'],0,1);
                 $prev = $char;
          ?>          
          <div class="row area-title">
            <div class="col-md-12 area-alpha"><strong><?php echo $char ?></strong></div>
          </div>
          <?php }  ?>
          <div class="row <?php echo $char.'-areas' ?>">
            <div class="col-md-8 area-val"><?php echo $area['area'] ?> <a class="details">show details</a></div>
            <div class="col-md-4"><button type="button" name="add" class="btn btn-default add" value="<?php echo htmlentities(json_encode(array('id'=>$area['id'], 'area' => $area['area']))) ?>">Add practice area</button></div>
            <div class="col-md-12 desc"><?php echo $area['description'] ?></div>
          </div>
          <?php }  ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<script>
$('#add1, #add2').click(function(e){ e.preventDefault(); $('#areas_modal').modal('show'); });

$('#areas_modal input[name=search]').keyup(function(){ 
   var v = $(this).val(); 
   if(v == '') { $('.row').show(); return false; }; 
   var fnd = false;
   $.each($('#areas_modal #list .area-alpha'), function(k, el){  
     if($(el).text() == v.charAt(0).toUpperCase()){ 
       $('#areas_modal #list .row').hide(); 
       if(v.length > 1)
       {
         $.each($('.'+$(el).text()+'-areas .area-val'), function(i,a){console.log(v.toUpperCase()); if(v.toUpperCase() == $(a).text().substring(0,v.length).toUpperCase()){  console.log('here'); $(el).closest('.area-title').show(); $(this).closest('.row').show(); fnd = true; } });
       }
       else 
       {
         $(el).closest('.area-title').show(); 
         $('.'+$(el).text()+'-areas').show(); 
         fnd = true;
       }
       return false;
     } 
   }); 
   if(!fnd) { $('#areas_modal #list .row').hide(); }
});
function delete_area(that, btn)
{
  //$.ajax({ method:'post', url:'', 'dataType':'JSON', data:{}, success: {} });
  that.closest('tr').remove();  
  if($('#areas_table tbody tr.area-form').length == 0)
      $('#areas_table tbody tr.no-area').show();
  btn.removeClass('active').text('Add practice area');  
  btn.click(function(){
   add_area($(this));
  });
}

function add_area(btn)
{
  btn.unbind('click'); btn.addClass('active'); btn.text('Area added');
  //var btn = $(this);
  $('#areas_table tbody tr.no-area').hide();
  var js = JSON.parse(btn.val());
  var html = $('<tr class="area-form" id="form_'+js.id+'"><td><span>'+js.area+'</span><br><a class="delete">delete</a></td><td><input type="text" name="percentage"/></td><td><input type="text" name="years"/></td><td><input type="text" name="cases"/></td><td><span>500 characters remaining</span><br><textarea name="description" maxlength="500"></textarea></td></tr>');
  $('#areas_table tbody').append(html);
  html.find('textarea').keyup(function(){ $(this).closest('td').find('span').html((500-$(this).val().length)+ ' characters remaining'); });
  html.find('a.delete').click(function(){ delete_area($(this), btn); });
  $('#areas_modal').modal('hide');
}

$('#areas_modal #list .add').click(function(){
   add_area($(this));
});

$('#areas_modal #list .details').click(function(){ $(this).closest('.row').find('.desc').slideToggle('top'); });

$('#save').click(function(){ 

  if($('#areas_table tbody tr.area-form').length == 0)
  {
     alert('Please select your practice areas');
     return false;
  }
  var percentage = 0;
  $.each($('#areas_table tbody tr.area-form input[name=percentage]'),function(k,el){if(el.value != null) percentage += parseInt(el.value); });
  if(percentage > 100)
      alert('Total percentage should be lessthan 100');

  //$.each($('#areas_table tbody tr.area-form'),function(k,el){ console.log($(el).serialize()); });
     
});
</script>


<!-- main content container -->


<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->
</body>
</html>
