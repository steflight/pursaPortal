<?php 

	/**

	* Confirmation

	*/

	class Confirmation extends CI_Controller
	{
		public function Index($enc_id)
		{

			$coded = str_replace('*', '/', $enc_id);

			$code = str_replace('_', '|', $coded);

			$decoder = $this->mc_decrypt($code, ENCRYPTION_KEY);

			$user_id = $decoder;

			// echo $user_id;


			// checking to see if the user has already activated his code 
			$code_check = $this->confirmation_model->code_check($user_id);

			if ($code_check) {
				
				$this->session->set_flashdata('code_check', 'Your Account has already been validated. Login.');

				redirect('users/login');

			}

			$this->session->set_userdata('client_id', $user_id);


			$user_info = $this->confirmation_model->get_user_info($user_id);



			if ($user_info) {
						
				$client_name = $user_info['name'];

				$this->session->set_userdata('client_name', $client_name);

				$this->session->set_flashdata('code_input', 'Input Your Code Here.');

				redirect('confirmation/codex');


			} else {

				// $this->session->userdata('client_id');

				$this->session->set_flashdata('user_invalid_details', 'User Not Found, Please Contact The Administrator or Login.');

				redirect('');
			}
		}


		
		public function codex()
		{
			$this->form_validation->set_rules('code', 'code', 'required');


			if ($this->form_validation->run() === FALSE) {
				
				// Load View
				$this->load->view('templates/header');
				$this->load->view('confirmation/codex');
				$this->load->view('templates/footer');
				
			} else {


				$code = $this->input->post('code');


				$status = $this->confirmation_model->code_exist_validate($code);


				if ($status) {
					
					$this->session->set_flashdata('user_registered', 'Status Checked!');

					redirect('confirmation/create_password');

				} else {

					$this->session->set_flashdata('user_invalid_details', 'Status Check Failed! Contact The Administrator or Login.');

					redirect('confirmation/codex');

				}




			}

		}



		public function create_password()
		{	
			
			$user_id = $this->session->userdata('client_id');
			

			$data['title'] = 'Create Your Password';
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');


			if ($this->form_validation->run() === FALSE) {
				
				// Load View
				$this->load->view('templates/header');
				$this->load->view('confirmation/create_pass', $data);
				$this->load->view('templates/footer');
				
			} else {


				$pass = $this->input->post('password');

				$enc_pass = md5($pass);

				$create_pass = $this->confirmation_model->create_pass($user_id, $enc_pass);

				$this->session->set_flashdata('code_check', 'Account Password Created Successfully.');



				// unseting temporary data

				$this->session->unset_userdata('client_id');
				$this->session->unset_userdata('client_name');
				


				redirect('users/login');


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
	


 ?>