   
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url().'resource';?>" class="btn btn-success btn-sm pull-right">Back</a>
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
                            <label for="resource_name">Title</label>
                            <input type="text" class="form-control" name="resource_name" placeholder="Enter Title" value="<?php echo set_value("resource_name");?>">
                        </div>
                        <div class="form-group">
                            <label for="resource_description">Category</label>
                            <select class="form-control" name="resource_category_id">
                            	<option value="">--Select Category--</option>
								<?php
                                if($resource_categories->num_rows() > 0)
                                {
                                    $former_resource_category_id = set_value('resource_category_id');
                                    foreach($resource_categories->result() as $res)
                                    {
                                        $resource_category_id = $res->resource_category_id;
                                        $resource_category_name = $res->resource_category_name;
                                        
                                        if($former_resource_category_id == $resource_category_id)
                                        {
                                            echo '<option value="'.$resource_category_id.'" selected="selected">'.$resource_category_name.'</option>';
                                        }
                                        
                                        else
                                        {
                                            echo '<option value="'.$resource_category_id.'">'.$resource_category_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
					</div>
                	<div class="col-md-6">
                        <div class="form-group">
                             <label class="col-lg-4 control-label" for="image">Resource</label>
                            <div class="col-lg-8">
                            	<?php echo form_upload(array( 'name'=>'gallery[]', 'multiple'=>true, 'class'=>'btn'));?>
                            </div>
                        </div>
                	</div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Add Resource" class="login_btn btn btn-success">
				</div>
				<?php
					form_close();
				?>
                </div>
            </section>