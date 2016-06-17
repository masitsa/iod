	<section id="quizz-intro-section" class="quizz-intro-section learn-section">
        <div class="container">
            <div class="table-student-submission">
                <table class="mc-table">
                    <thead>
                        <tr>
                            <th class="submissions">Event Title</th>
                            <th class="author">Venue</th>
                            <th class="score">Price</th>
                            <th class="submit-date">Date</th>
                        </tr>
                    </thead>

                    <tbody>
						<?php
						$result = ''; 
						if($query->num_rows() > 0)
						{
							foreach($query->result() as $cat)
							{
								$training_id = $cat->training_id;
								$training_status = $cat->training_status;
								$training_date = $cat->training_date;
								$start_date = $cat->start_date;
								$end_date = $cat->end_date;
								$created = $cat->created;
								$training_name = $cat->training_name;
								$training_venue = $cat->training_venue;
								$training_price = number_format($cat->training_price, 2);
								$training_image_name = $cat->training_image_name;
								$start_date = date('jS M Y',strtotime($start_date));
								$end_date = date('jS M Y',strtotime($end_date));
								$created = date('jS M Y',strtotime($created));
								$day = date('d',strtotime($start_date));
								$month = date('M',strtotime($start_date));
								$web_name = $this->site_model->create_web_name($training_name);

								$result .= '
									<tr class="new">
										<td class="submissions"><a href="'.site_url().'member/events/'.$web_name.'-'.$training_id.'">'.$training_name.'</a></td>
										<td class="author">'.$training_venue.'</td>
										<td class="score">'.$training_price.'</td>
										<td class="submit-date">'.$start_date.'</td>
									</tr>
								';
								
							}
						}
						else
						{
							$result = '
							<tr class="new">
								<td class="submissions"><a href="#">There are no events</a></td>
								<td class="author"></td>
								<td class="score"></td>
								<td class="submit-date"></td>
							</tr>
							';
						}
						
						echo $result;
						?>

                    </tbody>
                </table>
            </div>
				
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($links)){echo $links;} ?>
                </div>
            </div>
        </div>
    </section>

