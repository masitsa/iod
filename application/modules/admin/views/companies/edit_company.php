
          <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
            
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url();?>admin/categories" class="btn btn-info pull-right">Back to categories</a>
                        </div>
                    </div>
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			
			//the company details
            $row = $company[0];
			
			$company_name = $row->company_name;
			$company_phone = $row->company_phone;
			$company_email = $row->company_email;
			$company_physical_address = $row->company_physical_address;
			$company_status = $row->company_status;
			$company_postal_address = $row->company_postal_address;
			$company_post_code = $row->company_post_code;
			$company_town = $row->company_town;
			$company_facsimile = $row->company_facsimile;
			$company_cell_phone = $row->company_cell_phone;
			$company_activity = $row->company_activity;
			
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$company_name = set_value('company_name');
				$company_phone = set_value('company_phone');
				$company_email = set_value('company_email');
				$company_physical_address = set_value('company_physical_address');
				$company_status = set_value('company_status');
				$company_postal_address = set_value('company_postal_address');
				$company_post_code = set_value('company_post_code');
				$company_town = set_value('company_town');
				$company_facsimile = set_value('company_facsimile');
				$company_cell_phone = set_value('company_cell_phone');
				$company_activity = set_value('company_activity');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_name" class="form-control input-lg" placeholder="Company" tabindex="3" value="<?php echo $company_name;?>">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_physical_address" class="form-control input-lg" placeholder="Company Physical Address" tabindex="3" value="<?php echo $company_physical_address;?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_postal_address" class="form-control input-lg" placeholder="Company Postal Address" tabindex="3" value="<?php echo $company_postal_address;?>">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_post_code" class="form-control input-lg" placeholder="Company Post Code" tabindex="3" value="<?php echo $company_post_code;?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="company_town" class="form-control input-lg" placeholder="Company Town" tabindex="3" value="<?php echo $company_town;?>">
            </div>
            <div class="form-group">
                <input type="text" name="company_email" class="form-control input-lg" placeholder="Company Email" tabindex="3" value="<?php echo $company_email;?>">
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_phone" class="form-control input-lg" placeholder="Company Phone" tabindex="3" value="<?php echo $company_phone;?>">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" name="company_cell_phone" class="form-control input-lg" placeholder="Company Cell Phone" tabindex="3" value="<?php echo $company_cell_phone;?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="company_facsimile" class="form-control input-lg" placeholder="Company Facsimile" tabindex="3" value="<?php echo $company_facsimile;?>">
            </div>
            <div class="form-group">
                <input type="text" name="company_activity" class="form-control input-lg" placeholder="Company Activity" tabindex="3" value="<?php echo $company_activity;?>">
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate company?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                        	<?php
                            if($company_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="company_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="1" name="company_status">';}
							?>
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<?php
                            if($company_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="company_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="0" name="company_status">';}
							?>
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit company
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                </div>
            </section>