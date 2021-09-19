<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenerimaController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Penerima',
			'view' => 'admin/contents/penerima',
			'data_penerima' => $this->db->get('penerima')->result_array()
		];
		$this->load->view('admin/layouts/app', $data);
	}
	public function create()
	{
		$this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required|max_length[50]');
		$this->form_validation->set_rules('jenis_penerima', 'Jenis Penerima', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Create Penerima',
				'view' => 'admin/contents/penerima-create',
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$data = [
				'nama_penerima' => $this->input->post('nama_penerima'),
				'jenis_penerima' => $this->input->post('jenis_penerima'),
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->insert('penerima', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.');
			redirect('penerima');
		}
	}
	public function update($id_penerima)
	{
		$this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required|max_length[50]');
		$this->form_validation->set_rules('jenis_penerima', 'Jenis Penerima', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Update Penerima',
				'view' => 'admin/contents/penerima-create',
				'data_penerima' => $this->db->get_where('penerima', ['id_penerima' => $id_penerima])->row_array(),
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$data = [
				'nama_penerima' => $this->input->post('nama_penerima'),
				'jenis_penerima' => $this->input->post('jenis_penerima'),
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->update('penerima', $data, ['id_penerima' => $id_penerima]);
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect('penerima');
		}
	}
	public function delete($id_penerima)
	{
		$this->db->delete('penerima', ['id_penerima' => $id_penerima]);
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect('penerima');
	}
}
