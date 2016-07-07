<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php echo $this->load->view('home/slider', '', TRUE); ?>
        </div>
        <div class="col-md-4">
            <?php echo $this->load->view('home/recent_events', '', TRUE); ?>
        </div>
    </div>
</div>

<?php 
	echo $this->load->view('home/about', '', TRUE); 
 // echo $this->load->view('home/trainings', '', TRUE); 
?>
<?php
// echo $this->load->view('home/gallery', '', TRUE); 
?>
<?php 

//echo $this->load->view('home/register', '', TRUE); ?>
<?php echo $this->load->view('home/partners','',TRUE);?>
<?php //echo $this->load->view('home/testimonials', '', TRUE); ?>