<?php
	//get client details
	if($sender->num_rows() > 0)
	{
		$row = $sender->row();
		$client_username = $row->username;
		$client_id = $row->id;
		$client_thumb = 'user.png';
	}
?>

<?php
//var_dump($messages);

if(is_array($messages))
{
	$total_messages = count($messages);
	
	if($total_messages > 0)
	{
		//last message
		$r = $total_messages - 1;
		
		$message_data = $messages[$r];
		$sender = $message_data->id;
		$receiver = $message_data->id;
		$created = $message_data->created;
		$client_message_details = $message_data->client_message_details;
		
		//if I am the one receiving align left
		if($sender == $client_id)
		{
			echo 
			'<div class="message message-sent"><div class="message-text">'.$client_message_details.'</div><div class="messages-date">'.date('jS M Y',strtotime($created)).' <span>'.date('H:i a',strtotime($created)).'</span></div></div><div class="message message-sent message-pic"><div class="message-label">Delivered</div></div>';
		}
	}
}
?>