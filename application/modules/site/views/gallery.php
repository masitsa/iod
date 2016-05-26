<?php
    $gallery = $this->site_model->get_active_service_gallery_names();
    $gallery_items_names = ' <li><a data-value="all">All</a></li>';
    if($gallery->num_rows() > 0)
    {   
        foreach($gallery->result() as $res_gallery)
        {
            $gallery_name = $res_gallery->gallery_name;
                    

                   
            $gallery_items_names .=' <li><a data-value="'.$gallery_name.'">'.$gallery_name.'</a></li>';
        }
    }

    $gallery_div = $this->site_model->get_active_gallery();
    $gallery_items = '';
    if($gallery_div->num_rows() > 0)
    {   
        foreach($gallery_div->result() as $res_gallery_div)
        {
            $gallery_name = $res_gallery_div->gallery_name;
            $gallery_image_name = $res_gallery_div->gallery_image_name;
            $gallery_image_thumb = $res_gallery_div->gallery_image_thumb;

             $gallery_items .=
                                    '
                                    <div class="filterable-item all '.$gallery_name.' col-md-3 col-sm-4 col-xs-12">
                                        <div class="edu_masonery_thumb">
                                            <img src="'.$gallery_location.''.$gallery_image_name.'" alt=""/>
                                            <div class="caption"><a href="'.$gallery_location.''.$gallery_image_name.'">'.$gallery_name.'</a></div>
                                            <a href="'.$gallery_location.''.$gallery_image_name.'" data-rel="prettyPhoto[gallery2]" class="zoom"><i class="fa fa-search"></i></a>
                                        </div>  
                                    </div>
                                    ';      
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
                        <h3>gallery</h3>
                    </div>
                   
                    <div class="kf_inr_breadcrumb">
                        <ul>
                            
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
            
    <div class="gallery-masonery_page gallery inner-content-holder">
        <div class="container">
            <div class="row">
                <ul id="filterable-item-filter-1">
                    <?php echo $gallery_items_names;?>
                </ul>

                <div id="filterable-item-holder-1">
                    <?php echo $gallery_items;?>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="loadmore">
                <a href="gallery-masonary-4col.html#" class="btn-3">load more</a>
            </div>
        </div> -->
    </div>
        
</div>
<!--Content Wrap End-->

