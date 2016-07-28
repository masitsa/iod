
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url().'administration/add-resource';?>" class="btn btn-success pull-right">Add Resource</a>
                        </div>
                    </div>

<?php	

		$success = $this->session->userdata('success_message');
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
				?>
                <table class="table table-condensed table-striped table-hover">
                    <tr>
                    	<th>Category</th>
                    	<th>Title</th>
                    	<th>Status</th>
                    	<th>Actions</th>
                    </tr>
                <?php
				foreach($query->result() as $cat){
					
					$resource_id = $cat->resource_id;
					$resource_status = $cat->resource_status;
					$resource_name = $cat->resource_name;
					$resource_description = $cat->resource_description;
					$resource_category_name = $cat->resource_category_name;
					$resource_image_name = $cat->resource_image_name;
					
					if($resource_status == 1){
						$status = '<span class="label label-success">Active</span>';
					}
					else{
						$status = '<span class="label label-important">Deactivated</span>';
					}
					?>
                    <tr>
                    	<td><?php echo $resource_category_name?></td>
                    	<td><?php echo $resource_name?></td>
                    	<td><?php echo $status?></td>
                    	<td>
                        	<a href="<?php echo $resource_location.$resource_image_name;?>" class="btn btn-info btn-sm" target="_blank" title="Download">Download</a>
                    	</td>
                    	<td>
                        	<a href="<?php echo site_url()."administration/edit-resource/".$resource_id.'/'.$page;?>" class="i_size" title="Edit">
                            <button class="btn btn-success btn-sm" type="button" ><i class="fa fa-pencil-square-o"></i> Edit</button>
                            	
                            </a>
                        	<a href="<?php echo site_url()."administration/delete-resource/".$resource_id.'/'.$page;?>" class="i_size" title="Delete" onclick="return confirm('Do you really want to delete this resource?');">
                            	 <button class="btn btn-danger btn-sm" type="button" ><i class="fa fa-trash-o"></i> Delete</button>
                            </a>
                            <?php
								if($resource_status == 1){
									?>
                                        <a href="<?php echo site_url()."administration/deactivate-resource/".$resource_id.'/'.$page;?>" class="i_size" title="Deactivate" onclick="return confirm('Do you really want to deactivate this resource?');">
                            <button class="btn btn-warning btn-sm" type="button" ><i class="fa fa-thumbs-o-down"></i> Deactivate</button>
                                        </a>
                                    <?php
								}
								else{
									?>
                                        <a href="<?php echo site_url()."administration/activate-resource/".$resource_id.'/'.$page;?>" class="i_size" title="Activate" onclick="return confirm('Do you really want to activate this resource?');">
                            <button class="btn btn-info btn-sm" type="button" ><i class="fa fa-thumbs-o-up"></i> Activate</button>
                                        </a>
                                    <?php
								}
							?>
                        </td>
                    </tr>
                    <?php
				}
				?>
                </table>
                <?php
			}
			
			else{
				echo "There are no resources to display :-(";
			}
			
			if(isset($links)){echo $links;}
		?>
                </div>
            </section>