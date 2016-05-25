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
    }
?>

  <?php
        //if users exist display them
        $item_data = "";
        if ($items->num_rows() > 0)
        {   
           $counter = 0;
           
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
                $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
                $created = $row->created;
                $day = date('j',strtotime($created));
                $month = date('M Y',strtotime($created));
                $created_on = date('jS M Y',strtotime($row->created));
                
                $categories = '';
                $item_data ='<p class="description upper">'.$description.'</p>';
            }
        }
        ?>


 <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                            <div class="inr_banner_heading">
                                <h3><?php echo $title?></h3>
                            </div>
                           
                            <div class="kf_inr_breadcrumb">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">about us</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->

        <!--Content Wrap Start-->
        <div class="kf_content_wrap">
                    
            <!--ABOUT UNIVERSITY START-->
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="abt_univ_wrap">
                                <!-- HEADING 1 START-->
                                <div class="kf_edu2_heading1">
                                    <h3>Welcome To <?php echo $company_name;?></h3>
                                </div>
                                <!-- HEADING 1 END-->

                                <div class="abt_univ_des">

                                    <?php echo $item_data;?>
                                    <a href="#" class="btn-3">Know More</a>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                        <!-- INTERO DES START-->
                            <div class="abt_univ_des">
                                <h6>Our Mission</h6>
                                <p><?php echo $mission;?></p>
                            </div>
                        <!-- INTERO DES END-->
                            <div class="abt_univ_des">
                                <h6>Our Vision</h6>
                                <p><?php echo $vision;?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--ABOUT UNIVERSITY END-->


            <!--KF INTRO WRAP START-->
            <section class="abut-padiing">
                <div class="kf_intro_des_wrap aboutus_page">
                    <div class="container">
                        <div class="row">
                            <!-- HEADING 2 START-->
                            <div class="col-md-12">
                                <div class="kf_edu2_heading2">
                                    <h3>our services</h3>
                                </div>
                            </div>
                            <!-- HEADING 2 END-->

                            <div class="col-md-3 col-sm-6">
                                <!-- INTERO DES START-->
                                <div class="kf_intro_des">
                                    <div class="kf_intro_des_caption">
                                        <span><i class=" icon-earth132 "></i></span>
                                        <h6>Corporate Governance</h6>
                                        <p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris itae erat.</p>
                                        <a href="#">view more</a>
                                    </div>
                                </div>
                                <!-- INTERO DES END-->
                            </div>

                           
                        </div>
                    </div>
                </div>
            </section>
            <!--KF INTRO WRAP END-->

          

            <!-- FACULTY WRAP START-->
            <section>
                <div class="container">
                    <div class="row">
                        <!-- HEADING 1 START-->
                        <div class="col-md-12">
                            <div class="kf_edu2_heading1">
                                <h3>Our Partners</h3>
                            </div>
                        </div>
                        <!-- HEADING 1 END-->

                        <!-- FACULTY SLIDER WRAP START-->
                        <div class="edu2_faculty_wrap">
                            <div id="owl-demo-8" class="owl-carousel owl-theme">
                                <div class="item">
                                    <!-- FACULTY DES START-->
                                    <div class="edu2_faculty_des">
                                        <figure><img src="extra-images/faculty-mb1.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </figcaption>
                                        </figure>
                                        <div class="edu2_faculty_des2">
                                            <h6><a href="#">Simon Grishaber</a></h6>
                                           
                                        </div>
                                    </div>
                                    <!-- FACULTY DES END-->
                                </div>

                                <div class="item">
                                    <!-- FACULTY DES START-->
                                    <div class="edu2_faculty_des">
                                        <figure><img src="extra-images/faculty-mb2.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </figcaption>
                                        </figure>
                                        <div class="edu2_faculty_des2">
                                            <h6><a href="#">Simon Grishaber</a></h6>
                                           
                                        </div>
                                    </div>
                                    <!-- FACULTY DES END-->
                                </div>

                                <div class="item">
                                    <!-- FACULTY DES START-->
                                    <div class="edu2_faculty_des">
                                        <figure><img src="extra-images/faculty-mb3.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </figcaption>
                                        </figure>
                                        <div class="edu2_faculty_des2">
                                            <h6><a href="#">Simon Grishaber</a></h6>
                                           
                                        </div>
                                    </div>
                                    <!-- FACULTY DES END-->
                                </div>

                                <div class="item">
                                    <!-- FACULTY DES START-->
                                    <div class="edu2_faculty_des">
                                        <figure><img src="extra-images/faculty-mb4.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </figcaption>
                                        </figure>
                                        <div class="edu2_faculty_des2">
                                            <h6><a href="#">Simon Grishaber</a></h6>
                                           
                                        </div>
                                    </div>
                                    <!-- FACULTY DES END-->
                                </div>

                                <div class="item">
                                    <!-- FACULTY DES START-->
                                    <div class="edu2_faculty_des">
                                        <figure><img src="extra-images/faculty-mb1.jpg" alt=""/>
                                            <figcaption>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </figcaption>
                                        </figure>
                                        <div class="edu2_faculty_des2">
                                            <h6><a href="#">Simon Grishaber</a></h6>
                                           
                                        </div>
                                    </div>
                                    <!-- FACULTY DES END-->
                                </div>
                            </div>
                        </div>
                        <!-- FACULTY SLIDER WRAP END-->
                    </div>
                </div>
            </section>
            <!-- FACULTY WRAP START-->
        </div>
        <!--Content Wrap End-->