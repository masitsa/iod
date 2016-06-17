<?php

class Directors_model extends CI_Model 
{	
	public function upload_directors_image($directors_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 150;
		$resize['height'] = 150;
		
		if(!empty($_FILES['directors_image']['tmp_name']))
		{
			$image = $this->session->userdata('directors_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($directors_path."\\".$image, $directors_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($directors_path."\\thumbnail_".$image, $directors_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($directors_path, 'directors_image', $resize);//var_dump($response);die();
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//crop file to 1920 by 1010
				$response_crop = $this->file_model->crop_file($directors_path."/".$file_name, $resize['width'], $resize['height']);
				
				if(!$response_crop['response'])
				{
					$this->session->set_userdata('error_message', 'Cannot crop image. '.$response_crop['message']);
				
					return FALSE;
				}
				
				else
				{
					//Set sessions for the image details
					$this->session->set_userdata('directors_file_name', $file_name);
					$this->session->set_userdata('directors_thumb_name', $thumb_name);
				
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
	
	public function get_all_directors($table, $where, $per_page, $page)
	{
		//retrieve all directorss
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('directors_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing directors
	*	@param int $directors_id
	*
	*/
	public function delete_directors($directors_id)
	{
		if($this->db->delete('directors', array('directors_id' => $directors_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated directors
	*	@param int $directors_id
	*
	*/
	public function activate_directors($directors_id)
	{
		$data = array(
				'directors_status' => 1
			);
		$this->db->where('directors_id', $directors_id);
		
		if($this->db->update('directors', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated directors
	*	@param int $directors_id
	*
	*/
	public function deactivate_directors($directors_id)
	{
		$data = array(
				'directors_status' => 0
			);
		$this->db->where('directors_id', $directors_id);
		
		if($this->db->update('directors', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
