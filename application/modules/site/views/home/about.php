<?php
    if(count($contacts) > 0)
    {
        $email = $contacts['email'];
        $facebook = $contacts['facebook'];
        $twitter = $contacts['twitter'];
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

         $mission = $contacts['mission'];
          $vision = $contacts['vision'];
          $about = $contacts['about'];
    }
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="abt_univ_wrap">
					<!-- HEADING 1 START-->
					<div class="kf_edu2_heading1">
						<h3>ABOUT IOD</h3>
					</div>
					<!-- HEADING 1 END-->

					<div class="abt_univ_des">
						<p><?php echo $about;?></p>
						<a href="<?php echo site_url();?>about" class="btn-3">Know More</a>

					</div>
				</div>
			</div>

			<div class="col-md-4">

					 <form>
                        <div class="contact_des">
                             <div class="kf_edu2_heading1">
								<h3>Member sign in</h3>
							</div>
							<div class="abt_univ_des">
	                            <div class="inputs_des des_2">
	                                <input type="email" placeholder="E-mail" required><i class="fa fa-envelope-o"></i>
	                            </div>
	                            <div class="inputs_des des_2">
	                                <input type="password" placeholder="Password" required><i class="fa fa-lock"></i>
	                            </div>
	                            <div class="inputs_des des_3 align-center">
	                                <a href="#"> Forgot password ?</a>
	                            </div>
	                            <div class="inputs_des des_2">
	                                <button type="submit">login</button>
	                            </div>
	                        </div>
                        </div>
                    </form>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
								<!--COURSE CATEGORIES WRAP START-->
								<div class="kf_cur_catg_wrap">
									<!--COURSE CATEGORIES WRAP HEADING START-->
									<div class="col-md-12">
										<div class="kf_edu2_heading1">
											<h3>Course Categories</h3>
										</div>
									</div>
									<!--COURSE CATEGORIES WRAP HEADING END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-1">
											<span><i class="icon-statistics"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Business</h5>
												<p>Business Trends changing with latest courses are available with us.</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-2">
											<span><i class="icon-accounting5"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Accounting</h5>
												<p>Accounting need to be perfect. Come and join with us with best resources.</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-3">
											<span><i class="icon-chemistry29"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Science &amp; Technology</h5>
												<p>Latest technologies online courses are available with new courses. </p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-4">
											<span><i class="icon-caduceus8"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Health &amp; Psychology</h5>
												<p>Learn about the Health &amp; Psychology with the complete presentation. </p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-5">
											<span><i class="icon-cocktail32"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Food &amp; Drinking</h5>
												<p>Get the best eating education and practice by taking online courses.</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-6">
											<span><i class="fa fa-line-chart"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Creative Arts &amp; Media</h5>
												<p>Come and explore your creative arts and media by going further.</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

								</div>
								<!--COURSE CATEGORIES WRAP END-->
							</div>
		</div>

		</div>
	</div>
</section>