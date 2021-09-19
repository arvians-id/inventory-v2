<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluarModel extends CI_Model
{
	public function getKodeBarangKeluar()
	{
		$this->db->select_max('kode_keluar');
		return $this->db->get('barang_keluar')->row_array();
	}
	public function getBarangKeluar($kode_keluar = null, $awal = null, $akhir = null)
	{
		$this->db->select('*, a.keterangan as keterangan_keluar, a.created_at as tanggal_input');
		$this->db->from('barang_keluar a');
		$this->db->join('barang b', 'a.kode_barang = b.kode_barang');
		if ($kode_keluar != null) {
			$this->db->where('a.kode_keluar', $kode_keluar);
		}
		if ($awal != null && $akhir != null) {
			$this->db->where("DATE(a.created_at) >=", $awal);
			$this->db->where("DATE(a.created_at) <=", $akhir);
		}
		$this->db->order_by('a.id_keluar', 'desc');
		return $this->db->get();
	}
	public function insertBarangKeluar()
	{
		$barang_masuk = [
			'kode_keluar' => $this->input->post('kode_keluar'),
			'kode_barang' => $this->input->post('kode_barang'),
			'jumlah_keluar' => $this->input->post('jumlah_keluar'),
			'tanggal_keluar' => $this->input->post('tanggal_keluar'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
		];
		$this->db->insert('barang_keluar', $barang_masuk);
	}
	public function updateBarangKeluar($kode_keluar)
	{
		$barang_keluar = [
			'tanggal_keluar' => $this->input->post('tanggal_keluar'),
			'jumlah_keluar' => $this->input->post('jumlah_keluar'),
			'keterangan' => $this->input->post('keterangan'),
		];
		$this->db->update('barang_keluar', $barang_keluar, ['kode_keluar' => $kode_keluar]);
	}
	public function deleteBarangKeluar($kode_keluar)
	{
		$this->db->where('kode_keluar', $kode_keluar);
		$this->db->delete('barang_keluar');
	}
}
