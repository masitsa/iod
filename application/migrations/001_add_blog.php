<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_blog extends CI_Migration 
{
	function __construct()
	{
		parent:: __construct();
		
		$this->load->dbforge();
	}
	
	public function up()
	{
		$this->dbforge->create_table('notification');
		$this->dbforge->add_field(array(
			'blog_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'blog_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'blog_description' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
		));
	}

	public function down()
	{
		//$this->dbforge->drop_table('blog');
	}
}
?>