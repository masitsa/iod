<?php
$result = '';

//if users exist display them
if ($query->num_rows() > 0)
{
	$count = $page;
	
	$result .= 
		'
			<table class="table table-hover table-bordered ">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Name</th>
				  <th>Phone</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
		';
	
	foreach ($query->result() as $row)
	{
		
		$message_id = $row->message_id;
		$entryid = $row->member_id;
		$name = $row->member_first_name.' '.$row->member_surname;
		$Phonenumber = $row->member_phone;
		
		$count++;
		$result .= 
			'
				<tr>
					<td>'.$count.'</td>
					<td>'.$name.'</td>
					<td>'.$Phonenumber.'</td>
					<td><a href="'.site_url().'delete-message-contact/'.$message_id.'/'.$message_batch_id.'/'.$message_template_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$name.' from the list of message?\');" title="Delete '.$name.'"><i class="fa fa-trash"></i></a></td>

					
				</tr> 
			';
	}
	
	$result .= 
	'
				  </tbody>
				</table>
	';
}

else
{
	$result .= "There are no personnel";
}

$message_template_id = $message_template[0]->message_template_id;
$message_template_code = $message_template[0]->message_template_code;
$message_template_description = $message_template[0]->message_template_description;
$message_template_status = $message_template[0]->message_template_status;


$sample_text = $this->messaging_model->get_sample_text($message_template_description);

?>
<div class="row" style="margin-top:0px">
	<div class="col-md-12">
		<section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">
                    
                    <div class="widget-summary-col">
                        <div class="summary" >
                            <!-- <h4 class="title">Message Template</h4> -->
                            <div class="info ">
                            	<strong>Template:</strong> <?php echo $message_template_description;?>
                               <p><strong> Example text : <span style="text-style:intalic;">"<?php echo $sample_text;?>"</span></strong></p>
                            </div>
                            <?php
                             $search_template = $this->session->userdata('search_template');
                            if(!empty($search_template))
                            {
                            	?>
                            	<hr>
                            	  <div class="info center-align">
		                            	<strong>Serach Template:</strong><?php echo $this->session->userdata('search_title');?>
		                           </div>
                            	<?php
                            	echo form_open("create-batch-items/".$message_template_id, array("class" => "form-horizontal", "role" => "form"));
                            	?>
                            	<input type="hidden" name="message_template_description" value="<?php echo $message_template_description?>">
                            	<div class="row" style="margin-top:10px;">
									<div class="col-md-12">
								        <div class="form-actions center-align">
								            <button class="submit btn btn-sm btn-primary" type="submit">
								                Create Batch Items
								            </button>
								        </div>
								    </div>
								</div>
                            	<?php
                            	echo form_close();
                            }
                            ?>

                        </div>

                    </div>
                </div>

            </div>
        </section>
	</div>
	
</div>
<section class="panel">
	<header class="panel-heading">						
		<h2 class="panel-title"><?php echo $title;?> for batch <?php echo $message_template_code;?></h2>
		<a href="<?php echo site_url();?>template-detail/<?php echo $message_template_id;?>" class="btn btn-sm btn-info pull-right" style="margin-top:-25px"> Back to messaging section</a>
	</header>
	<div class="panel-body">
		<?php
	    $success = $this->session->userdata('success_message');

		if(!empty($success)){

					echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		?>
		<div class="table-responsive">
	    	
			<?php echo $result;?>

	    </div>
	</div>
	<div class="panel-footer">
		<?php if(isset($links)){echo $links;}?>
	</div>
</section>