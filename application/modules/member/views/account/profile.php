<?php
$row = $member_details->row();
$member_id = $row->member_id;
$member_postal_code = $row->member_postal_code;
$member_postal_address = $row->member_postal_address;
$member_email = $row->member_email;
$member_first_name = $row->member_first_name;
$member_surname = $row->member_surname;
$member_phone = $row->member_phone;
$member_title = $row->member_title;
$date_of_birth = $row->date_of_birth;
$nationality = $row->nationality;
$qualifications = $row->qualifications;
$designation = $row->designation;
$company_name = $row->company;
$company_physical_address = $row->company_physical_address;
$company_postal_address = $row->company_postal_address;
$company_post_code = $row->company_post_code;
$company_town = $row->company_town;
$company_phone = $row->company_phone;
$company_facsimile = $row->company_facsimile;
$company_cell_phone = $row->company_cell_phone;
$company_email = $row->company_email;
$company_activity = $row->company_activity;
$member_number = $row->member_number;
$member_image = $row->member_image;
$image = $this->site_model->image_display(realpath(APPPATH . '../assets/images/profile'), base_url().'assets/images/profile/', $member_image);

$v_data['uploads_path'] = $uploads_path;
$v_data['uploads_location'] = $uploads_location;
$v_data['member_id'] = $member_id;
$v_data['uploads'] = $uploads;
$v_data['member_id'] = $member_id;
?>
    <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">
            
            <div class="table-asignment">

                <ul class="nav-tabs" role="tablist">
                    <li class="active"><a href="account-assignment.html#about_me" role="tab" data-toggle="tab">About Me</a></li>
                    <li><a href="account-assignment.html#company_details" role="tab" data-toggle="tab">Company Details</a></li>
                    <li><a href="account-assignment.html#settings" role="tab" data-toggle="tab">Settings</a></li>
                    <li><a href="account-assignment.html#uploads" role="tab" data-toggle="tab">Uploads</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade in active" id="about_me">
                        
						<h3 class="md black">About</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="avatar-acount">
									<div class="changes-avatar">
										<form action="<?php echo site_url().'member/edit-general-details'?>" method="post" role="form" enctype="multipart/form-data">
                                        <div class="img-acount">
											<div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                    <img src="<?php echo $image;?>">
                                                </div>
                                                <div>
                                                    <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="offer_image"></span>
                                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
										</div>
										<div class="choses-file up-file">
											
										</div>
                                        </form>
									</div>   
									<div class="info-acount">
                                    	<form action="<?php echo site_url().'member/edit-general-details'?>" method="post" role="form">
										<h3 class="md black"><?php echo $member_first_name;?> <?php echo $member_surname;?></h3>
										<div class="security">
                                        	<h5>Edit General Details</h5>
                                                <div class="tittle-security">
                                                    <div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                                        <div class="form-group">
                                                            <input type="text" name="member_first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" value="<?php echo $member_first_name;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <input type="text" name="member_surname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="<?php echo $member_surname;?>">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <input type="text" name="member_title" class="form-control input-lg" placeholder="Title" tabindex="2" value="<?php echo $member_title;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group date" data-provide="datepicker">
                                                            <input type="text" name="date_of_birth" class="form-control input-lg datepicker" placeholder="Date of Birth" tabindex="3" value="<?php echo $date_of_birth;?>" data-date-format="mm/dd/yyyy">
                                                            <div class="input-group-addon">
                                                                <span class="glyphicon glyphicon-th"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="nationality" class="form-control input-lg" placeholder="Nationality" tabindex="3" value="<?php echo $nationality;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="qualifications" class="form-control input-lg" placeholder="Qualifications" tabindex="3" value="<?php echo $qualifications;?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="member_phone" id="phone" class="form-control input-lg" placeholder="Phone" tabindex="3" value="<?php echo $member_phone;?>">
                                                    </div>
                                                    
                                                    <!--<h5>Email</h5>
                                                    <input type="text">
                                                    <h5>Password</h5>
                                                    <input type="password" placeholder="Current password">
                                                    <input type="password" placeholder="New password">
                                                    <input type="password" placeholder="Confirm password">-->
                                                </div>
										</div>
									</div>
									<div class="input-save">   
										<input type="submit" value="Update Profile" class="mc-btn btn-style-1">
									</div>
                                    </form>
								</div>    
							</div>
							
						</div>
									
                    </div>
                    <!-- END / MY SUBMISSIONS -->

                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade" id="company_details">
                        
						<h3 class="md black">Company</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="avatar-acount">
									<form action="<?php echo site_url().'member/edit-company-details'?>" method="post" role="form">
                                    <div class="info-acount">
										<h3 class="md black"><?php echo $company_name;?></h3>
										<div class="security">
											<div class="tittle-security">
												<h5>Edit Company</h5>
												<div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="company_name" class="form-control input-lg" placeholder="Company" tabindex="3" value="<?php echo $company_name;?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="designation" class="form-control input-lg" placeholder="Designation" tabindex="3" value="<?php echo $designation;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="company_physical_address" class="form-control input-lg" placeholder="Company Physical Address" tabindex="3" value="<?php echo $company_physical_address;?>">
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="company_postal_address" class="form-control input-lg" placeholder="Company Postal Address" tabindex="3" value="<?php echo $company_postal_address;?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="company_postal_code" class="form-control input-lg" placeholder="Company Post Code" tabindex="3" value="<?php echo $company_post_code;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="company_town" class="form-control input-lg" placeholder="Company Town" tabindex="3" value="<?php echo $company_town;?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="company_email" class="form-control input-lg" placeholder="Company Email" tabindex="3" value="<?php echo $company_email;?>">
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="company_phone" class="form-control input-lg" placeholder="Company Phone" tabindex="3" value="<?php echo $company_phone;?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                                    <div class="form-group">
                                                        <input type="text" name="company_cell_phone" class="form-control input-lg" placeholder="Company Cell Phone" tabindex="3" value="<?php echo $company_cell_phone;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="company_facsimile" class="form-control input-lg" placeholder="Company Facsimile" tabindex="3" value="<?php echo $company_facsimile;?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="company_activity" class="form-control input-lg" placeholder="Company Activity" tabindex="3" value="<?php echo $company_activity;?>">
                                                </div>
											</div>
										</div>
									</div>
									<div class="input-save">   
										<input type="submit" value="Save changes" class="mc-btn btn-style-1">
									</div>
                                    </form>
								</div>    
							</div>
							
						</div>
						
					</div>
                    <!-- END / MY SUBMISSIONS -->

                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade" id="settings">
                        		
						<!-- SETTING -->
						<section class="setting">
							<div class="container">
								<div class="content-setting">
									<h3 class="big black text-center">Settings</h3>
									<div class="row">
										<div class="col-md-8 col-md-offset-2">
											<div class="notification-setting setting-box">
												<h4 class="sm black bold">Notification</h4>
												<ul>
													<li>
														<input type="checkbox" class="inputcheck" id="promotion-annoucement">
														<label for="promotion-annoucement">
															Promotion and Annoucement
															<i class="icon md-check-1"></i>
														</label>
													</li>
													<li>
														<input type="checkbox" class="inputcheck" id="new-user-following-you">
														<label for="new-user-following-you">
															New user following you
															<i class="icon md-check-1"></i>
														</label>
													</li>

												</ul>
											</div>
											<div class="setting-box">
												<h4 class="sm black bold">Email subscribe </h4>
												<ul>
													<li>
														<input type="checkbox" class="inputcheck" id="Receive-new-notification">
														<label for="Receive-new-notification">
															Receive new notification
															<i class="icon md-check-1"></i>
														</label>
													</li>
													<li>
														<input type="checkbox" class="inputcheck" id="new-promotion-sales">
														<label for="new-promotion-sales">
															New promotion and sales
															<i class="icon md-check-1"></i>
														</label>
													</li>
													<li>
														<input type="checkbox" class="inputcheck" id="confirm-password">
														<label for="confirm-password">
															Confirm password
															<i class="icon md-check-1"></i>
														</label>
													</li>

												</ul>
											</div>
											<div class="setting-box">
												<h4 class="sm black bold">Profile privacy</h4>
												<ul>
													<li>
														<input type="checkbox" class="inputcheck" id="show-my-location">
														<label for="show-my-location">
															Show my location
															<i class="icon md-check-1"></i>
														</label>
													</li>
													<li>
														<input type="checkbox" class="inputcheck" id="show-my-email">
														<label for="show-my-email">
															Show my email
															<i class="icon md-check-1"></i>
														</label>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="input-save">   
										<input type="submit" value="Save changes" class="mc-btn btn-style-1">
									 </div>   
								</div>
							</div>    
						</section>
						<!-- END / SETTING -->
						
					</div>
                    <!-- END / MY SUBMISSIONS -->

                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade" id="uploads">
						<?php echo $this->load->view('member/account/uploads', $v_data, TRUE);?>
					</div>
                    <!-- END / MY SUBMISSIONS -->

                </div>

            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->