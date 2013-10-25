<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	//	$this->load->library('session');
	//	$this->logged_in = $this->session->userdata('logged_in');
	//	$this->user_id = $this->session->userdata('user_id');
	//	$this->username = $this->session->userdata('username');
		// Loads the url helper right from the start to avoid loading the helper file TWICE.
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->logged_in)
		{
			redirect('queue_home');
		}
		else
			redirect('login');
	}
}

?>