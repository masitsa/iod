<?php
$result = ''; 
if($query->num_rows() > 0)
{
	foreach($query->result() as $cat)
	{
		$training_id = $cat->training_id;
		$training_status = $cat->training_status;
		$training_price = $cat->training_price;
		$training_venue = $cat->training_venue;
		$training_date = $cat->training_date;
		$start_date = $cat->start_date;
		$end_date = $cat->end_date;
		$created = $cat->created;
		$training_name = $cat->training_name;
		$training_image_name = $cat->training_image_name;
		$training_description = $cat->training_description;
		$start_date = date('jS M Y',strtotime($start_date));
		$end_date = date('jS M Y',strtotime($end_date));
		$created = date('jS M Y',strtotime($created));
		$day = date('d',strtotime($start_date));
		$month = date('M',strtotime($start_date));
	}
}
?>
    <!-- PAGE CONTROL -->
    <section class="page-control">
        <div class="container">
            <div class="page-info">
                <a href="<?php echo site_url().'member/events';?>"><i class="fa fa-arrow-left"></i>Back to Events</a>
            </div>
        </div>
    </section>
    <!-- END / PAGE CONTROL -->
    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="sidebar-course-intro">
                        <div class="video-course-intro">
                            <img src="<?php echo $training_location;?>/<?php echo $training_image_name;?>" alt="">
                            <div class="price">
                                 Kes <?php echo number_format($training_price, 2)?>
                             </div>
                            <a href="#" class="take-this-course mc-btn btn-style-1">Book Now</a>
                        </div>

                        <div class="new-course">
                            <div class="item course-code">
                                <i class="fa fa-location"></i>
                                <h4><a href="#">Location</a></h4>
                                <p class="detail-course"><?php echo $training_venue;?></p>
                            </div>
                            <div class="item course-code">
                                <i class="fa fa-time"></i>
                                <h4><a href="#">Start Date</a></h4>
                                <p class="detail-course"><?php echo $start_date;?></p>
                            </div>
                            <div class="item course-code">
                                <i class="fa fa-img-check"></i>
                                <h4><a href="#">End Date</a></h4>
                                <p class="detail-course"><?php echo $end_date;?></p>
                            </div>
                        </div>
                        <hr class="line">
                        <div class="about-instructor">
                            <h4 class="xsm black bold">About Instructor</h4>
                            <ul>
                                <li>
                                    <div class="image-instructor text-center">
                                        <img src="<?php echo base_url().'assets/images/avatar.png';?>" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a href="#">James Nabangi</a></cite>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                        <a href="#"><i class="fa fa-check-square"></i></a>
                                        <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget_share">
                            <h4 class="xsm black bold">Share Event</h4>
                            <div class="share-body">
                                <a href="#" class="twitter" title="twitter">
                                    <i class="fa fa-twitter fa-2x"></i>
                                </a>
                                <a href="#" class="facebook" title="facebook">
                                    <i class="fa fa-facebook fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-md-7">
                    <div class="tabs-page">
                        <ul class="nav-tabs" role="tablist">
                            <li class="active"><a href="#introduction" role="tab" data-toggle="tab">About The Training</a></li>
                            <li><a href="#outline" role="tab" data-toggle="tab">How To Book</a></li>
                            <li><a href="#comments" role="tab" data-toggle="tab">Commments</a></li>
                            <li><a href="#add_comment" role="tab" data-toggle="tab">Add Comment</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- INTRODUCTION -->
                            <div class="tab-pane fade in active" id="introduction">
                                <h4 class="sm black bold">About</h4>
                                <?php echo $training_description;?>
                            </div>
                            <!-- END / INTRODUCTION -->
    
                            <!-- OUTLINE -->
                            <div class="tab-pane fade" id="outline">
                                <h4 class="sm black bold">Booking</h4>
    
                                <p>Booking instructions</p>
                            </div>
                            <!-- END / OUTLINE -->
    
                            <!-- REVIEW -->
                            <div class="tab-pane fade" id="comments">
                                <div class="total-review">
                                    <h3 class="md black">4 Reviews</h3>
                                    <div class="rating">
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#"></a>
                                        <a href="#"></a>
                                    </div>
                                </div>  
                                <ul class="list-review">
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url().'assets/images/avatar.png';?>" alt="">
                                                    <i class="fa fa-email"></i>
                                                </a>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                             
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url().'assets/images/avatar.png';?>" alt="">
                                                    <i class="fa fa-email"></i>
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url().'assets/images/avatar.png';?>" alt="">
                                                    <i class="fa fa-email"></i>
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>                        
                                </ul>
                            </div>
                            <!-- END / REVIEW -->
    						
                            <!-- COMMENT -->
                            <div class="tab-pane fade" id="add_comment">
                                <div id="respond">
                                    <h3 class="md black">100 Comments</h3>
                                    <form>
                                        <div class="comment-form-comment">
                                            <textarea placeholder="Comment"></textarea>
                                        </div>
                                        <div class="form-submit">
                                            <input type="submit" value="Add" class="mc-btn-2 btn-style-2">
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- END / COMMENT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
