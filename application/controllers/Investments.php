<?php 

	class Investments extends CI_Controller
	{
		
		public function investment()
		{

			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {
					$data['title'] = 'Investment';
					// $data['code'] = $decoder;

					$this->form_validation->set_rules('amount', 'Amount', 'required');
					$this->form_validation->set_rules('payout', 'Payout', 'required');
					$this->form_validation->set_rules('duration', 'Duration', 'required');

					if ($this->form_validation->run() === FALSE) {

						$this->load->view('templates/header');
						$this->load->view('investments/investment', $data);
						$this->load->view('templates/footer');

					} else{

						$amount = $this->input->post('amount');

						$payout = $this->input->post('payout');

						$duration = $this->input->post('duration');

						$client_id = $this->session->userdata('client_id');
						
						$date = $this->input->post('date');



						$package_info = $this->investment_model->get_package($amount);

						if ($package_info) {
							
							$package = $package_info['name'];

						} else{

							// Set message
							$this->session->set_flashdata('amount_error', $amount.' FCFA is Lower than the minimun amount.');

							redirect('investments/investment');
						}


						$this->session->set_userdata('client_package', $package);

						

						$invest = $this->investment_model->invest($client_id, $amount, $payout, $duration, $date);

						if ($invest) {

							$investment_id = $invest;


							$package_id = $package_info['id'];

							$interest = $this->investment_model->get_interest($duration, $payout, $package_id);

							$generate = $this->investment_model->generate_profits($client_id, $investment_id, $amount, $duration, $interest, $date);

							if ($generate) {
								
								// Set message
									$this->session->set_flashdata('code_check', ' Profits generated  Successfully!');
							} else{

								$this->session->set_flashdata('amount_error', 'Profits Generated Unsuccessfully!');
							}

							
							$this->session->set_userdata('client_interest', $interest);
							$this->session->set_userdata('client_amount', $amount);
							// $this->session->set_userdata('client_payout', $payout);
							// $this->session->set_userdata('client_duration', $duration);

							redirect('displays');
							
						} else {

							redirect('investments/investment');
						}	
					}
			} else {

				redirect('');
			}
					
		}

		public function new_investment($client_id = NULL)
		{
			if ($client_id == NULL) {

				if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

						$data['title'] = ' New Investment';
						// $data['code'] = $decoder;

						$this->form_validation->set_rules('amount', 'Amount', 'required');
						$this->form_validation->set_rules('payout', 'Payout', 'required');
						$this->form_validation->set_rules('duration', 'Duration', 'required');

						if ($this->form_validation->run() === FALSE) {

							$this->load->view('templates/header');
							$this->load->view('investments/new_investment', $data);
							$this->load->view('templates/footer');

						} else{
							$amount = $this->input->post('amount');
							$payout = $this->input->post('payout');
							$duration = $this->input->post('duration');
							$client_id = $this->session->userdata('client_id');
							$date = $this->input->post('date');
							$package_info = $this->investment_model->get_package($amount);

							if ($package_info) {	
								$package = $package_info['name'];
							} else{

								// Set message
								$this->session->set_flashdata('amount_error', $amount.' FCFA is Lower than the minimun amount.');

								redirect('investments/new_investment');
							}


							$this->session->set_userdata('client_package', $package);
							$invest = $this->investment_model->invest($client_id, $amount, $payout, $duration, $date);

							if ($invest) {

								$investment_id = $invest;
								$package_id = $package_info['id'];
								$interest = $this->investment_model->get_interest($duration, $payout, $package_id);
								$generate = $this->investment_model->generate_profits($client_id, $investment_id, $amount, $duration, $interest, $date);

								if ($generate) {
									// Set message
									$this->session->set_flashdata('code_check', ' Profits generated  Successfully!');
								} else{

									$this->session->set_flashdata('amount_error', 'Profits Generated Unsuccessfully!');
								}

								
								$this->session->set_userdata('client_interest', $interest);
								$this->session->set_userdata('client_amount', $amount);
								// $this->session->set_userdata('client_payout', $payout);
								// $this->session->set_userdata('client_duration', $duration);

								redirect('displays/users');	
							} else {
								redirect('investments/new_investment');
							}	
						}
				} else {
					redirect('');
				}


				
			} else{

				$this->session->set_userdata('client_id', $client_id);
				$data['title'] = ' New Investment';
				$this->load->view('templates/header');
				$this->load->view('investments/new_investment', $data);
				$this->load->view('templates/footer');
			}
		}





		public function edit_investment($investment_id = NULL)
		{	


			if ($investment_id == NULL) {
				

				if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

					$data['title'] = 'Topup Investment';

					$this->session->unset_userdata('client_package');


					$this->form_validation->set_rules('amount', 'Amount', 'required');
					$this->form_validation->set_rules('payout', 'Payout', 'required');
					$this->form_validation->set_rules('duration', 'Duration', 'required');

					if ($this->form_validation->run() === FALSE) {

						$this->load->view('templates/header');
						$this->load->view('investments/edit_investment', $data);
						$this->load->view('templates/footer');

					} else{

						$amount = $this->input->post('amount');

						$payout = $this->input->post('payout');

						$duration = $this->input->post('duration');

						$investment_id = $this->session->userdata('investment_id');

						$client_id = $this->session->userdata('client_id');



						$package_info = $this->investment_model->get_package($amount);

						if ($package_info) {
							
							$package = $package_info['name'];

						} else{

							// Set message
							$this->session->set_flashdata('amount_error', $amount.' FCFA is Lower than the minimun amount.');

							redirect('investments/edit_investment');
						}


						$this->session->set_userdata('client_package', $package);

						

						$invest = $this->investment_model->edit_invest($client_id, $amount, $payout, $duration, $investment_id);

						if ($invest) {



							$investment_id = $invest;


							$package_id = $package_info['id'];

							$interest = $this->investment_model->get_interest($duration, $payout, $package_id);

							$generate = $this->investment_model->generate_profits($client_id, $investment_id, $amount, $duration, $interest);

							if ($generate) {
								
								// Set message
									$this->session->set_flashdata('code_check', ' Profits generated  Successfully!');
							} else{

								$this->session->set_flashdata('amount_error', 'Profits Generated Unsuccessfully!');
							}

							
							$this->session->set_userdata('client_interest', $interest);
							$this->session->set_userdata('client_amount', $amount);
							// $this->session->set_userdata('client_payout', $payout);
							

							// Set message
							$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Investment Topup Successfully!');

							redirect('displays/users');
							
						} else {

							$this->session->set_flashdata('amount_error', 'Investment Topup Failed!');

							redirect('displays/users');
						}




						
					}
					
				} else {

					redirect('');
				}
			} else {



				$set_values = $this->display_model->get_investment_info($investment_id);


				if ($set_values) {

					$this->session->set_userdata('client_id', $set_values['client_id']);
					$this->session->set_userdata('investment_id', $investment_id);
					$this->session->set_userdata('client_issue_date', $set_values['issue_date']);
					$this->session->set_userdata('client_start_date', $set_values['starting_date']);
					$this->session->set_userdata('client_first_payout', $set_values['first_payout']);
					$this->session->set_userdata('client_last_payout', $set_values['last_payout']);
					$this->session->set_userdata('client_package', $set_values['package_type']);
					// $this->session->set_userdata('client_interest', $interest);
					$this->session->set_userdata('client_amount', $set_values['amount']);
					$this->session->set_userdata('client_payout', $set_values['payout']);
					$this->session->set_userdata('client_duration', $set_values['duration']);
					
					// Load View
					$data['title'] = 'Topup Investment';

					$this->load->view('templates/header');
					$this->load->view('investments/edit_investment', $data);
					$this->load->view('templates/footer');
					
				} else {


					$this->session->set_flashdata('code_check', 'Error, Edit Failure.');

					redirect('displays/users');
				}

				
			}


		}

		public function edit()
		{
			if(!file_exists(APPPATH.'views/investments/edit_investment.php')){
				// echo "This is the page";
				show_404();
			}

			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) {

					$data['title'] = 'Edit Investment';

					$this->session->unset_userdata('client_package');


					$this->form_validation->set_rules('amount', 'Amount', 'required');
					$this->form_validation->set_rules('payout', 'Payout', 'required');
					$this->form_validation->set_rules('duration', 'Duration', 'required');

					if ($this->form_validation->run() === FALSE) {

						$this->load->view('templates/header');
						$this->load->view('investments/edit_investment', $data);
						$this->load->view('templates/footer');

					} else{

						$amount = $this->input->post('amount');

						$payout = $this->input->post('payout');

						$duration = $this->input->post('duration');

						$client_id = $this->session->userdata('client_id');



						$package_info = $this->investment_model->get_package($amount);

						if ($package_info) {
							
							$package = $package_info['name'];

						} else{

							// Set message
							$this->session->set_flashdata('amount_error', $amount.' FCFA is Lower than the minimun amount.');

							redirect('investments/edit');
						}


						$this->session->set_userdata('client_package', $package);

						

						$invest = $this->investment_model->edit($client_id, $amount, $payout, $duration);

						if ($invest) {



							$package_id = $package_info['id'];

							$interest = $this->investment_model->get_interest($duration, $payout, $package_id);

							
							$this->session->set_userdata('client_interest', $interest);
							$this->session->set_userdata('client_amount', $amount);
							// $this->session->set_userdata('client_payout', $payout);
							

							// Set message
							$this->session->set_flashdata('user_registered', $this->input->post('user_type').' Investment Edited Successfully!');

							redirect('displays');
							
						} else {

							$this->session->set_flashdata('amount_error', 'Investment Edit Failed!');

							redirect('investments/edit');
						}					
					}
			} else {

				redirect('');
			}
					
		}
		
		public function paidprofit($profit_id, $user_id = null)
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) 
			{
				
				$this->investment_model->markProfitAsPaid($profit_id);
				redirect('displays/user_investments/'.$user_id);
				
			} else {
				redirect('');
			}
		}
		
		public function unpaidprofit($profit_id, $user_id = null)
		{
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'superadmin') ) 
			{
				$this->investment_model->markProfitAsUnPaid($profit_id);
				redirect('displays/user_investments/'.$user_id);
			} else {
				redirect('');
			}
		}
		
		public function deleteInvestment ($investment_id) {
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) 
			{
				$this->investment_model->deleteInvestment($investment_id);
				redirect('displays/user_investments/'.$user_id);
			} else {
				redirect('');
			}
		}
		
		public function editPackages ($package_id = null) {
			if ($this->session->userdata('logged_in') && ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'superadmin') ) 
			{
				if(isset($package_id) && $package_id == 1) {
					$this->form_validation->set_rules('min', 'Min. Amount', 'required');
					$this->form_validation->set_rules('0mths', 'Percentage', 'required');
				} else {
					$this->form_validation->set_rules('min', 'Min. Amount', 'required');
					$this->form_validation->set_rules('3mths', 'Percentage for 3 Months', 'required');
					$this->form_validation->set_rules('6mths', 'Percentage for 6 Months', 'required');
					$this->form_validation->set_rules('12mths', 'Percentage for 12 Months', 'required');
				}
				$data['packages'] = $this->investment_model->getpackages();
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('templates/header');
					$this->load->view('investments/edit_packages', $data);
					$this->load->view('templates/footer');
				} else {
					$min = $this->input->post('min');
					$mths0 = $this->input->post('0mths');
					$mths3 = $this->input->post('3mths');
					$mths6 = $this->input->post('6mths');
					$mths12 = $this->input->post('12mths');
					$this->investment_model->editpackage($package_id, $min, $mths0, $mths3, $mths6, $mths12);
					redirect('');
				}
			} else {
				redirect('investments/investment');
			}
		}
	}
