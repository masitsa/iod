<?php 
 $checking_items = '';
if($query->num_rows() > 0)
{   $count = 0;
    foreach($query->result() as $res)
    {
        $resource_category_name = $res->resource_category_name;
        $resource_category_id = $res->resource_category_id;
        $resource_category_description = $res->resource_category_description;
        $mini_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 100));
        $maxi_desc = implode(' ', array_slice(explode(' ', $resource_category_description), 0, 40));
        
        $where = 'resource_category_id ='.$resource_category_id;
        $table = 'resource';

        $total_rows_item = $this->resources_model->count_items($table, $where);

        $count ++;

        $checking_items .=
                        '
                            <li>
                                  <a href="resource-single.html?a_id='.$resource_category_id.'" class="item-link item-content" onclick="get_resources_description('.$resource_category_id.')">
                                    <div class="item-media">
                                        <div class="item-media">
                                            <i class="fa fa-download"></i>
                                        </div>
                                     </div>
                                    <div class="item-inner">
                                      <div class="item-title-row">
                                        <div class="item-title">'.strip_tags($resource_category_name,'<p><a>').'</div>
                                      </div>
                                       <!-- <div class="item-subtitle"> Seminar </div> -->
                                      <div class="item-text">Published: 5th May 2016 Downloads: <span class="badge">5</span></div>
                                    </div>
                                  </a>
                                </li>'; 
       
    }
}
else
{
  $checking_items = '
            <li>
                    <div class="item-inner">
                       No resource categories yet
                    </div>
                </li>';
}
echo $checking_items;
    
?>
