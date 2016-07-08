<?php 



$result = '<div class="page_content"> 

            <div class="buttons-row">

                    <a href="#tab3" class="tab-link active button">ICPAK News</a>

                    <a href="#tab4" class="tab-link button">E-connect News</a>

              </div>

              

              <div class="tabs-simple">

                    <div class="tabs">

                      <div id="tab3" class="tab active">

                            <div class="blog-posts-events" id="icpaknews">';



                            if ($query->num_rows() > 0)

                            {

            

                            $result .=' 



                                  <ul class="posts">';

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

                                                    <div class="post_date">

                                                        <span class="day">'.$day.'</span>

                                                        <span class="month">'.$month.'</span>

                                                    </div>

                                                    <div class="post_title">

                                                    <!--<h2><a href="blog-single.html?id='.$id.'">'.strip_tags($mini_title).'</a></h2>-->

                                                    <h3><a href="blog-single.html?id='.$id.'" onclick="get_news_description('.$id.')">'.strip_tags($mini_title).'</a></h3>

                                                         Published : '.$publish_up.'

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

                                    $result .= "There are no blog categories";

                                }

                            $result .= '

                              

                            

                        </div>

                        <div id="tab4" class="tab">

                           <div class="blog-posts-ecconect" id="icpakecconect">';

                           if ($econnect_query->num_rows() > 0)

                            {

            

                            $result .='



                              <ul class="posts-ecconect"  id="icpakecconect">';

                                  foreach ($econnect_query->result() as $row_ecconect)

                                    {

                                         $id = $row_ecconect->post_id;

                                        $title = $row_ecconect->post_title;

                                        $alias = $row_ecconect->post_name;





                                        // $introtext = $row_ecconect->introtext;

                                        $fulltext  = $row_ecconect->post_content;

                                         // $fulltext = htmlentities($fulltext, UTF-8);

                                        /*$state = $row_ecconect->state;

                                        $sectionid = $row_ecconect->sectionid;

                                        $mask = $row_ecconect->mask;

                                        

                                        $hits = $row_ecconect->hits;

                                        $metadata = $row_ecconect->metadata;

                                        $metadesc = $row_ecconect->metadesc;

                                        $access = $row_ecconect->access;*/



                                        $post_content = $row_ecconect->post_content;

                                         $date = date('jS M Y',strtotime($row_ecconect->post_date));

                                          $publish_upe = date('jS M Y',strtotime($row_ecconect->post_date));

                                         $day = date('j',strtotime($row_ecconect->post_date));

                                         $month = date('M',strtotime($row_ecconect->post_date));



                                        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;

                                        $title = $row_ecconect->post_title;

                                        $mini_title2 = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;

                                        $result .='

                                            <li>

                                                <div class="post_entry">

                                                    <div class="post_date">

                                                        <span class="day">'.$day.'</span>

                                                        <span class="month">'.$month.'</span>

                                                    </div>

                                                    <div class="post_title">

                                                    <h3><a href="blog-single.html?id='.$id.'" onclick="get_news_description('.$id.')">'. strip_tags($mini_title2).'</a></h3>

                                                        Published : '.$publish_upe.'

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

                                    $result .= "There are no blog categories";

                                }

                            $result .= '

                      </div> 

                    </div>

                </div>



            </div>';

echo $result;