<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller 
{
	function __construct()
	{
		parent:: __construct();
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		redirect('login');
	}
}
?>