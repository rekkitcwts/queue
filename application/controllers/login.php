<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');			
		$this->load->helper('url');
		$this->load->model('queue_model','',TRUE);
	}
	public function index()
	{
		$data['title'] = "Staff";
		$data['include'] = 'loginStaff';
		$data['headline'] = "Log-in As Staff";
		$this->load->view('layout4',$data);
	}
	
	function logging_in(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');			
		//$password = md5($password);
		$result = $this->queue_model->login($u,$p);
		$logged = false;				
		if($result->num_rows() > 0){
			$logged = true;			
			foreach($result->result() as $row){
				$username=$row->username;
				$password = $row->password;
				$type = $row->type;
			}
			$credentials = array('username' => $username,'logged_in' => $logged, 'password' => $password, 'type' => $type);
			$this->session->set_userdata($credentials);
			redirect('queue_home/home');
		}
		else
			redirect('login/login_fail');
	}
	
	function login_fail()
	{
		$data['title'] = "Log-in";
		$data['headline'] ="Log-in As Staff";
		$data['include'] = 'invalidLogin';
		$this->load->view('layout4',$data);
	}
}
