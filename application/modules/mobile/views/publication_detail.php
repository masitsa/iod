<?php

$result = '';

  if ($query->num_rows() > 0)
  {
		foreach ($query->result() as $row)
        {
			$publication_id = $row->publication_id;
			$publication_title = $row->publication_title;
			$publication_link = $row->publication_link;
			$publication_date = date('jS M Y',strtotime($row->publication_date));
			

            $result .='
            			<iframe width="100%" height="530px" src="https://www.yumpu.com/en/embed/view/'.$publication_link.'" frameborder="0" allowfullscreen="true" allowtransparency="true"></iframe>
                    ';

        }

}

else

{

    $result = ' <li>
					<a href="#" class="item-link item-content">
					        
					        <div class="item-inner">
					          <div class="item-title-row">
					            <div class="item-title">No publications added</div>
					          </div>
					        </div>
					      </a>
				</li>';

}
	echo $result;

?>