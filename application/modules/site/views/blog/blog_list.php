<?php

$result = '';

//if users exist display them

if ($query->num_rows() > 0)
{	
	//get all administrators
	$administrators = $this->users_model->get_all_administrators();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
	}
	
	else
	{
		$admins = NULL;
	}
	
	foreach ($query->result() as $row)
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
		$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
		$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
		$description = $row->post_content;
		$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 20));
		$created = $row->created;
		$day = date('j',strtotime($created));
		$month = date('M',strtotime($created));
		$created_on = date('jS M Y',strtotime($row->created));
		$post_video = $row->post_video;
		
		if(empty($post_video))
		{
			$image = '<img src="'.$image.'" alt=""/>';
		}
		
		else
		{
			$image = '<div class="youtube" id="'.$post_video.'"></div>';
		}
		
		$categories = '';
		$count = 0;
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
				$category_web_name = $this->site_model->create_web_name($category_name);
				
				if($count == $categories_query->num_rows())
				{
					$categories .= '<a href="'.site_url().'blog/category/'.$category_web_name.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
				}
				
				else
				{
					$categories .= '<a href="'.site_url().'blog/category/'.$category_web_name.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
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
					$date = date('jS M Y',strtotime($row->comment_created));
					
					$comments .= 
					'
						<div class="user_comment">
							<h5>'.$post_comment_user.' - '.$date.'</h5>
							<p>'.$post_comment_description.'</p>
						</div>
					';
				}
			}
		$result .= '
				<div class="col-md-4">
					<!--BLOG 3 WRAP START-->
					<div class="blog_3_wrap">
						<!--BLOG 3 SIDE BAR START-->
						<ul class="blog_3_sidebar">
							<li>
								<a href="#">
									'.$day.'
									<span>'.$month.'</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-comments-o"></i>
									<span>'.$total_comments.'</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-thumbs-o-up"></i>
									<span>'.$total_comments.'</span>
								</a>
							</li>
						</ul>
						<!--BLOG 3 SIDE BAR END-->
						<!--BLOG 3 DES START-->
						<div class="blog_3_des">
							<figure>
								'.$image.'
								<figcaption><a href="'.site_url().'blog/'.$web_name.'"><i class="fa fa-search-plus"></i></a></figcaption>
							</figure>
							<ul>
								<li><a href="'.site_url().'blog/'.$web_name.'">'.$blog_category_name.'</a>1 week ago</li>
								<li><a href="'.site_url().'blog/'.$web_name.'#comments"><i class="fa fa-link"></i></a>'.$total_comments.'</li>
							</ul>
							<h5>'.$post_title.'</h5>
							<p>'.$mini_desc.'</p>
							<a class="readmore" href="'.site_url().'blog/'.$web_name.'">
								read more
								<i class="fa fa-long-arrow-right"></i>
							</a>
						</div>
						<!--BLOG 3 DES END-->
					</div>
					<!--BLOG 3 WRAP END-->
				</div>

           
            ';
        }
	}
	else
	{
		$result .= "There are no posts :-(";
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
						<h3>Blog</h3>
                	</div>
                   
                    <div class="kf_inr_breadcrumb">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Blog</a></li>
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
			
	<!--BLOG 3 PAGE START-->
	<section>
		<div class="container">
			<div class="row">
				
				<?php echo $result;?>

				<div class="col-md-12">
						<!--KF_PAGINATION_WRAP START-->
					<div class="kf_edu_pagination_wrap">
						<?php if(isset($links)){echo $links;}?>
					</div>
					<!--KF_PAGINATION_WRAP END-->
					</div>

			</div>
		</div>
	</section>
	<!--BLOG 3 PAGE END-->
</div>
<!--Content Wrap End-->

