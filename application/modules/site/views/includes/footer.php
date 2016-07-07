<?php
$contacts = $this->site_model->get_contacts();
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$facebook = $contacts['facebook'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
        $address = $contacts['address'];
        $post_code = $contacts['post_code'];
        $city = $contacts['city'];
        $building = $contacts['building'];
        $floor = $contacts['floor'];
        $location = $contacts['location'];

         $working_weekday = $contacts['working_weekday'];
        $working_weekend = $contacts['working_weekend'];
	}
	$tweets = $this->site_model->get_tweets();
?>


		<!--NEWS LETTERS START-->
		<div class="edu2_ft_topbar_wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="edu2_ft_topbar_des">
							<h5>Subcribe weekly newsletter</h5>
						</div>
					</div>
					<div class="col-md-6">
						<div class="edu2_ft_topbar_des">
							<form>
								<input type="email" placeholder="Enter Valid Email Address">
								<button><i class="fa fa-paper-plane"></i>Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--NEWS LETTERS END-->
		<!--FOOTER START-->
		<footer>
			<!--EDU2 FOOTER CONTANT WRAP START-->
				<div class="container">
					<div class="row">
						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-links">
								<h5>Let's Get Social</h5>
								<ul>
									<li>
                                        <a href="https://twitter.com/IODKenya">
                                            <i class="fa fa-twitter"></i> @IODKenya
                                        </a>
                                    </li>
									<li>
                                        <a href="https://web.facebook.com/IODKenya">
                                            <i class="fa fa-facebook"></i> Institute of Directors Kenya
                                        </a>
                                    </li>
									<li>
                                    <a href="https://www.linkedin.com/groups/3239622">
                                        <i class="fa fa-linkedin"></i> Institute of Directors Kenya
                                    </a>
                    				</li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-links">
								<h5>Business Hours</h5>
								<ul>
									<li>
                                        <a href="#">Monday-Friday: <?php echo $working_weekday;?></a>
                                    </li>
                                    <li>
                                        <a href="#">Saturday / Sunday: <?php echo $working_weekend;?></a>
                                    </li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget wiget-instagram">
								<h5>Twitter Feed</h5>
								<?php //echo $tweets;?>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-contact">
								<h5>Contact</h5>
								<ul>
									<li>Location : <a href="#"><?php echo $location;?> <?php echo $building;?> <?php echo $floor;?></a></li>
									<li>P.O. Box <?php echo $address;?> - <?php echo $post_code;?> <?php echo $city;?></li>
									<li>Phone : <a href="#"><?php echo $phone;?></a></li>
									<li>Email : <a href="#"><?php echo $email;?></a></li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->
					</div>
				</div>
		</footer>
		<!--FOOTER END-->
		<!--COPYRIGHTS START-->
		<div class="edu2_copyright_wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="edu2_ft_logo_wrap">
							<a href="#"><img alt="" src="<?php echo site_url().'assets/images/acgn';?>.png"></a>
						</div>
					</div>

					<div class="col-md-6">
						<div class="copyright_des">
							<span>&copy; All Rights reserved. Powered By <a href="https://www.omnis.co.ke">Omnis Limited</a></span>
						</div>
					</div>

					<div class="col-md-3">
						
					</div>
				</div>
			</div>
		</div>
		<!--COPYRIGHTS START-->
