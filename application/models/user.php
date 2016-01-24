<?php

class User extends CI_Model
{
	public function create_user($post)
	{
	 $this->load->library("form_validation");
	 $this->form_validation->set_error_delimiters('<p class = "error">','<p>');
	 $this->form_validation->set_rules("first_name", "First Name" , "trim|required|alpha");
	 $this->form_validation->set_rules("last_name", "Last Name" , "trim|required|alpha");
	 $this->form_validation->set_rules("email", "Email" , "trim|required|valid_email|is_unique[users.email]");
	 $this->form_validation->set_rules("password", "Password" , "trim|required|min_length[8]|matches[pw_confirmation]");
	 $result = array();
	 if($this->form_validation->run() === FALSE)
		{
			$result[] = false;
			$result[] = validation_errors();
		}
	 else
		{
			$first_name = $post['first_name'];
			$last_name = $post['last_name'];
			$email = $post['email'];
			$password = md5($post['password']);  //md5 encription 
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?, NOW(),NOW())";
			$insert_result = $this->db->query($query, array($first_name, $last_name, $email, $password));
			if($insert_result){
				$result[] = $this->db->insert_id();
				$result[] = "Successfully Registered User";
			}else{
				$result[] = false;
				$result[] = "<p class = 'error'> There Was a Database Error</p>";
			}
		}
	 return $result;	
  }

 //  public function user_by_email($email){

 
	//  $this->load->library("form_validation");
	//  $this->form_validation->set_error_delimiters('<p class = "error">','<p>');
	//  $this->form_validation->set_rules("email", "Email" , "trim|required|valid_email|matches[users.email]");
	//  $this->form_validation->set_rules("password", "Password", "required|matches[users.password]");
	//  $result = array();
	//  if($this->form_validation->run() === FALSE)
	// 	{
	// 		$result[] = false;
	// 		$result[] = validation_errors();
	// 	}
	// else
	// 	{
	// 		$email = $post['email'];
	// 		$password = md5($post['password']); 
	//   		$query ="SELECT * FROM users WHERE email = ?";
	// 		return $this->db->query($query, array($email))->row_array();
	// 	}	
	// return $result;
 //  }


public function get_user_by_id($id){
    $query = "SELECT * FROM users WHERE id = ?";
    return $this->db->query($query, array($id))->row_array();
  }


public function login_user($post){
    // var_dump($post);
    $email = $post['email'];
    $query = "SELECT * FROM users WHERE email = ?";
    $user = $this->db->query($query, array($email))->row_array();
    // echo 'the user';
    // var_dump($user);
    // die();
    if($user){
      // $test_password = md5($post['password'].''.$user['salt']);
      $test_password = md5($post['password']);
      if($user['password'] == $test_password){
        return $user['id'];
      }
    }
    return "<p class='error'>Invalid Email and Password Combination</p>";
  }  


}






?>