<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?php echo $this->load->view('site/includes/header', '', TRUE); ?>
    <!-- end of head -->
    
    <body>
        <!--KF KODE WRAPPER WRAP START-->
        <div class="kode_wrapper">
        	
            <?php echo $this->load->view('site/includes/navigation', '', TRUE); ?>
            
            <!-- content -->
			<?php echo $content;?>
            <!-- end of content -->
        	
            <!-- start of footer -->
            <?php echo $this->load->view('site/includes/footer', '', TRUE); ?>
            <!--end of footer -->
        </div>
    	<!--KF KODE WRAPPER WRAP END-->
        
        <!--Bootstrap core JavaScript-->
		<script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.js"></script>
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/bootstrap.min.js"></script>
        <!--Bx-Slider JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.bxslider.min.js"></script>
        <!--Owl Carousel JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/owl.carousel.min.js"></script>
        <!--Pretty Photo JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.prettyPhoto.js"></script>
        <!--Full Calender JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/moment.min.js"></script>
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/fullcalendar.min.js"></script>
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.downCount.js"></script>
        <!--Image Filterable JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery-filterable.js"></script>
        <!--Accordian JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.accordion.js"></script>
        <!--Number Count (Waypoints) JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/waypoints-min.js"></script>
        <!--v ticker-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.vticker.min.js"></script>
        <!--select menu-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.selectric.min.js"></script>
        <!--Side Menu-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/jquery.sidr.min.js"></script>
        <!--Custom JavaScript-->
        <script src="<?php echo base_url()."assets/themes/uoe/";?>js/custom.js"></script>
        
	</body>
</html>
