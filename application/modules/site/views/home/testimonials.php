<?php

    $result = '';
    
    //if users exist display them

    if ($testimonials->num_rows() > 0)
    {   
       
        foreach ($testimonials->result() as $row)
        {
            $post_id = $row->post_id;
            $blog_category_name = $row->blog_category_name;
            $blog_category_id = $row->blog_category_id;
            $post_title = $row->post_title;
            $web_name = $this->site_model->create_web_name($post_title);
            $post_status = $row->post_status;
            $post_views = $row->post_views;
            $image = base_url().'assets/images/posts/'.$row->post_image;
            $created_by = $row->created_by;
            $modified_by = $row->modified_by;
            $description = $row->post_content;
            $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
            $created = $row->created;
            $day = date('j',strtotime($created));
            $month = date('M Y',strtotime($created));
            $created_on = date('jS M Y',strtotime($row->created));
            
            $categories = '';
            $count = 0;
           
              
            $result .= '
                         <div class="item">
                            <!-- TESTEMONIAL SLIDER WRAP START-->
                            <div class="edu_testemonial_wrap">
                                <figure><img src="'.$image.'" alt=""/></figure>
                                <div class="kode-text">
                                    <p>T'.$description.'</p>
                                    <a href="#">'.$post_title.'<span>- Happy Member</span></a>
                                </div>
                            </div>
                            <!-- TESTEMONIAL SLIDER WRAP END-->
                        </div>
                ';
            }
        }
        else
        {
            $result .= "There are no testimonials :-(";
        }
       
      ?> 

<!--OUR TESTEMONIAL WRAP START-->
<section class="background_color">
    <div class="container">
        <div class="row">
            <!-- HEADING 2 START-->
            <div class="col-md-12">
                <div class="training_heading">
                    <h4>Our Testimonial</h4>
                </div>
            </div>
            <!-- HEADING 2 END-->
            <!-- TESTEMONIAL SLIDER WRAP START-->
            <div class="edu2_testemonial_slider_wrap">
                <div id="owl-demo-9">
                   <?php echo $result;?>
                </div>
            </div>
            <!-- TESTEMONIAL SLIDER WRAP END-->
        </div>
    </div>
</section>
<!--OUR TESTEMONIAL WRAP END-->