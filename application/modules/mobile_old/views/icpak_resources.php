<?php



$result = '<div class="page_content"> 

      

		    <div class="blog-posts">';

		       if ($query->num_rows() > 0)

                {



                $result .=' 



                      <ul class="posts-resources">';



				         foreach ($query->result() as $row)

                        {

                            
                          $id = $row->post_id;

                            $title = $row->post_title;

                            $title_alias = $row->post_name;
                            $fulltext  = $row->post_content;
                            $post_content = $row->post_content;

                            // $post_date = $row->post_date;
                             $date = date('jS M Y',strtotime($row->post_date));

                            $publish_up = date('jS M Y',strtotime($row->post_date));

                             $day = date('j',strtotime($row->post_date));

                             $month = date('M',strtotime($row->post_date));



                            $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;

                            $title = $row->post_title;

                            $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;

                            $result .='

                                <li>

                                    <div class="post_entry">

                                    	<div class="post_image">

                                            <div class="feat_small_icon"><img src="images/icons/black/download.png" alt="" title="" /></div>

                                        </div>

                                    	

                                        <div class="post_title_resourses">

                                       		<h3><a href="article-single.html?a_id='.$id.'" onclick="get_resources_description('.$id.')">'.strip_tags($mini_title,'<p><a>').'</a></h3>

                                       		

                                        </div>

                                    </div>

                                </li>';

                        }

                        $result .='

                      </ul>

                    <div class="clear"></div>  

	                    <div id="loadMore"><img src="images/load_posts.png" alt="" title="" /></div> 

	                    <div id="showLess"><img src="images/load_posts_disabled.png" alt="" title="" /></div> 

                    </div>

                      ';

                    }

                    else

                    {

                        $result .= "There are no articles";

                    }

            $result .= '                

				</div>';

	echo $result;

?>