<?php 

	/**
	* Investment Model
	*/
	class Investment_model extends CI_Model
	{
		
		

		public function invest($client_id, $amount, $payout, $duration)
		{
			
			$duration_time = $duration;

			$current_date = date('l d-m-Y H:i:sa');

			$starting_date = date('l d-m-Y H:i:sa', strtotime('next Monday 8am'));

			// checking first payout date from payout type

			if ($payout == "weekly") {
				

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('next Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('2 Saturday 8am'));
					
				}

			} else {

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('4 Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('5 Saturday 8am'));
					
				}


			}

			// checking last date from duration
			
			if ($duration == "3") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('12 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('13 Saturdays'));
					
				}

			}

			if ($duration == "6") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('24 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('25 Saturdays'));
					
				}

			}

			if ($duration == "12") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('48 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-Y H:i:sa', strtotime('49 Saturdays'));
					
				}

			}

			// if ($duration == "0") {
				
			// 	$last_payout_date = "Anytime";

			// }


			$package_type = $this->session->userdata('client_package');

			if ($package_type == "starter") {

				$duration_time = "Unlimited";
				
				$last_payout_date = "Anytime";

				$payout = "monthly";

			}


			$this->session->set_userdata('client_issue_date', $current_date);
			$this->session->set_userdata('client_start_date', $starting_date);
			$this->session->set_userdata('client_first_payout', $first_payout_date);
			$this->session->set_userdata('client_last_payout', $last_payout_date);
			$this->session->set_userdata('client_duration', $duration_time);
			$this->session->set_userdata('client_payout', $payout);

			// Client investment data array
			
			$data = array(

				'client_id' => $client_id,
				'amount' => $amount,
				'package_type' => $package_type,
				'payout' => $payout,
                'duration' => $duration,
				'issue_date' => $current_date,
				'starting_date' => $starting_date,
				'first_payout' => $first_payout_date,
				'last_payout' => $last_payout_date,
                'validity' => true
                
			);



			// Insert in Investments
			$invest = $this->db->insert('investments', $data);



			if ($invest) {
				
				// Getting New Investment Id

				$get_id = $this->db->get_where('investments', $data);

				if ($get_id->num_rows() == 1) {
					
					$id = $get_id->row(0)->id;

					return $id;

				} else {

					return false;
					
				}
			} else {

				return false;

			}



		}


		// Edit Investment

		public function edit_invest($client_id, $amount, $payout, $duration, $id)
		{
			$this->session->unset_userdata('client_interest');
			$this->session->unset_userdata('client_amount');
			$this->session->unset_userdata('client_payout');
			$this->session->unset_userdata('client_duration');
			$this->session->unset_userdata('client_issue_date');
			$this->session->unset_userdata('client_start_date');
			$this->session->unset_userdata('client_first_payout');
			$this->session->unset_userdata('client_last_payout');


			// $duration = $this->input->post('duration');

			$current_date = date('l d-m-Y H:i:sa');

			$starting_date = date('l d-m-y H:i:sa', strtotime('next Monday 8am'));

			// checking first payout date from payout type

			if ($payout == "weekly") {
				

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('next Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('2 Saturday 8am'));
					
				}

			} else {

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('4 Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('5 Saturday 8am'));
					
				}


			}

			// checking last date from duration
			
			if ($duration == "3") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('12 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('13 Saturdays'));
					
				}

			}

			if ($duration == "6") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('24 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('25 Saturdays'));
					
				}

			}

			if ($duration == "12") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('48 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('49 Saturdays'));
					
				}

			}

			// if ($duration == "0") {

			// 	$duration = "Any";
				
			// 	$last_payout_date = "Anytime";

			// }


			$package_type = $this->session->userdata('client_package');

			if ($package_type == "starter") {

				$duration = "Unlimited";
				
				$last_payout_date = "Anytime";

				$payout = "monthly";

			}

			$this->session->set_userdata('client_issue_date', $current_date);
			$this->session->set_userdata('client_start_date', $starting_date);
			$this->session->set_userdata('client_first_payout', $first_payout_date);
			$this->session->set_userdata('client_last_payout', $last_payout_date);
			$this->session->set_userdata('client_duration', $duration);
			$this->session->set_userdata('client_payout', $payout);





			// check t see if invesment has already been toppedup from

			$this->db->where('id', $id);
			$this->db->where('validity', FALSE);

			$check = $this->db->get('investments');

			if (!empty($check->row_array())) {
				
				$this->session->set_flashdata('user_invalid_details', 'Topup Forbiden, Validity False!');

				return false;

			}


			// Client investment data array
			
			$data = array(

				'client_id' => $client_id,
				'amount' => $amount,
				'package_type' => $package_type,
				'payout' => $payout,
                'duration' => $duration,
				'issue_date' => $current_date,
				'starting_date' => $starting_date,
				'first_payout' => $first_payout_date,
				'last_payout' => $last_payout_date,
				'top_up_from' => $id,
                'validity' => true
                
			);



			// switching status of the toped up investment
			$change  = array('validity' => FALSE );

			$this->db->where('id', $id);

			$close = $this->db->update('investments', $change);

			// Topup in Investments
			
			if ($close) {
				
				$topup = $this->db->insert('investments', $data);

				if ($topup) {
				
					// Getting New Investment Id

					$get_id = $this->db->get_where('investments', $data);

					if ($get_id->num_rows() == 1) {
						
						$id = $result->row(0)->id;

						return $id;

					} else {

						return false;
						
					}

				} else {

					return false;

				}

			} else {

				return false;

			}
			

				


		}



		public function edit($client_id, $amount, $payout, $duration)
		{
			$this->session->unset_userdata('client_interest');
			$this->session->unset_userdata('client_amount');
			$this->session->unset_userdata('client_payout');
			$this->session->unset_userdata('client_duration');
			$this->session->unset_userdata('client_issue_date');
			$this->session->unset_userdata('client_start_date');
			$this->session->unset_userdata('client_first_payout');
			$this->session->unset_userdata('client_last_payout');


			// $duration = $this->input->post('duration');

			$current_date = date('l d-m-Y H:i:sa');

			$starting_date = date('l d-m-y H:i:sa', strtotime('next Monday 8am'));

			// checking first payout date from payout type

			if ($payout == "weekly") {
				

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('next Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('2 Saturday 8am'));
					
				}

			} else {

				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('4 Saturday 8am'));

				} else {

					$first_payout_date = date('l d-m-Y H:i:sa', strtotime('5 Saturday 8am'));
					
				}


			}

			// checking last date from duration
			
			if ($duration == "3") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('12 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('13 Saturdays'));
					
				}

			}

			if ($duration == "6") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('24 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('25 Saturdays'));
					
				}

			}

			if ($duration == "12") {
				
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$last_payout_date = date('l d-m-y H:i:sa', strtotime('48 Saturdays'));
					
				} else {

					$last_payout_date = date('l d-m-y H:i:sa', strtotime('49 Saturdays'));
					
				}

			}

			// if ($duration == "0") {

			// 	$duration = "Any";
				
			// 	$last_payout_date = "Anytime";

			// }


			$package_type = $this->session->userdata('client_package');

			if ($package_type == "starter") {

				$duration = "Unlimited";
				
				$last_payout_date = "Anytime";

				$payout = "monthly";

			}

			$this->session->set_userdata('client_issue_date', $current_date);
			$this->session->set_userdata('client_start_date', $starting_date);
			$this->session->set_userdata('client_first_payout', $first_payout_date);
			$this->session->set_userdata('client_last_payout', $last_payout_date);
			$this->session->set_userdata('client_duration', $duration);
			$this->session->set_userdata('client_payout', $payout);





			// // check t see if invesment has already been toppedup from

			// $this->db->where('id', $id);
			// $this->db->where('validity', FALSE);

			// $check = $this->db->get('investments');

			// if (!empty($check->row_array())) {
				
			// 	$this->session->set_flashdata('user_invalid_details', 'Topup Forbiden, Validity False!');
				
			// 	return false;

			// }


			// Client investment data array
			
			$data = array(

				'client_id' => $client_id,
				'amount' => $amount,
				'package_type' => $package_type,
				'payout' => $payout,
                'duration' => $duration,
				'issue_date' => $current_date,
				'starting_date' => $starting_date,
				'first_payout' => $first_payout_date,
				'last_payout' => $last_payout_date,
                'validity' => true
                
			);


			$topup = $this->db->update('investments', $data);

			return $topup;
			
			

				


		}





		public function get_package($amount)
		{
			$this->db->where('minimum_amount <=' , $amount);
			$result = $this->db->get('packages');




			if($result->num_rows() == 3){

				$package_info = array(

					'id' => 3,
					'name' => 'premium'
		

				);

				return $package_info;

			}

			if ($result->num_rows() == 2) {
						

				$package_info = array(

					'id' => 2,
					'name' => 'business'
		

				);

				return $package_info;
						
			}


			// if ($result->row(0)->minimum_amount > $amount) {
				
			// 	return false;

			// }

			if ($result->num_rows() == 1) {

				$package_info = array(

					'id' => 1,
					'name' => 'starter'
		

				);

				return $package_info;		
						
			} else{

				return false;
			}

		}


		public function get_interest($duration, $payout, $package_id)
		{
			$this->db->where('contract_duration' , $duration);
			$this->db->where('payout' , $payout);
			$this->db->where('package_id' , $package_id);
			$result = $this->db->get('interests');

			if ($result->num_rows() == 1) {
				
				$interest = $result->row(0)->percentage;

				return $interest;
			} else {

				return false;
			}

		}



		public function generate_profits($client_id, $investment_id, $amount, $duration, $interest)
		{
			
			$percentage = $interest/100;

			$profit = $amount * $percentage;

			$gap = 0;

			$payout_count = 5;


			for ($i=0; $i < $duration; $i++) { 


				$gap = $gap + $payout_count;

				//$stamp = '';
				//$next_payout_date = '';
				if (date('l') == 'Saturday' || date('l') == 'Sunday') {
					
					$next_payout_date = date('l d-m-Y h:i:sa', strtotime($gap.' Saturdays 8am'));
					$stamp = strtotime($gap.' Saturdays 8am');
					
				} else {

					$gapplus = $gap + 1;

					$next_payout_date = date('l d-m-Y h:i:sa', strtotime($gapplus.' Saturdays 8am'));
					$stamp = strtotime($gapplus.' Saturdays 8am');
					
				}



				$data = array(

					'client_id' => $client_id, 
					'investment_id' => $investment_id, 
					'amount' => $profit, 
					'due_date' => $next_payout_date, 
					'duration' => $duration, 
					'validity' => true,
					'datestamp' => $stamp


					);


				$place_profit = $this->db->insert('profits', $data);

				if ($place_profit === FALSE) {
					
					return false;
				}

			}

			return true;
		}
		
		public function markProfitAsPaid($profit_id)
		{
			$this->db->set('validity', 0);
			$this->db->where('id', $profit_id);
			$this->db->update('profits');
		}
	}






































 ?>