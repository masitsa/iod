   
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url().'corporates';?>" class="btn btn-success btn-sm pull-right">Back</a>
                        </div>
                    </div>
        <!-- Jasny -->
        <link href="<?php echo base_url();?>assets/jasny/jasny-bootstrap.css" rel="stylesheet">		
        <script type="text/javascript" src="<?php echo base_url();?>assets/jasny/jasny-bootstrap.js"></script> 
          <div class="padd">
            <?php
				$error2 = validation_errors(); 
				if(!empty($error2)){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo validation_errors(); ?>
							</div>
						</div>
					</div>
				<?php }
			
				if(isset($_SESSION['error'])){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo $_SESSION['error']; $_SESSION['error'] = NULL;?>
							</div>
						</div>
					</div>
				<?php }?>
			
				<?php
				$attributes = array('role' => 'form');
		
				echo form_open_multipart($this->uri->uri_string(), $attributes);
				
				if(!empty($error))
				{
					?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
					<?php
				}
				?>
                <div class="row">
                	<div class="col-md-6">
                        <div class="form-group">
                            <label for="corporates_name">Title</label>
                            <input type="text" class="form-control" name="corporates_name" placeholder="Enter Title" value="<?php echo set_value("corporates_name");?>">
                        </div>
                        <div class="form-group">
                            <label for="corporates_name">Button Text</label>
                            <input type="text" class="form-control" name="corporates_button_text" placeholder="Button Text" value="<?php echo set_value("corporates_button_text");?>">
                        </div>
                        <div class="form-group">
                            <label for="corporates_name">Link</label>
                            <input type="text" class="form-control" name="corporates_link" placeholder="Link" value="<?php echo set_value("corporates_link");?>">
                        </div>
                        <div class="form-group">
                            <label for="corporates_description">Description</label>
                            <textarea class="form-control" name="corporates_description"><?php echo set_value("corporates_description");?></textarea>
                        </div>
                        <input type="hidden" name="check" value="1"/>
					</div>
                	<div class="col-md-6">
                        <label class="control-label" for="image">Slide Image</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="corporates_image"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                	</div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Add Corporate" class="login_btn btn btn-success">
				</div>
				<?php
					form_close();
				?>
                </div>
            </section>