 <!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container message-body">
        	<div class="row">
            	<div class="col-md-12">
                	<?php
                        $success_message = $this->session->userdata('success_message');
                        if(!empty($success_message))
                        {
                            $this->session->unset_userdata('success_message');
                            echo '<div class="alert alert-success">'.$success_message.'</div>';
                        }
                        
                        $error_message = $this->session->userdata('error_message');
                        if(!empty($error_message))
                        {
                            $this->session->unset_userdata('error_message');
                            echo '<div class="alert alert-danger">'.$error_message.'</div>';
                        }
                    ?>
                </div>
            </div>
            <div class="table-asignment">

                <ul class="nav-tabs" role="tablist">
                    <li class="active"><a href="#invoices" role="tab" data-toggle="tab">My Invoices</a></li>
                    <li><a href="#payments" role="tab" data-toggle="tab">My Payments</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade in active" id="invoices">
                    	<!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice No</th>
                                            <th>Invoice date</th>
                                            <th>Status</th>
                                            <th colspan="3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										//var_dump($invoices); die();
										if($invoices->num_rows() > 0)
										{
											$count = 0;
											foreach($invoices->result() as $res)
											{
												$member_id = $res->member_id;
												$invoice_id = $res->invoice_id;
												$invoice_date = date('jS M Y',strtotime($res->invoice_date));
												$invoice_status_name = $res->invoice_status_name;
												$invoice_status = $res->invoice_status;
												$invoice_number = $res->invoice_number;
												$invoice_items = $this->invoices_model->get_invoice_items($invoice_id);
												$count++;
												$button = '';
												if($invoice_status == 0)
												{
													$button = '<span class="label label-danger">'.$invoice_status_name.'</span>';
												}
												else
												{
													$button = '<span class="label label-success">'.$invoice_status_name.'</span>';
												}
											?>
											<tr>
												<td><?php echo $count;?></td>
												<td><?php echo $invoice_number;?></td>
												<td><?php echo $invoice_date;?></td>
												<td><?php echo $button;?></td>
                                                <td>
                                                	<a href="<?php echo site_url().'member/download_invoice/'.$invoice_id;?>" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a>
                                                </td>
												<td>
                                                	<a title="View Invoice <?php echo $invoice_number;?>" class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#view_invoice<?php echo $invoice_id;?>"><i class="fa fa-plus"></i></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="view_invoice<?php echo $invoice_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel"><?php echo $invoice_number;?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Item</th>
                                                                            <th>Amount</th>
                                                                            <th>Units</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                	<?php
                                                                    if($invoice_items->num_rows() > 0)
																	{
																		$counter = 0;
																		$total = 0;
																		foreach($invoice_items->result() as $row)
																		{
																			$invoice_item_amount = $row->invoice_item_amount;
																			$invoice_item_description = $row->invoice_item_description;
																			$units = 1;
																			$counter++;
																			$total+=$invoice_item_amount;
																			?>
                                                                            <tr>
                                                                                <td><?php echo $counter;?></td>
                                                                                <td><?php echo $invoice_item_description;?></td>
                                                                                <td><?php echo number_format($invoice_item_amount);?></td>
                                                                                <td><?php echo $units;?></td>
                                                                                <td><?php echo number_format($invoice_item_amount);?></td>
                                                                            </tr>
                                                                            <?php
																		}
																		?>
																		<tr>
																			<th colspan="4">Total</th>
																			<td><?php echo number_format($total);?></td>
																		</tr>
																		<?php
																	}
																	?>
                                                                    	</tbody>
                                                                    </table>
                                                                    <h4>How to Pay</h4>
                                                                    <p>Payments can be made to<br/> <strong>Chase Bank Kenya</strong><br/> <strong>Strathmore Branch</strong><br/> <strong>A/C No 0012254444788</strong><br/>Please bring your deposit slips once you have made payments<br/>You can also pay by Mpesa <br/>Paybill no <strong>55879</strong> <br/>Acc no <strong><?php echo $invoice_number;?></strong></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                	<a href="<?php echo site_url().'payment/'.$total.'/'.$invoice_number.'/'.$invoice_id.'/'.$member_id;?>" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a> Pay
                                                </td>
											</tr>
                                        <?php
										 	}
										}
										else
										{
											echo "No invoices have been added to your account";
										}?>
                                    
									</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- END / MY SUBMISSIONS -->

                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade" id="payments">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice No</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Date</th>
                                            <th>Receipt Number</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										if($payments->num_rows() > 0)
										{
											$count = 0;
											foreach($payments->result() as $res)
											{
												$invoice_id = $res->invoice_id;
												$invoice_number = $res->invoice_number;
												$payment_date = $res->payment_date;
												$receipt_number = $res->reciept_number;
												$payment_amount = $res->payment_amount;
												$invoice_status == 8; 
												$count++;
												$button = '';
												
											?>
											<tr>
												<td><?php echo $count;?></td>
												<td><?php echo $invoice_number;?></td>
												<td><?php echo $payment_amount;?></td>
                                                <td><?php echo $payment_date;?></td>
												<td><?php echo $receipt_number;?></td>
                                                <td>
                                                	<a href="<?php echo site_url().'member/download_invoice/'.$invoice_id;?>" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a>
                                                </td>
												<td>
                                                	<a title="View Invoice <?php echo $invoice_number;?>" class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#view_invoice<?php echo $invoice_id;?>"><i class="fa fa-plus"></i></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="view_invoice<?php echo $invoice_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                 u   <h4 class="modal-title" id="myModalLabel"><?php echo $invoice_number;?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Item</th>
                                                                            <th>Amount</th>
                                                                            <th>Units</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                	<?php
                                                                    if($invoice_items->num_rows() > 0)
																	{
																		$counter = 0;
																		$total = 0;
																		foreach($invoice_items->result() as $row)
																		{
																			$invoice_item_amount = $row->invoice_item_amount;
																			$invoice_item_description = $row->invoice_item_description;
																			$units = 1;
																			$counter++;
																			$total+=$invoice_item_amount;
																			?>
                                                                            <tr>
                                                                                <td><?php echo $counter;?></td>
                                                                                <td><?php echo $invoice_item_description;?></td>
                                                                                <td><?php echo number_format($invoice_item_amount);?></td>
                                                                                <td><?php echo $units;?></td>
                                                                                <td><?php echo number_format($invoice_item_amount);?></td>
                                                                            </tr>
                                                                            <?php
																		}
																		?>
																		<tr>
																			<th colspan="4">Total</th>
																			<td><?php echo number_format($total);?></td>
																		</tr>
																		<?php
																	}
																	?>
                                                                    	</tbody>
                                                                    </table>
                                                                    <h4>How to Pay</h4>
                                                                    <p>Payments can be made to<br/> <strong>Chase Bank Kenya</strong><br/> <strong>Strathmore Branch</strong><br/> <strong>A/C No 0012254444788</strong><br/>Please bring your deposit slips once you have made payments<br/>You can also pay by Mpesa <br/>Paybill no <strong>55879</strong> <br/>Acc no <strong><?php echo $invoice_number;?></strong></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
											</tr>
                                        <?php }
										}
										else
										{
											echo "No payments have been made yet";
										}?>
                                    
									</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                </div>

            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
<script type="text/javascript">

    $.each($('.table-wrap'), function() {
        $(this)
            .find('.table-item')
            .children('.thead:not(.active)')
            .next('.tbody').hide();
        $(this)
            .find('.table-item')
            .delegate('.thead', 'click', function(evt) {
                evt.preventDefault();
                if ($(this).hasClass('active')==false) {
                    $('.table-item')
                        .find('.thead')
                        .removeClass('active')
                        .siblings('.tbody')
                            .slideUp(200);
                }
                $(this)
                    .toggleClass('active')
                    .siblings('.tbody')
                        .slideToggle(200);
        });
    });

</script>
