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
                                    <li><a href="">Home</a></li>
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

                                    <?php echo $about;?>

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

        
          
        </div>
        <!--Content Wrap End-->