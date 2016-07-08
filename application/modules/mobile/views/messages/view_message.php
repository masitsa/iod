<?php
	//get receiver details
	if($receiver->num_rows() > 0)
	{
		$row = $receiver->row();
		$receiver_username = $row->name;
		$receiver_thumb = '';
		$receiver_thumb = 'user.png';
		$receiver_id = $row->id;
	}
	
	//get client details
	if($sender->num_rows() > 0)
	{
		$row = $sender->row();
		$client_username = $row->name;
		$client_thumb = '';
		$client_id = $row->id;
		$client_thumb = 'user.png';
	}
?>

<?php
//var_dump($messages);

if(is_array($messages))
{
	$total_messages = count($messages);
	
	for($r = 0; $r < $total_messages; $r++)
	{
		$message_data = $messages[$r];
		$sender = $message_data->client_id;
		$receiver = $message_data->receiver_id;
		$created = $message_data->created;
		$client_message_details = $message_data->client_message_details;
		
		//if I am the one receiving align left
		if($receiver == $client_id)
		{
			echo 
			'<div class="message message-first message-received"><div class="message-name">'.$receiver_username.'</div><div class="message-text">'.$client_message_details.'</div><div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div><div style="background-image:url('.$receiver_thumb.')" class="message-avatar"></div></div>';
		}
		
		//align right
		else
		{
			echo 
			'<div class="message message-sent"><div class="message-text">'.$client_message_details.'</div><div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div></div><div class="message message-sent message-pic"><div class="message-label">Delivered</div></div>';
		}
	}
}
?>

<!--
			<div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div>
			<div class="message message-last message-received">
				<div class="message-name">'.$receiver_username.'</div>
				<div class="message-text">'.$client_message_details.'</div>
				<div style="background-image:url('.$receiver_thumb.')" class="message-avatar"></div>
			</div>
            
            <div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div>
				<div class="message message-sent">
					<div class="message-text">'.$client_message_details.'</div>
				</div>
				
				<div class="message message-sent message-pic">
					<div class="message-text"><img src="http://lorempixel.com/300/300/"></div>
					<div class="message-label">Delivered</div>
				</div>
-->
