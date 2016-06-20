
    <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<?php
                        $success_message = $this->session->userdata('success_message');
                        if(!empty($success_message))
                        {
                            $this->session->unset_userdata('success_message');
                            echo '<div class="alert alert-success">'.$success_message.'</div>';
                        }
                        
                        $error_message = $this->session->userdata('error_message');
                        if(!empty($error_message))
                        {
                            $this->session->unset_userdata('error_message');
                            echo '<div class="alert alert-danger">'.$error_message.'</div>';
                        }
                    ?>
                </div>
            </div>
            
            <div class="row">
				<?php
                    if($query->num_rows() > 0)
                    {
                        foreach ($query->result() as $row)
                        {
                            $offer_id = $row->offer_id;
                            $offer_title = $row->offer_title;
                            $offer_content = $row->offer_content;
                            $offer_status = $row->offer_status;
                            $offer_views = $row->offer_views;
                            $image = $row->offer_image;
                            $offer_expiry_date = date('jS M Y',strtotime($row->offer_expiry_date));
                            $created_by = $row->created_by;
                            $modified_by = $row->modified_by;
                            $offer_image = base_url()."assets/images/offers/thumbnail_".$image;
                            $mini_desc = implode(' ', array_slice(explode(' ', strip_tags($offer_content)), 0, 10));
							
                            echo
                            '
							<div class="col-xs-6 col-sm-4 col-md-3">
								<!-- MC ITEM -->
								<div class="mc-teaching-item mc-item mc-item-2">
									<div class="image-heading">
										<img src="'.$offer_image.'" alt="'.$offer_title.'">
									</div>
									<div class="meta-categories"><a href="#">Expires '.$offer_expiry_date.'</a></div>
									<div class="content-item">
										<h4><a href="#">'.$offer_title.'</a></h4>
									</div>
									
								</div>
								<!-- END / MC ITEM -->
							</div>
                            ';
                        }
                    }
                    
                    else
                    {
                        echo 'There are no offers';
                    }
                ?>
                
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
