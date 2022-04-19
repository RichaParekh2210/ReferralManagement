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
			
			$level_2 = (5 / 100) * 500;
			$level_3 = (2 / 100) * 500;
			$where = array(
				'id ' => $id
			);
			$this->db->select('*');
			$this->db->where($where);
			$user = $this->db->get('referral_tbl');
			$referral_user = $user->row();
			$main_user = $referral_user->user_id;
			$ref_user  = $referral_user->referral_user_id;
			$account_detail = $this->get_account($ref_user);
			$count_ref = $this->count_ref($ref_user);
			
			if($count_ref->reference_count == 1){
				$result = $this->level_1($ref_user);
				$count_parent = $this->count_parent_ref($ref_user);
				foreach ($count_parent as $data) {
					$this->level_2($data->referral_user_id);
				}
			}elseif($count_ref->reference_count == 2){
				$result = $this->level_2($ref_user);
				$count_parent = $this->count_parent_ref($ref_user);
				if($count_parent){
					foreach ($count_parent as $data) {
						$this->level_3($data->referral_user_id);
					}
				}
			}elseif($count_ref->reference_count == 3){
				$result = $this->level_3($ref_user);
			}else{
				$this->level_1($ref_user);
			}
		}
		public function get_account($user_id){
			$this->db->select('*');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get('account');
			if($query->row()){
				return $query->row();
			}else{
				return false;
			}
		}
		public function count_ref($user_id){
			$this->db->select('COUNT(referral_user_id) as reference_count');
			$this->db->where('referral_user_id',$user_id);
			$user = $this->db->get('referral_tbl');
			if($user->row()){
				return $user->row();
			}else{
				return false;
			}
		}
		public function count_parent_ref($user_id){
			$this->db->select('*');
			$this->db->where('user_id',$user_id);
			$user = $this->db->get('referral_tbl');
			
			if($user->result()){
				foreach ($user->result() as $data) {
					$this->db->select('referral_user_id,COUNT(referral_user_id) as perent_ref_count');
					$this->db->where('referral_user_id',$data->referral_user_id);
					$this->db->group_by('referral_user_id');
					$this->db->having('COUNT(referral_user_id) > 0 && COUNT(referral_user_id) <= 3');
					$user = $this->db->get('referral_tbl');
					$parent_user_count = $user->result();
					return $parent_user_count;
				}
			}else{
				return false;
			}
		}
		public function level_1($id){
			$level_1 = (10 / 100) * 500;
			$account_detail = $this->get_account($id);

			if($account_detail){
				$data = array(
					'user_id' => $account_detail->user_id,
					'income' => $account_detail->income + $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}else{
				$data = array(
					'user_id' => $id,
					'income' => $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}
			return true;
		}
		public function level_2($id){
			$level_1 = (5 / 100) * 500;
			$account_detail = $this->get_account($id);

			if($account_detail){
				$data = array(
					'user_id' => $account_detail->user_id,
					'income' => $account_detail->income + $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}else{
				$data = array(
					'user_id' => $id,
					'income' => $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}
			return true;
		}
		public function level_3($id){
			$level_1 = (1 / 100) * 500;
			$account_detail = $this->get_account($id);

			if($account_detail){
				$data = array(
					'user_id' => $account_detail->user_id,
					'income' => $account_detail->income + $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}else{
				$data = array(
					'user_id' => $id,
					'income' => $level_1,
					'credit_debit' => $level_1,
					'code' => 'c'
				);
				$this->db->insert('account',$data);
			}
			return true;
		}
	}
?>