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

			 <div class="page_content">
			        <h3>'.$recording_title.'</h3>
			        <div class="videocontainer">
			       		 <iframe width="100%" height="180" src="http://www.youtube.com/embed/'.$recording_link.'" frameborder="0"></iframe>
			        </div>
			      

			  </div>
		  ';
	}
}
else
{
	$result = 'No streaming event currently';
}
echo $result;

?>