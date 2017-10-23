<?php 

	/**
	* Confirmation_model
	*/
	class Confirmation_model extends CI_Model
	{
		
		public function get_user_info($user_id)
		{
			
			$this->db->where('id' , $user_id);

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

				return false;
			}



		}



		public function code_exist_validate($code)
		{	
			$this->db->where('code' , $code);
			$this->db->where('user_id' , $this->session->userdata('client_id'));
			$this->db->where('validity' , true);

			$query = $this->db->get('codes');

			if($query->num_rows() == 1){

				$data = array(
					
	                'validity' => false
	                
				);

				$this->db->where('code' , $code);
				$this->db->where('user_id' , $this->session->userdata('client_id'));
				$this->db->where('validity' , true);

				$this->db->update('codes', $data);

				return true;

			} else {

				return false;
			}

		}



		// Insert Password into database

		public function create_pass($id, $enc_password)
		{
			$pass = array('password' => $enc_password);

			$this->db->where('id', $id);

			return $this->db->update('users', $pass);
		}










		public function code_check($user_id)
		{	
			// $this->db->where('code' , $code);
			$this->db->where('user_id' , $user_id);
			$this->db->where('validity' , false);

			$query = $this->db->get('codes');

			if(empty($query->row_array())){

				return false;

			} else {

				return true;
			}

		}




















	}



 ?>