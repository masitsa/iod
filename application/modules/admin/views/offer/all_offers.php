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
					  <th>Offer Title</th>
					  <th>Expiry Date</th>
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
				$offer_id = $row->offer_id;
				$offer_title = $row->offer_title;
				$offer_status = $row->offer_status;
				$offer_views = $row->offer_views;
				$image = $row->offer_image;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				
				//status
				if($offer_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
				
				//create deactivated status display
				if($offer_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'activate-offer/'.$offer_id.'" onclick="return confirm(\'Do you want to activate '.$offer_title.'?\');">Activate</a>';
				}
				//create activated status display
				else if($offer_status == 1)
				{
					$status = '<span class="label label-info">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'deactivate-offer/'.$offer_id.'" onclick="return confirm(\'Do you want to deactivate '.$offer_title.'?\');">Deactivate</a>';
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
						<td><img src="'.base_url()."assets/images/offers/thumbnail_".$image.'" height="100"></td>
						<td>'.$offer_title.'</td>
						<td>'.date('jS M Y',strtotime($row->offer_expiry_date)).'</td>
						<td>'.$offer_views.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-offer/'.$offer_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-offer/'.$offer_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$offer_title.'? This will also delete all comments associated with this offer\');">Delete</a></td>
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
			$result .= "There are no offers";
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
                                    	<a href="<?php echo site_url();?>add-offer" class="btn btn-success btn-sm pull-right">Add Offer</a>
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