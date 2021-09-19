<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasukModel extends CI_Model
{
	public function getKodeBarangMasuk()
	{
		$this->db->select_max('kode_masuk');
		return $this->db->get('barang_masuk')->row_array();
	}
	public function getBarangMasuk($kode_masuk = null, $awal = null, $akhir = null)
	{
		$this->db->select('*, a.keterangan as keterangan_masuk, a.created_at as tanggal_input');
		$this->db->from('barang_masuk a');
		$this->db->join('barang b', 'a.kode_barang = b.kode_barang');
		$this->db->join('penerima c', 'a.penerima_id = c.id_penerima', 'left');
		if ($kode_masuk != null) {
			$this->db->where('a.kode_masuk', $kode_masuk);
		}
		if ($awal != null && $akhir != null) {
			$this->db->where("DATE(a.created_at) >=", $awal);
			$this->db->where("DATE(a.created_at) <=", $akhir);
		}
		$this->db->order_by('a.id_masuk', 'desc');
		return $this->db->get();
	}
	public function insertBarangMasuk()
	{
		$data_barangMasuk = [
			'kode_masuk' => $this->input->post('kode_masuk'),
			'penerima_id' => $this->input->post('penerima_id'),
			'kode_barang' => $this->input->post('kode_barang'),
			'jumlah_masuk' => $this->input->post('jumlah_masuk'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
		];
		$this->db->insert('barang_masuk', $data_barangMasuk);
	}
	public function updateBarangMasuk($kode_masuk)
	{
		$data_barang_masuk = [
			'penerima_id' => $this->input->post('penerima_id'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'jumlah_masuk' => $this->input->post('jumlah_masuk'),
			'keterangan' => $this->input->post('keterangan'),
		];
		// Update jumlah masuk
		$this->db->update('barang_masuk', $data_barang_masuk, ['kode_masuk' => $kode_masuk]);
	}
	public function deleteBarangMasuk($kode_masuk)
	{
		// Delete barang masuk
		$this->db->where('kode_masuk', $kode_masuk);
		$this->db->delete('barang_masuk');
	}
}
