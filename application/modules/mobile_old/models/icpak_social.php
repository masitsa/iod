<?php

$result = ' 
		<h3>Members forum</h3>';
		if ($social_forum->num_rows() > 0)
                {

                $result .=' 

                       <ul class="comments">';

				        foreach ($social_forum->result() as $row)
                        {
                            $member_id  = $row->member_id;
				            $comment = $row->comment;
				            $name = $row->name;

				            if($member_id == $this->session->userdata('member_id'))
				            {	
				            	$result .= '
						            	<li class="comment_row">
							                  <div class="comm_avatar"><img src="images/icons/black/user.png" alt="" title="" border="0" /></div>
							                  <div class="comm_content"><p> '.$comment.' <a href="#">Me</a></p></div>
							            </li>

				            			';

				            }
				            else
				            {
				            	$result .= '
						            	<li class="comment_row">
							                 <div class="comm_content"><p> '.$comment.' <a href="#">'.$name.'</a></p></div>
							                 <div class="comm_avatar"><img src="images/icons/black/user.png" alt="" title="" border="0" /></div>

							            </li>

				            			';

				            }

				        }
		           $result .='
		              <div class="clear"></div>
		          </ul>';
		     }
		     else
		     {
		     	$result .= 'No comments yet';
		     }
echo $result;

?>