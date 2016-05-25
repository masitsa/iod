<!--Banner Wrap Start-->
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
                            <li><a href="<?php echo site_url();?>services">Services</a></li>
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
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget widget-archive ">
                        <h4> SERVICES LISTS</h4>
                        <ul class="sidebar_archive_des">
                            <?php
                            $services = $this->site_model->get_active_services();
                            $checking_items = '';
                            if($services->num_rows() > 0)
                            {   $count = 0;
                                foreach($services->result() as $res)
                                {
                                    $service_name = $res->service_name;
                                    $service_description = $res->service_description;
                                     $mini_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 10));
                                     $maxi_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 30));
                                    $web_name = $this->site_model->create_web_name($service_name);
                                    if($title == $service_name)
                                    {
                                        $item_active = 'active';
                                    }
                                    else
                                    {
                                        $item_active = '';
                                    }
                                    $checking_items .=' <li><a href="'.base_url().'services/'.$web_name.'" > <i class="fa fa-angle-right"></i> '.$service_name.'</a> </li>';
                                }
                            }
                            echo $checking_items;
                            ?>
                           
                        </ul>
                    </div>

                </div>
                <div class="col-md-8">
                    <?php
                    if($services_item->num_rows() > 0)
                    {   
                        foreach($services_item->result() as $res_item)
                        {   $service_name = $res_item->service_name;
                            $service_description = $res_item->service_description;
                            $service_id = $res_item->service_id;
                            $created = $res_item->created;
                           
                        }
                    }
                    $services_gallery = $this->site_model->get_active_service_gallery($service_id);
                    $service_gallery_items = '';
                    if($services_gallery->num_rows() > 0)
                    {   
                        foreach($services_gallery->result() as $res_gallery)
                        {
                            $service_gallery_image_name = $res_gallery->service_gallery_image_name;
                                    
                            $service_gallery_items .=' 
                                                <div class="col-md-4 col-sm-4 ">
                                                    <figure>
                                                        <img alt="" src="'.$service_location.''.$service_gallery_image_name.'">
                                                        <figcaption><a href="'.$service_location.''.$service_gallery_image_name.'"><i class="fa fa-search"></i></a></figcaption>
                                                    </figure>
                                                </div>
                                                ';
                        }
                    }
                    ?>

                    <!-- COURSES DETAIL WRAP START -->
                    <div class="kf_courses_detail_wrap">
                        
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
                        <hr>
                        <div class="course_detail_thumbnail">
                            <figure>
                                <img src="extra-images/course-thumbnail.jpg" alt=""/>
                                <figcaption><a href="#"><i class="fa fa-play"></i></a></figcaption>
                            </figure>
                        </div>
                        <div class="blog_thumb_wrap" style="margin-top:5px;">
                            <div class="kf_edu2_heading1">
                                <h4>SERVICE GALLERY</h4>
                            </div>
                            <div class="row">
                               <?php echo $service_gallery_items;?>
                            </div>
                        </div>
                        
                        <!--KF_BLOG DETAIL_DES END-->


                    </div>
                    <!-- COURSES DETAIL WRAP END -->
                </div>
            </div>
        </div>
    </section>
</div>
<!--Content Wrap End-->