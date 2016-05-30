<?php
if($query->num_rows()>0)
{
	foreach($query->result() as $row)
	{
$post_id = $row->post_id;
$blog_category_name = $row->blog_category_name;
$blog_category_id = $row->blog_category_id;
$post_image = $row->post_image;
$post_content = $row->post_content;
$post_title = $row->post_title;
$post_comments = $row->post_comments;
$post_status = $row->post_status;
$post_views = $row->post_views;
$image = base_url().'assets/images/posts/'.$row->post_image;
$created_by = $row->created_by;
$modified_by = $row->modified_by;
$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
$description = $row->post_content;
$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
$created = $row->created;
$day = date('j',strtotime($created));
$month = date('M Y',strtotime($created));
$created_on = date('jS M Y H:i a',strtotime($row->created));

$categories = '';
$count = 0;
	}
}
//get all administrators
	$administrators = $this->users_model->get_all_administrators();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
		
		if($admins != NULL)
		{
			foreach($admins as $adm)
			{
				$user_id = $adm->user_id;
				
				if($user_id == $created_by)
				{
					$created_by = $adm->first_name;
				}
			}
		}
	}
	
	else
	{
		$admins = NULL;
	}

	foreach($categories_query->result() as $res)
	{
		$count++;
		$category_name = $res->blog_category_name;
		$category_id = $res->blog_category_id;
		
		if($count == $categories_query->num_rows())
		{
			$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
		}
		
		else
		{
			$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
		}
	}
	$comments_query = $this->blog_model->get_post_comments($post_id);
	//comments
	$comments = 'No Comments';
	$total_comments = $comments_query->num_rows();
	if($total_comments == 1)
	{
		$title = 'comment';
	}
	else
	{
		$title = 'comments';
	}
	
	if($comments_query->num_rows() > 0)
	{
		$comments = '';
		foreach ($comments_query->result() as $row)
		{
			$post_comment_user = $row->post_comment_user;
			$post_comment_description = $row->post_comment_description;
			$date = date('jS M Y H:i a',strtotime($row->comment_created));
			
			$comments .= 
			'
                 <!-- Comment Item -->
                    <li>
											<!-- COMMENT WRAP START-->
											<div class="comment_wrap">
    											<div class="comment_des">
    												<div class="comment_des_hed">
    													<cite><a href="blog-detail.html#">'.$post_comment_user.'</a><span>'.$date.'</span></cite>
    													<a class="comment_reply" href="blog-detail.html#"><i class="fa fa-mail-reply"></i>Reply</a>
    												</div>
    												<p>'.$post_comment_description.' </p>
    											</div>
    										</div>
    										<!-- COMMENT WRAP END-->
										</li>
                    <!-- End Comment Item -->
				
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
								<h3>Blog Detail</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="blog-detail.html#">Home</a></li>
									<li><a href="blog-detail.html#">Blog Detail</a></li>
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
    					<div class="col-md-12">

    						<!--KF_BLOG DETAIL_WRAP START-->
    						<div class="kf_blog_detail_wrap">

    							<!-- BLOG DETAIL THUMBNAIL START-->
    							<div class="blog_detail_thumbnail">
	    							<figure>
	    								<img src="<?php echo base_url()?>assets/images/posts/<?php echo $post_image;?>" alt=""/>
	    								<figcaption><a href="blog-detail.html#">education</a></figcaption>
	    							</figure>
	    						</div>
	    						<!-- BLOG DETAIL THUMBNAIL END-->

    							<!--KF_BLOG DETAIL_DES START-->
    							<div class="kf_blog_detail_des">
	    							<div class="blog-detl_heading">
	    								<h5><?php echo $post_title;?></h5>
	    							</div>

    								<ul class="blog_detail_meta">
    									<li><i class="fa fa-calendar"></i><a href="blog-detail.html#"><?php echo $created; ?></a></li>
    									<li><i class="fa fa-comments-o"></i><a href="blog-detail.html#"><?php echo $post_comments;?> Comments</a></li>
    								</ul>

	    							<p><?php echo $post_content;?> </p>
	    							<p class="margin-bottom"><?php echo $post_content;?></p>

	    						</div>
	    						<!--KF_BLOG DETAIL_DES END--
	    						<!--SECTION COMMENT START-->
	    						<div class="section-comment">
	    							<div class="blog-detl_heading">
	    								<h5>Comments</h5>
                                        
	    							</div>
                                    <ul class="coment_list">
										<?php echo $comments;?>
    								</ul>
                                </div>
    								<!-- COMM
    										
	    						<!-- BLOG PG FORM START-->
	    						<div class="blog_pg_form">
	    							<div class="blog-detl_heading">
	    								<h5>Leave A Message</h5>
	    							</div>
	    							<form>
	    								<div class="row">
	    									<div class="col-md-6">
	    										<input type="text" placeholder="Name">
	    									</div>
	    									<div class="col-md-6">
	    										<input type="text" placeholder="E-mail">
	    									</div>
	    									<div class="col-md-12">
	    										<textarea placeholder="Message"></textarea>
	    									</div>
	    								</div>
	    								<button>Send Comment</button>
	    							</form>
	    						</div>
	    						<!-- BLOG PG FORM END-->
    						</div>
    						<!--KF_BLOG DETAIL_WRAP END-->
    					</div>
    				</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End-->