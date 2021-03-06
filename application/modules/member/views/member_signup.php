<!--Banner Wrap Start-->
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                    <div class="inr_banner_heading">
                        <h3>Member Registration</h3>
                    </div>
                   
                    <div class="kf_inr_breadcrumb">
                        <ul>
                            <li><a href="<?php echo site_url();?>">Home</a></li>
                            <li><a href="#">Register</a></li>
                        </ul>
                    </div>
                </div>
                <!--KF INR BANNER DES Wrap End-->
            </div>
        </div>
    </div>
</div>
<!--Banner Wrap End-->

<!--Content Wrap Start-->
<div class="kf_content_wrap">
            
    <!--ABOUT UNIVERSITY START-->
    <section>
        <div class="container">
            <form action="<?php echo $this->uri->uri_string();?>" method="post" role="form">
                <div class="row">
                	<div class="col-md-12">
                    	<h2>Member Registration</h2>
                        <hr class="colorgraph">

						<?php
						$validation_errors = validation_errors();
						if(!empty($validation_errors))
						{
							echo '<div class="alert alert-danger">'.$validation_errors.'</div>';
						}
						?>
                    </div>
                    <div class="col-md-6">
						<!-- HEADING 1 START-->
						<div class="kf_edu2_heading1">
							<h3>
                                General <small>Details</small>
                            </h3>
						</div>
						<!-- HEADING 1 END-->
				
						<div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
							<div class="form-group">
								<input type="text" name="member_first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" value="<?php echo set_value('member_first_name');?>">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
							<div class="form-group">
								<input type="text" name="member_surname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="<?php echo set_value('member_surname');?>">
							</div>
						</div>
					
						<div class="form-group">
							<input type="text" name="member_title" class="form-control input-lg" placeholder="Title" tabindex="2" value="<?php echo set_value('member_title');?>">
						</div>
						<div class="form-group">
							<div class="input-group date" data-provide="datepicker">
								<input type="text" name="date_of_birth" class="form-control input-lg datepicker" placeholder="Date of Birth" tabindex="3" value="<?php echo set_value('date_of_birth');?>" data-date-format="mm/dd/yyyy">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-th"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="text" name="nationality" class="form-control input-lg" placeholder="Nationality" tabindex="3" value="<?php echo set_value('nationality');?>">
						</div>
						<div class="form-group">
							<input type="text" name="qualifications" class="form-control input-lg" placeholder="Qualifications" tabindex="3" value="<?php echo set_value('qualifications');?>">
						</div>
						<div class="form-group">
							<input type="text" name="member_phone" id="phone" class="form-control input-lg" placeholder="Phone" tabindex="3" value="<?php echo set_value('member_phone');?>">
						</div>
						<div class="form-group">
							<input type="email" name="member_email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" value="<?php echo set_value('member_email');?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                            <div class="form-group">
                                <input type="password" name="member_password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" value="<?php echo set_value('member_password');?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                            </div>
                        </div>
                    
					</div>
					<div class="col-md-6>">

                        <div class="col-md-6">
                            <!-- HEADING 1 START-->
                            <div class="kf_edu2_heading1">
                                <h3>
                                    Company <small>Details</small>
                                </h3>
                            </div>
                            <!-- HEADING 1 END-->
                        	<div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                <div class="form-group">
                                    <input type="text" name="company_name" class="form-control input-lg" placeholder="Company" tabindex="3" value="<?php echo set_value('company_name');?>">
                                </div>
                            </div>
                        	<div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                <div class="form-group">
                                    <input type="text" name="designation" class="form-control input-lg" placeholder="Designation" tabindex="3" value="<?php echo set_value('designation');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_physical_address" class="form-control input-lg" placeholder="Company Physical Address" tabindex="3" value="<?php echo set_value('company_physical_address');?>">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                <div class="form-group">
                                    <input type="text" name="company_postal_address" class="form-control input-lg" placeholder="Company Postal Address" tabindex="3" value="<?php echo set_value('company_postal_address');?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                <div class="form-group">
                                    <input type="text" name="company_postal_code" class="form-control input-lg" placeholder="Company Post Code" tabindex="3" value="<?php echo set_value('company_postal_code');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_town" class="form-control input-lg" placeholder="Company Town" tabindex="3" value="<?php echo set_value('company_town');?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_email" class="form-control input-lg" placeholder="Company Email" tabindex="3" value="<?php echo set_value('company_email');?>">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6" style="padding-left:0;">
                                <div class="form-group">
                                    <input type="text" name="company_phone" class="form-control input-lg" placeholder="Company Phone" tabindex="3" value="<?php echo set_value('company_phone');?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6" style="padding-right:0;">
                                <div class="form-group">
                                    <input type="text" name="company_cell_phone" class="form-control input-lg" placeholder="Company Cell Phone" tabindex="3" value="<?php echo set_value('company_cell_phone');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_facsimile" class="form-control input-lg" placeholder="Company Facsimile" tabindex="3" value="<?php echo set_value('company_facsimile');?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_activity" class="form-control input-lg" placeholder="Company Activity" tabindex="3" value="<?php echo set_value('company_activity');?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-3 col-md-3">
                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="primary" tabindex="7">I Agree</button>
                            <input type="checkbox" name="member_agree" id="t_and_c" class="hidden" value="1">
                        </span>
                    </div>
                    <div class="col-xs-8 col-sm-9 col-md-9">
                         By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <hr class="colorgraph">
                    </div>
                    
                    <div class="col-xs-12 col-md-6"><a href="<?php echo site_url().'login';?>" class="btn btn-default btn-block btn-lg">Sign In</a></div>
                    <div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                </div>
            </form>
			<!-- Modal -->
			<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">Membership Application Terms & Conditions</h4>
						</div>
						<div class="modal-body">
							<p>I hereby apply for membership of the Institute of Directors (Kenya) and agree to be bound by its memorandum and articles of association. I confirm that I do not have any criminal convictions nor have I had any civil judgment entered against me in connection with fraud or corporate misfeasance; I am not an undischarged bankrupt; and I am not disqualified (by court order or voluntary undertaking) from being a director of any company.</p>
							<p>I undertake to conduct myself, both publicly and privately, in a professional manner and so as to uphold the Institutes reputation and standing and not to cause embarrassment or distress to other members of the Institute or its staff and not to represent publicly the views of the Institute or to claim its support, without the consent of the Board (or of an officer or employee of the Institute nominated by the Board for such purpose).</p>
							<h1><small>Subscription Rates</small></h1>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Type of Membership</th>
										<th>Entrance Fee</th>
										<th>Annual subscription (Kshs)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Ordinary Members</td>
										<td>3,000</td>
										<td>12,000</td>
									</tr>
									<tr>
										<td>Associate Members</td>
										<td>3,000</td>
										<td>10,000</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
	</section>
</div>