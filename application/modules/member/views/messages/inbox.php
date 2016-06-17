
    <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">

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
									$last_chatted = '';
									if($messages->num_rows() > 0)
									{
										$message = $messages->result();
										
										foreach($message as $mes)
										{
											$unread = 0;
											$client_id = $mes->client_id;
											$receiver_id = $mes->receiver_id;
											$created = $mes->created;
											//$last_chatted = $mes->last_chatted;
											$message_file_name = $mes->message_file_name;
											
											if($client_id == $current_client_id)
											{
												$receiver_query = $this->profile_model->get_client($receiver_id);
												$sent_messages = $this->profile_model->get_messages($current_client_id, $receiver_id, $this->messages_path);
											}
											else
											{
												$receiver_query = $this->profile_model->get_client($client_id);
												$sent_messages = $this->profile_model->get_messages($current_client_id, $client_id, $messages_path);
											}
											
											//message details
											$mini_msg = '';
											if(is_array($sent_messages))
											{
												$total_messages = count($sent_messages);
												$last_message = $total_messages - 1;
												
												if($total_messages > 0)
												{
													$message_data = $sent_messages[$last_message];
													$client_message_details = $message_data->client_message_details;
													$check_receiver_id = $message_data->receiver_id;
													$last_chatted = $message_data->created;
													$mini_msg = implode(' ', array_slice(explode(' ', $client_message_details), 0, 10));
												
													//bold unread messages
													if($check_receiver_id == $current_client_id)
													{
														$unread = 1;
													}
												}
											}
											$today_check = date('jS M Y',strtotime($last_chatted));
											$today = date('jS M Y',strtotime(date('Y-m-d')));
											
											//if today display time
											if($today_check == $today)
											{
												$date_display = date('H:i a',strtotime($last_chatted));
											}
											else
											{
												$date_display = date('jS M Y',strtotime($last_chatted));
											}
											
											//get receiver details
											$prods = $receiver_query->row();
											$client_image = $this->profile_image_location.$prods->client_thumb;
											$client_dob = $prods->client_dob;
											$client_username = $prods->client_username;
											$age = $this->profile_model->calculate_age($client_dob);
											$web_name = $this->profile_model->create_web_name($client_username);
											
											if($unread == 1)
											{
												$client_username = '<strong>'.$client_username.'</strong>';
												$mini_msg = '<strong>'.$mini_msg.'</strong>';
											}
											
											echo
											'
											<!-- LIST ITEM -->
											<li class="ac-new">
												<a href="'.site_url().'messages/inbox/'.$web_name.'">
													<div class="image">
														<img src="'.$client_image.'" alt="">
													</div>
													<div class="list-body">
														<div class="author">
															<span>'.$client_username.'</span>
															<div class="div-x"></div>
														</div>
														<p>'.$mini_msg.'</p>
														<div class="time">
															<span>'.$date_display.'</span>
														</div>
														<div class="indicator">
															<i class="fa fa-envelope"></i>
														</div>
													</div>
												</a>
											</li>
											';
										}
									}
									
									else
									{
										echo 'There are no notifications';
									}
								?>
                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Welcome message</p>
                                            <div class="time">
                                                <span>12:53</span>
                                            </div>
                                            <div class="indicator">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Welcome message</p>
                                            <div class="time">
                                                <span>12:53</span>
                                            </div>
                                            <div class="indicator">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Welcome message</p>
                                            <div class="time">
                                                <span>12:53</span>
                                            </div>
                                            <div class="indicator">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="active">
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Name of sender</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Message title</p>
                                            <div class="time">
                                                <span>5 days ago</span>
                                            </div>
                                            <div class="indicator">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Sasha Grey</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Maecenas sodales, nisl eget dign...</p>
                                            <div class="time">
                                                <span>5 days ago</span>
                                            </div>
                                            <div class="indicator">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-inbox.html#">
                                        <div class="image">
                                            <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                        </div>
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Amanda Gleam</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>Message title</p>
                                            <div class="time">
                                                <span>5 days ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="message-ct">
                            <div class="author">
                                <div class="image">
                                    <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                                </div>
                                <span class="author-name">Anna Molly</span>
                                <em>5 days ago</em>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                            <a href="account-inbox.html#" class="download-ind">
                                <i class="fa fa-paperclip"></i>
                                toanna.zip (12mb)
                            </a>
                            <div class="text-form-editor">
                                <img src="images/editor-demo-1.jpg" alt="">
                                <textarea placeholder="Discussion content"></textarea>
                            </div>
                            <div class="form-action">
                                <input type="submit" value="Send message" class="send mc-btn-3 btn-style-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
