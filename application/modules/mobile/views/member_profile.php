<?php
$result ='';
$query = $this->login_model->get_profile_items($member_no);
if($query->num_rows() > 0)
{
	foreach ($query->result() as $key) {
		# code...
		$member_number = $key->member_number;
		$member_first_name = $key->member_first_name;
		$member_email = $key->member_email;
		$member_surname = $key->member_surname;
		$member_postal_code = $key->member_postal_code;
		$member_postal_address = $key->member_postal_address;
		$member_phone = $key->member_phone;
	}
}




$result .='<div class="content-block">
        	<div class="content-block-title">BIO INFORMATION</div>
        	<div class="content-block-inner">
        		<div class="row">
        			<div class="col-50"><span> NAME : </span> '.$member_surname.' '.$member_first_name.'</div>
        			<div class="col-50"><span>  MEMBER NO. :</span> '.$member_number.'</div>
        		</div>
        	
        	</div>
        	<div class="content-block-title">CONTACT INFORMATION</div>
        	<form id="" method="post">
        	<div class="list-block">
						<ul>
							<li>
						      <div class="item-content">
						        <div class="item-media"><i class="fa fa-envelope"></i></div>
						        <div class="item-inner">
						          <div class="item-title label">E-mail</div>
						          <div class="item-input">
						            <input type="email" placeholder="E-mail" value="'.$member_email.'">
						          </div>
						        </div>
						      </div>
						    </li>
						    <li>
						      <div class="item-content">
						        <div class="item-media"><i class="fa fa-phone"></i></div>
						        <div class="item-inner">
						          <div class="item-title label">Phone</div>
						          <div class="item-input">
						            <input type="text" placeholder="Phone number" value="'.$member_phone.'">
						          </div>
						        </div>
						      </div>
						    </li>
						    <li>
						      <div class="item-content">
						        <div class="item-media"><i class="fa fa-inbox"></i></div>
						        <div class="item-inner">
						          <div class="item-title label">Postal Code</div>
						          <div class="item-input">
						            <input type="text" placeholder="Postal Code" value="'.$member_postal_code.'">
						          </div>
						        </div>
						      </div>
						    </li>
						    <li>
						      <div class="item-content">
						        <div class="item-media"><i class="fa fa-inbox"></i></div>
						        <div class="item-inner">
						          <div class="item-title label">Postal Address</div>
						          <div class="item-input">
						            <input type="text" placeholder="Postal address" value="'.$member_postal_address.'">
						          </div>
						        </div>
						      </div>
						    </li>
					</ul>
				</div>
				<div class="row" style="margin-top:15px;">
					<div class="col-100">
						<input type="submit" class="button active button-small" value="UPDATE CONTACT">
					</div>
				</div>
			</form>
        </div>';
echo $result;
?>

