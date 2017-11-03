<?php 

	class Displays extends CI_Controller
	{
		
		public function users()
		{	
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
			
				$data['title'] = 'Users';

	            $data['users'] = $this->display_model->get_users();

	            $this->load->view('templates/header');
	            $this->load->view('displays/users', $data);
	            $this->load->view('templates/footer');

	        } else {

				redirect('');
			}

		}
		
		public function user_investments( $user_id )
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				if(!isset($user_id)) { redirect('displays/users'); }
				$data['title'] = 'User Investments';
				
				$data['investments'] = $this->display_model->get_user_investments($user_id);
				$data['profits'] = $this->display_model->get_user_profits($user_id);
				$data['user'] = $user_id;
				
	            $this->load->view('templates/header');
	            $this->load->view('displays/user_investments', $data);
	            $this->load->view('templates/footer');
				
			} else {
				redirect('');
			}
		}
		
		public function dashboard( )
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				//if(!isset($user_id)) { redirect('displays/users'); }
				$data['title'] = 'Investments Report';
				
				$data['investments'] = $this->display_model->get_all_investments();
				$data['profits'] = $this->display_model->get_all_profits();
				//$data['user'] = $user_id;
				
	            $this->load->view('templates/header');
	            $this->load->view('displays/all_investments', $data);
	            $this->load->view('templates/footer');
				
			} else {
				redirect('');
			}
		}
		
		public function investmentReports () {
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				//if(!isset($user_id)) { redirect('displays/users'); }
				$data['title'] = 'Investments Report';
				
				$data['investments'] = $this->display_model->get_all_investments();
				//$data['profits'] = $this->display_model->get_all_profits();
				//$data['user'] = $user_id;
				
	            $this->load->view('templates/header');
	            $this->load->view('displays/investment_reports', $data);
	            $this->load->view('templates/footer');
				
			} else {
				redirect('');
			}
		}
		
		public function profitReports ($date = null) {
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				//if(!isset($user_id)) { redirect('displays/users'); }
				$data['title'] = 'Investments Report';
				
				if(!$date) $date = $this->input->post('profitsDate');
				
				//$data['investments'] = $this->display_model->get_all_investments();
				$data['profits'] = $this->display_model->get_all_profits($date);
				$data['allProfits'] = $this->display_model->get_all_profits();
				$data['date'] = $date;
				
	            $this->load->view('templates/header');
	            $this->load->view('displays/profit_reports', $data);
	            $this->load->view('templates/footer');
				
			} else {
				redirect('');
			}
		}
		
		public function my_investments()
		{
			if ($this->session->userdata('logged_in') ) {
				$user_id = $this->session->userdata('user_id');
				$data['title'] = 'User Investments';
				
				$data['investments'] = $this->display_model->get_user_investments($user_id);
				$data['profits'] = $this->display_model->get_user_profits($user_id);
				$data['user'] = $user_id;
				
	            $this->load->view('templates/header');
	            $this->load->view('displays/user_investments', $data);
	            $this->load->view('templates/footer');
				
			} else {
				redirect('');
			}
		}


		public function investments($user_id)
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

				$data['title'] = 'Investments';

	            $data['investments'] = $this->display_model->get_user_investments($user_id);

	            $this->load->view('templates/header');
	            $this->load->view('displays/investments', $data);
	            $this->load->view('templates/footer');


	        } else {

				redirect('');
			}

		}




		public function contract_details(){

			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
				if(!file_exists(APPPATH.'views/displays/contract_details.php')){
					// echo "This is the page";
					show_404();
				}

				if ($this->session->userdata('logged_in') ) {
						$data['title'] = 'Contract Details';

						$this->load->view('templates/header');
						$this->load->view('displays/contract_details', $data);
						$this->load->view('templates/footer');





				} else {

					redirect('');
				}
			} else {

				redirect('');
			}
		}



		public function user_details()
		{ 
			// if ($this->session->userdata('logged_in') ) {

				if (!file_exists(APPPATH.'views/displays/user_details.php')) {

					show_404();

				}


				$data['title'] = 'My Contract Details';

				$user_id = $this->session->userdata('user_id');



				$user_investment = $this->display_model->get_user_investments($user_id);



				if ($user_investment) {

					$package_info = $this->display_model->get_package($user_investment['amount']);

					$package_id = $package_info['id'];

					$interest = $this->display_model->get_interest($user_investment['duration'], $user_investment['payout'], $package_id);
					
					$this->session->set_userdata('client_issue_date', $user_investment['issue_date']);
					$this->session->set_userdata('client_start_date', $user_investment['starting_date']);
					$this->session->set_userdata('client_first_payout', $user_investment['first_payout']);
					$this->session->set_userdata('client_last_payout', $user_investment['last_payout']);
					$this->session->set_userdata('client_package', $user_investment['package_type']);
					$this->session->set_userdata('client_interest', $interest);
					$this->session->set_userdata('client_amount', $user_investment['amount']);
					$this->session->set_userdata('client_payout', $user_investment['payout']);
					$this->session->set_userdata('client_duration', $user_investment['duration']);


					$this->load->view('templates/header');
					$this->load->view('displays/user_details', $data);
					$this->load->view('templates/footer');

				} else {

					// Set message
					$this->session->set_flashdata('user_ivalid_details', 'Sorry, your investment details were not found!');

					redirect('');

				}

			// } else {

			// 	redirect('');
			// }

		}
	}