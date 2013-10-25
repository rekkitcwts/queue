<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model','login',TRUE);
		$this->load->library('session');			
		$this->load->helper('url');
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}