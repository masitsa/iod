<?php
	$parents = $this->admin_model->get_admin_module_parents();
	$children = $this->admin_model->get_admin_module_children();
	$modules = '';
	
	if($parents->num_rows() > 0)
	{
		foreach($parents->result() as $res)
		{
			$module_id = $res->module_id;
			$module_name = $res->module_name;
			$module_parent = $res->module_parent;
			$module_icon = $res->module_icon;
			$web_name = strtolower($this->site_model->create_web_name($module_name));
			$link = site_url().'admin/'.$web_name;
			$module_children = $this->admin_model->check_children($children, $module_id);
			$total_children = count($module_children);
			
			if($total_children == 0)
			{
				if($title == $module_name)
				{
					$modules .= '<li class="nav-active">';
				}
				
				else
				{
					$modules .= '<li>';
				}
				$modules .= '
					<a href="'.$link.'">
						<span class="pull-right label label-primary">182</span>
						<i class="fa fa-'.$module_icon.'" aria-hidden="true"></i>
						<span>'.$module_name.'</span>
					</a>
				</li>
				';
			}
			
			else
			{
				if($title == $module_name)
				{
					$modules .= '<li class="nav-active nav-parent">';
				}
				
				else
				{
					$modules .= '<li class="nav-parent">';
				}
				$modules .= '
					<a>
						<i class="fa fa-'.$module_icon.'" aria-hidden="true"></i>
						<span>'.$module_name.'</span>
					</a>
					<ul class="nav nav-children">';
				
				//children
				for($r = 0; $r < $total_children; $r++)
				{
					$name = $module_children[$r]['module_name'];
					$link = $module_children[$r]['link'];
					
					$modules .= '
						<li>
							<a href="'.$link.'">
								 '.$name.'
							</a>
						</li>
					';
				}
				
				$modules .= '
				</ul></li>
				';
			}
		}
	}
	
?>				
                <!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<?php echo $modules;?>
								</ul>
							</nav>
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->