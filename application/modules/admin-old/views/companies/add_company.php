          
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url();?>admin/companies" class="btn btn-info pull-right">Back to companies</a>
                        </div>
                    </div>
                        
                    <!-- Adding Errors -->
                    <?php
                    if(isset($error)){
                        echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
                    }
                    
                    $validation_errors = validation_errors();
                    
                    if(!empty($validation_errors))
                    {
                        echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
                    }
                    ?>
                    
                    <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="company_name" class="form-control input-lg" placeholder="Company" tabindex="3" value="<?php echo set_value('company_name');?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="company_physical_address" class="form-control input-lg" placeholder="Company Physical Address" tabindex="3" value="<?php echo set_value('company_physical_address');?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="company_postal_address" class="form-control input-lg" placeholder="Company Postal Address" tabindex="3" value="<?php echo set_value('company_postal_address');?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="company_post_code" class="form-control input-lg" placeholder="Company Post Code" tabindex="3" value="<?php echo set_value('company_post_code');?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="company_town" class="form-control input-lg" placeholder="Company Town" tabindex="3" value="<?php echo set_value('company_town');?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_email" class="form-control input-lg" placeholder="Company Email" tabindex="3" value="<?php echo set_value('company_email');?>">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="company_phone" class="form-control input-lg" placeholder="Company Phone" tabindex="3" value="<?php echo set_value('company_phone');?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="company_cell_phone" class="form-control input-lg" placeholder="Company Cell Phone" tabindex="3" value="<?php echo set_value('company_cell_phone');?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_facsimile" class="form-control input-lg" placeholder="Company Facsimile" tabindex="3" value="<?php echo set_value('company_facsimile');?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_activity" class="form-control input-lg" placeholder="Company Activity" tabindex="3" value="<?php echo set_value('company_activity');?>">
                    </div>
                    <!-- Activate checkbox -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate company?</label>
                        <div class="col-lg-6">
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios1" type="radio" checked value="1" name="company_status">
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="optionsRadios2" type="radio" value="0" name="company_status">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions center-align">
                        <button class="submit btn btn-primary" type="submit">
                            Add company
                        </button>
                    </div>
                    <br />
                    <?php echo form_close();?>
                </div>
            </section>