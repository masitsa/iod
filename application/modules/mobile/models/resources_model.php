<?php



class Resources_model extends CI_Model 

{

	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	/*

	*	Update user's last login date

	*

	*/

	public function get_resources()

	{

		$this->db->where('resource_category_id > 0');

		$query = $this->db->get('resource_category');
		return $query;

	}
	public function get_publications()
	{
		$this->db->where('publication_status = 1');
		$query = $this->db->get('publications');
		return $query;
	}
	public function get_publication_detail($id)
	{
		$this->db->where('publication_id = '.$id);
		$query = $this->db->get('publications');

		return $query;

	}


	public function get_resources_detail($id)

	{
		$this->db->where('resource_category_id ='.$id);

		$query = $this->db->get('resource_category');
		return $query;

	}

	public function get_attachments($id)
	{

		$this->db->select('*');
		$this->db->where('resource_category_id ='.$id);
		$this->db->order_by('resource_category_id','DESC');
		$query = $this->db->get('resource');

		return $query;



	}



}