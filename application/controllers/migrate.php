<?php
$this->load->library('migration');

if ( ! $this->migration->current())
{
	show_error($this->migration->error_string());
}
?>