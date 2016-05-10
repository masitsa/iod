<?php

class Admin_model extends CI_Model 
{
	/*
	*	Get admin module parents
	*
	*/
	public function get_admin_module_parents()
	{
		$this->db->where(array('module_user' => 1, 'module_parent' => 0));
		$this->db->order_by('module_position');
		return $this->db->get('module');
	}
	
	/*
	*	Get admin module children
	*
	*/
	public function get_admin_module_children()
	{
		$this->db->where(array('module_user' => 1, 'module_parent >' => 0));
		$this->db->order_by('module_parent');
		return $this->db->get('module');
	}
	
	/*
	*	Check if parent has children
	*
	*/
	public function check_children($children, $module_id)
	{
		$module_children = array();
		
		if($children->num_rows() > 0)
		{
			foreach($children->result() as $res)
			{
				$parent = $res->module_parent;
				
				if($parent == $module_id)
				{
					$module_name = $res->module_name;
					
					$child_array = array
					(
						'module_name' => $module_name,
						'link' => site_url().'admin/'.strtolower($this->site_model->create_web_name($module_name)),
					);
					
					array_push($module_children, $child_array);
				}
			}
		}
		
		return $module_children;
	}
	
	public function get_breadcrumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		$last = $total - 1;
		$crumbs = '<li><a href="'.site_url().'dashboard"><i class="fa fa-home"></i></a></li>';
		
		for($r = 0; $r < $total; $r++)
		{
			$name = $this->site_model->decode_web_name($page[$r]);
			if($r == $last)
			{
				$crumbs .= '<li><span>'.strtoupper($name).'</span></li>';
			}
			else
			{
				if($total == 3)
				{
					if($r == 1)
					{
						$crumbs .= '<li><a href="'.site_url().$page[$r-1].'/'.strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
					else
					{
						$crumbs .= '<li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
				}
				else
				{
					$crumbs .= '<li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
				}
			}
		}
		
		return $crumbs;
	}
	
	public function create_breadcrumbs($title)
	{
		$crumbs = '<li><a href="'.site_url().'dashboard"><i class="fa fa-home"></i></a></li>';
		$crumbs .= '<li><span>'.strtoupper($title).'</span></li>';
		
		return $crumbs;
	}
}
?>