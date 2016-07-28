<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Edit Event</h2>
        <a href="<?php echo site_url().'content/events';?>" class="btn btn-success btn-sm pull-right" style="margin-top:-25px;">Back to events</a>
    </header>
    <div class="panel-body">   
        <!-- Jasny -->
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
                            <label for="event_type_id">Event Type</label>
                            <select class="form-control" name="event_type_id">
                                <?php
                                    foreach ($event_types->result() as $key) {
                                        # code...
                                        $event_type_id = $key->event_type_id;
                                        $event_type_name = $key->event_type_name;
                                        $selected_event_type_id = $event_row->event_type_id;
                                            
                                        if($selected_event_type_id == $event_type_id)
                                        {
                                        ?>
                                        <option value="<?php echo $event_type_id;?>" selected="selected"><?php echo $event_type_name;?></option>
                                        <?php
                                        }
                                        
                                        else
                                        {
                                        ?>
                                        <option value="<?php echo $event_type_id;?>" ><?php echo $event_type_name;?></option>
                                        <?php
                                        }
                                    }
                                ?>
                                    
                            </select>
	                    </div>
                        <div class="form-group">
                            <label for="event_name">Event Name</label>
                            <input type="text" class="form-control" name="event_name" placeholder="Event Name" value="<?php echo $event_row->event_name;?>">
                        </div>
                        <div class="form-group">
                            <label for="event_name">Event Venue</label>
                            <input type="text" class="form-control" name="event_venue" placeholder="Event venue" value="<?php echo $event_row->event_venue;?>">
                        </div>
                        <div class="form-group">
                            <label for="event_name">Event Location</label>
                            <input type="text" class="form-control" name="event_location" placeholder="Event location" value="<?php echo $event_row->event_location;?>">
                        </div>
                        <div class="form-group">
                            <label for="event_name">Event start date</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="event_start_time" placeholder="Event start date" value="<?php echo $event_row->event_start_time;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_name">Event end date</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="event_end_time" placeholder="Event end date" value="<?php echo $event_row->event_end_time;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_name">Event admission cost</label>
                            <input type="text" class="form-control" name="event_admission" placeholder="Event admission cost" value="<?php echo $event_row->event_admission;?>">
                        </div>
					</div>
                	<div class="col-md-6">
                        <label class="control-label" for="image">Event Image</label>
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 400px;">
								<img src="<?php echo $event_location;?>" class="img-responsive"/>
							</div>
							
							<div>
								<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="event_image"></span>
								<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="event_description">Event description</label>
                            <div class="col-md-10">
                            	<textarea class="cleditor" name="event_description" id="event_description"><?php echo $event_row->event_description;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group center-align">
					<input type="submit" value="Edit Event" class="login_btn btn btn-success btn-lg">
				</div>
				<?php
					echo form_close();
				?>
		</div>
	</div>
</section>