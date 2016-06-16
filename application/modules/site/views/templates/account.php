<?php
	$contacts = $this->site_model->get_contacts();
	//$banners = $this->banner_model->get_banners($this->session->userdata('customer_id'));
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
			$facebook = '<li class="facebook"><a href="'.$facebook.'" target="_blank" title="Facebook">Facebook</a></li>';
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
	
	if(!isset($website))
	{
		$website = '';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/";?>themes/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/megacourse/";?>css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/megacourse/";?>css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/megacourse/";?>css/md-font.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/megacourse/";?>css/style.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/jquery-1.11.0.min.js"></script>
</head>
<body id="page-top">

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="pre-icon">
            <div class="pre-item pre-item-1"></div>
            <div class="pre-item pre-item-2"></div>
            <div class="pre-item pre-item-3"></div>
            <div class="pre-item pre-item-4"></div>
        </div>
    </div>
    <!-- END / PRELOADER -->

   <?php echo $this->load->view("site/includes/accounts/navigation","",TRUE);?>
   <?php echo $this->load->view("member/account/member_details","",TRUE);?>
	<?php echo $this->load->view("member/account/acount_navigation","",TRUE);?>
    <?php echo $content;?>
    
   <?php echo $this->load->view("site/includes/accounts/footer");?>
</div>
<!-- END / PAGE WRAP -->

<!-- Load jQuery -->

<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/megacourse/";?>js/scripts.js"></script>

</body>
</html>