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
<!--search bar start-->
<div class="kf_content_wrap overflow_visible">
    <div class="search_bar_outer_wrap">
    <section>
        <div class="container">

            <div class="row">
                <?php
                    $services = $this->site_model->get_active_services();
                    $checking_items = '';
                    if($services->num_rows() > 0)
                    {   $count = 0;
                        foreach($services->result() as $res)
                        {
                            $service_name = $res->service_name;
                            $service_description = $res->service_description;
                             $mini_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 100));
                             $maxi_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 40));
                            $web_name = $this->site_model->create_web_name($service_name);

                            $count ++;

                            $checking_items .=
                                            '
                                            <div class="col-md-4 col-sm-6">
                                                <div class="edu2_col_3_wrap">
                                                    <figure>
                                                        <img src="extra-images/col-3-thum2.jpg" alt=""/>
                                                        <figcaption><a href="#"><i class="fa fa-play"></i></a></figcaption>
                                                    </figure>
                                                    <div class="edu2_col_3_des">
                                                        <h6>'.$service_name.'</h6>
                                                        <p>'.$maxi_desc.' </p>
                                                        <div class="video_link_wrap">
                                                            <a href="'.base_url().'director-development/'.$web_name.'">Read More</a>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>'; 
                           
                        }
                    }
                    echo $checking_items;
                ?>

            </div>
        </div>
    </section>
<!--Content Wrap End-->