 <?php

$result = '';
if($query->num_rows() > 0)
{
    foreach ($query->result() as $key) {
        # code...

        
        $recording_title = $key->recording_title;
        $recording_link = $key->recording_link;
        $recording_status = $key->recording_status;
    
		 $result .='
		 			  <li>
					      <a href="event-single.html" class="item-link item-content">
					        <div class="item-media">
				        	  	<img src="http://img.youtube.com/vi/'.$recording_link.'/0.jpg" width="70">
				        	</div>
					        <div class="item-inner">
					          <div class="item-title-row">
					            <div class="item-title">'.$recording_title.'</div>
					            <div class="item-after">FREE</div>
					          </div>
					          <div class="item-text"><span><i class="fa fa-calendar"></i> Published :</span> 5th May 2016 <span><i class="fa fa-eye"></i> Views :</span> 6 </div>
					        </div>
					      </a>
					    </li>';
	}
}
else
{
	$result .= ' <li>
					<a href="#" class="item-link item-content">
					        
					        <div class="item-inner">
					          <div class="item-title-row">
					            <div class="item-title">No videos added</div>
					          </div>
					        </div>
					      </a>
				</li>';
}

echo $result;
?>