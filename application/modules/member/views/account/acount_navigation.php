<!-- CONTEN BAR -->
    <section class="content-bar">
        <div class="container">
            <ul>
                <li>
                    <a href="account-learning.html">
                        <i class="icon md-book-1"></i>
                        Learning
                    </a>
                </li>
                <li>
                    <a href="account-teaching.html">
                        <i class="icon md-people"></i>
                        Teaching
                    </a>
                </li>
                <li class="current">
                    <a href="<?php echo site_url().'member/my_account' ?>">
                        <i class="icon md-shopping"></i>
                        Account
                    </a>
                </li>
                <li>
                    <a href="<?php 
					$member_id = $this->member_id;
					 echo site_url().'update_profile/'.$member_id?>">
                        <i class="icon md-user-minus"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="account-inbox.html">
                        <i class="icon md-email"></i>
                        Inbox
                    </a>
                </li>
            </ul>
        </div>
    </section>
   <!-- END / CONTENT BAR -->
 