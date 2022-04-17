<?php
	/**
	 * User model
	 */
	class User_Model extends CI_Model
	{
		
		public function __construct(){
			parent::__construct();
		}
		public function register_user($userData = array()){
			$result = $this->db->insert('user',$userData);
			$last_id = $this->db->insert_id();
			if($last_id){
				return $last_id;
			}else{
				return false;
			}
		}

		public function login_user($login_user = array()){
			$where = array(
				'email' => $login_user['email'],
				'password' => $login_user['password']
			);
			$this->db->select('id,fname');
			$this->db->where($where);
			$user = $this->db->get('user');
			return $user->row();
		}

		public function get_user($id){
			$this->db->select('*');
			$this->db->where('id', $id);
			$user = $this->db->get('user');
			return $user->row();
		}

		public function ref_user($id,$code){
			$where = array(
				'user_referral_code ' => $code
			);
			$this->db->select('id');
			$this->db->where($where);
			$user = $this->db->get('user');
			$referral_user_id = $user->row();
			
			if(!empty($referral_user_id)){
				$referral_data = array(
					'user_id' => $id,
					'referral_user_id' => $referral_user_id->id,
					'referral_code' => $code
				);
				$result = $this->db->insert('referral_tbl',$referral_data);
				$last_id = $this->db->insert_id();
			}else{
				$data = array(
						'user_id' => $id,
						'income' => 500,
						'credit_debit' => 500,
						'code' => 'c'
					);
				$this->db->insert('account',$data);
			}
			if($last_id){
				return $last_id;
			}else{
				return false;
			}
		}
		public function add_amount($id){
			$amount = 500;
			$where = array(
				'id ' => $id
			);
			$this->db->select('*');
			$this->db->where($where);
			$user = $this->db->get('referral_tbl');
			$referral_user = $user->row();
			$main_user = $referral_user->user_id;
			$ref_user  = $referral_user->referral_user_id;
			
			$this->db->select('COUNT(*) as main_user');
			$this->db->where('user_id',$main_user);
			$query = $this->db->get('account');
			$main_user_count = $query->row();

			$this->db->select('COUNT(*) as ref_user');
			$this->db->where('user_id',$ref_user);
			$query = $this->db->get('account');
			$ref_user_count = $query->row();
			$ref_amount = (10 / 100) * $amount;
			
			if($ref_user_count->ref_user > 0){	
				$this->db->select('COUNT(*) as refered');
				$this->db->where('referral_user_id',$ref_user);
				$query = $this->db->get('referral_tbl');
				$main_user_count = $query->row();
				
				if($main_user_count->refered == 1){
					$this->db->select('*');
					$this->db->where('user_id',$ref_user);
					$user = $this->db->get('referral_tbl');
					$referral_user_count = $user->result();
					foreach ($referral_user_count as $data) {
						$this->db->select('*');
						$this->db->where('user_id',$data->referral_user_id);
						$query = $this->db->get('account');
						$data = $query->result();
						$last_data = end($data);
						$data = array(
							'user_id' => $last_data->user_id,
							'income' => $last_data->income + $ref_amount,
							'credit_debit' => $ref_amount,
							'code' => 'c'
						);
						$this->db->insert('account',$data);
					}
				}
				if($main_user_count->refered == 2){
					$ref_amount = (5 / 100) * $amount;
					$this->db->select('*');
					$this->db->where('user_id',$ref_user);
					$user = $this->db->get('referral_tbl');
					$referral_user_count = $user->result();
					foreach ($referral_user_count as $data) {
						$this->db->select('*');
						$this->db->where('user_id',$data->referral_user_id);
						$query = $this->db->get('account');
						$data = $query->result();
						$last_data = end($data);
						$data = array(
							'user_id' => $last_data->user_id,
							'income' => $last_data->income + $ref_amount,
							'credit_debit' => $ref_amount,
							'code' => 'c'
						);
						$this->db->insert('account',$data);
					}
				}
				if($main_user_count->refered == 3){
					$ref_amount = (1 / 100) * $amount;
					$this->db->select('*');
					$this->db->where('user_id',$ref_user);
					$user = $this->db->get('referral_tbl');
					$referral_user_count = $user->result();
					foreach ($referral_user_count as $data) {
						$this->db->select('*');
						$this->db->where('user_id',$data->referral_user_id);
						$query = $this->db->get('account');
						$data = $query->result();
						$last_data = end($data);
						$data = array(
							'user_id' => $last_data->user_id,
							'income' => $last_data->income + $ref_amount,
							'credit_debit' => $ref_amount,
							'code' => 'c'
						);
						$this->db->insert('account',$data);
					}
				}
				$ref_amount = (10 / 100) * $amount;
				$this->db->select('*');
				$this->db->where('user_id',$ref_user);
				$query = $this->db->get('account');
				$data = $query->result();
				$last_data = end($data);
				$data = array(
					'user_id' => $last_data->user_id,
					'income' => $last_data->income + $ref_amount,
					'credit_debit' => $ref_amount,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}
			if($main_user){	
				$this->db->select('*');
				$this->db->where('user_id',$main_user);
				$query = $this->db->get('account');
				$data = $query->row();
				if($main_user_count->main_user > 0){
					$main_user_amt = $data->income + ($amount - $ref_amount);
					$data = array(
						'user_id' => $data->user_id,
						'income' => $main_user_amt,
						'credit_debit' => $main_user_amt,
						'code' => 'c'
					);
				}else{
					$data = array(
						'user_id' => $main_user,
						'income' => $amount - $ref_amount,
						'credit_debit' => $amount - $ref_amount,
						'code' => 'c'
					);
				}
				$this->db->insert('account',$data);
			}
			return true;
		}
	}
?>