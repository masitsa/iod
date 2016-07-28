<?php

class Resource_model extends CI_Model 
{	
	public function upload_resource_image($resource_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 2000;
		$resize['height'] = 1200;
		
		if(!empty($_FILES['resource_image']['tmp_name']))
		{
			$image = $this->session->userdata('resource_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($resource_path."\\".$image, $resource_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($resource_path."\\thumbnail_".$image, $resource_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($resource_path, 'resource_image', $resize);//var_dump($response);die();
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//crop file to 1920 by 1010
				$response_crop = $this->file_model->crop_file($resource_path."/".$file_name, $resize['width'], $resize['height']);
				
				if(!$response_crop['response'])
				{
					$this->session->set_userdata('error_message', 'Cannot crop image. '.$response_crop['message']);
				
					return FALSE;
				}
				
				else
				{
					//Set sessions for the image details
					$this->session->set_userdata('resource_file_name', $file_name);
					$this->session->set_userdata('resource_thumb_name', $thumb_name);
				
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
	
	public function get_all_resource($table, $where, $per_page, $page)
	{
		//retrieve all resources
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('resource_category.resource_category_name');
		$this->db->order_by('resource.resource_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing resource
	*	@param int $resource_id
	*
	*/
	public function delete_resource($resource_id)
	{
		if($this->db->delete('resource', array('resource_id' => $resource_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated resource
	*	@param int $resource_id
	*
	*/
	public function activate_resource($resource_id)
	{
		$data = array(
				'resource_status' => 1
			);
		$this->db->where('resource_id', $resource_id);
		
		if($this->db->update('resource', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated resource
	*	@param int $resource_id
	*
	*/
	public function deactivate_resource($resource_id)
	{
		$data = array(
				'resource_status' => 0
			);
		$this->db->where('resource_id', $resource_id);
		
		if($this->db->update('resource', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function save_resource_file($resource, $resource_id = NULL)
	{
		//save the image data to the database
		$data = array(
			'resource_name'=>$this->input->post("resource_name"),
			'resource_category_id'=>$this->input->post("resource_category_id"),
			'resource_image_name'=>$resource
		);
		
		if($resource_id == NULL)
		{
			if($this->db->insert('resource', $data))
			{
				return $this->db->insert_id();
			}
			else
			{
				return FALSE;
			}
		}
		
		else
		{
			$this->db->where('resource_id', $resource_id);
			if($this->db->update('resource', $data))
			{
				return $resource_id;
			}
			else
			{
				return FALSE;
			}
		}
	}
}
