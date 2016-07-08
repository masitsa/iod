<?php
	if($profiles->num_rows() > 0)
	{
		$product = $profiles->result();
		
		foreach($product as $prods)
		{
			$member_first_name = $prods->member_first_name;
			$member_surname = $prods->member_surname;
			$member_id = $prods->member_id;
			$web_name = $this->profile_model->create_web_name($member_first_name);
			$number = '';
			
			echo
				$number.'
					<li class="chat-item">
						<a href="chat-single.html" class="item-link item-content" onclick="chat_single('.$member_id.');">
							<div class="item-media">
								<div class="image-icon ">
									<img src="user.png">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title">'.$member_first_name.'</div>
								</div>
							</div>
						</a>
					</li>
			';
		}
	}
	
	else
	{
		echo ' We are unable to find any profiles';
	}
?>