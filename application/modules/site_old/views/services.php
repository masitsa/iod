 <div class="page-header page-title-left page-title-pattern">
 	<div class="image-bg content-in fixed" data-background="<?php echo base_url()?>assets/img/top_page.jpg"><div class="overlay-dark"></div></div>
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
<!-- page-header -->
<section id="services" class="page-section">
    <div class="container">
        <div class="row">
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

                        $count ++;

                        $checking_items .=
                                        '<div class="col-sm-6 col-md-4 col-xs-12">
                                            <p class="text-center">
                                                <a href="img/sections/services/1.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                                    <img src="img/sections/services/1.jpg" width="420" height="280" alt="" />
                                                </a>
                                            </p>
                                            <h3>
                                                <a href="'.base_url().'services/'.$web_name.'">'.$service_name.'</a>
                                            </h3>
                                            <p>'.$maxi_desc.'.</p>
                                            <a href="'.base_url().'services/'.$web_name.'" class="btn btn-default">Read More</a>
                                        </div>'; 
                        if(($count%3) == 0)
                        {
                            $checking_items .= '<hr class="tb-margin-30" />';
                        }
                    }
                }
                echo $checking_items;
            ?>
            
        </div>
    </div>
</section>
<!-- Services -->
<div id="get-quote" class="bg-color black text-center">
    <div class="container">
        <div class="row get-a-quote">
            <div class="col-md-12">Get A Free Quote / Need Help ? 
            <a class="black" href="<?php echo base_url()?>contact">Contact Us</a></div>
        </div>
        <div class="move-top bg-color page-scroll">
            <a href="#page">
                <i class="glyphicon glyphicon-arrow-up"></i>
            </a>
        </div>
    </div>
</div>
<!-- request -->