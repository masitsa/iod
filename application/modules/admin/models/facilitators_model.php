<?php

class Facilitators_model extends CI_Model 
{	
	public function upload_facilitators_image($facilitators_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 150;
		$resize['height'] = 150;
		
		if(!empty($_FILES['facilitators_image']['tmp_name']))
		{
			$image = $this->session->userdata('facilitators_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($facilitators_path."\\".$image, $facilitators_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($facilitators_path."\\thumbnail_".$image, $facilitators_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($facilitators_path, 'facilitators_image', $resize);//var_dump($response);die();
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//crop file to 1920 by 1010
				$response_crop = $this->file_model->crop_file($facilitators_path."/".$file_name, $resize['width'], $resize['height']);
				
				if(!$response_crop['response'])
				{
					$this->session->set_userdata('error_message', 'Cannot crop image. '.$response_crop['message']);
				
					return FALSE;
				}
				
				else
				{
					//Set sessions for the image details
					$this->session->set_userdata('facilitators_file_name', $file_name);
					$this->session->set_userdata('facilitators_thumb_name', $thumb_name);
				
					return TRUE;
				}
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
	
	public function get_all_facilitators($table, $where, $per_page, $page)
	{
		//retrieve all facilitatorss
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('facilitators_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing facilitators
	*	@param int $facilitators_id
	*
	*/
	public function delete_facilitators($facilitators_id)
	{
		if($this->db->delete('facilitators', array('facilitators_id' => $facilitators_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated facilitators
	*	@param int $facilitators_id
	*
	*/
	public function activate_facilitators($facilitators_id)
	{
		$data = array(
				'facilitators_status' => 1
			);
		$this->db->where('facilitators_id', $facilitators_id);
		
		if($this->db->update('facilitators', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated facilitators
	*	@param int $facilitators_id
	*
	*/
	public function deactivate_facilitators($facilitators_id)
	{
		$data = array(
				'facilitators_status' => 0
			);
		$this->db->where('facilitators_id', $facilitators_id);
		
		if($this->db->update('facilitators', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
