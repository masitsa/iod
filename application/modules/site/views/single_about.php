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
        if($services->num_rows() > 0)
        {   $count = 0;
            foreach($services->result() as $res)
            {
                $service_name = $res->service_name;
                $service_description = $res->service_description;
                $mini_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 100));
                $maxi_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 40));
                $web_name = $this->site_model->create_web_name($service_name);
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
                                <!-- <h3><?php echo $title?></h3> -->
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

        <!--Content Wrap Start-->
        <div class="kf_content_wrap">
                    
            <!--ABOUT UNIVERSITY START-->
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="abt_univ_wrap">
                                <!-- HEADING 1 START-->
                                <div class="kf_edu2_heading1">
                                    <h3><?php echo $service_name;?></h3>
                                </div>
                                <!-- HEADING 1 END-->

                                <div class="abt_univ_des">

                                    <?php echo $service_description;?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--ABOUT UNIVERSITY END-->
        </div>
        <!--Content Wrap End-->