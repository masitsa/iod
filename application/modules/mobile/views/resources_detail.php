<?php
if($query->num_rows() > 0)
{   $count = 0;
    foreach($query->result() as $res)
    {
        $resource_category_name = $res->resource_category_name;
        $resource_category_id = $res->resource_category_id;
        $resource_category_description = $res->resource_category_description;
        $mini_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 100));
        $maxi_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 40));

        $attachments = $this->resources_model->get_attachments($resource_category_id);
       
	}
	$result = '
				<div class="content-block-title">
		            <div class="row">
		              <div class="col-100">
		                <span class="event-title">'.strip_tags($resource_category_name).'</span>
		              </div>
		             </div>
		        </div>
		        <div class="content-block">
		            <div class="content-block-inner">
		              <p>'.$resource_category_description.'</p>';
		              	if ($attachments->num_rows() > 0)
						{
						       
								$result .=' 
				             	<ul class="simple_list">';
				             		foreach ($attachments->result() as $row_item)
									{
										$resource_name = $row_item->resource_name;
										$description = $row_item->resource_description;
										$resource_image = $row_item->resource_image_name;
										$resource_image_name = $row_item->resource_image_name;
										$resource_button_text = $row_item->resource_button_text;
										$resource_link = site_url().'assets/resource/'.$resource_image_name;
								        
				             			 $result .="<li><a href='#' class='download-resource' download_file='".$resource_link."'>".$resource_name."</a></li>";

				             		}
				             	$result .='	
				             	<ul>';
				         }
		               $result .='
		            </div>
		        </div>';
}else
{
	$result = 'Data not found';
}
echo $result;
?>