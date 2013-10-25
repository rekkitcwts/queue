<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue_home extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('queue_model','',TRUE);
	}
	function index()
	{
		// display information for the view
			$this->session->sess_destroy();
			$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "Welcome to Donut Queuing system";
			if($this->queue_model->check_if_admin_exist())
			{
				$this->user();
			}
			else
			{
				$data['include'] = 'no_systemadmin';
				$this->load->view('layout',$data);
			}	
	}
	function create_systemadmin()
	{
		$data['title'] = "Donut Fortress Queueing System";
		$data['headline'] = "Create System Administrator Account";
		$data['include'] = 'create_system_admin';
		$this->load->view('layout',$data);
	}
	function system_admin_created()
	{
		$this->form_validation->set_rules('systemusername','System Username','trim|required|min_length[2]|xss_clean');
		$this->form_validation->set_rules('systempassword','System Password','trim|required|alpha_numeric|min_length[6]|xss_clean');
		$this->form_validation->set_rules('systemconfirm_password','Password Confirmation','trim|required|alpha_numeric|matches[systempassword]|xss_clean');
		if($this->form_validation->run()==FALSE)
		{
			$this->create_systemadmin();
		}
		else
		{
			$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "Welcome to Donut Queuing system";
			$systemusername=$this->input->post("systemusername");
			$systempassword=$this->input->post("systempassword");
			$this->queue_model->create_system_admin($systemusername,$systempassword);
			$data['include'] = 'system_admin_created';
			$this->load->view('layout5',$data);
		}
	}
	function user()
	{
		// display information for the view
			$data['title'] = "Customer";
			$data['headline'] = "Welcome to Donut Queuing system";
			$usertype=$this->input->post("usertype");
			if($usertype=="staff")
			{
				redirect('queue');
			}
			else
			{
				$data['include'] = 'customer';
				$data['headline'] = "Hello Customer!";
				$this->load->view('layout5',$data);
			}
	}
	function register_customer()
	{
			$customertype=$this->input->post("customertype");
			$data['headline'] = "Register to Queue(".$customertype.")";
			$my_transaction=$this->queue_model->get_present_transaction();
			$data['my_transactions']=$my_transaction;
			if($customertype=="Constituent")
			{
				$data['include'] = 'register_constituent';
				$data['title']= "Constituent";
			}
			else
			{
				$data['include'] = 'register_walkin';
				$data['title']= "Walkin";
			}
			$this->load->view('layout5',$data);
	}
	function walkin_registered()
	{
		$this->form_validation->set_rules('lastname','Lastname','trim|required|min_length[1]|strtolower|xss_clean');
		$this->form_validation->set_rules('firstname','Firstname','trim|required|min_length[1]|xss_clean');
		$this->form_validation->set_rules('transaction','Transaction','trim|required|min_length[1]|xss_clean');
		if($this->form_validation->run()==FALSE)
		{
			$my_transaction=$this->queue_model->get_present_transaction();
			$data['my_transactions']=$my_transaction;
			$data['headline'] = "Register to Queue(Walk-in)";
			$data['include'] = 'register_walkin';
			$data['title']= "Walkin";
		}
		else
		{
			$last_name=$this->input->post("lastname");
			$first_name=$this->input->post("firstname");
			$purpose=$this->input->post("transaction");
			$cname=$this->queue_model->match_transaction($purpose);
			foreach($cname->result() as $result)
			{
				$countername=$result->countername;
			}
			$data['countername']=$countername;
			$data['first_name']=$first_name;
			$this->queue_model->register_walkin($countername,$last_name,$first_name,$purpose);
			$data['include'] = 'customer_registered';
			$data['title'] = "Constituent Registered";
			$data['headline'] = "WALK-IN ADDED TO QUEUE";
		}
		$this->load->view('layout5',$data);
	}
	function constituent_registered()
	{
		$this->form_validation->set_rules('idnumber','ID number','trim|required|strtolower|xss_clean|callback_id_number_exist|callback_id_number_not_in_database');
		$this->form_validation->set_rules('transaction','Transaction','trim|required|min_length[1]|xss_clean');
		if($this->form_validation->run()==FALSE)
		{
			$my_transaction=$this->queue_model->get_present_transaction();
			$data['my_transactions']=$my_transaction;
			$data['headline'] = "Register to Queue(Constituent)";
			$data['include'] = 'register_constituent';
			$data['title']= "Constituent";
		}
		else
		{
			$id_number=$this->input->post("idnumber");
			$purpose=$this->input->post("transaction");
			$name=$this->queue_model->getName_of_constituent($id_number);
			foreach($name->result() as $myname)
			{
				$last_name=$myname->lastname;
				$first_name=$myname->firstname;
			}
			$cname=$this->queue_model->match_transaction($purpose);
			foreach($cname->result() as $result)
			{
				$countername=$result->countername;
			}
			$data['countername']=$countername;
			$data['first_name']=$first_name;
			$this->queue_model->register_constituent($id_number,$countername,$last_name,$first_name,$purpose);
			$data['include'] = 'customer_registered';
			$data['title'] = "Constituent Registered";
			$data['headline'] = "CONSTITUENT ADDED TO QUEUE";
		}
		$this->load->view('layout5',$data);
	}
	function id_number_exist($id_number)
	{
		$this->form_validation->set_message('id_number_exist','Sorry! The ID Number is already in the Queue');  
		if($this->queue_model->check_if_idnumber_exist($id_number))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function id_number_not_in_database($id_number)
	{
		$this->form_validation->set_message('id_number_not_in_database','Sorry! The ID number youve entered is not in the database. Maybe youre not a Constituent in this School');  
		if($this->queue_model->check_if_idnumber_is_in_database($id_number))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function logout()
	{
			
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='clerk')
			{
				$this->queue_model->set_this_counter_to_false($username);
			}
			$this->session->sess_destroy();
			redirect('login');
		}
		else
			redirect('login/login_fail');
	}
	function home()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['headline'] = "Welcome to Donut Queuing system";
				$data['include'] = 'queueing_index';
				$this->load->view('layout2',$data);
			}
			else if($type=='clerk')
			{
				$data['title'] = "Clerk";
				$data['staff_type'] = "Clerk";
				$data['headline'] = "Welcome to Donut Queuing system";
				$data['include'] = 'queueing_index';
				$this->load->view('layout3',$data);
			}
			
		}
		else
			redirect('login/login_fail');
	}
	function generate_constituent()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['headline'] = "Generate Constituent";
				$data['include'] = 'generate_constituent';
				$this->load->view('layout2', $data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');	
	}
	function constituent_generated()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			$this->form_validation->set_rules('idnumber','ID Number','trim|required|min_length[6]|xss_clean|callback_id_number_exist_in_database');
			$this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|xss_clean');
			$this->form_validation->set_rules('firstname','First Name','trim|required|alpha_numeric|min_length[2]');
			if($this->form_validation->run()==FALSE)
			{
				$data['headline'] = "Generate Constituent";
				$data['include'] = 'generate_constituent';
			}
			else
			{
				$idnumber=$this->input->post("idnumber");
				$lastname=$this->input->post("lastname");
				$firstname=$this->input->post("firstname");
				$this->queue_model->generate_constituent($idnumber,$lastname,$firstname);
				$data['include'] = 'constituent_generated';
				$data['headline'] = "Welcome to Donut Queuing system";
			}
			$data['title'] = "Adminstrator";
			$data['staff_type'] = "System Administrator";
			$this->load->view('layout2',$data);
		}
		else
			redirect('login/login_fail');
	}
	function id_number_exist_in_database($id_number)
	{
		$this->form_validation->set_message('id_number_exist_in_database','Error! The ID Number you entered is already in the Database!');  
		if($this->queue_model->check_if_idnumber_exist_in_constituentdatabase($id_number))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function countername_exist($counter_name)
    {
        $username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			$this->form_validation->set_message('countername_exist','That Counter Name already exist.Try different Counter Name :)');  
			if($this->queue_model->check_if_countername_exist($counter_name))
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
			redirect('login/login_fail');
    }
	function username_exist($uname)
    {
        $username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			$this->form_validation->set_message('username_exist','That Username already exist.Try different Username  :)');  
			if($this->queue_model->check_if_username_exist($uname))
			  {
				  return FALSE;
			  }
			  else
			  {
				  return TRUE;
			  }
		}
		else
			redirect('login/login_fail');
    }
	function create_counter()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['headline'] = "Add a New Counter";
				$data['systemusername']=$username;
				$data['include'] = 'add_counter';
				$this->load->view('layout2', $data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function counter_created()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			$this->form_validation->set_rules('counter_name','Counter name','trim|required|alpha_numeric|strtoupper|xss_clean|callback_countername_exist');
			$this->form_validation->set_rules('uname','Username','trim|required|alpha_numeric|min_length[2]|xss_clean|callback_username_exist');
			$this->form_validation->set_rules('pass','Password','trim|required|alpha_numeric|min_length[6]|xss_clean');
			$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|alpha_numeric|matches[pass]|xss_clean');
			$this->form_validation->set_rules('transaction','transaction','trim|required|min_length[2]|xss_clean');
			if($this->form_validation->run()==FALSE)
			{
				$data['headline'] = "Add a New Counter";
				$data['include'] = 'add_counter';
				$data['systemusername']=$username;
			}
			else
			{
				$counter_name=$this->input->post("counter_name");
				$uname=$this->input->post("uname");
				$pass=$this->input->post("pass");
				$transaction=$this->input->post("transaction");
				$conf_pass=$this->input->post("confirm_password");
				$this->queue_model->create_counter($counter_name,$username,$uname,$pass,$transaction,"clerk");
				$data['include'] = 'counter_created';
				$data['headline'] = "Welcome to Donut Queuing system";
			}
			$data['title'] = "Adminstrator";
			$data['staff_type'] = "System Administrator";
			
			$this->load->view('layout2',$data);
		}
		else
			redirect('login/login_fail');
	}
	function edit_or_view_constituent_in_database()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['include'] = 'view_and_edit_all_constituent_in_database';
				$data['headline'] = "View/Edit All Constituent";
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function edit_this_constituent()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$idnumber=$this->input->post("edit_constituent");
				$id_number=array('myidnumber'=> $idnumber);
				$this->session->set_userdata($id_number);
				redirect('queue_home/updating_constituent');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function updating_constituent()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$this->form_validation->set_rules('idnumber','ID Number','trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|xss_clean');
				$this->form_validation->set_rules('firstname','First Name','trim|required|alpha_numeric|min_length[2]');
				if($this->form_validation->run()==FALSE)
				{
					$data['title'] = "Adminstrator";
					$data['staff_type'] = "System Administrator";
					$idnumber=$this->session->userdata('myidnumber');
					$data['headline'] = "Edit Constituent";
					$atrributes=$this->queue_model->get_attribute_of_this_constituent($idnumber);
					foreach($atrributes->result() as $constituent_att)
					{
						$idnumber=$constituent_att->idnumber;
						$lastname=$constituent_att->lastname;
						$firstname=$constituent_att->firstname;
						$data['idnumber']=$idnumber;
						$data['lastname']=$lastname;
						$data['firstname']=$firstname;
					}
					$data['include'] = 'edit_specific_constituent';
					$my_data1=array('old_idnumber'=>$idnumber,'old_lastname'=>$lastname,'old_firstname'=>$firstname);
					$this->session->set_userdata($my_data1);
					$this->load->view('layout2',$data);
				}
				else
				{
					$new_idnumber=$this->input->post("idnumber");
					$new_lastname=$this->input->post("lastname");
					$new_firstname=$this->input->post("firstname");
					$old_idnumber=$this->session->userdata('old_idnumber');
					$this->queue_model->update_constituent($new_idnumber,$new_lastname,$new_firstname,$old_idnumber);
					redirect('queue_home/edit_or_view_constituent_in_database');
				}
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function view_or_edit_all_counter()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$clerks = $this->queue_model->view_all_clerks($username);
				if($clerks->num_rows()>0)
				{
					$data['include'] = 'view_and_edit_counter';
					$data['clerks'] = $clerks;
				}
				else
				{
					$data['include'] = 'no_counter_yet';
				}
				$data['headline'] = "View/Edit Counter";
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function edit_this_counter()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$c=$this->input->post("edit");
				$cname=array('cname'=> $c);
				$this->session->set_userdata($cname);
				redirect('queue_home/updating_clerkaccount');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function updating_clerkaccount()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$this->form_validation->set_rules('countername','countername','trim|required|alpha_numeric|strtoupper|xss_clean');
				$this->form_validation->set_rules('username','username','trim|required|alpha_numeric|min_length[2]|xss_clean');
				$this->form_validation->set_rules('password','password','trim|required|alpha_numeric|min_length[6]|xss_clean');
				$this->form_validation->set_rules('transaction','transaction','trim|required|min_length[2]|xss_clean');
				if($this->form_validation->run()==FALSE)
				{
					$data['title'] = "Adminstrator";
					$data['staff_type'] = "System Administrator";
					$countername=$this->session->userdata('cname');
					$data['systemusername']=$username;
					$data['headline'] = "Edit Counter: ".$countername;
					$data['allcounters']=$this->queue_model->get_counternames($username);
					$atrributes=$this->queue_model->get_attribute_of_this_counter($countername);
					foreach($atrributes->result() as $clerk_att)
					{
						$data['username']=$clerk_att->username;
						$uname=$clerk_att->username;
						$data['password']=$clerk_att->password;
						$data['transaction']=$clerk_att->transaction;
						$data['ispresent']=$clerk_att->ispresent;
						$data['countername']=$countername;
					}
					$my_data=array('old_countername'=>$countername,'old_username'=>$uname);
					$this->session->set_userdata($my_data);
					$data['customers']=$this->queue_model->get_customers_of_this_counter($countername);
					$data['include'] = 'edit_specific_counter';
					$this->load->view('layout2',$data);
				}
				else
				{
					$countername=$this->input->post("countername");
					$uname=$this->input->post("username");
					$password=$this->input->post("password");
					$transaction=$this->input->post("transaction");
					$old_countername=$this->session->userdata('old_countername');
					$old_username=$this->session->userdata('old_username');
					$this->queue_model->update_counter($countername,$username,$uname,$password,$transaction,$old_countername,$old_username);
					redirect('queue_home/view_or_edit_all_counter');
				}
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
		
	}
	function transfer_customers()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$old_cname=$this->input->post("old_countername");
				$new_cname=$this->input->post("new_countername");
				$this->queue_model->transfer_customer($old_cname,$new_cname);
				$data['allcounters']=$this->queue_model->get_counternames($username);
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$countername=$this->session->userdata('cname');
				$data['headline'] = "Edit Counter: ".$countername;
				$atrributes=$this->queue_model->get_attribute_of_this_counter($countername);
				foreach($atrributes->result() as $clerk_att)
				{
					$data['username']=$clerk_att->username;
					$data['password']=$clerk_att->password;
					$data['transaction']=$clerk_att->transaction;
					$data['ispresent']=$clerk_att->ispresent;
					$data['countername']=$countername;
				}
				$this->queue_model->restart_queue_of_this_counter($countername);
				$data['customers']=$this->queue_model->get_customers_of_this_counter($countername);
				$data['include'] = 'edit_specific_counter';
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function restart_this_queue()
	{
		
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$countername=$this->session->userdata('cname');
				$data['headline'] = "Edit Counter: ".$countername;
				$atrributes=$this->queue_model->get_attribute_of_this_counter($countername);
				$data['allcounters']=$this->queue_model->get_counternames($username);
				foreach($atrributes->result() as $clerk_att)
				{
					$data['username']=$clerk_att->username;
					$data['password']=$clerk_att->password;
					$data['transaction']=$clerk_att->transaction;
					$data['ispresent']=$clerk_att->ispresent;
					$data['countername']=$countername;
				}
				$this->queue_model->restart_queue_of_this_counter($countername);
				$data['customers']=$this->queue_model->get_customers_of_this_counter($countername);
				$data['include'] = 'edit_specific_counter';
				$this->load->view('layout2',$data);
			}
			else
			{
				$data['title'] = "Clerk";
				$data['staff_type'] = "Clerk";
				$countername=$this->input->post("restart_queue");
				$this->queue_model->restart_queue_of_this_counter($countername);
				redirect('queue_home/now_serving');
			}
		}
		else
			redirect('login/login_fail');
	}
	function delete_this_constituent()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$idnumber=$this->input->post("delete_constituent");
				$this->queue_model->delete_this_constituent_in_database($idnumber);
				redirect('queue_home/edit_or_view_constituent_in_database');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function delete_this_counter()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$c=$this->input->post("delete");
				$this->queue_model->delete_this_counter($c);
				redirect('queue_home/view_or_edit_all_counter');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function reset_all_queue()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['headline'] = "Delete all Queue";
				$data['include'] = 'reset_all_queue';
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function all_queue_resarted()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$this->queue_model->reset_all_queues();
				$data['headline'] = "Welcome to Donut Queuing System";
				$data['include'] = 'all_queue_restarted';
				$data['staff_type'] = "System Administrator";
				$data['title'] = 'Administrator';
				$this->load->view('layout2',$data);
				
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function dissolve_system_admin()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['headline'] = "Dissolve System Administrator";
				$data['include'] = 'dissolve_admin';
				$data['staff_type'] = "System Administrator";
				$data['title'] = 'Administrator';
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function admin_dissolved()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$this->queue_model->dissolve_admin();
				$this->index();
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function change_admin_password()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$data['title'] = "Adminstrator";
				$data['staff_type'] = "System Administrator";
				$data['headline'] = "Change Password";
				$admin_atrribute=$this->queue_model->get_admin_password($username);
				foreach($admin_atrribute->result() as $attribute)
				{
					$data['systempassword']=$attribute->systempassword;
				}
				$data['username']=$username;
				$data['include']='change_admin_password';
				$this->load->view('layout2',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function system_password_changed()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='systemadmin')
			{
				$this->form_validation->set_rules('my_old_password','old Password','trim|required|min_length[2]|xss_clean');
				$this->form_validation->set_rules('password','Old Password','trim|required|alpha_numeric|matches[my_old_password]|min_length[2]|xss_clean');
				$this->form_validation->set_rules('new_password','new Password','trim|required|min_length[2]|xss_clean');
				$this->form_validation->set_rules('confirm_password','Password Confirmation','trim|required|alpha_numeric|matches[new_password]|xss_clean');
				if($this->form_validation->run()==FALSE)
				{
					$this->change_admin_password();
				}
				else
				{
					$systempassword=$this->input->post("new_password");
					$systemusername=$username;
					$this->queue_model->change_password($systemusername,$systempassword);
					$data['title'] = "Adminstrator";
					$data['staff_type'] = "System Administrator";
					$data['headline'] = "Welcome to Donut Queuing system";
					$data['include']='password_changed';
					$this->load->view('layout2',$data);
				}
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function now_serving()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='clerk')
			{
				$clerk_att=$this->queue_model->get_clerk_att($username);
				foreach($clerk_att->result() as $my_clerk_att)
				{
					$data['transaction']=$my_clerk_att->transaction;
					$data['ispresent']=$my_clerk_att->ispresent;
					$countername=$my_clerk_att->countername;
					$data['countername']=$countername;
				}
				$clerk_session=array('countername'=> $countername);
				$this->session->set_userdata($clerk_session);
				$data['title'] = "Clerk";
				$data['staff_type'] = "Clerk";
				$data['headline'] = "Counter: ".$countername;
				$data['include'] = 'now_serving_page';
				$data['customers']=$this->queue_model->get_customers_of_this_counter($countername);
				$data['first_customer']=$this->queue_model->get_head_of_the_queue($countername);
				//$this->queue_model->set_this_counter_to_true($username);
				$this->load->view('layout3',$data);
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function set_presence()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='clerk')
			{
				$presence=$this->input->post("presence");
				if($presence=='f')
				{
					$this->queue_model->set_this_counter_to_true($username);
				}
				else
					$this->queue_model->set_this_counter_to_false($username);
				redirect('queue_home/now_serving');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function nextcustomer()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='clerk')
			{
				$customer_pnumber=$this->input->post("customer_pnumber");
				$countername=$this->session->userdata('countername');
				$this->queue_model->delete_customer($customer_pnumber,$countername);
				redirect('queue_home/now_serving');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function requeue()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		if ($this->queue_model->check_if_logged_in($username))
		{
			if($type=='clerk')
			{
				$customer_pnumber=$this->input->post("customer_pnumber");
				$countername=$this->session->userdata('countername');
				$this->queue_model->requeue($customer_pnumber,$countername);
				redirect('queue_home/now_serving');
			}
			else
			{
				redirect('login/login_fail');
			}
		}
		else
			redirect('login/login_fail');
	}
	function about()
	{
		$username= $this->session->userdata('username');
		$password= $this->session->userdata('password');
		$type= $this->session->userdata('type');
		$data['headline'] = "Meet The Donut";
		$data['include'] = 'queueing_about';
		if($type=='systemadmin')
		{
			$data['title'] = "Adminstrator";
			$data['staff_type'] = "System Administrator";
			$this->load->view('layout2', $data);
		}
		else if($type=='clerk')
		{
			$data['title'] = "Clerk";
			$data['staff_type'] = "Clerk";
			$this->load->view('layout3', $data);
		}
		else
		{
			$data['title'] = "Customer";
			$data['staff_type'] = "Customer";
			$this->load->view('layout', $data);
		}
	}
	//wla ni labot sa baba
	function addToQueue()
	{
			$this->load->model('queue_model');
			$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "Queue Customer";
			$data['include'] = 'queueing_add';

			$this->load->view('layout2', $data);
	}
	
	function createNewCustomer()
	{
		$this->load->model('queue_model','',TRUE);
		// Get highest priority number
		$curprio = $this->queue_model->getMaxPrioNum($_POST['window'])->row()->maxprio;
		// Increment highest priority number...
		$curprio++;
		// ... then create a new array.
		$customerdata = array('lname' => $_POST['lname'], 'fname' => $_POST['fname'], 'prionum' => $curprio, 'window' => $_POST['window']);
		$this->queue_model->addCustToQueue($customerdata);
		redirect('queue_home/addToQueue','refresh');
	}
	
	function viewLatestCust()
	{
		$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "Now Serving";
			$data['include'] = 'queueing_now_serving';

			$this->load->view('layout2', $data);
	}
	
	function selectWindow()
	{
		$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "Select Window";
			$data['include'] = 'queueing_select_window';

			$this->load->view('layout2', $data);
	}
	
	function viewQueue()
	{
		// TODO
			$this->load->library('table');
			$this->load->model('queue_model');
			$data['title'] = "Donut Fortress Queueing System";
			$data['headline'] = "View Queue";
			$data['include'] = 'queueing_view';

			$this->load->view('layout2', $data);
	}
	
}