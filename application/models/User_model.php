<?php
	class User_model extends CI_Model{

		public function register(){
			// User data array
			$data = array(
				
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'number' => $this->input->post('number'),
                'username' => $this->input->post('username'),
                'user_type' => $this->input->post('user_type'),
				'visacard' => $this->input->post('visacard')
                // 'password' => $enc_password
                
			);

			// if ($this->input->post('user_type') == "client") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }

			// if ($this->input->post('user_type') == "admin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// } 

			// if ($this->input->post('user_type') == "superadmin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }

			// Insert in Users
			$insert = $this->db->insert('users', $data);

			
			// $this->user_info($this->input->post('username'), $this->input->post('number'));

			
			// $id = $user_info['name'];

			return $insert;

			
		}

		// Edit 

		public function edit_register(){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'number' => $this->input->post('number'),
                'username' => $this->input->post('username'),
                'user_type' => $this->input->post('user_type')
                // 'password' => $enc_password
                
			);

			// if ($this->input->post('user_type') == "client") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }

			// if ($this->input->post('user_type') == "admin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// } 

			// if ($this->input->post('user_type') == "superadmin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }

			// Update in User info
			$this->db->where('id' , $this->session->userdata('client_id'));
			$update = $this->db->update('users', $data);

			
			// $this->user_info($this->input->post('username'), $this->input->post('number'));

			
			// $id = $user_info['name'];

			return $update;

			
		}


		public function user_info($username, $number)
		{
			// Get User Info
			$this->db->where('username' , $username);
			$this->db->where('number', $number);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){

				$user_info = array(

					'id' => $result->row(0)->id,
					'name' => $result->row(0)->name,
					'number' => $result->row(0)->number,
					'email' => $result->row(0)->email,
					'username' => $result->row(0)->username,
					'user_type' => $result->row(0)->user_type


				);

				return $user_info;

			} else {

				return $result->num_rows();
			}

		}


		// Insert Password into database

		// public function user_password_insert($id, $enc_password)
		// {
		// 	$pass = array('password' => $enc_password);

		// 	$this->db->where('id', $id);

		// 	return $this->db->update('users', $pass);
		// }




		public function create_user($enc_password){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'number' => $this->input->post('number'),
                'username' => $this->input->post('username'),
                'password' => $enc_password
                
			);

			// if ($this->input->post('user_type') == "client") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }

			// if ($this->input->post('user_type') == "admin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// } 

			// if ($this->input->post('user_type') == "superadmin") {

			// 	$data['user_type'] = $this->input->post('user_type');

			// }
			// 
			
			$insert = $this->db->insert('users', $data);

			// $id = $this->register();

			// $this->user_password_insert($id, $enc_password);
			
			// Insert in Users
			return true;
			
		}





		// Make active
		// public function make_active()
		// {
		// 	$data = array(

		// 			'status' => TRUE

		// 		);

		// 	return $this->db->update('admin', $data);
		// }

		// Log user in
		public function login($username, $password){

			// Validate
			$this->db->where('email' , $username);
			$this->db->where('password', $password);
			$this->db->or_where('number' , $username);
			$this->db->where('password', $password);
			$this->db->or_where('username' , $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){

				// check here if account is active by first querying to see if user account 
				// is in active state else return a statement e.g "AccountError"

				$user_details = array(

					'id' => $result->row(0)->id,
					'name' => $result->row(0)->name,
					'number' => $result->row(0)->number,
					'email' => $result->row(0)->email,
					'username' => $result->row(0)->username,
					'user_type' => $result->row(0)->user_type


				);

				return $user_details;
			} else {
				return false;
			}
		}



		public function get($value='')
		{
			# code...
		}
		// Get user type
		// public function get_user_type($username, $password){
		// 	// Validate
		// 	$this->db->where('username' , '$username');
		// 	$this->db->or_where('number' , $username);
		// 	$this->db->where('password', $password);

		// 	$result = $this->db->get($table = 'users');

		// 	if($result->num_rows() == 1){
		// 		return $result->row(0)->user_type;
		// 	} else {
		// 		return false;
		// 	}
			
		// }

		// Check username exists
		public function check_username_exists($username){

			if ($this->session->userdata('client_id')) {
				
				$query = $this->db->get_where('users', array('username' => $username, 'id !=' => $this->session->userdata('client_id')));
				if(empty($query->row_array())){
				return true;
				} else {
					return false;
				}
			}

			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){

			if ($this->session->userdata('client_id')) {
				
				$query = $this->db->get_where('users', array('email' => $email, 'id !=' => $this->session->userdata('client_id')));
				if(empty($query->row_array())){
				return true;
				} else {
					return false;
				}
			}

			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}


		// Check number exists
		public function check_number_exists($number){

			if ($this->session->userdata('client_id')) {
				
				$query = $this->db->get_where('users', array('number' => $number, 'id !=' => $this->session->userdata('client_id')));
				if(empty($query->row_array())){
				return true;
				} else {
					return false;
				}
			}

			// echo $number." Hahahahaahahahahah";
			$query = $this->db->get_where('users', array('number' => $number));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}




		public function check_code_exist($code)
		{
			
			$query = $this->db->get_where('codes', array('code' => $code));
			if(empty($query->row_array())){

				$data = array(
					
	                'code' => $code,
	                'user_id' => $this->session->userdata('client_id'),
	                'validity' => true
	                
				);

				$this->db->insert('codes', $data);

				return true;

			} else {

				return false;
			}


		}







	}