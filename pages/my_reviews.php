<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
<?php include 'meta.php' ?>
<script type="text/javascript" src="<?php echo base_url();?>src/js/jRate.min.js"></script>

<body>
<?php include 'header.php' ?>
<div class="clearfix"></div>
<section class="container">
<?php
foreach ($reviews as $value) {
	?>
	<p><a><?php echo $value['title'];?></a></p>
	<p><a><?php echo $this->my_quickr_model->get_name_by_id($value['fa_id']);?></a></p>
	<script type="text/javascript">
	$(function () {
    $("#jRate_<?php echo $value['id'];?>").jRate({
        strokeColor: '#FE9A23',
        startColor: "#FE9A23",
        endColor: "#FE9A23",
		width: 15,
		height: 15,
		shapeGap: '5px',
		precision: 1,
        readOnly: true,
	    rating:<?php echo $value["overall_rating"];?>
	});
});
	</script>
	<div id="jRate_<?php echo $value['id'];?>" style="height:50px;width: 200px;"></div>
	<p><?php echo $value['review'];?></p>
	<p>Posted about <?php echo $this->my_quickr_model->time_cal(strtotime($value['reviewed_at']));?></p>
	<?php
}
?>
</section>
<!--footer starts here -->
<?php include 'footer.php' ?>

<!--footer ends here -->

</body>
</html>