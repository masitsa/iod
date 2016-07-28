<!--Banner Wrap Start-->
<div class="kf_inr_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<!--KF INR BANNER DES Wrap Start-->
                <div class="kf_inr_ban_des">
                	<div class="inr_banner_heading">
						<h3>Calendar</h3>
                	</div>
                   
                    <div class="kf_inr_breadcrumb">
						<ul>
							<?php echo $this->site_model->get_breadcrumbs();?>
						</ul>
					</div>
                </div>
                <!--KF INR BANNER DES Wrap End-->
            </div>
        </div>
    </div>
</div>

<!--Banner Wrap End-->
<?php
$result = ''; 
if($query->num_rows() > 0)
{
	foreach($query->result() as $value)
	{
		$event_type_name = $value->event_type_name;
		$event_name = $value->event_name;
		$event_web_name = $value->event_web_name;
		$start_date = $value->event_start_time;
		$end_date = $value->event_end_time;

		$start_date = date('jS M Y',strtotime($start_date));
		$month = date('M',strtotime($start_date));
		$day = date('d',strtotime($start_date));
		$end_date = date('jS M Y',strtotime($end_date));

		$result .= '
					<div class="col-md-6">
						<div class="edu2_event_wrap">
							<div class="edu2_event_des">
								<h4>'.$month.'</h4>
								<p>'.$event_name.'</p>
								<ul class="post-option">
									<li><strong>From :</strong> '.$start_date.' <strong>To: </strong> '.$end_date.'</li>
									<li>10 <a href="'.site_url().'calendar/'.$event_type_name.'/'.$event_web_name.'/comments">Comments</a></li>
								</ul>
								<a class="readmore" href="'.site_url().'calendar/'.$event_type_name.'/'.$event_web_name.'">read more<i class="fa fa-long-arrow-right"></i></a>
								<span> '.$day.'</span>
							</div>
								
							<figure><img alt="" src="'.base_url().'assets/images/iod_logo_cropped.jpg">
								<figcaption><a href="'.site_url().'calendar/'.$event_type_name.'/'.$event_web_name.'"><i class="fa fa-plus"></i></a></figcaption>
							</figure>
						</div>
					</div>

				
					';
		
	}
}
else
{
	$result = 'There are no caledar items';
}

?>
<!--Content Wrap Start-->
<div class="kf_content_wrap">
	<section class="our_event_page">
		<div class="container">
			<div class="row">

				<!-- HEADING 2 START-->
				<div class="col-md-12">
					<div class="kf_edu2_heading2">
						<h3>Upcoming</h3>
					</div>
				</div>
				<!-- HEADING 2 END-->
				<div class="row">
                	<div class="col-md-4 col-md-offset-4">
                		<a class="btn-3" href="<?php echo site_url().'assets/resource/IoDCalendar2016.pdf';?>" target="_blank">Download Full Calendar</a>
                    </div>
                </div>
				<?php echo $result;?>
				<div class="row">
                	<div class="col-md-4 col-md-offset-4">
                		<a class="btn-3" href="<?php echo site_url().'assets/resource/IoDCalendar2016.pdf';?>" target="_blank">Download Full Calendar</a>
                    </div>
                </div>
				<div class="col-md-12">
					<!--KF_PAGINATION_WRAP START-->
					<div class="kf_edu_pagination_wrap">
						<?php if(isset($links)){echo $links;}?>
					</div>
					<!--KF_PAGINATION_WRAP END-->
				</div>

			</div>
		</div>
	</section>
</div>
<!--Content Wrap End-->