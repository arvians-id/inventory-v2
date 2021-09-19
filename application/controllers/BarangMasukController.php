<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasukController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel');
		$this->load->model('BarangMasukModel');
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Barang Masuk',
			'view' => 'admin/contents/barang-masuk',
			'data_barang_masuk' => $this->BarangMasukModel->getBarangMasuk()->result_array()
		];
		$this->load->view('admin/layouts/app', $data);
	}
	public function create()
	{
		$this->form_validation->set_rules('kode_masuk', 'Kode Transaksi', 'required|trim|is_unique[barang_masuk.kode_masuk]');
		$this->form_validation->set_rules('kode_barang', 'Barang', 'required');
		$this->form_validation->set_rules('penerima_id', 'Penerima', 'required');
		$this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|numeric');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		if ($this->form_validation->run() == FALSE) {
			$kode = $this->BarangMasukModel->getKodeBarangMasuk();
			$getKode = (int) substr($kode['kode_masuk'], -3);
			$getKode++;

			$kode_masuk = 'ID-BM-' . date('Y') . sprintf('%03s', $getKode);
			$data = [
				'title' => 'Admin Page | Create Barang Masuk',
				'view' => 'admin/contents/barang-masuk-create',
				'data_barang' => $this->BarangModel->getBarang()->result_array(),
				'data_penerima' => $this->db->get('penerima')->result_array(),
				'kode_masuk' => $kode_masuk
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$this->BarangMasukModel->insertBarangMasuk();
			$this->session->set_flashdata('success', 'Data berhasil dibuat.');
			redirect('barang-masuk');
		}
	}
	public function update($kode_masuk)
	{
		$this->form_validation->set_rules('penerima_id', 'Penerima', 'required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Update Barang Masuk',
				'view' => 'admin/contents/barang-masuk-update',
				'barang_masuk' => $this->BarangMasukModel->getBarangMasuk($kode_masuk)->row_array(),
				'data_barang' => $this->db->get('barang')->result_array(),
				'data_penerima' => $this->db->get('penerima')->result_array(),
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$barang_masuk = $this->db->get_where('barang_masuk', ['kode_masuk' => $kode_masuk])->row_array();
			$barang = $this->BarangModel->getBarang($barang_masuk['kode_barang'])->row_array();
			if (($barang_masuk['jumlah_masuk'] - $this->input->post('jumlah_masuk')) > $barang['stok']) {
				$this->session->set_flashdata('error', 'Data gagal diubah! dikarenakan stok akan minus apabila jumlah masuk kurang dari ' . ($barang_masuk['jumlah_masuk'] - $barang['stok']));
				redirect('barang-masuk/update/' . $kode_masuk);
			} else {
				$this->BarangMasukModel->updateBarangMasuk($kode_masuk);
				$this->session->set_flashdata('success', 'Data berhasil diubah.');
				redirect('barang-masuk');
			}
		}
	}

	public function delete($kode_masuk)
	{
		$barang_masuk = $this->db->get_where('barang_masuk', ['kode_masuk' => $kode_masuk])->row_array();
		$barang = $this->BarangModel->getBarang($barang_masuk['kode_barang'])->row_array();
		if (($barang['stok'] - $barang_masuk['jumlah_masuk']) < 0) {
			$this->session->set_flashdata('error', 'Data gagal dihapus! dikarenakan stok akan minus apabila data ini dihapus');
			redirect('barang-masuk');
		} else {
			$this->BarangMasukModel->deleteBarangMasuk($kode_masuk);
			$this->session->set_flashdata('success', 'Data berhasil dihapus, stok barang berubah.');
			redirect('barang-masuk');
		}
	}
}
