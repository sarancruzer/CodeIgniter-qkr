                    <table class="table table-bordered" id="award_table">
                        <tr>
                            <th>Award name</th>
                            <th>Grantor</th>
                            <th>Date granted</th>
                            <th>Action</th>
                        </tr> 
<?php foreach($awards as $award) { ?>
                    	<tr>
                            <td><?php echo $award['award_name'] ?></td>
                            <td><?php echo $award['grantor'] ?></td>
                            <td><?php echo $award['date_granted'] ?></td>
                            <td><input type="hidden" name="id" value="<?php echo $award['id'] ?>"/><i id="award_edit" class="fa fa-pencil"></i> <i id="award_delete" class="fa fa-trash"></i></td>
                        </tr> 
<?php } ?>
		    </table>

