<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function index()
	{
		$this->load->view('adminpanel/viewblog');
	}

	public function addblog()
	{
		$this->load->view('adminpanel/addblog');
	}

	public function addblog_post()
	{
		print_r($_POST);
		//$this->load->view('adminpanel/addblog');
	}
}
