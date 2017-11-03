<?php 
	
	/**
	* Display_Model
	*/
	class Display_Model extends CI_Model
	{
		
		public function get_users()
		{
			$query = $this->db->get('users');
            return $query->result_array();
		}
		
		public function get_user($user_id)
		{
			$query = $this->db->query("SELECT * FROM users WHERE id = '".$user_id."';");
			//$query = $this->db->get('users');
            return $query->row_array();
		}

		public function get_investment_info($id)
		{
			$this->db->where('id', $id);
			$result = $this->db->get('investments');

			if ($result->num_rows() == 1) {

				if ($result->row(0)->duration == 0) {

					$duration_time = "Any";
					
				} else{

					$duration_time = $result->row(0)->duration;
				}

				$details = array(

					'id' => $result->row(0)->id,
					'client_id' => $result->row(0)->client_id,
					'amount' => $result->row(0)->amount,
					'issue_date' => $result->row(0)->issue_date,
					'package_type' => $result->row(0)->package_type,
					'duration' => $duration_time,
					'starting_date' => $result->row(0)->starting_date,
					'payout' => $result->row(0)->payout,
					'first_payout' => $result->row(0)->first_payout,
					'last_payout' => $result->row(0)->last_payout

					 );

				return $details;

			} else{


				return false;
			}
		}

		public function get_user_profits ($client_id)
		{
			$this->db->where('client_id',  $client_id);
			$this->db->order_by('datestamp', 'asc');
			$result = $this->db->get('profits');
			if (empty($result->row_array())) {
				return false;
			} 
			return $result->result_array();
		}
		
		public function get_all_profits($date = null) {
			if($date) {$this->db->where('datestamp', strtotime($date));}
			$this->db->order_by('datestamp', 'asc');
			$result = $this->db->get('profits');
			if (empty($result->row_array())) {
				return false;
			} 
			return $result->result_array();
		}
		
		public function get_all_investments() {
			$result = $this->db->get('investments');
			if (empty($result->row_array())) {
				return false;
			} 
			return $result->result_array();
		}
		
		public function get_user_investments($client_id)
		{
			$this->db->where('client_id',  $client_id);
			$result = $this->db->get('investments');
			if (empty($result->row_array())) {
				return false;
			} 
			return $result->result_array();

			// if ($result->num_rows() == 1) {

			// 	if ($result->row(0)->duration == 0) {

			// 		$duration_time = "Any";
					
			// 	} else{

			// 		$duration_time = $result->row(0)->duration;
			// 	}

			// 	$details = array(

			// 		'id' => $result->row(0)->id,
			// 		'amount' => $result->row(0)->amount,
			// 		'issue_date' => $result->row(0)->issue_date,
			// 		'package_type' => $result->row(0)->package_type,
			// 		'duration' => $duration_time,
			// 		'starting_date' => $result->row(0)->starting_date,
			// 		'payout' => $result->row(0)->payout,
			// 		'first_payout' => $result->row(0)->first_payout,
			// 		'last_payout' => $result->row(0)->last_payout

			// 		 );

			// 	return $details;

			// } else{


			// 	return false;
			// }
		}


		public function get_package($amount)
		{
			$this->db->where('minimum_amount <' , $amount);
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



		
	}





































 ?>