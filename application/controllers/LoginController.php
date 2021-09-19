<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
	public function index()
	{
		is_logged_in();

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login', ['title' => 'Login Page']);
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cekUser = $this->db->get_where('users', ['username' => $username, 'password' => md5($password)])->row_array();
			if ($cekUser) {
				$setSession = [
					'id' => $cekUser['id'],
					'username' => $cekUser['username'],
					'photo' => $cekUser['photo']
				];
				$this->session->set_userdata($setSession);
				redirect('home');
			}
			$this->session->set_flashdata('error', 'Username atau password salah!');
			redirect(base_url());
		}
	}
	public function logout()
	{
		$data = ['id', 'username'];
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('success', 'Anda berhasil keluar.');
		redirect('login');
	}
}
