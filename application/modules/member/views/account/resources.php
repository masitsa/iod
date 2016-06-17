
    <!-- PAGE CONTROL -->
    <section class="page-control">
        <div class="container">
            <div class="page-info">
                <a href="<?php echo site_url();?>"><i class="fa fa-arrow-left"></i>Back to home</a>
            </div>
        </div>
    </section>
    <!-- END / PAGE CONTROL -->
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">
    
                <div class="col-md-9 col-md-push-3">
                    <div class="content grid">
                        <div class="row">
							<?php
							if($query->num_rows() > 0)
							{
								foreach($query->result() as $row)
								{
									$resource_id = $row->resource_id;
									$resource_name = $row->resource_name;
									$resource_description = $row->resource_description;
									$resource_category_id = $row->resource_category_id;
									$resource_category_name = $row->resource_category_name;
									$resource_image = $row->resource_image_name;
									$resource_category_web_name = $this->site_model->create_web_name($resource_category_name);
									$array = explode('.', $resource_image);
									$suffix = $array[1];

									if($suffix == 'pdf' OR $suffix == 'PDF')
									{
										$fa = 'fa-file-pdf-o';
									}
									else if($suffix == 'xls' OR $suffix == 'XLS')
									{
										$fa = 'fa-file-excel-o';
									}
									else if($suffix == 'doc' OR $suffix == 'Doc')
									{
										$fa = 'fa-file-word-o';
									}
									else if($suffix == 'docx' OR $suffix == 'DOCX')
									{
										$fa = 'fa-file-word-o';
									}
									else if($suffix == 'ppt' OR $suffix == 'PPT')
									{
										$fa = 'fa-file-powerpoint-o';
									}
									else if($suffix == 'pptx' OR $suffix == 'PPTX')
									{
										$fa = 'fa-file-powerpoint-o';
									}
									else
									{
										$fa = 'fa-file-o';
									}
									
									?>
									<!-- ITEM -->
									<div class="col-sm-4 col-md-3">
										<div class="mc-item mc-item-2">
											<div class="image-heading">
												<img src="<?php echo base_url().'assets/images/iod_logo_cropped.jpg';?>" alt="">
											</div>
											<div class="meta-categories"><a href="<?php echo site_url().'member/resources/'.$resource_category_web_name;?>"><?php echo $resource_category_name;?></a></div>
											<div class="content-item">
												<h4><a href="<?php echo $resource_location.''.$resource_image;?>" target="_blank"><i class="fa <?php echo $fa;?> fa-2x pull-right" aria-hidden="true"></i><?php echo $resource_name;?></a> </h4>
											</div>
										</div>
									</div>
									<!-- END / ITEM -->
									<?php
								}
							}
							?>
                            
                            <div class="col-md-12">
								<?php if(isset($links)){echo $links;} ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR CATEGORIES -->
                <div class="col-md-3 col-md-pull-9">
                    <aside class="sidebar-categories">
                        <div class="inner">
    
                            <!-- WIDGET CATEGORIES -->
                            <div class="widget widget_categories">
                                <ul class="list-style-block">
                                	<li><a href="<?php echo site_url().'member/resources';?>">All Categories</a></li>
									<?php
									if($resource_categories->num_rows() > 0)
									{
										foreach($resource_categories->result() as $row)
										{
											$resource_category_id = $row->resource_category_id;
											$resource_category_name = $row->resource_category_name;
											$resource_category_web_name = $this->site_model->create_web_name($resource_category_name);
											?>
											<li><a href="<?php echo site_url().'member/resources/'.$resource_category_web_name;?>"><?php echo $resource_category_name;?></a></li>
											<?php
										}
									}
									?>
                                </ul>
                            </div>
                            <!-- END / WIDGET CATEGORIES -->
                        </div>
                    </aside>
                </div>
                <!-- END / SIDEBAR CATEGORIES -->
    
            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
    
    