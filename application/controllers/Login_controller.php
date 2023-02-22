<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model');
		$this->login = new Login_model;
	}

	public function login()
	{
		if ($this->session->has_userdata('user_id') != '') {

			redirect(base_url() . 'crud_demo/dashboard');
		}

		$this->form_validation->set_rules("email", "EMAIL", "required|valid_email", array(

			"required" => "email field is required",
			"valid_email" => "valid email is required"

		));
		$this->form_validation->set_rules("password", "password", "required|min_length[8]", array(

			"required" => "password is required",
			"min_length" => "minimum 8 length is required",

		));

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('crud/login');
		} else {

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$session = $this->login->login_user($email, $password);

			if ($session == true) {

				$this->session->set_flashdata('success', '<div class="alert alert-success text-center"><b>You are successfully login..</b></div>');
				redirect(base_url() . 'crud_demo/dashboard');
			} else {

				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Email or Password is Invalid!</div>');
				$this->load->view('crud/login');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		redirect(base_url() . 'crud_demo/login');
	}

	public function changePassword()
	{

		$this->form_validation->set_rules("old", "old password", "required");
		$this->form_validation->set_rules("new", "new password", "required|min_length[8]|regex_check");
		$this->form_validation->set_rules("confirm", "confirm password", "required|min_length[8]|matches[new]");

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('crud/changePass');
		} else {

			$user_id  = $this->session->userdata('user_id');
			$new =	$this->encryption->encrypt($this->input->post('new'));

			$old = 	$this->input->post('old');
			$old_pass = $this->login->get_password($user_id, $old);

			if ($old_pass == true) {

				$change = $this->login->change_password($user_id, $new);
				if ($change == true) {

					$this->session->set_flashdata('success', '<div class="alert alert-success text-center"><b>Password is successfully changed...</b></div>');
					redirect(base_url() . 'crud_demo/dashboard');

				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Old password is not match in your exist password.!</div>');
				$this->load->view('crud/changePass');
			}
		}
	}

}
