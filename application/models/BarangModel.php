<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
	public function getKode()
	{
		$this->db->select_max('kode_barang');
		return $this->db->get('barang')->row_array();
	}
	public function getBarangKeluar($kode_keluar = null, $awal = null, $akhir = null)
	{
		$this->db->select('*, a.keterangan as keterangan_keluar, a.created_at as tanggal_input');
		$this->db->from('barang_keluar a');
		$this->db->join('barang b', 'a.kode_barang = b.kode_barang');
		if ($kode_keluar != null) {
			$this->db->where('kode_keluar', $kode_keluar);
		}
		if ($awal != null && $akhir != null) {
			$this->db->where("DATE(a.created_at) >=", $awal);
			$this->db->where("DATE(a.created_at) <=", $akhir);
		}
		$this->db->order_by('a.id_keluar', 'desc');
		return $this->db->get();
	}
	public function getBarangMasuk($kode_masuk = null, $awal = null, $akhir = null)
	{
		$this->db->select('*, a.keterangan as keterangan_masuk, a.created_at as tanggal_input');
		$this->db->from('barang_masuk a');
		$this->db->join('barang b', 'a.kode_barang = b.kode_barang');
		$this->db->join('penerima c', 'a.penerima_id = c.id_penerima');
		if ($kode_masuk != null) {
			$this->db->where('kode_masuk', $kode_masuk);
		}
		if ($awal != null && $akhir != null) {
			$this->db->where("DATE(a.created_at) >=", $awal);
			$this->db->where("DATE(a.created_at) <=", $akhir);
		}
		$this->db->order_by('a.id_masuk', 'desc');
		return $this->db->get();
	}
	public function laporan($awal, $akhir, $tabel)
	{
		if ($tabel == 'barang') {
			return $this->getBarangWithDate($awal, $akhir)->result_array();
		} elseif ($tabel == 'barang_masuk') {
			return $this->getBarangMasuk(null, $awal, $akhir)->result_array();
		} elseif ($tabel == 'barang_keluar') {
			return $this->getBarangKeluar(null, $awal, $akhir)->result_array();
		}
	}
	public function getBarang($kode_barang = null)
	{
		if ($kode_barang != null) {
			$kode_barang = "WHERE p.kode_barang = '$kode_barang'";
		}
		$sql = "SELECT *,p.kode_barang as kode, (COALESCE(SUM(masuk.total),0) - COALESCE(SUM(keluar.total),0)) as stok
				FROM barang p 
				LEFT JOIN (SELECT kode_masuk, kode_barang, SUM(jumlah_masuk) total 
						FROM		barang_masuk 
						GROUP BY 	kode_barang) masuk 
						ON			p.kode_barang = masuk.kode_barang 
				LEFT JOIN (SELECT kode_keluar, kode_barang, SUM(jumlah_keluar) total 
						FROM		barang_keluar 
						GROUP BY 	kode_barang) keluar 
						ON			p.kode_barang = keluar.kode_barang
				$kode_barang
		 		GROUP BY p.kode_barang
				ORDER BY p.id_barang DESC";
		return $this->db->query($sql);
	}
	public function getBarangWithDate($awal, $akhir)
	{
		$sql = "SELECT *,p.kode_barang as kode,p.created_at as tanggal_input,p.updated_at as terakhir_diubah,(COALESCE(SUM(masuk.total),0) - COALESCE(SUM(keluar.total),0)) as stok
				FROM barang p 
				LEFT JOIN (SELECT kode_masuk, kode_barang, SUM(jumlah_masuk) total 
						FROM		barang_masuk 
						GROUP BY 	kode_barang) masuk 
						ON			p.kode_barang = masuk.kode_barang 
				LEFT JOIN (SELECT kode_keluar, kode_barang, SUM(jumlah_keluar) total 
						FROM		barang_keluar 
						GROUP BY 	kode_barang) keluar 
						ON			p.kode_barang = keluar.kode_barang
				WHERE DATE(p.created_at) >= '$awal'
				AND DATE(p.created_at) <= '$akhir'
		 		GROUP BY p.kode_barang
				ORDER BY p.id_barang DESC";
		return $this->db->query($sql);
	}
}
