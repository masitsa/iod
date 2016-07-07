<?php

class Site_model extends CI_Model 
{
	public function get_slides()
	{
  		$table = "slideshow";
		$where = "slideshow_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_partners()
	{
  		$table = "partners";
		$where = "partners_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_all_services()
	{
		$table = "service";
		$where = "service_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;

	}
	public function get_resource($limit = NULL)
	{
		$table = "resource";
		$where = "resource_status = 1";
		if($limit !=NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->where($where);
		$this->db->order_by('resource_id', 'DESC');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function display_page_title()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		$last = $total - 1;
		$name = $this->site_model->decode_web_name($page[$last]);
		
		if(is_numeric($name))
		{
			$last = $last - 1;
			$name = $this->site_model->decode_web_name($page[$last]);
		}
		$page_url = ucwords(strtolower($name));
		
		return $page_url;
	}
	
	function generate_price_range()
	{
		$max_price = $this->products_model->get_max_product_price();
		//$min_price = $this->products_model->get_min_product_price();
		
		$interval = $max_price/5;
		
		$range = '';
		$start = 0;
		$end = 0;
		
		for($r = 0; $r < 5; $r++)
		{
			$end = $start + $interval;
			$value = 'KES '.number_format(($start+1), 0, '.', ',').' - KES '.number_format($end, 0, '.', ',');
			$range .= '
			<label class="radio-fancy">
				<input type="radio" name="agree" value="'.$start.'-'.$end.'">
				<span class="light-blue round-corners"><i class="dark-blue round-corners"></i></span>
				<b>'.$value.'</b>
			</label>';
			
			$start = $end;
		}
		
		return $range;
	}
	
	public function get_account_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[1]);
		
		$resources = '';
		$events = '';
		$notifications = '';
		$offers = '';
		$invoices = '';
		$profile = '';
		
		if($name == 'resources')
		{
			$resources = 'current';
		}
		
		if($name == 'events')
		{
			$events = 'current';
		}
		if($name == 'notifications')
		{
			$notifications = 'current';
		}
		if($name == 'offers')
		{
			$offers = 'current';
		}
		if($name == 'invoices')
		{
			$invoices = 'current';
		}
		if($name == 'profile')
		{
			$profile = 'current';
		}
		
		$navigation = 
		'
			<li class="'.$resources.'">
				<a href="'.site_url().'member/resources">
					<i class="fa fa-book"></i>
					Resources
				</a>
			</li>
			<li class="'.$events.'">
				<a href="'.site_url().'member/events">
					<i class="fa fa-newspaper-o"></i>
					Events
				</a>
			</li>
			<li class="'.$notifications.'">
				<a href="'.site_url().'member/notifications">
					<i class="fa fa-bell"></i>
					Notifications
				</a>
			</li>
			<li class="'.$offers.'">
				<a href="'.site_url().'member/offers">
					<i class="fa fa-plus-square"></i>
					Offers
				</a>
			</li>
			<li class="'.$invoices.'">
				<a href="'.site_url().'member/invoices">
					<i class="fa fa-money"></i>
					Invoices
				</a>
			</li>
			<li class="'.$profile.'">
				<a href="'.site_url().'member/profile">
					<i class="fa fa-user"></i>
					Profile
				</a>
			</li>
			
			';
		
		return $navigation;
	}
	
	public function get_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[0]);
		
		$home = '';
		$about = '';
		$services = '';
		$projects = '';
		$contact = '';
		$gallery = '';
		$membership = '';
		$blog = '';
		$calendar = '';
		$resources = '';
		
		if($name == 'home')
		{
			$home = 'active';
		}
		
		if($name == 'about')
		{
			$about = 'active';
		}
		if($name == 'director-development')
		{
			$services = 'active';
		}
		if($name == 'calendar')
		{
			$calendar = 'active';
		}
		if($name == 'contact')
		{
			$contact = 'active';
		}
		if($name == 'gallery')
		{
			$gallery = 'active';
		}
		if($name == 'blog')
		{
			$blog = 'active';
		}
		if($name == 'membership')
		{
			$membership = 'active';
		}
		if($name == 'calendar')
		{
			$calendar = 'active';
		}
		if($name == 'resources')
		{
			$resources = 'active';
		}
		
		//get departments
		
		// service number two
		$services_query = $this->get_active_departments('Services');
		$services_sub_menu_services = '';
		if($services_query->num_rows() > 0)
		{
			foreach($services_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$services_sub_menu_services .= '<li><a href="'.site_url().'director-development/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}

		// service number two
		$membership_query = $this->get_active_departments('Membership');
		$membership_sub_menu_services = '';
		if($membership_query->num_rows() > 0)
		{
			foreach($membership_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$membership_sub_menu_services .= '<li><a href="'.site_url().'membership/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}

		// service number two
		$about_query = $this->get_active_departments('About');
		$about_sub_menu_services = '';
		if($about_query->num_rows() > 0)
		{
			foreach($about_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$about_sub_menu_services .= '<li><a href="'.site_url().'about/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}
		$navigation = 
		'
			<li><a class="'.$home.'" href="'.site_url().'home">Home</a></li>
			<li>
				<a class="'.$about.'" href="'.site_url().'about">About</a>
				<ul>
					<li><a href="'.site_url().'about">About IoD (Kenya)</a></li>
					'.$about_sub_menu_services.'
					<li><a href="'.site_url().'about/board">Our Board</a></li>
				</ul>
			</li>
			
			<!-- Service Menu -->
			<li>
				<a class="'.$services.'"  href="'.site_url().'director-development">Director Development</a>
				<ul>
					'.$services_sub_menu_services.'
				</ul>
			</li>
			<!-- Service Menu -->
			<!-- Portfolio Menu -->
			<li>
				<a class="'.$membership.'" href="'.site_url().'membership">Membership</a>
				<ul>
					'.$membership_sub_menu_services.'
				</ul>
			</li>
			<li>
				<a class="'.$calendar.'" href="'.site_url().'calendar">Calendar</a>
				<ul>
					<li><a href="'.site_url().'event/facilitators">Facilitators</a></li>
				</ul>
			</li>
			<li><a class="'.$resources.'" href="'.site_url().'resources">Resources</a></li>
			<li><a class="'.$blog.'" href="'.site_url().'blog">Blog</a></li>
			<li><a class="'.$gallery.'" href="'.site_url().'gallery">Gallery</a></li>
			<li><a class="'.$contact.'" href="'.site_url().'contact">Contact</a></li>
			
			';
		
		return $navigation;
	}
	public function get_active_departments($service_name)
	{
  		$table = "service, department";
		$where = "department.department_status = 1 AND service.department_id = department.department_id AND department.department_name = '".$service_name."'";
		
		$this->db->select('service.*');
		$this->db->where($where);
		$this->db->group_by('service_name');
		$this->db->order_by('service_id', 'ASC');
		$query = $this->db->get($table);
		
		return $query;
	}

	public function get_active_services()
	{
  		$table = "service";
		$where = "service.service_status = 1 AND department_id = 2";
		
		$this->db->select('service.*');
		$this->db->where($where);
		$this->db->group_by('service_name');
		$this->db->order_by('position', 'ASC');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_active_service_gallery($service_id)
	{
		$table = "service_gallery";
		$where = "service_id = ".$service_id;
		
		$this->db->select('service_gallery.*');
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_active_gallery()
	{
		$table = "gallery";
		$where = "gallery_status > 0";
		
		$this->db->select('gallery.*');
		$this->db->where($where);
		
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_active_service_gallery_names()
	{
		$table = "gallery";
		$where = "gallery_status > 0";
		
		$this->db->select('gallery.*');
		$this->db->where($where);
		$this->db->group_by('gallery_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", $field_name);
		
		return $web_name;
	}
	public function get_services($table, $where, $limit = NULL)
	{
		$this->db->where($where);
		$this->db->select('service.*');
		$this->db->order_by('service_name', 'ASC');
		$query = $this->db->get($table);
		
		
		return $query;
	}
	
	public function decode_web_name($web_name)
	{
		$field_name = str_replace("-", " ", $web_name);
		
		return $field_name;
	}
	
	public function image_display($base_path, $location, $image_name = NULL)
	{
		$default_image = 'http://placehold.it/300x300&text=IOD';
		$file_path = $base_path.'/'.$image_name;
		//echo $file_path.'<br/>';
		
		//Check if image was passed
		if($image_name != NULL)
		{
			if(!empty($image_name))
			{
				if((file_exists($file_path)) && ($file_path != $base_path.'\\'))
				{
					return $location.$image_name;
				}
				
				else
				{
					return $default_image;
				}
			}
			
			else
			{
				return $default_image;
			}
		}
		
		else
		{
			return $default_image;
		}
	}
	
	public function get_contacts()
	{
  		$table = "contacts";
		
		$query = $this->db->get($table);
		$contacts = array();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$contacts['email'] = $row->email;
			$contacts['phone'] = $row->phone;
			$contacts['facebook'] = $row->facebook;
			$contacts['twitter'] = $row->twitter;
			$contacts['linkedin'] = $row->pintrest;
			$contacts['company_name'] = $row->company_name;
			$contacts['logo'] = $row->logo;
			$contacts['address'] = $row->address;
			$contacts['city'] = $row->city;
			$contacts['post_code'] = $row->post_code;
			$contacts['building'] = $row->building;
			$contacts['floor'] = $row->floor;
			$contacts['location'] = $row->location;
			$contacts['working_weekend'] = $row->working_weekend;
			$contacts['working_weekday'] = $row->working_weekday;
			$contacts['mission'] = $row->mission;
			$contacts['vision'] = $row->vision;
			$contacts['motto'] = $row->motto;
			$contacts['about'] = $row->about;
			$contacts['objectives'] = $row->objectives;
			$contacts['core_values'] = $row->core_values;
		}
		return $contacts;
	}
	
	public function get_breadcrumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		$last = $total - 1;
		$crumbs = '<li><a href="'.site_url().'home">HOME </a></li>';
		
		for($r = 0; $r < $total; $r++)
		{
			$name = $this->decode_web_name($page[$r]);
			if($r == $last)
			{
				$crumbs .= '<li class="active">'.strtoupper($name).'</li>';
			}
			else
			{
				if($total == 3)
				{
					if($r == 1)
					{
						$crumbs .= '<li><a href="'.site_url().$this->create_web_name($page[$r-1]).'/'.$this->create_web_name(strtolower($name)).'">'.strtoupper($name).'</a></li>';
					}
					else
					{
						$crumbs .= '<li><a href="'.$this->create_web_name(site_url().strtolower($name)).'">'.strtoupper($name).'</a></li>';
					}
				}
				else
				{
					$crumbs .= '<li><a href="'.$this->create_web_name(site_url().strtolower($name)).'">'.strtoupper($name).'</a></li>';
				}
			}
		}
		
		return $crumbs;
	}
	public function contact() 
	{
		$this->load->model('site/email_model');
		$this->load->library('Mandrill', $this->config->item('mandrill_key'));
		
		$date = date('jS M Y H:i a',strtotime(date('Y-m-d H:i:s')));
		$subject = $this->input->post('sender_name')." needs some help";
		$message = '
				<p>A help message was sent on '.$date.' saying:</p> 
				<p>'.$this->input->post('message').'</p>
				<p>Their contact details are:</p>
				<p>
					Name: '.$this->input->post('sender_name').'<br/>
					Email: '.$this->input->post('sender_email').'<br/>
					Phone: '.$this->input->post('sender_phone').'
				</p>
				';
		$sender_email = $this->input->post('sender_email');
		$shopping = "";
		$from = $this->input->post('sender_name');
		
		$button = '';
		$response = $this->email_model->send_mandrill_mail('info@instorelook.com.au', "Hi", $subject, $message, $sender_email, $shopping, $from, $button, $cc = NULL);
		
		//echo var_dump($response);
		
		return $response;
	}
	
	public function get_neighbourhoods()
	{
		$this->db->order_by('neighbourhood_name');
		return $this->db->get('neighbourhood');
	}
	public function get_testimonials()
	{
		$this->db->where('post.blog_category_id = blog_category.blog_category_id AND (blog_category.blog_category_name LIKE "%testimonials%") AND post.post_status = 1');
		$this->db->order_by('post.created','ASC');
		return $this->db->get('post,blog_category');
	}
	public function get_faqs()
	{
		$this->db->where('post.blog_category_id = blog_category.blog_category_id AND (blog_category.blog_category_name LIKE "%faqs%") AND post.post_status = 1');
		$this->db->order_by('post.created','ASC');
		return $this->db->get('post,blog_category');
	}
	public function get_front_end_items()
	{
		$this->db->where('post.blog_category_id = blog_category.blog_category_id AND (blog_category.blog_category_name LIKE "%front%") AND post.post_status = 1');
		$this->db->order_by('post.created','ASC');
		$this->db->limit(1);
		return $this->db->get('post,blog_category');
	}
	
	public function valid_url($url)
	{
		$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
		//$pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
        if (!preg_match($pattern, $url))
		{
            return FALSE;
        }
 
        return TRUE;
	}
	
	public function get_days($date)
	{
		$now = time(); // or your date as well
		$your_date = strtotime($date);
		$datediff = $now - $your_date;
		return floor($datediff/(60*60*24));
	}
	
	public function limit_text($text, $limit) 
	{
		$pieces = explode(" ", $text);
		$total_words = count($pieces);
		
		if ($total_words > $limit) 
		{
			$return = "<i>";
			$count = 0;
			for($r = 0; $r < $total_words; $r++)
			{
				$count++;
				if(($count%$limit) == 0)
				{
					$return .= $pieces[$r]."</i><br/><i>";
				}
				else{
					$return .= $pieces[$r]." ";
				}
			}
		}
		
		else{
			$return = "<i>".$text;
		}
		return $return.'</i><br/>';
    }

    public function get_all_resources($table, $where, $per_page, $page)
	{
		//retrieve all trainings
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('resource_category.resource_category_id', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	public function view_single_post($post_title)
	{
		$this->db->where('post_title = $post_title');
		$this->db->select('*');
		return $query = $this->db->get('post');
	}
	public function get_event($training_id)
	{
		$this->db->where('training_id  = '.$training_id);
		$this->db->select('*');
		return $query = $this->db->get('training');
	}

	public function get_event_id($training_name)
	{
		//retrieve all users
		$this->db->from('training');
		$this->db->select('training_id');
		$this->db->where('training_name', $training_name);
		$query = $this->db->get();
		$training_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$training_id = $row->training_id;
		}
		
		return $training_id;
	}

	public function get_crumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$crumb[0]['name'] = ucwords(strtolower($page[0]));
		$crumb[0]['link'] = $page[0];
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.$sub_page[$r];
			}
			$crumb[1]['name'] = ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($category_name));
				$crumb[2]['link'] = 'products/category/'.$category_id;
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($brand_name));
				$crumb[2]['link'] = 'products/brand/'.$brand_id;
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($product_name));
				$crumb[2]['link'] = 'products/view-product/'.$product_id;
			}
			
			else
			{
				$crumb[1]['link'] = '#';
			}
		}
		
		return $crumb;
	}
	
	public function get_resource_category_id($resource_category_name)
	{
		//retrieve all users
		$this->db->from('resource_category');
		$this->db->select('resource_category_id');
		$this->db->where('resource_category_name', $resource_category_name);
		$query = $this->db->get();
		$resource_category_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$resource_category_id = $row->resource_category_id;
		}
		
		return $resource_category_id;
	}
	public function get_service_id($about_name)
	{
		$this->db->from('service');
		$this->db->select('service_id');
		$this->db->where('service_name', $about_name);
		$query = $this->db->get();
		$service_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$service_id = $row->service_id;
		}
		
		return $service_id;
	}

	public function get_resource_item($resource_category_id)
	{
		$this->db->where('resource_category_id  = '.$resource_category_id);
		$this->db->select('*');
		return $query = $this->db->get('resource');
	}
	public function get_resource_category($resource_category_id)
	{

		$this->db->where('resource_category_id  = '.$resource_category_id);
		$this->db->select('*');
		return $query = $this->db->get('resource_category');

	}
	public function get_about_item($service_id)
	{
		$this->db->where('service_id  = '.$service_id);
		$this->db->select('*');
		return $query = $this->db->get('service');
	}
	public function get_directors()
	{
		$table = "directors";
		$where = "directors_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_tweets()
	{
		$this->load->library('twitterfetcher');
	
		$tweets = $this->twitterfetcher->getTweets(array(
			'consumerKey'       => 'fZvEA9Mw24i2jT3VIn1sIz92y',
			'consumerSecret'    => 'NW3rzs0jEv39JdSmNeurZvKL577vxPVLuV95vedROczQtQIbDp',
			'accessToken'       => '588425913-dHNleDnlFPdfHGYjZpUnph7MEhKTXqULJ6OaP6IP',
			'accessTokenSecret' => 'iMmuv0bADX4CbG3i0T1vDvGo1uRYlAWfb5khB9Qfm7v3m',
			'usecache'          => true,
			'count'             => 5,  //this how many tweets to fectch
			'numdays'           => 3000
		));
		
		return $tweets;
	}
}

?>