                    <table class="table table-bordered" id="license_table">
                        <tr>
                            <th>Controlled function</th>
                            <th>Firm name</th>
                            <th>Start year</th>
                            <th>End year</th>
                            <th>Action</th>
                        </tr> 
<?php foreach($licenses as $license) { ?>
                    	<tr>
                            <td><?php echo $license['controlled_function'] ?></td>
                            <td><?php echo $license['firm_name'] ?></td>
                            <td><?php echo $license['start_date'] ?></td>
                            <td><?php echo $license['end_date'] ?></td>                            
                            <td><input type="hidden" name="id" value="<?php echo $license['id'] ?>"/><i id="license_edit" class="fa fa-pencil"></i> <i id="license_delete" class="fa fa-trash"></i></td>
                        </tr> 
<?php } ?>
		    </table>

