<?php
$result = ''; 
if($query->num_rows() > 0)
{
	foreach($query->result() as $cat)
	{
		$training_id = $cat->training_id;
		$training_status = $cat->training_status;
		$training_date = $cat->training_date;
		$start_date = $cat->start_date;
		$end_date = $cat->end_date;
		$created = $cat->created;
		$training_name = $cat->training_name;
		$training_image_name = $cat->training_image_name;
		$training_description = $cat->training_description;
		$trainees = $this->training_model->get_attendees($training_id);
		$registered_attendees = $trainees->num_rows();
		
		$v_data['training_id'] = $training_id;
		$v_data['trainees'] = $trainees;
		$start_date = date('jS M Y',strtotime($start_date));
		$end_date = date('jS M Y',strtotime($end_date));
		$created = date('jS M Y',strtotime($created));
		$day = date('d',strtotime($start_date));
		$month = date('M',strtotime($start_date));
	}
}
?>
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                	<div class="inr_banner_heading">
						<h3><?php echo $title;?></h3>
                	</div>
                   
                    <div class="kf_inr_breadcrumb">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Events</a></li>
							<li><a href="#"><?php echo $title;?></a></li>
						</ul>
					</div>
                </div>
                <!--KF INR BANNER DES Wrap End-->
            </div>
        </div>
    </div>
</div>
<div class="kf_content_wrap">
<section>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8">

				<!--EVENT CONVOCATION OUTER Wrap START-->
				<div class="kf_convocation_outer_wrap">	
					<div class="convocation_slider">
						<figure>
							<img src="<?php echo $training_location;?>/<?php echo $training_image_name;?>" alt=""/>
						</figure>
					</div>

					<!--EVENT CONVOCATION  Wrap START-->
					<div class="kf_convocation_wrap">
						<h4><span><?php echo $title;?></span> </h4>
						<ul class="convocation_timing">
							<li><i class="fa fa-calendar"></i><?php echo $start_date;?> to: <?php echo $end_date;?></li>
							<li><i class="fa fa-clock-o"></i>10:00 am - 04:00 pm</li>
						</ul>

						<!--EVENT CONVOCATION DES START-->
						<div class="kf_convocation_des">
							<p><?php echo $training_description;?></p>
							<a href="#"><i class="fa fa-plus"></i>Google Calender</a>
							<a href="#"><i class="fa fa-plus"></i>Local Expert</a>

							<!--EVENT CONVOCATION MAP  Wrap START-->
							<div class="kf_convocation_map">
								 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8527541847375!2d36.78480584990425!3d-1.2605522359486399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1763f94bbe07%3A0x99634989c4997a05!2sAll+Africa+Conference+of+Churches!5e0!3m2!1sen!2ske!4v1464154893311" width="600" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
								<a href="#" class="convocation_link">Book Now</a>
								<a href="#" class="convocation_link">Organizer</a>
								<a href="#" class="convocation_link">Venue</a>
							</div>
							<!--EVENT CONVOCATION MAP  Wrap END-->

						</div>
						<!--EVENT CONVOCATION DES END-->

					</div>
					<!--EVENT CONVOCATION  Wrap END-->

					<!--EVENT SPEAKER Wrap START-->
					<div class="kf_event_speakers">
						<div class="heading_5">
							<h4><span>Event</span> Speakers</h4>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="kf_event_speakers_des">
									<figure><img alt="" src="extra-images/event-sp.jpg"></figure>
									<h5><a href="#">Jim Taylor</a></h5>
									<p>Speaker</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4">
								<div class="kf_event_speakers_des">
									<figure><img alt="" src="extra-images/event-sp2.jpg"></figure>
									<h5><a href="#">Alberta Doe</a></h5>
									<p>Speaker</p>
								</div>
							</div>

							<div class="col-md-4 col-sm-4">
								<div class="kf_event_speakers_des">
									<figure><img alt="" src="extra-images/event-sp3.jpg"></figure>
									<h5><a href="#">Jim Taylor</a></h5>
									<p>Speaker</p>
								</div>
							</div>
						</div>
					</div>
					<!--EVENT SPEAKER Wrap End-->

					<!--EVENT GALLERY Wrap STAT-->
					<div class="kf_event_gallery">
						<div class="heading_5">
							<h4><span>Event</span> Gallery</h4>
						</div>
						<ul class="event_gallery_des">
							<li><a href="#"><img alt="" src="extra-images/event_gallery1.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery2.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery3.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery4.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery5.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery6.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery7.jpg"></a></li>
							<li><a href="#"><img alt="" src="extra-images/event_gallery8.jpg"></a></li>
						</ul>
						<a href="#" class="event_link next">NEXT EVENT<i class="fa fa-angle-right"></i></a>
						<a href="#" class="event_link prev"><i class="fa fa-angle-left"></i>PREVIOUS EVENT</a>
					</div>
					<!--EVENT GALLERY Wrap End-->

				</div>
				<!--EVENT CONVOCATION OUTER Wrap END-->

			</div>

			<!--KF_EDU_SIDEBAR_WRAP START-->
			<div class="col-md-4">
				<div class="kf-sidebar">

					<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP START-->
					<div class="widget widget-categories">
						<h2>Categories</h2>
						<ul class="blog">
							<li><a href="event-detail.html"><i class="fa fa-caret-right"></i>Seminars</a></li>
							<li><a href="event-detail.html"><i class="fa fa-caret-right"></i>Conferences</a></li>
							<li><a href="event-detail.html"><i class="fa fa-caret-right"></i>Special Events</a></li>
						</ul>
					</div>
					<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP END-->

				</div>
			</div>
			<!--KF EDU SIDEBAR WRAP END-->

		</div>
	</div>
</section>
</div>

<!--Banner Wrap End-->