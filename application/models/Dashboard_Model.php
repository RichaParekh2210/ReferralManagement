<?php
	/**
	 * Dashboard model
	 */
	class Dashboard_Model extends CI_Model
	{
		
		public function __construct(){
			parent::__construct();
		}

		public function insert_income($amount,$user_id){
			$data = array(
				'user_id' => $user_id,
				'income' => $amount,
				'credit_debit' => $amount,
				'code' => 'c'
			);
			$this->db->insert('account',$data);
			return true;
		}
		public function get_data($user_id){
			$this->db->select('*');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get('account');
			if($query->result()){
				return $query->result();
			}else{
				return false;
			}
		}
		public function debit($amount,$data=array()){
			$this->db->insert('account',$data);
			return true;
		}
		public function total_withdraw($id){
			$this->db->select('SUM(credit_debit) AS total_debit');
			$this->db->where('user_id',$id);
			$this->db->where('code','d');
			$query = $this->db->get('account');
			if($query->row()){
				return $query->row();
			}else{
				return false;
			}
		}
		public function total_credit($id){
			$this->db->select('SUM(credit_debit) AS total_credit');
			$this->db->where('user_id',$id);
			$this->db->where('code','c');
			$query = $this->db->get('account');
			if($query->row()){
				return $query->row();
			}else{
				return false;
			}
		}
		public function get_users(){
			$this->db->select('*');
			$this->db->where('fname!=','admin');
			$user = $this->db->get('user');
			return $user->result();
		}
		public function total_users(){
			$this->db->select('COUNT(id) as total_users');
			$this->db->where('fname!=','admin');
			$user = $this->db->get('user');
			return $user->row();
		}
		public function total_users_credit(){
			$this->db->select('SUM(credit_debit) AS total_credits');
			$this->db->where('code','c');
			$query = $this->db->get('account');
			if($query->row()){
				return $query->row();
			}else{
				return false;
			}
		}
		public function total_users_withdraws(){
			$this->db->select('SUM(credit_debit) AS total_debits');
			$this->db->where('code','d');
			$query = $this->db->get('account');
			if($query->row()){
				return $query->row();
			}else{
				return false;
			}
		}
	}
?>