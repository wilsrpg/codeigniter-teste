<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index()
	{
		//if (isset($_SESSION['id_do_usuario'])) {
		session_destroy();
		redirect('admin/login');
	}
}
