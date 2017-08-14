                    <table class="table table-bordered" id="experience_table">
                        <tr>
                            <th>Title</th>
                            <th>Company</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                        </tr> 
<?php foreach($experiences as $experience) { ?>
                    	<tr>
                            <td><?php echo $experience['title'] ?></td>
                            <td><?php echo $experience['company'] ?></td>
                            <td><?php echo $experience['from'] ?></td>
                            <td><?php if($experience['present']) echo 'present'; else echo $experience['to'] ?></td>                            
                            <td><input type="hidden" name="id" value="<?php echo $experience['id'] ?>"/><i id="experience_edit" class="fa fa-pencil"></i> <i id="experience_delete" class="fa fa-trash"></i></td>
                        </tr> 
<?php } ?>
		    </table>

