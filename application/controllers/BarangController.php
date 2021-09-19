<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel');
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Barang',
			'view' => 'admin/contents/barang',
			'data_barang' => $this->BarangModel->getBarang()->result_array()
		];
		$this->load->view('admin/layouts/app', $data);
	}
	public function create()
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|trim|is_unique[barang.kode_barang]');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('tempat_barang', 'Tempat Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('spesifikasi', 'Spesifikasi Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		if ($this->form_validation->run() == FALSE) {
			// Set Kode
			$kode = $this->BarangModel->getKode();
			$getKode = (int) substr($kode['kode_barang'], -3);
			$getKode++;
			// Passing data to view
			$data = [
				'title' => 'Admin Page | Create Barang',
				'view' => 'admin/contents/barang-create',
				'kode_barang' => 'BRG-' . date('Y') . sprintf('%03s', $getKode),
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			// Set Photo
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
				'kode_barang' => $this->input->post('kode_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'tempat_barang' => $this->input->post('tempat_barang'),
				'spesifikasi' => $this->input->post('spesifikasi'),
				'keterangan' => $this->input->post('keterangan'),
				'photo' => $photo ?: 'no-image.png',
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->insert('barang', $data);
			$this->session->set_flashdata('success', 'Data berhasil dibuat.');
			redirect('data-barang');
		}
	}
	public function update($id_barang)
	{
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('tempat_barang', 'Tempat Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('spesifikasi', 'Spesifikasi Barang', 'required|max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		$data_barang =  $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Update Barang',
				'view' => 'admin/contents/barang-create',
				'data_barang' => $data_barang,
				'kode_barang' => $data_barang['kode_barang']
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$photo = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path']          = './assets/image';
				$config['allowed_types']        = 'jpg|png|jpeg';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					if ($data_barang['photo'] != 'no-image.png') {
						unlink(FCPATH . 'assets/image/' .  $data_barang['photo']);
					}
					$photo = $this->upload->data('file_name', 'photo');
				}
			}
			$data = [
				'nama_barang' => $this->input->post('nama_barang'),
				'tempat_barang' => $this->input->post('tempat_barang'),
				'spesifikasi' => $this->input->post('spesifikasi'),
				'keterangan' => $this->input->post('keterangan'),
				'photo' => $photo ?: $data_barang['photo'],
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$this->db->update('barang', $data, ['id_barang' => $id_barang]);
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			redirect('data-barang');
		}
	}
	public function delete($id_barang)
	{
		$data_barang =  $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
		if ($data_barang['photo'] != 'no-image.png') {
			unlink(FCPATH . 'assets/image/' .  $data_barang['photo']);
		}
		$this->db->delete('barang', ['id_barang' => $id_barang]);
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect('data-barang');
	}
}
