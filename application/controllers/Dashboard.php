<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('user_model');
		if ($this->session->has_userdata('userId')) {
	       $this->user_id = $this->session->userdata('userId');   
	    } else {
	       redirect('login');    
	    }
	}
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('dashboard/account');
		$this->load->view('common/footer');
	}
	public function account()
	{
		$data = array();
		$data['title'] = 'Dashboard';
		$data['user_data'] = $this->user_model->get_user($this->user_id);
		$result = $this->dashboard_model->get_data($this->user_id);
		if($result){
			foreach ($result as $value) {
				$data['userData'][] = array(
					'id' => $value->user_id,
					'income' => $value->income,
					'credit_debit' => $value->credit_debit,
					'code' => $value->code,
				);
			}
		}
		$data['total_debit'] = $this->dashboard_model->total_withdraw($this->user_id);
		$data['total_credit'] = $this->dashboard_model->total_credit($this->user_id);
		$this->load->view('common/header');
		$this->load->view('dashboard/account',$data);
		$this->load->view('common/footer');
	}
	public function add_income()
	{
		if($this->input->post('income_btn')){
			$income_amount = $this->input->post('income');
			$u_id = $this->user_id;
			$result = $this->dashboard_model->insert_income($income_amount,$u_id);
			if($result){
				redirect('dashboard/account');
			}
		}
		$this->load->view('common/header');
		$this->load->view('dashboard/add_income');
		$this->load->view('common/footer');
	}
	public function debit()
	{
		if($this->input->post('debit_btn')){
			$debit_amount = $this->input->post('debit_amount');
			$result = $this->dashboard_model->get_data($this->user_id);
			$last_data = end($result);
			$new_income = $last_data->income - $debit_amount;
			$data = array(
				'user_id' => $last_data->user_id,
				'income' => $new_income,
				'credit_debit ' => $debit_amount,
				'code' => 'd'
			);
			$result = $this->dashboard_model->debit($debit_amount,$data);
			if($result){
				redirect('dashboard/account');
			}
		}
		$this->load->view('common/header');
		$this->load->view('dashboard/withdraw_amount');
		$this->load->view('common/footer');
	}

	public function admin(){
		$data = array();
		$data['title'] = 'Admin Dashboard';
		$data['users'] = $this->dashboard_model->get_users();
		$data['total_users'] = $this->dashboard_model->total_users();
		$data['total_debit'] = $this->dashboard_model->total_users_withdraws();
		$data['total_credit'] = $this->dashboard_model->total_users_credit();
		$this->load->view('common/header');
		$this->load->view('dashboard/admin',$data);
		$this->load->view('common/footer');
	}

	public function view($id){
		$data = array();
		$data['title'] = 'User detail';
		$data['user'] = $this->dashboard_model->get_data($id);
		$data['total_debit'] = $this->dashboard_model->total_withdraw($id);
		$data['total_credit'] = $this->dashboard_model->total_credit($id);
		$this->load->view('common/header');
		$this->load->view('dashboard/user_detail',$data);
		$this->load->view('common/footer');
	}
}
