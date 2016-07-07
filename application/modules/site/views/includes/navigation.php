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
    							<li><a href="tel:<?php echo $phone;?>"><em class="contct_2"><i class="fa fa-phone"></i> Call Us  on <?php echo $phone;?></em></a></li>
    							<li><a href="<?php echo site_url().'register';?>"><i class="fa fa-user"></i>Register</a></li>
    							<li><a href="<?php echo site_url().'login';?>" data-toggle="modal"><i class="fa fa-sign-in"></i>Sign In</a></li>
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