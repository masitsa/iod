<?php
$member_id = $this->session->userdata('member_id');
$member_details = $this->member_model->get_member_details($member_id);
if($member_details->num_rows() > 0)
{
	$row = $member_details->row();
	$member_first_name = $row->member_first_name;
	$member_surname = $row-> member_surname;   
	$member_title  =  $row-> member_title;
	$date_of_birth   = $row->date_of_birth;
	$nationality = $row->nationality;
	$qualifications = $row->qualifications;
	$member_phone  = $row->member_phone;
	$member_email  = $row->member_email;
	$designation = $row->designation;
	$member_number = $row->member_number;
}
?>
 <!-- PROFILE FEATURE -->
    <section class="profile-feature">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="info-author">
                <div class="image">
                    <img src="<?php echo base_url().'assets/';?>images/avatar.png" alt="">
                </div>    
                <div class="name-author">
                    <h2 class="big"><?php echo $member_first_name.' '.$member_surname;?></h2>
                </div>     
                <div class="address-author">
                    <h3><?php echo $member_number;?></h3>
                </div>
            </div>
            <div class="info-follow">
                <div class="trophies">
                    <span>12</span>
                    <p>Upcoming Events</p>
                </div>
                <div class="trophies">
                    <span>12</span>
                    <p>New Offers</p>
                </div>
                <div class="trophies">
                    <span>Kes 0</span>
                    <p>Due</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END / PROFILE FEATURE -->