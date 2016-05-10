<div class="container">

    <div class="row">
    
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        	<?php
				$validation_errors = validation_errors();
				if(!empty($validation_errors))
				{
					echo '<div class="alert alert-danger">'.$validation_errors.'</div>';
				}
				
				$login_error = $this->session->userdata('login_error');
				if(!empty($login_error))
				{
					$this->session->unset_userdata('login_error');
					echo '<div class="alert alert-danger">'.$login_error.'</div>';
				}
			?>
            <form action="<?php echo site_url().'admin/auth/login_admin';?>" method="post" role="form">
                <h2>Admin <small>Login</small></h2>
                <hr class="colorgraph">
                
                <div class="form-group">
                    <input type="email" name="user_email" id="email" class="form-control input-lg" placeholder="Email" tabindex="4" value="<?php echo set_value('user_email');?>">
                </div>
                <div class="form-group">
                    <input type="password" name="user_password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" value="<?php echo set_value('user_password');?>">
                </div>
                
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3"><input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                </div>
            </form>
        </div>
    </div>
</div>
