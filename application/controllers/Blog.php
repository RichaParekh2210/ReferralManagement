z<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/*public function __construct(){
		parent::__construct();
		$this->load->model('blog_model');
	}
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('blog/blog_list');
		$this->load->view('common/footer');
	}

	public function blogList(){
		$blogData = $this->blog_model->list_blog();
		$blogDetails = array(
			'blogs' => $blogData
		);
		$this->load->view('common/header');
		$this->load->view('blog/blog_list',$blogDetails);
		$this->load->view('common/footer');
	}

	public function blogForm(){
		$this->load->view('common/header');
		$this->load->view('blog/add_blog');
		$this->load->view('common/footer');
	}

	public function addBlog(){
		if($this->input->post('add_blog')){
			if(!empty($_FILES['blog_img']['name'])){
				$config['upload_path'] = 'assets/uploads/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '100';
				$config['file_name'] = $_FILES['blog_img']['name'];

				$this->load->library('upload',$config);

				if($this->upload->do_upload('blog_img')){
					$uploadImage = $this->upload->data();
					$image_name = $uploadImage['file_name'];
				}else{
					$image_name = '';
					$data['upload_error'] = 'Failed to upload file';
					$this->session->set_flashdata('upload_image_error','Error occured while upload image! Please try again.');
				}
			}else{
				$image_name = '';
				$data['upload_error'] = 'Failed to upload file';
				$this->session->set_flashdata('upload_image_error','Error occured while upload image! Please try again.');
			}
			if($image_name != ''){
				$blog_detail = array(
					'title' => $this->input->post('title',true),
					'description' => $this->input->post('desc',true),
					'image' => $image_name,
				);
				$tag_name = $this->input->post('tags',true);
				$blogData = $this->blog_model->add_blog($blog_detail,$tag_name);
			}
			if (isset($blogData)) {
				$this->load->view('common/header');
				redirect('blog/blogList');
				$this->load->view('common/footer');
			}
		}
		$this->load->view('common/header');
		$this->load->view('blog/add_blog');
		$this->load->view('common/footer');
	}

	public function editForm($id){
		$result = $this->blog_model->blog_by_id($id);
		$blog_data = array(
			'blogDetails' => $result
		);
		$this->load->view('common/header');
		$this->load->view('blog/edit_blog',$blog_data);
		$this->load->view('common/footer');
	}
	public function editBlog(){
		if($this->input->post('edit_blog')){
			if(!empty($_FILES['blog_img']['name'])){
				$config['upload_path'] = 'assets/uploads/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '100';
				$config['file_name'] = $_FILES['blog_img']['name'];

				$this->load->library('upload',$config);

				if($this->upload->do_upload('blog_img')){
					$uploadImage = $this->upload->data();
					$image_name = $uploadImage['file_name'];
				}else{
					$image_name = '';
					$data['upload_error'] = 'Failed to upload file';
					$this->session->set_flashdata('upload_image_error','Error occured while upload image! Please try again.');
				}
			}else{
				$image_name = '';
				$data['upload_error'] = 'Failed to upload file';
				$this->session->set_flashdata('upload_image_error','Error occured while upload image! Please try again.');
			}
			if($image_name != ''){
				$blog_detail = array(
					'title' => $this->input->post('title',true),
					'description' => $this->input->post('desc',true),
					'image' => $image_name,
				);
				$tags = array(
					'tag_name' => $this->input->post('tags',true)
				);
				$blog_id = $this->input->post('blog_id');
				$blogData = $this->blog_model->edit_blog($blog_detail,$tags,$blog_id);
			}
			if ($blogData) {
				$this->load->view('common/header');
				redirect('blog/blogList');
				$this->load->view('common/footer');
			}
		}
		$this->load->view('common/header');
		$this->load->view('blog/edit_blog');
		$this->load->view('common/footer');
	}
	public function deleteBlog($id){
		$result = $this->blog_model->delete_blog($id);
		redirect('blog/blogList');
	}*/
}
