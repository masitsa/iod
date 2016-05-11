<?php
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
    }
?>
<div class="row" >
  <div class="page-header page-title-left page-title-pattern">
  			<div class="image-bg content-in fixed" data-background="<?php echo base_url()?>assets/img/top_page2.jpg"><div class="overlay-dark"></div></div>
            <div class="container" id="breadcrum-modification" >
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="title white"><?php echo $title?></h1>
                        <h5></h5>
                        <ul class="breadcrumb">
                            <?php echo $this->site_model->get_breadcrumbs();?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
         <?php
        //if users exist display them

        if ($items->num_rows() > 0)
        {   
           $counter = 0;
           $item_data = "";
            foreach ($items->result() as $row)
            {
                $counter++;
                $post_id = $row->post_id;
                $blog_category_name = $row->blog_category_name;
                $blog_category_id = $row->blog_category_id;
                $post_title = $row->post_title;
                $web_name = $this->site_model->create_web_name($post_title);
                $post_status = $row->post_status;
                $post_views = $row->post_views;
                $image = base_url().'assets/images/posts/'.$row->post_image;
                if($row->post_image == "" || $row->post_image == NULL)
                {
                    // $image ="http://placehold.it/450x250?text=Comparison+graph";
                    $image = base_url().'assets/themes/metal/img/sections/bg/intro.jpg';
                }
                $created_by = $row->created_by;
                $modified_by = $row->modified_by;
                $description = $row->post_content;
                $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
                $created = $row->created;
                $day = date('j',strtotime($created));
                $month = date('M Y',strtotime($created));
                $created_on = date('jS M Y',strtotime($row->created));
                
                $categories = '';
                $item_data ='<p class="description upper">'.$description.'</p>';
            }
        }
        ?>
        <!-- page-header -->
        <section id="who-we-are" class="page-section border-tb">
            <div class="container who-we-are">
                <div class="section-title text-left">
                    <!-- Title -->
                    <h2 class="title">Who We Are</h2>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <?php echo $item_data;?>
                        <div class="row">
                            <div class="col-md-10">
                                <ul class="arrow-style">
                                    <li>Mission</li>
                                    <p><?php echo $mission;?></p>
                                    <li>Vision.</li>
                                    <p><?php echo $vision?></p>
                                </ul>
                            </div>
                          
                        </div>
                        <h3>
                            <a href="#" class="hover">Download Our Brochure - 
                            <i class="icon-file-pdf red"></i></a>
                        </h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 service-list content-block">
                                <h4>why choose us</h4>
                                <ul>
                                    <li>
                                        <i class="icon-alarm3 text-color"></i>
                                        <p>We available 24/7 feel free to contact us.</p>
                                    </li>
                                    <li>
                                        <i class="icon-shield2 text-color"></i>
                                        <p>We are genius because of experience.</p>
                                    </li>
                                    <li>
                                        <i class="icon-price-tag text-color"></i>
                                        <p>Offer low price compare with other builders</p>
                                    </li>
                                    <li>
                                        <i class="icon-headphones text-color"></i>
                                        <p>We provide free estimation for all projects</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                          <?php
                            $services = $this->site_model->get_active_services();
                            $checking_items = '';
                            if($services->num_rows() > 0)
                            {   $count = 0;
                                foreach($services->result() as $res)
                                {
                                    $service_name = $res->service_name;
                                    $service_description = $res->service_description;
                                     $mini_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 10));
                                     $maxi_desc = implode(' ', array_slice(explode(' ', $service_description), 0, 30));
                                    $web_name = $this->site_model->create_web_name($service_name);
                                    $checking_items .='<a href="'.base_url().'services/'.$web_name.'" class="list-group-item">'.$service_name.'</a> ';
                                }
                            }
                            ?>
                        <div class="widget list-border">
                            <div class="widget-title">
                                <h3 class="title">Our Services</h3>
                            </div>
                            <div id="MainMenu1">
                                <div class="list-group panel">
                                    <div class="collapse in" id="demo">
                                        <?php echo $checking_items;?>
                                    </div>
                                </div>
                            </div>
                            <!-- category-list -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- who-we-are -->
       <section id="fun-factor" class="page-section transparent">			
			<div class="image-bg content-in fixed" data-background="<?php echo base_url();?>assets/img/background.jpg"><div class="overlay-dark"></div></div>
            <div class="container">
                <div class="row text-right fact-counter white">
                    <div class="col-sm-6 col-md-4 bottom-xs-pad-30 fun-icon">
                        <!-- Icon -->
                        <div class="count-number text-color" data-count="8">
                            <span class="counter"></span>
                        </div>
                        <!-- Title -->
                        <h3>Projects 
                        <span>Delivered</span></h3>
                    </div>
                    <div class="col-sm-6 col-md-4 bottom-xs-pad-30">
                        <!-- Icon -->
                        <div class="count-number text-color" data-count="8">
                            <span class="counter"></span>
                        </div>
                        <!-- Title -->
                        <h3>Happy 
                        <span>Clients</span></h3>
                    </div>
                    <div class="col-sm-6 col-md-4 bottom-xs-pad-30">
                        <!-- Icon -->
                        <div class="count-number text-color" data-count="3">
                            <span class="counter"></span>
                        </div>
                        <!-- Title -->
                        <h3>Counties
                        <span>Covered</span></h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- fun-factor -->
        <!-- clients -->
        <div id="get-quote" class="bg-color black text-center">
            <div class="container">
                <div class="row get-a-quote">
                    <div class="col-md-12">Get A Free Quote / Need Help ? 
                    <a class="black" href="<?php echo base_url();?>contact">Contact Us</a></div>
                </div>
                <div class="move-top bg-color page-scroll">
                    <a href="#page">
                        <i class="glyphicon glyphicon-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- request -->
</div>