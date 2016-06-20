
    <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<?php
                        $success_message = $this->session->userdata('success_message');
                        if(!empty($success_message))
                        {
                            $this->session->unset_userdata('success_message');
                            echo '<div class="alert alert-success">'.$success_message.'</div>';
                        }
                        
                        $error_message = $this->session->userdata('error_message');
                        if(!empty($error_message))
                        {
                            $this->session->unset_userdata('error_message');
                            echo '<div class="alert alert-danger">'.$error_message.'</div>';
                        }
                    ?>
                </div>
            </div>
            <div class="message-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="message-sb">
                            <div class="message-sb-title">
                                <h4>Notifications</h4>
                                <!--<a href="#" class="new-message"><i class="fa fa-plus"></i>New message</a>-->
                            </div>
                            <ul class="list-message">
								<?php
									$first_notice = '';
									if($query->num_rows() > 0)
									{
										foreach ($query->result() as $row)
										{
											$notification_id = $row->notification_id;
											$notification_title = $row->notification_title;
											$notification_content = $row->notification_content;
											$notification_status = $row->notification_status;
											$notification_views = $row->notification_views;
											$image = $row->notification_image;
											$created = date('jS M Y',strtotime($row->created));
											$created_by = $row->created_by;
											$modified_by = $row->modified_by;
											$notification_image = base_url()."assets/images/notifications/thumbnail_".$image;
											$mini_desc = implode(' ', array_slice(explode(' ', strip_tags($notification_content)), 0, 10));
											if($first_notice == '')
											{
												$first_notice = $notification_id;
											}
											echo
											'
											<!-- LIST ITEM -->
											<li class="ac-new">
												<a href="'.$notification_id.'" class="view-notification">
													<div class="image">
														<img src="'.$notification_image.'" alt="'.$notification_title.'">
													</div>
													<div class="list-body">
														<div class="author">
															<span>'.$notification_title.'</span>
														</div>
														<p>'.$mini_desc.'</p>
														<div class="time">
															<span>'.$created.'</span>
														</div>
														<div class="indicator">
															<i class="fa fa-envelope"></i>
														</div>
													</div>
												</a>
											</li>
											
											<div class="display-none" id="notice-content'.$notification_id.'">
												<div class="row">
													<div class="col-md-4">
														<div class="author" style="margin-bottom:10px;">
															<div class="image">
																<img src="'.base_url().'assets/images/avatar.png" alt="">
															</div>
															<span class="author-name">Admin</span>
															<em>'.$created.'</em>
														</div>
														<img src="'.$notification_image.'" alt="" class="img-responsive">
													</div>
													<div class="col-md-8">
														<h3 style="margin-top:0;">'.$notification_title.'</h3>
														<p>'.$notification_content.'</p>
													</div>
												</div>
												
												<!--<a href="#" class="download-ind">
													<i class="fa fa-paperclip"></i>
													toanna.zip (12mb)
												</a>
												<div class="text-form-editor">
													<img src="" alt="">
													<textarea placeholder="Discussion content"></textarea>
												</div>
												<div class="form-action">
													<input type="submit" value="Send message" class="send mc-btn-3 btn-style-1">
												</div>-->
											</div>
											';
										}
									}
									
									else
									{
										echo 'There are no notifications';
									}
								?>
                                
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="message-ct" id="notification-content">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
    
    <script type="text/javascript">
		$(document).ready(function(){
			var notification_id = '<?php echo $first_notice;?>';
			//get notice content
			var notice = $('#notice-content'+notification_id).html();
			//set notice content
			$('#notification-content').html(notice);
		});
		
		$(document).on("click","a.view-notification",function(e)
		{
			e.preventDefault();
			
			//get notification id
			var notification_id = $(this).attr('href');
			//get notice content
			var notice = $('#notice-content'+notification_id).html();
			//set notice content
			$('#notification-content').html(notice);
			return false;
		});
	</script>
