<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluarController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel');
		$this->load->model('BarangKeluarModel');
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Barang Keluar',
			'view' => 'admin/contents/barang-keluar',
			'data_barang_keluar' => $this->BarangKeluarModel->getBarangKeluar()->result_array()
		];
		$this->load->view('admin/layouts/app', $data);
	}
	public function create()
	{
		$this->form_validation->set_rules('kode_keluar', 'Kode Transaksi', 'required|trim|is_unique[barang_keluar.kode_keluar]');
		$this->form_validation->set_rules('kode_barang', 'Barang', 'required');
		$this->form_validation->set_rules('jumlah_keluar', 'Jumlah Keluar', 'required|numeric');
		$this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');
		$this->form_validation->set_rules('stok', 'Total Stok', 'numeric|greater_than[-1]', ['greater_than' => 'Stok harus harus melebihi 0']);

		if ($this->form_validation->run() == FALSE) {
			$kode = $this->BarangKeluarModel->getKodeBarangKeluar();
			$getKode = (int) substr($kode['kode_keluar'], -3);
			$getKode++;

			$data = [
				'title' => 'Admin Page | Create Barang Keluar',
				'view' => 'admin/contents/barang-keluar-create',
				'data_barang' => $this->BarangModel->getBarang()->result_array(),
				'kode_keluar' => 'ID-BK-' . date('Y') . sprintf('%03s', $getKode)
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$this->BarangKeluarModel->insertBarangKeluar();
			$this->session->set_flashdata('success', 'Data berhasil dibuat.');
			redirect('barang-keluar');
		}
	}
	public function update($kode_keluar)
	{
		$this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		$barang_keluar = $this->BarangKeluarModel->getBarangKeluar($kode_keluar)->row_array();
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Update Barang Keluar',
				'view' => 'admin/contents/barang-keluar-update',
				'barang_keluar' => $barang_keluar,
				'barang' => $this->db->get_where('barang', ['kode_barang' => $barang_keluar['kode_barang']])->row_array(),
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$barang_keluar = $this->db->get_where('barang_keluar', ['kode_keluar' => $kode_keluar])->row_array();
			$barang = $this->BarangModel->getBarang($barang_keluar['kode_barang'])->row_array();
			if (($barang_keluar['jumlah_keluar'] - $this->input->post('jumlah_keluar') + $barang['stok']) < 0) {
				$this->session->set_flashdata('error', 'Data gagal diubah! dikarenakan stok akan minus apabila jumlah keluar lebih dari ' . ($barang_keluar['jumlah_keluar'] + $barang['stok']));
				redirect('barang-keluar/update/' . $kode_keluar);
			} else {
				$this->BarangKeluarModel->updateBarangKeluar($kode_keluar);
				$this->session->set_flashdata('success', 'Data berhasil diubah.');
				redirect('barang-keluar');
			}
		}
	}
	public function delete($kode_keluar)
	{
		$this->BarangKeluarModel->deleteBarangKeluar($kode_keluar);
		$this->session->set_flashdata('success', 'Data berhasil dihapus, stok barang berubah.');
		redirect('barang-keluar');
	}
}
