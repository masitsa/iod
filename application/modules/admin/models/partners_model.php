<?php

class Partners_model extends CI_Model 
{	
	public function upload_partners_image($partners_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 300;
		$resize['height'] = 300;
		
		if(!empty($_FILES['partners_image']['tmp_name']))
		{
			$image = $this->session->userdata('partners_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($partners_path."\\".$image, $partners_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($partners_path."\\thumbnail_".$image, $partners_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($partners_path, 'partners_image', $resize);//var_dump($response);die();
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//Set sessions for the image details
				$this->session->set_userdata('partners_file_name', $file_name);
				$this->session->set_userdata('partners_thumb_name', $thumb_name);
			
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
	
	public function get_all_partners($table, $where, $per_page, $page)
	{
		//retrieve all partnerss
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('partner_type_name');
		$this->db->order_by('partners_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing partners
	*	@param int $partners_id
	*
	*/
	public function delete_partners($partners_id)
	{
		if($this->db->delete('partners', array('partners_id' => $partners_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated partners
	*	@param int $partners_id
	*
	*/
	public function activate_partners($partners_id)
	{
		$data = array(
				'partners_status' => 1
			);
		$this->db->where('partners_id', $partners_id);
		
		if($this->db->update('partners', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated partners
	*	@param int $partners_id
	*
	*/
	public function deactivate_partners($partners_id)
	{
		$data = array(
				'partners_status' => 0
			);
		$this->db->where('partners_id', $partners_id);
		
		if($this->db->update('partners', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
