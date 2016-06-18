
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?php echo $title;?></h2>
        </header>
        <div class="panel-body">
          <style type="text/css">
		  	.add-on{cursor:pointer;}
		  </style>
          <div class="padd">
          	<a href="<?php echo site_url().'notifications';?>" class="btn btn-primary pull-right">Back to notifications</a>
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            $error_message = $this->session->userdata('error_message');
            if(!empty($error_message))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$error_message.' </div>';
				$this->session->unset_userdata('error_message');
            }
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- notification Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Notification Title</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="notification_title" placeholder="Notification Title" value="<?php echo set_value('notification_title');?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Notification Date</label>
                
                <div class="col-lg-4">
                	<div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="created" placeholder="Notification Date" value="<?php echo set_value('created');?>">
                    </div>
                    
                </div>
            </div>
            <!-- Image -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Notification Image</label>
                <div class="col-lg-4">
                    
                    <div class="row">
                    
                    	<div class="col-md-4 col-sm-4 col-xs-4">
                        	<div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                    <img src="http://placehold.it/200x200">
                                </div>
                                <div>
                                    <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="notification_image"></span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Notification?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" checked value="1" name="notification_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" value="0" name="notification_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <!-- notification content -->
            <div class="form-group">
                <label class="col-lg-12 control-label">Notification Content</label>
                <div class="col-lg-12" style="height:500px;">
                    <textarea class="cleditor" name="notification_content" placeholder="Notification Content"><?php echo set_value('notification_content');?></textarea>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add notification
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>
    </div>
</section>