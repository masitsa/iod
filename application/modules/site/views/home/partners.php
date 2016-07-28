<section>
    <div class="container">
        <div class="row">
            <!-- HEADING 1 START-->
            <div class="col-md-12">
                <div class="kf_edu2_heading2">
                    <h3>Our Corporate Members</h3>
                </div>
                
                <div class="edu2_main_bn_wrap">
                    <div id="owl-partners-main" class="owl-carousel owl-theme">
                        <?php
						
                        if($corporates->num_rows() > 0)
                        {
                            foreach($corporates->result() as $row)
                            {
                                $corporates_name = $row->corporates_name;
								$description = $row->corporates_description;
								$corporates_image = $row->corporates_image_name;
								$corporates_link = $row->corporates_link;
								$corporates_button_text = $row->corporates_button_text;
								$description = $this->site_model->limit_text($description, 8);
                                
                                ?>
                                <div class="item">
                                    <figure>
                                        <img src="<?php echo $corporates_location.''.$corporates_image;?>" alt="<?php echo $corporates_name;?>"/>
                                        <!--<figcaption>
                                            <h2><?php echo $corporates_name;?></h2>
                                            <a href="<?php echo $corporates_link;?>" class="btn-1" target="_blank">View more</a>
                                        </figcaption>-->
                                    </figure>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- HEADING 1 END-->
        </div>
    </div>
</section>
<!-- FACULTY WRAP START-->