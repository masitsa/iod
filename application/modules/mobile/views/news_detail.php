<?php

if ($query->num_rows() > 0)

{

            

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

          $attachments = $this->news_model->get_attachments($id);

	}

	$result = '<h2 class="page_title">'.strip_tags($title).'</h2>

	 

	          <div class="post_single">

	                 

	            <div class="page_content"> 



	              <div class="entry">

	              	'.$post_content.'

	              </div>

	            </div>
	             <div class="page_content">';
		             	if ($attachments->num_rows() > 0)
						{
						       
								$result .=' 
				             	<ul class="simple_list">';
				             		foreach ($attachments->result() as $row_item)
									{


								         $id = $row_item->post_id;

								        $title = $row_item->post_title;

								        $title_alias = $row_item->post_name;
								        $fulltext  = $row_item->post_content;
								        $post_content = $row_item->post_content;
								         $kb_download = $row_item->guid;

								        // $post_date = $row_item->post_date;
								         $date = date('jS M Y',strtotime($row_item->post_date));

								        $publish_up = date('jS M Y',strtotime($row_item->post_date));

								         $day = date('j',strtotime($row_item->post_date));

								         $month = date('M',strtotime($row_item->post_date));

				             			// $result .='<li><a href="#" onclick="window.open("http://www.icpak.com/download.php?a_id='.$article_id.'&download='.$kb_download.', "_system", "location=yes"")">'.$download_title.'</a> </li>';
				             			//$result .="<li><a href='#' onclick='get_download(".$id.",".$kb_download.");'>".$title."</a></li>";
										$result .="<li><a href='#' class='download-resource' download_file='".$kb_download."'>".$title."</a></li>";

				             		}
				             	$result .='	
				             	<ul>';
				         }
				     $result .='
		             </div>

	            

	          </div>

	          

	          

	          ';

}else

{

	$result = 'Data not found';

}

echo $result;

?>