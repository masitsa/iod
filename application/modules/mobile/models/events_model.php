<?php
class Events_model extends CI_Model 
{

	// public function get_events()

	// {
	// 	$this->db->select('post_id, post_title, post_content, post_date, post_name,max(case when wp_vhxu_postmeta.meta_key = "_EventStartDate" then meta_value end) AS StartDate  , max(case when meta_key = "_EventEndDate" then meta_value end) AS EndDate, max(case when meta_key = "_ecp_custom_9" then meta_value end) MemberPrice, max(case when meta_key = "_ecp_custom_10" then meta_value end) NonMemberPrice,max(case when meta_key = "_ecp_custom_8" then meta_value end) AssociateMemberPrice,max(case when meta_key = "VenueID" then meta_value end) VenueID');
	// 	$this->db->where('wp_vhxu_posts.ID = wp_vhxu_postmeta.post_id AND wp_vhxu_posts.post_type = "tribe_events" AND wp_vhxu_posts.post_status = "publish"');

	// 	//$this->db->order_by('StartDate','ASC');
	// 	$this->db->group_by('wp_vhxu_posts.ID');
	// 	$this->db->limit(20);
	// 	$query = $this->db->get('`wp_vhxu_posts` , `wp_vhxu_postmeta`');

		

	// 	return $query;

	// }
	public function get_events()

	{
		$this->db->select('event.*');
		$this->db->where('event_status = 1 AND event_start_time > NOW()');
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('event');

		return $query;

	}

	public function get_event_detail($id)

	{

		$this->db->select('event.*');
		$this->db->where('event_status = 1 AND event_id ='.$id);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('event');

		return $query;



	}





}
?>