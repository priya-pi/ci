<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Register_model');
		$this->insertform_data = new Register_model;
	}

	public function index()
	{
		$this->load->view('crud/index');
	}

	public function registerForm()
	{

		$this->form_validation->set_rules("name", "name", "required|alpha_check");
		$this->form_validation->set_rules("email", "email", "required|valid_email|is_unique[user.email]");
		$this->form_validation->set_rules("pass", "password", "required|min_length[8]|Password_regex_check");
		$this->form_validation->set_rules("gender", "gender", "required");
		$this->form_validation->set_rules("hobby", "hobby", "callback_hobby_check");

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('crud/register');
		} else {

			$data = array(

				"name" => $this->input->post('name'),
				"email" => $this->input->post('email'),
				"password" => $this->encryption->encrypt($this->input->post('pass')),
				"gender" => $this->input->post('gender'),
				"interest" => $this->input->post('hobby')
			);

			$name = $data['name'];
			$email = $data['email'];
			$password = $data['password'];
			$gender = $data['gender'];
			$hobby = $data['interest'];

			$str = implode(',', $hobby);
			$json = json_encode($str);

			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('imagefile')) {

				$upload_error = array('error' => $this->upload->display_errors());
				$this->load->view('crud/register', $upload_error);
				
			} else {

				$uploadData = $this->upload->data();
				$image = $uploadData['file_name'];
				$data['image'] = $image;

				$response = $this->insertform_data->form_insert_data([

					"name" => $name,
					"email" => $email,
					"password" => $password,
					"gender" => $gender,
					"interest" => $json,
					"image" => $image
				]);

				if ($response) {
					$this->session->set_flashdata('success', '<div class="alert alert-success text-center">successfully Registered</div>');
					redirect(base_url('crud_demo/login'));
				}
			}
		}
	}

	function hobby_check() //register
	{
		$hobby = $this->input->post('hobby');

		if ($hobby == null || count($hobby) < 0) {

			$this->form_validation->set_message('hobby_check', 'checkbox must be cheked');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
