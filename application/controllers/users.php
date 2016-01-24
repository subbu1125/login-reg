<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('User');
		
	}  

	public function index()
	{
		$this->load->view('users/index');
	}

	 // public function login()
  //   {	
  //   	$result = $this->User->user_by_email($this->input->post());
  //       if($result[0] == false)
  //       {
  //           $this->session->set_flashdata('login_errors',$result[1]);
  //           redirect('/');
  //       }
  //       else if($user && $user['password'] == $password)
  //       {
  //           $user_data = array(
  //              'id' => $user['id'],
  //              'email' => $user['email'],
  //              'first_name' => $user['first_name'].' '.$user['last_name'],
  //              'logged_in' => true
  //           );
  //           $this->session->set_userdata($user_data);
  //           redirect('/welcome');
  //       }
      
  //   }

	public function new_user()
	{
		$result = $this->User->create_user($this->input->post());
		if($result[0]== false){
			$this->session->set_flashdata('regis_errors', $result[1]);
			redirect('/');
		}else{
			$user = $this->User->user_by_email($this->input->post('email'));
			$user_data = array(
									"id"=> $user['id'],
									"first_name"=> $user['first_name'],
									"logged_in"=> true
							  );
			$this->session->set_userdata($user_data);
			redirect('/welcome');

		}
	}
	public function login()
  {
    $result = $this->User->login_user($this->input->post());
    if(is_numeric($result)){
      $this->session->set_userdata('user_id', $result);
      redirect('/welcome');
    } else {
      $this->session->set_flashdata('login_errors', $result);
      redirect('/');
    }
  }

  // public function create()
  // {
  //   // var_dump($this->input->post());
  //   $result = $this->User->create_user($this->input->post());
  //   if(is_numeric($result)){
  //     $this->session->set_userdata('user_id', $result);
  //     redirect('/dashboard/index');
  //   } else {
  //     $this->session->set_flashdata('regis_errors', $result);
  //     redirect('/');
  //   }
  // }





}
  