<?php
    if($messages->num_rows() > 0)
    {
        $message = $messages->result();
        
        foreach($message as $mes)
        {
			$unread = 0;
            $client_id = $mes->client_id;
            $receiver_id = $mes->receiver_id;
            $created = $mes->created;
            //$last_chatted = $mes->last_chatted;
            $message_file_name = $mes->message_file_name;
			
            if($client_id == $current_client_id)
            {
                $receiver_query = $this->profile_model->get_client($receiver_id);
				$sent_messages = $this->profile_model->get_messages($current_client_id, $receiver_id, $this->messages_path);
            }
            else
            {
                $receiver_query = $this->profile_model->get_client($client_id);
				$sent_messages = $this->profile_model->get_messages($current_client_id, $client_id, $messages_path);
            }
			
			//message details
			$mini_msg = '';
			if(is_array($sent_messages))
			{
				$total_messages = count($sent_messages);
				$last_message = $total_messages - 1;
				
				$message_data = $sent_messages[$last_message];
				$client_message_details = $message_data->client_message_details;
				$check_receiver_id = $message_data->receiver_id;
				$last_chatted = $message_data->created;
            	$mini_msg = implode(' ', array_slice(explode(' ', $client_message_details), 0, 8));
			
				//bold unread messages
				if($check_receiver_id == $current_client_id)
				{
					$unread = 1;
				}
			}
            $today_check = date('jS M Y',strtotime($last_chatted));
            $today = date('jS M Y',strtotime(date('Y-m-d')));
            
            //if today display time
            if($today_check == $today)
            {
                $date_display = date('H:i a',strtotime($last_chatted));
            }
            else
            {
                $date_display = date('jS M Y',strtotime($last_chatted));
            }
            
            //get receiver details
            $prods = $receiver_query->row();
            $client_image = '';
            $client_dob = '';
            $client_id = $prods->id;
            $created = '';
			$time = date("jS F Y H:i");
            $client_username = $prods->name;
            $age = 0;
			$web_name = $this->profile_model->create_web_name($client_username);
			$image = '';
			
			if($unread == 1)
			{
				$client_username = '<strong>'.$client_username.'</strong>';
				$mini_msg = '<strong>'.$mini_msg.'</strong>';
				$badge = '<div class="item-after">'.$time.' <span class="badge bg-red">!</span></div>';
			}
			
			else
			{
				$badge = ''; 
			}
            
            echo
            '
					<li class="chat-item">
						<a href="chat-single.html" class="item-link item-content" onclick="chat_single('.$client_id.')">
							<div class="item-media">
								<div class="image-icon ">
									<img src="user.png">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title">'.$client_username.'</div>
									'.$badge.'
								</div>
								<div class="item-subtitle"> 
									'.$mini_msg.'
								</div>
							
							</div>
						</a>
					</li>
	            ';
        }
    }
    
    else
    {
        echo 'There are no messages :-(';
    }
?>