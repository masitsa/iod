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
			$partners_result .= ' <div>
								      <img src="'.$partners_location.''.$partners_image.'">
								    </div>';
		}
	}
	else
	{

	}

 ?>

<section>
    <div class="container">
        <div class="row">
            <!-- HEADING 1 START-->
            <div class="col-md-12">
                <div class="kf_edu2_heading2">
                    <h3>Our Partners</h3>
                </div>

                <!-- FACULTY SLIDER WRAP START-->
                <div class="edu2_faculty_wrap regular slider">
                  
                    <?php echo $partners_result;?>
                </div>
                <!-- FACULTY SLIDER WRAP END-->
            </div>
            <!-- HEADING 1 END-->
        </div>
    </div>
</section>
<!-- FACULTY WRAP START-->