		<div class="edu2_main_bn_wrap">
			<div id="owl-demo-main" class="owl-carousel owl-theme">
                <?php
				if($slides->num_rows() > 0)
				{
					foreach($slides->result() as $slide)
					{
						$slide_name = $slide->slideshow_name;
						$description = $slide->slideshow_description;
						$slide_image = $slide->slideshow_image_name;
						$description = $this->site_model->limit_text($description, 8);
						
						?>
                        <div class="item">
                            <figure>
                                <img src="<?php echo base_url();?>assets/slideshow/<?php echo $slide_image;?>" alt=""/>
                                <figcaption>
                                    <span>Institute of Directors Kenya</span>
                                    <h2><?php echo $slide_name;?></h2>
                                    <p><?php echo $description;?></p>
                                </figcaption>
                            </figure>
                        </div>
					<?php
					}
				}
				?>
			</div>
		</div>

