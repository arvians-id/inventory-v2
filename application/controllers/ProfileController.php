<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_not_in();
	}
	public function index()
	{
		$user = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();
		$unique_username = '';
		if ($user['username'] != $this->input->post('username')) {
			$unique_username = '|is_unique[users.username]';
		}
		$this->form_validation->set_rules('username', 'username', 'required' . $unique_username);
		$this->form_validation->set_rules('password', 'password', 'min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Update Profile',
				'view' => 'admin/contents/profile',
				'user' => $user
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$photo = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path']          = './assets/image';
				$config['allowed_types']        = 'jpg|png|jpeg';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					if ($user['photo'] != 'default.png') {
						unlink(FCPATH . 'assets/image/' .  $user['photo']);
					}
					$photo = $this->upload->data('file_name', 'photo');
				}
			}
			$data = [
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'photo' => $photo ?: $user['photo'],
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->update('users', $data, ['id' => $this->session->userdata('id')]);
			$this->session->set_flashdata('success', 'Data berhasil diubah. Silahkan logout, dan login kembali jika anda merubah photo');
			redirect('profile');
		}
	}
}
