<?php

$result = '';

		  if ($query->num_rows() > 0)
          {
				foreach ($query->result() as $row)
                {
					$publication_id = $row->publication_id;
					$publication_title = $row->publication_title;
					$publication_link = $row->publication_link;
					$publication_date = date('jS M Y',strtotime($row->publication_date));
					

                    $result .='
                    			<li>
							      <a href="book-single.html?id='.$publication_id.'" class="item-link item-content" onclick="get_publication_detail('.$publication_id.')">
							        
							        <div class="item-inner">
							          <div class="item-title-row">
							            <div class="item-title">'.strip_tags($publication_title,'<p><a>').'</div>
							          </div>
							          <div class="item-text"><span><i class="fa fa-calendar"></i> Published :</span> '.$publication_date.'</div>
							        </div>
							      </a>
							    </li>
                            ';

                }

        }

        else

        {

            $result = ' <li>
							<a href="#" class="item-link item-content">
							        
							        <div class="item-inner">
							          <div class="item-title-row">
							            <div class="item-title">No publications added</div>
							          </div>
							        </div>
							      </a>
						</li>';

        }
	echo $result;

?>