<?php
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
                            <h2>Sign up as a User</h2>
                            <!--FORM FIELD START-->
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
                                <a href="index.html#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>
                                <a href="index.html#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>
                            </div>
                            <!--OPTION END-->
                        </div>
                        <!--SIGNIN AS USER END-->
                        <div class="user-box-footer">
                            Already have an account? <a href="index.html#">Sign In</a>
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
                                <a href="index.html#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>
                                <a href="index.html#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>
                            </div>
                            <!--OPTION END-->
                        
                        </div>
                        <div class="user-box-footer">
                            <p>Don't have an account?<br><a href="index.html#">Sign up as a User</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- SIGNIN MODEL END -->
			
            <div id="sidr">
                <div class="logo_wrap">
                    <a href="index.html#"><img src="<?php echo base_url().'assets/logo/'.$logo;?>" alt="<?php echo $company_name;?>"></a>
                </div>
                <div class="clearfix clear"></div>
                <!-- Your content -->
                <div class="kf-sidebar">
                    <!--KF_SIDEBAR_SEARCH_WRAP START-->
                    <div class="widget widget-search">
                        <h2>Search Course</h2>
                        <form>
                            <input type="search" placeholder="Keyword...">
                        </form>
                    </div>
                    <!--KF_SIDEBAR_SEARCH_WRAP END-->
    
                    <!--KF_SIDEBAR_ARCHIVE_WRAP START-->
                    <div class="widget widget-archive ">
                        <h2>Archives</h2>
                        <ul class="sidebar_archive_des">
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>January 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>February 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>March 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>April 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>May 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>June 2016</a>
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-angle-right"></i>August 2016</a>
                            </li>
                        </ul>
                    </div>
                    <!--KF_SIDEBAR_ARCHIVE_WRAP END-->
    
                    <p class="copy-right-sidr">Design and Developed by KodeForest @ All Rights Reserved by KodeForest</p>
                </div>
            </div>
			
		<!--HEADER START-->
    	<header id="header_2">
    		<!--kode top bar start-->
    		<div class="top_bar_2">
	    		<div class="container">
	    			<div class="row">
	    				<div class="col-md-5">
	    					<div class="pull-left">
	    						<em class="contct_2"><i class="fa fa-phone"></i> Call Us  on <?php echo $phone;?></em>
	    					</div>
	    				</div>
	    				<div class="col-md-7">
    						<div class="lng_wrap">
	    						<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<i class="fa fa-globe"></i>Language
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li><a href="index.html#"><i><img src="<?php echo base_url()."assets/themes/uoe/";?>images/english.jpg" alt=""></i>English</a></li>
										<li><a href="index.html#"><i><img src="<?php echo base_url()."assets/themes/uoe/";?>images/german.jpg" alt=""></i>German</a></li> 
									</ul>
								</div>
	    					</div>
    						<ul class="login_wrap">
    							<li><a href="index.html#" data-toggle="modal" data-target="#reg-box"><i class="fa fa-user"></i>Register</a></li>
    							<li><a href="index.html#" data-toggle="modal" data-target="#signin-box"><i class="fa fa-sign-in"></i>Sign In</a></li>
    						</ul>	    					
	    					<ul class="top_nav">
	    						<?php echo $this->site_model->get_navigation();?>
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
		                            <li><a id="simple-menu" href="#sidr"><i class="fa fa-bars"></i></a></li>
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