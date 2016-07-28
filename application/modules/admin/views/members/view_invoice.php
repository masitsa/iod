<?php
$res = $invoices->row();
$invoice_id = $res->invoice_id;
$invoice_date = date('jS M Y',strtotime($res->invoice_date));
$invoice_status_name = $res->invoice_status_name;
$member_first_name = $res->member_first_name;
$member_surname = $res->member_surname;
$invoice_status = $res->invoice_status;
$invoice_number = $res->invoice_number;
$invoice_items = $this->invoices_model->get_invoice_items($invoice_id);

$button2 = $display_invoice_items = '';
if($invoice_status == 0)
{
	$button2 = '<span class="label label-danger">'.$invoice_status_name.'</span>';
}
else
{
	$button2 = '<span class="label label-success">'.$invoice_status_name.'</span>';
}
if(count($contacts) > 0)
{
	$email = $contacts['email'];
	$facebook = $contacts['facebook'];
	$twitter = $contacts['twitter'];
	$logo = $contacts['logo'];
	$company_name = $contacts['company_name'];
	$phone = $contacts['phone'];
	$address = $contacts['address'];
	$post_code = $contacts['post_code'];
	$city = $contacts['city'];
	$building = $contacts['building'];
	$floor = $contacts['floor'];
	$location = $contacts['location'];

	$working_weekday = $contacts['working_weekday'];
	$working_weekend = $contacts['working_weekend'];

	$mission = $contacts['mission'];
	$vision = $contacts['vision'];
	$about = $contacts['about'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Institute of Directors Kenya | Invoice</title>
        <!-- For mobile content -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- IE Support -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/";?>bootstrap/css/bootstrap.css" media="all"/>
        <style type="text/css">
			.receipt_spacing{letter-spacing:0px; font-size: 12px;}
			.center-align{margin:0 auto; text-align:center;}
			
			.receipt_bottom_border{border-bottom: #888888 thin solid;}
			.row .col-md-12 table {
				border:solid #000 !important;
				border-width:1px 0 0 1px !important;
				font-size:10px;
			}
			.row .col-md-12 th, .row .col-md-12 td {
				border:solid #000 !important;
				border-width:0 1px 1px 0 !important;
			}
			.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td
			{
				 padding: 2px;
			}
			
			.row .col-md-12 .title-item{float:left;width: 130px; font-weight:bold; text-align:right; padding-right: 20px;}
			.title-img{float:left; padding-left:30px;}
			img.logo{max-height:70px; margin:0 auto;}
			.table, p{font-size:0.6em !important;}
		</style>
    </head>
    <body>
    	<table class="table table-condensed receipt_bottom_border">
            <tr>
                <th>INVOICE</th>
                <th style="text-align:right;">
                    <?php echo $company_name;?><br/>
                    <?php echo $address;?> <?php echo $post_code;?> <?php echo $city;?><br/>
                    E-mail: <?php echo $email;?><br/>
                    Tel : <?php echo $phone;?><br/>
                    <?php echo $location;?> <?php echo $building;?> <?php echo $floor;?>
                </th>
                <th style="text-align:right;">
                    <img src="<?php echo base_url().'assets/logo/'.$logo;?>" alt="<?php echo $company_name;?>" class="img-responsive logo"/>
                </th>
            </tr>
        </table>
        
        <!-- Patient Details -->
    	<table class="table table-condensed receipt_bottom_border">
            <tr>
                <td>
                    <strong>Member:</strong>
                    <?php echo $member_first_name.' '.$member_surname; ?>
                </td>
                <td>
                    <strong>Invoice Number:</strong>
                    <?php echo $invoice_number; ?>
                </td>
                <td>
                    <strong>Invoice Date:</strong>
                    <?php echo $invoice_date; ?>
                </td>
            </tr>
        </table>
        
    	<div class="row receipt_bottom_border">
        	<div class="col-md-12 center-align">
            	<strong>BILLED ITEMS</strong>
            </div>
        </div>
        
    	<div class="row">
        	<div class="col-md-12">
            	<table class="table table-condensed table-bordered">
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
					foreach($invoice_items->result() as $row2)
					{
						$invoice_item_amount = $row2->invoice_item_amount;
						$invoice_item_description = $row2->invoice_item_description;
						$units = 1;
						$counter++;
						$total+=$invoice_item_amount;
						$display_invoice_items .= '
						<tr>
							<td>'.$counter.'</td>
							<td>'.$invoice_item_description.'</td>
							<td>'.number_format($invoice_item_amount).'</td>
							<td>'.$units.'</td>
							<td>'.number_format($invoice_item_amount).'</td>
						</tr>
						';
					}
					$display_invoice_items .= '
					<tr>
						<th colspan="4">Total</th>
						<td>'.number_format($total).'</td>
					</tr>
					';
				}
				echo $display_invoice_items;
				?>
                    </tbody>
                </table>
                
                <h4>How to Pay</h4>
                 <p>Mpesa Paybill or Standard Chartered Bank Account - The Mpesa Paybill No. is <strong>176760</strong>. Use account no. <strong>YourName-EventName(for training)/ YourName-Memberno. (for Subscriptions)</strong> You may also choose to use our Standard Chartered Bank <strong>A/c no. 0102097001400, Westlands Branch</strong>. A receipt shall be issued.</p>
            </div>
        </div>
        
    	<div class="row center-align" style="font-style:italic; font-size:11px;">
        	<div class="col-md-2">
            	<?php echo date('jS M Y H:i a'); ?> Thank you
            </div>
        </div>
    </body>
    
</html>