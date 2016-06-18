<?php
$contacts = $this->site_model->get_contacts();
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$email2 = $contacts['email'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
		
		if(!empty($facebook))
		{
			//$facebook = '<li class="facebook"><a href="'.$facebook.'" target="_blank" title="Facebook">Facebook</a></li>';
		}
		
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
		$google = '';
	}
?>
 <!-- HEADER -->
    <header id="header" class="header">
        <div class="container" style="overflow: hidden;">

            <!-- LOGO -->
            <div><a href="<?php echo site_url();?>"><img src="<?php echo base_url().'assets/logo/'.$logo;?>" alt="<?php echo $company_name;?>" class="account-logo"></a></div>
            <!-- END / LOGO -->

            <!-- NAVIGATION -->
            <nav class="navigation">

                <div class="open-menu">
                    <span class="item item-1"></span>
                    <span class="item item-2"></span>
                    <span class="item item-3"></span>
                </div>

                <!-- MENU -->
                <ul class="menu">
                    <li><a href="<?php echo site_url().'logout';?>">Sign Out</a></li>
                </ul>
                <!-- END / MENU -->

                <!-- LIST ACCOUNT INFO -->
                <ul class="list-account-info">

                    <!-- MESSAGE INFO -->
                    <li class="list-item messages">
                        <div class="message-info item-click">
                            <i class="fa fa-envelope"></i>
                            <span class="itemnew"></span>
                        </div>
                        <div class="toggle-message toggle-list">
                            <div class="list-profile-title">
                                <h4>Inbox message</h4>
                                <span class="count-value">3</span>
                                <a href="account-assignment.html#" class="new-message"><i class="fa fa-pencil"></i></a>
                            </div>
                            <ul class="list-message">

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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
                                                <i class="fa fa-paperclip"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="image">
                                            <img src="images/team-13.jpg" alt="">
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
                            <div class="viewall">
                                <a href="account-assignment.html#">view all 80 messages</a>
                            </div>
                        </div>
                    </li>
                    <!-- END / MESSAGE INFO -->

                    <!-- NOTIFICATION -->
                    <li class="list-item notification">
                        <div class="notification-info item-click">
                            <i class="fa fa-bell"></i>
                            <span class="itemnew"></span>
                        </div>
                        <div class="toggle-notification toggle-list">
                            <div class="list-profile-title">
                                <h4>Notification</h4>
                                <span class="count-value">2</span>
                            </div>

                            <ul class="list-notification">

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li class="ac-new">
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="account-assignment.html#">
                                        <div class="list-body">
                                            <div class="author">
                                                <span>Megacourse</span>
                                                <div class="div-x"></div>
                                            </div>
                                            <p>attend Salary for newbie course</p>
                                            <div class="image">
                                                <img src="images/feature/img-1.jpg" alt="">
                                            </div>
                                            <div class="time">
                                                <span>5 minutes ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- END / LIST ITEM -->

                                

                            </ul>
                        </div>
                    </li>
                    <!-- END / NOTIFICATION -->

                    <li class="list-item account">
                        <div class="account-info item-click">
                            <img src="images/team-13.jpg" alt="">
                        </div>
                        <div class="toggle-account toggle-list">
                            <ul class="list-account">
                                <li><a href="setting.html"><i class="fa fa-config"></i>Setting</a></li>
                                <li><a href="login.html"><i class="fa fa-arrow-right"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </li>


                </ul>
                <!-- END / LIST ACCOUNT INFO -->

            </nav>
            <!-- END / NAVIGATION -->

        </div>
    </header>
    <!-- END / HEADER -->

