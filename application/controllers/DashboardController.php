<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_not_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Admin Page | Home',
			'view' => 'admin/contents/index',
			'data_barang' => $this->db->get('barang')->num_rows(),
			'transaksi_masuk' => $this->db->get('barang_masuk')->num_rows(),
			'transaksi_keluar' => $this->db->get('barang_keluar')->num_rows()
		];
		$this->load->view('admin/layouts/app', $data);
	}
}
