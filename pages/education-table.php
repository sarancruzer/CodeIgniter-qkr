                    <table class="table table-bordered" id="edu_table">
                        <tr>
                            <th>University</th>
                            <th>Major</th>
                            <th>Degree</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr> 
<?php foreach($educations as $education) { ?>
                    	<tr>
                            <td><?php echo $education['university'] ?></td>
                            <td><?php echo $education['major'] ?></td>
                            <td><?php echo $education['degree'] ?></td>
                            <td><?php echo $education['year'] ?></td>                            
                            <td><input type="hidden" name="id" value="<?php echo $education['id'] ?>"/><i id="edu_edit" class="fa fa-pencil"></i> <i id="edu_delete" class="fa fa-trash"></i></td>
                        </tr> 
<?php } ?>
		    </table>

