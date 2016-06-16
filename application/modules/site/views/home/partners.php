 <?php
 	$partners_result = '';
	if($partners->num_rows() > 0)
	{
		$counter = 0;
		foreach($partners->result() as $partners)
		{
			$partners_name = $partners->partners_name;
			$description = $partners->partners_description;
			$partners_image = $partners->partners_image_name;
			$partners_link = $partners->partners_link;
			$partners_button_text = $partners->partners_button_text;
			$description = $this->site_model->limit_text($description, 8);


			// if ($counter % 3 == 0) {
			//    echo 'image file';
			// }
			$partners_result .= ' 
					              <div class="col-md-2">
					                <a class="thumbnail" href="#"><img alt="" src="'.$partners_location.''.$partners_image.'"></a>
					              </div>';
		}
	}
	else
	{

	}

 ?>

 <div class='col-md-12'>

  <div class="carousel slide media-carousel" id="media">
    <div class="carousel-inner">
    	<div class="item  active">
			<div class="row">
      			<?php echo $partners_result;?>
      		</div>
      	</div>
    </div>
    <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
    <a data-slide="next" href="#media" class="right carousel-control">›</a>
  </div>                          
</div>