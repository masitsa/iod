<?php
$contacts = $this->site_model->get_contacts();
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$email2 = $contacts['email'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
		
		if(!empty($facebook))
		{
			//$facebook = '<li class="facebook"><a href="'.$facebook.'" target="_blank" title="Facebook">Facebook</a></li>';
		}
		
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
		$google = '';
	}
?>
			<!-- register Modal -->
            <div class="modal fade" id="reg-box" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-content">
                        <!--SIGNIN AS USER START-->
                        <div class="user-box">
                            <h2>Member Registration</h2>
                            <!--FORM FIELD START-->
                            <?php
								$validation_errors = validation_errors();
								if(!empty($validation_errors))
								{
									echo '<div class="alert alert-danger">'.$validation_errors.'</div>';
								}
							?>
                            <div class="row">
                            	<div class="col-md-6">
                            		<h3>About You</h3>
                                    
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="member_first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" value="<?php echo set_value('member_first_name');?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="member_surname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="<?php echo set_value('member_surname');?>">
                                            </div>
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
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="password" name="member_password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" value="<?php echo set_value('member_password');?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                	
                                </div>
                            </div>
                            <div class="form">
                                <div class="input-container">
                                    <input type="text" placeholder="Name">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="input-container">
                                    <input type="text" placeholder="E-mail">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="input-container">
                                    <input type="password" placeholder="Password">
                                    <i class="fa fa-unlock"></i>
                                </div>
                                <div class="input-container">
                                    <label>
                                        <span class="radio">
                                            <input type="checkbox" name="foo" value="1" checked>
                                            <span class="radio-value" aria-hidden="true"></span>
                                        </span>
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <div class="input-container">
                                    <button class="btn-style">Sign Up</button>
                                </div>
                            </div>
                            <!--FORM FIELD END-->
                            <!--OPTION START-->
                            <div class="option">
                                <h5>Or Using</h5>
                            </div>
                            <!--OPTION END-->
                            <!--OPTION START-->
                            <div class="social-login">
                                <a href="#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>
                            </div>
                            <!--OPTION END-->
                        </div>
                        <!--SIGNIN AS USER END-->
                        <div class="user-box-footer">
                            Already have an account? <a href="#">Sign In</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- register Modal end-->
            
            <!-- SIGNIN MODEL START -->
            <div class="modal fade" id="signin-box" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-content">
                        <div class="user-box">
                            <h2>Sign In</h2>
                            <!--FORM FIELD START-->
                            <div class="form">
                                <div class="input-container">
                                    <input type="text" placeholder="E-mail">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="input-container">
                                    <input type="password" placeholder="Password">
                                    <i class="fa fa-unlock"></i>
                                </div>
                                <div class="input-container">
                                    <label>
                                        <span class="radio">
                                            <input type="checkbox" name="foo" value="1" checked>
                                            <span class="radio-value" aria-hidden="true"></span>
                                        </span>
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <div class="input-container">
                                    <button class="btn-style">Sign In</button>
                                </div>
                            </div>
                            <!--FORM FIELD END-->
                            <!--OPTION START-->
                            <div class="option">
                                <h5>Or Using</h5>
                            </div>
                            <!--OPTION END-->
                            <!--OPTION START-->
                            <div class="social-login">
                                <a href="#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>
                            </div>
                            <!--OPTION END-->
                        
                        </div>
                        <div class="user-box-footer">
                            <p>Don't have an account?<br><a href="#">Sign up as a User</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- SIGNIN MODEL END -->
			
		<!--HEADER START-->
    	<header id="header_2">
    		<!--kode top bar start-->
    		<div class="top_bar_2">
	    		<div class="container">
	    			<div class="row">
	    				<div class="col-md-12">
    						<!--<div class="lng_wrap">
	    						<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<i class="fa fa-globe"></i>Language
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li><a href="#"><i><img src="<?php echo base_url()."assets/themes/uoe/";?>images/english.jpg" alt=""></i>English</a></li>
										<li><a href="#"><i><img src="<?php echo base_url()."assets/themes/uoe/";?>images/german.jpg" alt=""></i>German</a></li> 
									</ul>
								</div>
	    					</div>-->
    						<ul class="login_wrap">
    							<li><a href="<?php echo site_url().'register';?>"><i class="fa fa-user"></i>Register</a></li>
    							<li><a href="#" data-toggle="modal" data-target="#signin-box"><i class="fa fa-sign-in"></i>Sign In</a></li>
    							<li><a href="tel:<?php echo $phone;?>"><em class="contct_2"><i class="fa fa-phone"></i> Call Us  on <?php echo $phone;?></em></a></li>
    						</ul>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
    		<!--kode top bar end-->
        	
	    	<!--kode navigation start-->
    		<div class="kode_navigation">
    			<div id="mobile-header">
                	<a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
                </div>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2">
    						<div class="logo_wrap">
    							<a href="#"><img src="<?php echo base_url().'assets/logo/'.$logo;?>" alt="<?php echo $company_name;?>" class="logo"></a>
    						</div>
    					</div>
    					<div class="col-md-10">
    						<!--kode nav_2 start-->
    						<div class="nav_2" id="navigation">
    							<ul>
    								<?php echo $this->site_model->get_navigation();?>
		                            <!--<li><a id="simple-menu" href="#sidr"><i class="fa fa-bars"></i></a></li>-->
    							</ul>
    						</div>
    						<!--kode nav_2 end-->
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--kode navigation end-->
		</header>
		<!--HEADER END-->