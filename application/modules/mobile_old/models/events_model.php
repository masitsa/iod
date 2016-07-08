<?php
class Events_model extends CI_Model 
{
	public function get_events()
	{
		$this->db->where('training.start_date >= '.date('Y').'');
		$this->db->order_by('training.start_date','ASC');
		$query = $this->db->get('training');
		return $query;
	}
	public function get_event_detail($id)
	{
		$this->db->where('training_id = '.$id);
		$this->db->order_by('training.start_date','ASC');
		$query = $this->db->get('training');
		return $query;
	}

}