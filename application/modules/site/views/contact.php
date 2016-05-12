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

 <div class="page-header page-title-left page-title-pattern">
 	<div class="image-bg content-in fixed" data-background="<?php echo base_url()?>assets/img/top_page2.jpg"><div class="overlay-dark"></div></div>
    <div class="container" id="breadcrum-modification" style="padding-top: 60px;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title white"><?php echo $title?></h1>
                <h5></h5>
                <ul class="breadcrumb">
                    <?php echo $this->site_model->get_breadcrumbs();?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- page-header -->

<section id="contact-us" class="page-section">

    <div class="container">

        <div class="row">

            <div class="col-sm-6 col-md-6">

                <div class="row">

                    <div class="col-sm-6 col-md-6">

                        <h5 class="title">

                        <i class="icon-address text-color"></i>Mailing Address</h5>

                        <?php echo $location;?>, <?php echo $building;?>, <?php echo $floor;?>

                        <br />P.O. <?php echo $address;?> - <?php echo $post_code;?>

                        <br /><?php echo $city?>, Kenya.

                    </div>

                    <div class="col-sm-6 col-md-6">

                        <h5 class="title">

                        <i class="icon-contacts text-color"></i>Contact Info</h5>

                        <div>Phone : <?php echo $phone;?></div>

                        <div>Mobile : <?php echo $phone;?></div>

                        <div>Email : 

                        <a href="mailto:support@yoursite.com"><?php echo $email;?></a></div>

                    </div>

                </div>

                <hr />
                <?php

                if ($items->num_rows() > 0)
                {   
                   $counter = 0;
                   $item_data = "";
                    foreach ($items->result() as $row)
                    {
                        $counter++;
                        $post_id = $row->post_id;
                        $blog_category_name = $row->blog_category_name;
                        $blog_category_id = $row->blog_category_id;
                        $post_title = $row->post_title;
                        $web_name = $this->site_model->create_web_name($post_title);
                        $post_status = $row->post_status;
                        $post_views = $row->post_views;
                        $image = base_url().'assets/images/posts/'.$row->post_image;
                        if($row->post_image == "" || $row->post_image == NULL)
                        {
                            // $image ="http://placehold.it/450x250?text=Comparison+graph";
                            $image = base_url().'assets/themes/metal/img/sections/bg/intro.jpg';
                        }
                        $created_by = $row->created_by;
                        $modified_by = $row->modified_by;
                        $description = $row->post_content;
                        $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 250));
                        $created = $row->created;
                        $day = date('j',strtotime($created));
                        $month = date('M Y',strtotime($created));
                        $created_on = date('jS M Y',strtotime($row->created));
                        
                        $categories = '';
                        $item_data ='<p class="description upper">'.$mini_desc.'</p>';
                    }
                }
                echo $item_data;
                ?>

               

            </div>

            <div class="col-md-6 col-md-6">

                <h3 class="title">Contact Form</h3>

				<p class="form-message"></p>

                <div class="contact-form">

                    <!-- Form Begins -->

					<form role="form" name="contactform" id="contactform" method="post" action="php/contact-form.php">

                        <div class="row">

                            <div class="col-md-6">

                                <!-- Field 1 -->

                                <div class="input-text form-group">

                                    <input type="text" name="contact_name" id="contact_name" class="input-name form-control"

                                    placeholder="Full Name" />

                                </div>

                            </div>

                            <div class="col-md-6">

                                <!-- Field 2 -->

                                <div class="input-email form-group">

                                    <input type="email" name="contact_email" id="contact_email" class="input-email form-control"

                                    placeholder="Email" />

                                </div>

                            </div>

                        </div>

                        <!-- Field 3 -->

                        <div class="input-email form-group">

                            <input type="text" name="contact_phone" id="contact_phone" class="input-phone form-control" placeholder="Phone" />

                        </div>

                        <!-- Field 4 -->

                        <div class="textarea-message form-group">

                            <textarea name="contact_message" id="contact_message" class="textarea-message form-control" placeholder="Message"

                            rows="6"></textarea>

                        </div>

                        <!-- Button -->

                        <button id="test-btn" class="btn btn-default" type="submit">Send Now 

                        <i class="icon-paper-plane"></i></button>

					</form>

                    <!-- Form Ends -->

                </div>

            </div>

        </div>

    </div>

</section>

<!-- page-section -->

<section id="map">

    <div class="map-section">

        <div class="map-canvas" data-zoom="12" data-lat="-1.2196369" data-lng="36.8863984" data-type="roadmap"

        data-title="Austin"

        data-content="Olinet Apartments Off Thika Road&lt;br&gt; Contact: +254736590509 &lt;br&gt; &lt;a href=&#39;mailto: info@setson.co.ke&#39;&gt; info@setson.co.ke&lt;/a&gt;"

        style="height: 376px;"></div>

    </div>

</section>

<!-- map -->

<div id="get-quote" class="bg-color black text-center">

    <div class="container">

        <div class="row get-a-quote">

            <div class="col-md-12">Get A Free Quote / Need Help ? 

            <a class="black" href="#">Contact Us</a></div>

        </div>

        <div class="move-top bg-color page-scroll">

            <a href="#page">

                <i class="glyphicon glyphicon-arrow-up"></i>

            </a>

        </div>

    </div>

</div>

<!-- request -->