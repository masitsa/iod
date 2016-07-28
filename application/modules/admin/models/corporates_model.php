<?php

class Corporates_model extends CI_Model 
{	
	public function upload_corporates_image($corporates_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 300;
		$resize['height'] = 300;
		
		if(!empty($_FILES['corporates_image']['tmp_name']))
		{
			$image = $this->session->userdata('corporates_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($corporates_path."\\".$image, $corporates_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($corporates_path."\\thumbnail_".$image, $corporates_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($corporates_path, 'corporates_image', $resize);//var_dump($response);die();
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//Set sessions for the image details
				$this->session->set_userdata('corporates_file_name', $file_name);
				$this->session->set_userdata('corporates_thumb_name', $thumb_name);
			
				return TRUE;
			}
		
			else
			{
				$this->session->set_userdata('error_message', 'Cannot upload image. '.$response['error']);
				
				return FALSE;
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', '');
			return FALSE;
		}
	}
	
	public function get_all_corporates($table, $where, $per_page, $page)
	{
		//retrieve all corporatess
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('corporates_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing corporates
	*	@param int $corporates_id
	*
	*/
	public function delete_corporates($corporates_id)
	{
		if($this->db->delete('corporates', array('corporates_id' => $corporates_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated corporates
	*	@param int $corporates_id
	*
	*/
	public function activate_corporates($corporates_id)
	{
		$data = array(
				'corporates_status' => 1
			);
		$this->db->where('corporates_id', $corporates_id);
		
		if($this->db->update('corporates', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated corporates
	*	@param int $corporates_id
	*
	*/
	public function deactivate_corporates($corporates_id)
	{
		$data = array(
				'corporates_status' => 0
			);
		$this->db->where('corporates_id', $corporates_id);
		
		if($this->db->update('corporates', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
