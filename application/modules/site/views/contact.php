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
		$address = $contacts['address'];
		$post_code = $contacts['post_code'];
		$city = $contacts['city'];
		$building = $contacts['building'];
		$floor = $contacts['floor'];
		$location = $contacts['location'];
		
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
		$address = '';
		$post_code = '';
		$city = '';
		$building = '';
		$floor = '';
		$location = '';
	}
?>

<!--Content Wrap Start-->
<div class="kf_content_wrap">
    <!--LOCATION MAP Wrap Start-->
    <div class="kf_location_wrap overlay">
        <div id="map-canvas" class="map-canvas">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8527541847375!2d36.78480584990425!3d-1.2605522359486399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1763f94bbe07%3A0x99634989c4997a05!2sAll+Africa+Conference+of+Churches!5e0!3m2!1sen!2ske!4v1464154893311" width="600" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="location_des">
            <h6><?php echo $company_name;?></h6>
            <ul class="location_meta">
                <li><i class="fa fa-phone"></i> <a href="#"><?php echo $phone;?></a></li>
                <li><i class="fa fa-map-marker"></i>  P.O.Box (<?php echo $post_code;?>) <?php echo $address;?>, <?php echo $location;?> <?php echo $building?> <?php echo $floor;?></li>
                <li><i class="fa fa-envelope-o"></i>  <a href="#"> <?php echo $email;?></a></li>
            </ul>
        </div>
    </div>
    <!--LOCATION MAP Wrap END-->
    <section>
        <div class="container">
            <div class="contct_wrap">
                <div class="row">
                    <div class="col-md-8">
                        <form>
                            <div class="contact_des">
                                 <div class="contact_heading">
                                    <h4>Contact info</h4>
                                </div>
                                <div class="inputs_des des_2">
                                    <input type="text" placeholder="Name" required><i class="fa fa-user"></i>
                                </div>

                                <div class="inputs_des des_2">
                                    <input type="email" placeholder="E-mail" required>
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="inputs_des des_2">
                                    <input type="text" placeholder="Phone" required>
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="inputs_des des_3">
                                    <textarea></textarea>
                                    <i class="fa fa-comments-o"></i>
                                </div>
                                <div class="inputs_des des_2">
                                    <button type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="contact_heading">
                            <h4>Contact info</h4>
                        </div>
                        <ul class="contact_meta">
                            <li><i class="fa fa-home"></i> P.O.Box (<?php echo $post_code;?>) <?php echo $address;?>, <?php echo $location;?> <?php echo $building?> <?php echo $floor;?></li>
                            <li><i class="fa fa-phone"></i><a href="contactus-2.html#"> <?php echo $phone;?></a></li>
                            <li><i class="fa fa-envelope-o"></i><a href="contactus-2.html#"> I<?php echo $email;?></a></li>
                        </ul>
                        <div class="contact_heading social">
                            <h4>Get Social</h4>
                        </div>
                        <ul class="cont_socil_meta">
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--Content Wrap End-->
   