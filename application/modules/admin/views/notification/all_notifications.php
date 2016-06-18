<?php
		
		$result = '';
            
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
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered table-responsive">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Image</th>
					  <th>Notification Title</th>
					  <th>Date Created</th>
					  <th>Views</th>
					  <th>Comments</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			//get all administrators
			$administrators = $this->users_model->get_all_administrators();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$notification_id = $row->notification_id;
				$notification_title = $row->notification_title;
				$notification_status = $row->notification_status;
				$notification_views = $row->notification_views;
				$image = $row->notification_image;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				
				//status
				if($notification_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
				
				//create deactivated status display
				if($notification_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'activate-notification/'.$notification_id.'" onclick="return confirm(\'Do you want to activate '.$notification_title.'?\');">Activate</a>';
				}
				//create activated status display
				else if($notification_status == 1)
				{
					$status = '<span class="label label-info">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'deactivate-notification/'.$notification_id.'" onclick="return confirm(\'Do you want to deactivate '.$notification_title.'?\');">Deactivate</a>';
				}
				
				//creators & editors
				if($admins != NULL)
				{
					foreach($admins as $adm)
					{
						$user_id = $adm->user_id;
						
						if($user_id == $created_by)
						{
							$created_by = $adm->first_name;
						}
						
						if($user_id == $modified_by)
						{
							$modified_by = $adm->first_name;
						}
					}
				}
				
				else
				{
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td><img src="'.base_url()."assets/images/notifications/thumbnail_".$image.'" height="100"></td>
						<td>'.$notification_title.'</td>
						<td>'.date('jS M Y',strtotime($row->created)).'</td>
						<td>'.$notification_views.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-notification/'.$notification_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-notification/'.$notification_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$notification_title.'? This will also delete all comments associated with this notification\');">Delete</a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no notifications";
		}
?>

<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title"><?php echo $title;?></h2>
							</header>
							<div class="panel-body">
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
								?>
                            	<div class="row" style="margin-bottom:20px;">
                                    <div class="col-lg-12">
                                    	<a href="<?php echo site_url();?>add-notification" class="btn btn-success btn-sm pull-right">Add Notification</a>
                                    </div>
                                </div>
								<div class="table-responsive">
                                	
									<?php echo $result;?>
							
                                </div>
							</div>
							<div class="panel-body">
                            	<?php if(isset($links)){echo $links;}?>
							</div>
						</section>