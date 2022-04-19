<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
	}
	public function index()
	{
		if($this->isUserLoggedIn){
			redirect('dashboard/account');
		}else{
			redirect('user/registerUser');
		}
	}

	public function registerUser()
	{
		$data = $insert_user = array();
		
		if($this->input->post('register')){
			$this->form_validation->set_rules('fname','First Name','required');
			$this->form_validation->set_rules('lname','Last Name','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
			$insert_user = array(
				'fname' => $this->input->post('fname',true),
				'lname' => $this->input->post('lname',true),
				'email' => $this->input->post('email',true),
				'password' => $this->input->post('password',true),
				'user_referral_code' => $this->input->post('user_referral_code',true),
			);
			$referral_code = $this->input->post('ref_code',true);
			if($this->form_validation->run() == true){
				$user_id = $this->user_model->register_user($insert_user);
				if($user_id){
					$ref_user = $this->user_model->ref_user($user_id,$referral_code);
					if($ref_user){
						$this->user_model->add_amount($ref_user);
					}
					$this->session->set_userdata('success_msg','User register successfully.');
					redirect('user/loginUser');
				}else{
					$data['error_msg'] = 'Please try again!';
				}
			}else{
				$data['error_msg'] = 'Please fill required filed';
			}
		}
		
		$data['userData'] = $insert_user;
		$this->load->view('common/header');
		$this->load->view('user/register',$data);
		$this->load->view('common/footer');
		
	}

	public function loginUser()
	{
		$data = array();
		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}

		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$thsi->session->unset_userdata('error_msg');
		}

		if($this->input->post('login')){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run() == true){
				$login_user = array(
					'email' => $this->input->post('email',true),
					'password' => $this->input->post('password',true)
				);
				$user_id = $this->user_model->login_user($login_user);
				if($user_id){
					$this->session->set_userdata('isUserLoggedIn',TRUE);
					$this->session->set_userdata('userId',$user_id->id);
					if($user_id->fname == 'admin'){
						redirect('dashboard/admin');
					}else{
						redirect('dashboard/account');
					}
					
				}else{
					$data['error_msg'] = 'wrong email';
				}
			}else{
				$data['error_msg'] = 'all filed required';
			}
			
		}
		
		$this->load->view('common/header');
		$this->load->view('user/login',$data);
		$this->load->view('common/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('isUserLoggedIn');
		$this->session->unset_userdata('userId');
		$this->session->sess_destroy();
		$this->load->view('common/header');
		$this->load->view('user/login');
		$this->load->view('common/footer');
	}
}
