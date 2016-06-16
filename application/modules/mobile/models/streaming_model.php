<?php

class Streaming_model extends CI_Model 
{

	/*
	*	Update user's last login date
	*
	*/
	public function get_now_streaming_event()
	{
		$this->db->where('streaming_status = 1');
		$query = $this->db->get('now_streaming');
		
		return $query;
	}
	public function get_now_recording_event()
	{
		$this->db->where('recording_status = 1');
		$query = $this->db->get('recording');
		
		return $query;
	}

}
?>