<?php 
	
	if(!isset($contacts))
	{
		$contacts = $this->site_model->get_contacts();
	}
	$data['contacts'] = $contacts; 

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        	
		<title>IOD | <?php echo $title;?></title>
        
        <!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="keywords" content="Dobi wash laundry" />
		<meta name="description" content="Dobi">
		<meta name="author" content="Dobi">

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url()."assets/themes/porto/";?>img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="<?php echo base_url()."assets/themes/porto/";?>img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
      <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bootstrap/";?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/themes/";?>fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/themes/";?>custom/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/themes/";?>custom/custom.css">
        
		<!--[if lt IE 9]>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo base_url()."assets/themes/custom/";?>jquery-2.2.3.min.js"></script>
		<!--<![endif]-->
    </head>

	<body>
    
    	<input type="hidden" id="base_url" value="<?php echo site_url()?>"/>
    	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
    	<div class="body">
            <!-- Top Navigation -->
            <?php //echo $this->load->view('site/includes/top_navigation', $data, TRUE); ?>
            
            <?php echo $content;?>
            
            <?php //echo $this->load->view('site/includes/footer', $data, TRUE); ?>
        </div>
        
        <!-- Vendor -->
		<script src="<?php echo base_url()."assets/themes/bootstrap/";?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()."assets/themes/custom/";?>bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url()."assets/themes/custom/";?>custom.js"></script>
	</body>
</html>
