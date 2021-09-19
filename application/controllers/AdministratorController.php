<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdministratorController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Administrator',
			'view' => 'admin/contents/administrator',
			'users' => $this->db->get('users')->result_array()
		];
		$this->load->view('admin/layouts/app', $data);
	}
	public function create()
	{
		$this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Create Administrator',
				'view' => 'admin/contents/administrator-create',
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$photo = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path']          = './assets/image';
				$config['allowed_types']        = 'jpg|png|jpeg';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$photo = $this->upload->data('file_name', 'photo');
				}
			}
			$data = [
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'photo' => $photo ?: 'default.png',
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->insert('users', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.');
			redirect('administrator');
		}
	}
	public function delete($id)
	{
		$user =  $this->db->get_where('users', ['id' => $id])->row_array();
		if ($user['photo'] != 'default.png') {
			unlink(FCPATH . 'assets/image/' .  $user['photo']);
		}
		$this->db->delete('users', ['id' => $id]);
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect('administrator');
	}
}
