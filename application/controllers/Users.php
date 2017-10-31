<?php
	class Users extends CI_Controller{

		public function view($page = 'home'){

			if(!file_exists(APPPATH.'views/users/'.$page.'.php')){
				//show_404();
			}
			if (!$this->session->userdata('logged_in')) {
				redirect('users/login');
			}
		    if ($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'client') {
				redirect('displays/my_investments');
			}
			redirect('displays/dashboard');

			$data['title'] = ucfirst($page);

			$this->load->view('templates/header');
			$this->load->view('users/'.$page, $data);
			$this->load->view('templates/footer');
		}

		// Register user
		public function register(){
			
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				$data['title'] = 'Sign Up';

				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
				$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
				$this->form_validation->set_rules('number', 'Number', 'required|callback_check_number_exists');
				$this->form_validation->set_rules('user_type', 'UserType', 'required|callback_check_user_type');
				// $this->form_validation->set_rules('password', 'Password', 'required');
				// $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

				if($this->form_validation->run() === FALSE){
					$this->load->view('templates/header');
					$this->load->view('users/register', $data);
					$this->load->view('templates/footer');
				} else {
					// Encrypt password
					$pass = random_string('alnum',8);
					$enc_password = md5($pass);
					$user_type = $this->input->post('user_type');
					$client_name = $this->input->post('name');
					$client_username = $this->input->post('username');
					$client_email = $this->input->post('email');
					$client_number = $this->input->post('number');
					$visa = $this->input->post('visacard');
					
					$this->user_model->register();

					$user_info = $this->user_model->user_info($client_username, $client_number);


					if ($user_info) {
						
						$client_id = $user_info['id'];


						$this->session->set_userdata('client_id', $client_id);
						$this->session->set_userdata('client_name', $client_name);
						$this->session->set_userdata('client_email', $client_email);
						$this->session->set_userdata('client_number', $client_number);

					} else {

						// $this->session->userdata('client_id');

						$this->session->set_flashdata('user_invalid_details', $this->input->post('user_type')." ".$client_name.' Account Creation Failed');

						redirect('users/register');
					}




					// Set message
					$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Account Created Successfully! ');

					redirect('investments');
				}







			} else {

				redirect('');
			}
		}


		// Edit information
		public function edit(){
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

				$data['title'] = 'Edit Info';

				// Useting pervious info about client
				$this->session->unset_userdata('client_name');
				$this->session->unset_userdata('client_email');
				$this->session->unset_userdata('client_number'); 

				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
				$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
				$this->form_validation->set_rules('number', 'Number', 'required|callback_check_number_exists');
				$this->form_validation->set_rules('user_type', 'UserType', 'required|callback_check_user_type');
				// $this->form_validation->set_rules('password', 'Password', 'required');
				// $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

				if($this->form_validation->run() === FALSE){
					$this->load->view('templates/header');
					$this->load->view('users/edit_register', $data);
					$this->load->view('templates/footer');
				} else {
					// Encrypt password
					// $enc_password = md5($this->input->post('password'));
					$user_type = $this->input->post('user_type');
					$client_name = $this->input->post('name');
					$client_username = $this->input->post('username');
					$client_email = $this->input->post('email');
					$client_number = $this->input->post('number');
					
					$this->user_model->edit_register();

					$user_info = $this->user_model->user_info($client_username, $client_number);


					if ($user_info) {
						
						$client_id = $user_info['id'];


						$this->session->set_userdata('client_id', $client_id);
						$this->session->set_userdata('client_name', $client_name);
						$this->session->set_userdata('client_email', $client_email);
						$this->session->set_userdata('client_number', $client_number);

					} else {

						// $this->session->userdata('client_id');

						$this->session->set_flashdata('user_invalid_details', $this->input->post('user_type')." ".$client_name.' Account Edit Failed');

						redirect('users/edit');
					}




					// Set message
					$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Account Edited Successfully!');

					redirect('investments/edit');
				}







			} else {

				// Set message
				$this->session->set_flashdata('amount_error', 'User Credentials Insufficient!');

				redirect('');
			}
		}

		// Creating a user
		public function create_user(){

			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				
			

				$data['title'] = 'Sign Up';

				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
				$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
				$this->form_validation->set_rules('number', 'Number', 'required|callback_check_number_exists');
				$this->form_validation->set_rules('user_type', 'UserType', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

				if($this->form_validation->run() === FALSE){
					$this->load->view('templates/header');
					$this->load->view('users/create_user', $data);
					$this->load->view('templates/footer');
				} else {
					// Encrypt password
					$enc_password = md5($this->input->post('password'));
					$user_type = $this->input->post('user_type');

					$create_user = $this->user_model->create_user($enc_password);


					if ($create_user) {
						
						// Set message
						$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Account Created Successfully! Now LogIn');
							
						redirect('');
					} else {

						// Set message
						$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Account Creation Failed!');
							
						redirect('users/create_user');


					}

				}








			} else{

				redirect('');
			}
		}

		// Log in user
		public function login(){

			if ($this->session->userdata('logged_in')) {
				
				redirect('');
			}

			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				//$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				//$this->load->view('templates/footer');
				// echo "here";
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

				// Login user
				$user_details = $this->user_model->login($username, $password);

				// do first validation here for the account active status here by 
				// using if and then redirect with specific error asking to contact 
				// admin

				if($user_details){

					// print_r ($user_details);
					// echo $user_details['id'];
					// echo $user_details['user_type'];
					// Get user type
					
					$id = $user_details['id'];
					$name = $user_details['name'];
					$number = $user_details['number'];
					$email = $user_details['email'];
					$username = $user_details['username'];
					$user_type = $user_details['user_type'];

					// Create session
					$user_data = array(

						'user_id' => $id,
						'name' =>  $name,
						'email' =>  $email,
						'number' =>  $number,
						'username' =>  $username,
						'user_type' =>  $user_type,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('');

				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid try again');

					redirect('users/login');
				}		
			}
		}

		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_type');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('client_id');
			$this->session->unset_userdata('client_name');
			$this->session->unset_userdata('investment_id');
			$this->session->unset_userdata('client_email');
			$this->session->unset_userdata('client_number');
			$this->session->unset_userdata('client_amount');
			$this->session->unset_userdata('client_package');
			$this->session->unset_userdata('client_interest');
			$this->session->unset_userdata('client_payout');
			$this->session->unset_userdata('client_duration');
			$this->session->unset_userdata('client_start_date');
			$this->session->unset_userdata('client_issue_date');
			$this->session->unset_userdata('client_first_payout');
			$this->session->unset_userdata('client_last_payout');
			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('users/login');
		}


		// public function code($encrypted)
		// {
		// 	if ($this->session->userdata('logged_in') ) {

		// 		$coded = str_replace('*', '/', $encrypted);

		// 		$code = str_replace('_', '|', $coded);

		// 		$decoded = $this->mc_decrypt($code, ENCRYPTION_KEY);


		// 		$user_id = $this->user_model->get_user($decoded);

		// 		if ($user_id) {

					

		// 		} else{

		// 			// Set message
		// 			$this->session->set_flashdata('user_loggedout', 'Sorry, Invalid User Credentials');

		// 			redirect('');
		// 		}


				
		// 		// $this->session->set_userdata('client_codeout', $decoder);

		// 	} else {

		// 		redirect('');
		// 	}
		// }


		public function send_mail()
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

				
				// Encrypting the client id

				$encode = $this->mc_encrypt($this->session->userdata('client_id'), ENCRYPTION_KEY);

				// parsed so it can be passed through the url
				$parse = str_replace('/', '*', $encode);

				$encoded = str_replace('|', '_', $parse);



				// Decodeing process
				// $coded = str_replace('*', '/', $codeInput);

				// $code = str_replace('_', '|', $coded);

				// $decoder = $this->mc_decrypt($code, ENCRYPTION_KEY);
				

				// Creating Unique user code
				
				$code = strtoupper(random_string('alnum',6));

				// check if code exist in database
				$check_code = $this->user_model->check_code_exist($code); 
				
				while ($check_code == false) {

					$code = strtoupper(random_string('alnum',6));

					$check_code = $this->user_model->check_code_exist($code);

				} 


				$user_code = $code;
				


				// Sending Email Here 
				



				// Here is the link in the email

		  		$link = base_url().'confirmation/'.$encoded;

		  		// Here is the unique user code

		  		$user_code;

		  		$name = $this->session->userdata('client_name');
		  		$email = $this->session->userdata('client_email');

		  		$to = $email;
				$subject = "HTML email";

				$message = "
				<html>
				<head>
				<title>Pursa Code</title>
				</head>
				<body>
				<p>Your Account is ready Click the link below to Activate it.</p>
				<table>
				<tr>
				<th>Name</th>
				<th>Code</th>
				</tr>
				<tr>
				<td>$name</td>
				<td><strong>$user_code</strong></td>
				</tr>
				</table>

				<h1><a href='$link'>CLICK HERE TO ACTIVATE</a></h1>
				</body>
				</html>
				";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <info@pursa.com>' . "\r\n";
				
								$this->load->library('email');
				
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.pursa.co';
				$config['smtp_user'] = 'noreply@pursa.co';
				$config['smtp_pass'] = '-=I)xuanFx.?';
				$config['smtp_port'] = '587';
				$this->email->initialize($config);
				
				$this->email->from('noreply@pursa.co', 'Pursa.co');
				$this->email->to($to);
				$this->email->subject('Your Login Details to Pursa Portal');
				$this->email->message($message);
				$this->email->send();


				mail($to,$subject,$message,$headers);


		  		// Here we unset all the previous user's information

				$this->session->unset_userdata('client_id');
				$this->session->unset_userdata('client_name');
				$this->session->unset_userdata('client_email');
				$this->session->unset_userdata('client_number');
				$this->session->unset_userdata('client_amount');
				$this->session->unset_userdata('client_package');
				$this->session->unset_userdata('client_interest');
				$this->session->unset_userdata('client_payout');
				$this->session->unset_userdata('client_duration');
				$this->session->unset_userdata('client_start_date');
				$this->session->unset_userdata('client_first_payout');
				$this->session->unset_userdata('client_last_payout');
				 
				 
				

				// Set message
				$this->session->set_flashdata('user_loggedin', 'Mail Sent!');

				redirect('users/register');

			} else{

				redirect('');
			}


		}












		// Validation functions

		// Check if username exists
		public function check_username_exists($username){
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
				if($this->user_model->check_username_exists($username)){
					return true;
				} else {
					return false;
				}
			} else{
				redirect('');
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
				if($this->user_model->check_email_exists($email)){
					return true;
				} else {
					return false;
				}
			} else {

				redirect('');
			}
		}


		// Check if number exists
		public function check_number_exists($number){
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				$this->form_validation->set_message('check_number_exists', 'That number is taken. Please choose a different one');
				if($this->user_model->check_number_exists($number)){
					return true;
				} else {
					return false;
				}
			} else{

				redirect('');
			}
		}


		// Check if number exists
		public function check_user_type($user_type){
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				$this->form_validation->set_message('check_user_type', 'User Credentials Insufficient!');
				
				if($user_type){
					return true;
				} else {
					return false;
				}
			} else{

				redirect('');
			}
		}


		// Encrypt Function
		public  function mc_encrypt($encrypt, $key)
		{
			
			if ($this->session->userdata('logged_in')) {


				    $encrypt = serialize($encrypt);
				    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
				    $key = pack('H*', $key);
				    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
				    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
				    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
				    return $encoded;

			}
			
		}


		// Decrypt Function
		public  function mc_decrypt($decrypt, $key)
		{
			// define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
			if ($this->session->userdata('logged_in')) {


				    $decrypt = explode('|', $decrypt.'|');
				    $decoded = base64_decode($decrypt[0]);
				    $iv = base64_decode($decrypt[1]);
				    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
				    $key = pack('H*', $key);
				    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
				    $mac = substr($decrypted, -64);
				    $decrypted = substr($decrypted, 0, -64);
				    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
				    if($calcmac!==$mac){ return false; }
				    $decrypted = unserialize($decrypted);
				    return $decrypted;

			}
			
		}













	}