<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="'.site_url().'admin/companies/company_name/'.$order_method.'/'.$page.'">Name</a></th>
						<th><a href="'.site_url().'admin/companies/company_phone/'.$order_method.'/'.$page.'">Phone</a></th>
						<th><a href="'.site_url().'admin/companies/company_email/'.$order_method.'/'.$page.'">Email</a></th>
						
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			foreach ($query->result() as $row)
			{
				$company_id = $row->company_id;
				$company_name = $row->company_name;
				$company_phone = $row->company_phone;
				$company_email = $row->company_email;
				$company_physical_address = $row->company_physical_address;
				$company_status = $row->company_status;
				$company_postal_address = $row->company_postal_address;
				$company_post_code = $row->company_post_code;
				$company_town = $row->company_town;
				$company_facsimile = $row->company_facsimile;
				$company_cell_phone = $row->company_cell_phone;
				$company_activity = $row->company_activity;
				
				//create deactivated status display
				if($company_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'admin/companies/activate_company/'.$company_id.'" onclick="return confirm(\'Do you want to activate '.$company_name.'?\');" title="Activate '.$company_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($company_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'admin/companies/deactivate_company/'.$company_id.'" onclick="return confirm(\'Do you want to deactivate '.$company_name.'?\');" title="Deactivate '.$company_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$company_name.'</td>
						<td>'.$company_phone.'</td>
						<td>'.$company_email.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'admin/companies/edit_company/'.$company_id.'" class="btn btn-sm btn-success"title="Edit '.$company_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td>
							<a title="View '.$company_name.'" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#view_company'.$company_id.'"><i class="fa fa-plus"></i></a>
							<!-- Modal -->
							<div class="modal fade" id="view_company'.$company_id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">'.$company_name.'</h4>
										</div>
										<div class="modal-body">
											<table class="table table-condensed table-striped table-hover">
												<tr>
													<th>Company Name</th>
													<td>'.$company_name.'</td>
												</tr>
												<tr>
													<th>Company Physical Address</th>
													<td>'.$company_physical_address.'</td>
												</tr>
												<tr>
													<th>Company Postal Address</th>
													<td>'.$company_postal_address.'</td>
												</tr>
												<tr>
													<th>Company Post Code</th>
													<td>'.$company_post_code.'</td>
												</tr>
												<tr>
													<th>Company Town</th>
													<td>'.$company_town.'</td>
												</tr>
												<tr>
													<th>Company Phone</th>
													<td>'.$company_phone.'</td>
												</tr>
												<tr>
													<th>Company Facsimile</th>
													<td>'.$company_facsimile.'</td>
												</tr>
												<tr>
													<th>Company Cell Phone</th>
													<td>'.$company_cell_phone.'</td>
												</tr>
												<tr>
													<th>Company Email</th>
													<td>'.$company_email.'</td>
												</tr>
												<tr>
													<th>Company Activity</th>
													<td>'.$company_activity.'</td>
												</tr>
												<tr>
													<th>Company Status</th>
													<td>'.$status.'</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</td>
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
			$result .= "There are no companies";
		}
?>

						<div class="panel panel-default">
							<div class="panel-heading"><?php echo $title;?></div>
							<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-2 col-md-offset-8">
                                    	<a href="<?php echo site_url().'admin/companies/add_company';?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add company</a>
                                    </div>
                                    
                                	<div class="col-md-2">
                                    	<a href="<?php echo site_url().'admin/companies/import_companies';?>" class="btn btn-sm btn-success"><i class="fa fa-upload"></i> Import companies</a>
                                    </div>
                                </div>
								<div class="table-responsive">
                                	
									<?php 
									$success = $this->session->userdata('success_message');
									$error = $this->session->userdata('error_message');
									
									if(!empty($success))
									{
										echo '<div class="alert alert-success">'.$success.'</div>';
										$this->session->unset_userdata('success_message');
									}
									
									if(!empty($error))
									{
										echo '<div class="alert alert-danger">'.$error.'</div>';
										$this->session->unset_userdata('error_message');
									}
									echo $result;
									?>
							
                                </div>
							</div>
                            
							<div class="panel-body">
                            	<?php if(isset($links)){echo $links;}?>
							</div>
                            
						</section>