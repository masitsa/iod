<?php

	$result = '';
	
	//if users exist display them

	if ($latest_posts->num_rows() > 0)
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
		
		foreach ($latest_posts->result() as $row)
		{
			$post_id = $row->post_id;
			$blog_category_name = '';//$row->blog_category_name;
			$blog_category_web_name = $this->site_model->create_web_name($blog_category_name);
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
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 30));
			$created = $row->created;
			$day = date('j',strtotime($created));
			$month = date('M',strtotime($created));
			$created_on = date('jS M Y',strtotime($row->created));
			
			$categories = '';
			$count = 0;
			
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
							<div class="user_comment">
								<h5>'.$post_comment_user.' - '.$date.'</h5>
								<p>'.$post_comment_description.'</p>
							</div>
						';
					}
				}
			$result .= '
						<!-- EDU2 NEW DES START-->
						<div class="col-md-6">
							<div class="edu2_new_des">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="edu2_event_des">
											<h4>'.$month.'</h4>
											<p>'.$post_title.'</p>
											<ul class="post-option">
 												<li>By<a href="'.site_url().'blog/'.$web_name.'">Admin</a></li>
 												<li>'.$created_on.'</li>
 												<li><a href="'.site_url().'blog/'.$web_name.'">'.$total_comments.' '.$title.'</a></li>
											</ul>
											<a href="'.site_url().'blog/'.$web_name.'" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
											<span>'.$day.'</span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 thumb">
										<figure><img src="'.$image.'" alt="'.$post_title.'"/>
											<figcaption><a href="'.site_url().'blog/'.$web_name.'"><i class="fa fa-plus"></i></a></figcaption>
										</figure>
									</div>
								</div>
							</div>
						</div>
						<!-- EDU2 NEW DES END-->
				';
			}
		}
		else
		{
			$result = "There are no posts :-(";
		}
	   
	  ?>
            <!-- LATEST NEWS AND EVENT WRAP START-->
			<section class="edu2_new_wrap">
				<div class="container">
					<!-- HEADING 2 START-->
					<div class="col-md-12">
						<div class="kf_edu2_heading2">
							<h3>Latest News</h3>
						</div>
					</div>
					<!-- HEADING 2 END-->
					<div class="row">
						
                        <?php echo $result;?>
                        
					</div>
				</div>
			</section>
			<!-- LATEST NEWS AND EVENT WRAP END-->

