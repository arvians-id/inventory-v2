<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel');
		is_logged_not_in();
	}
	public function index()
	{
		$this->form_validation->set_rules('awal', 'Awal', 'required');
		$this->form_validation->set_rules('akhir', 'Akhir', 'required');
		$this->form_validation->set_rules('laporan', 'Laporan', 'required');
		$this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Admin Page | Laporan',
				'view' => 'admin/contents/laporan',
			];
			$this->load->view('admin/layouts/app', $data);
		} else {
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');
			$tabel = $this->input->post('laporan');
			$jenis_laporan = $this->input->post('jenis_laporan');

			$laporan = $this->BarangModel->laporan($awal, $akhir, $tabel);

			if ($jenis_laporan == 'print') {
				return $this->_print($laporan, $tabel);
			} else {
				if ($tabel == 'barang') {
					return $this->_barang($laporan);
				} elseif ($tabel == 'barang_masuk') {
					return $this->_barang_masuk($laporan);
				} elseif ($tabel == 'barang_keluar') {
					return $this->_barang_keluar($laporan);
				}
			}
		}
	}
	private function _print($laporan, $tabel)
	{
		$data = [
			'title' => 'Admin Page | Print',
			'data_laporan' => $laporan,
		];
		if ($tabel == 'barang') {
			$this->load->view('admin/contents/print-out/print-barang', $data);
		} elseif ($tabel == 'barang_masuk') {
			$this->load->view('admin/contents/print-out/print-barang-masuk', $data);
		} elseif ($tabel == 'barang_keluar') {
			$this->load->view('admin/contents/print-out/print-barang-keluar', $data);
		}
	}
	private function _barang($laporan)
	{
		$excel = new Spreadsheet();
		$excel->getProperties()->setCreator('Dendi Nuryadi');
		$excel->getProperties()->setLastModifiedBy('Dendi Nuryadi');
		$excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Kode Barang')
			->setCellValue('C1', 'Nama Barang')
			->setCellValue('D1', 'Tempat Barang')
			->setCellValue('E1', 'Spesifikasi')
			->setCellValue('F1', 'Stok')
			->setCellValue('G1', 'Keterangan')
			->setCellValue('H1', 'Tanggal Di Input')
			->setCellValue('I1', 'Terakhir Di Ubah');
		$column = 2;
		$no = 1;
		if (!empty($laporan)) {
			if (is_array($laporan)) {
				foreach ($laporan as $lap) {
					$excel->setActiveSheetIndex(0)
						->setCellValue('A' . $column, $no++)
						->setCellValue('B' . $column, $lap['kode'])
						->setCellValue('C' . $column, $lap['nama_barang'])
						->setCellValue('D' . $column, $lap['tempat_barang'])
						->setCellValue('E' . $column, $lap['spesifikasi'])
						->setCellValue('F' . $column, $lap['stok'])
						->setCellValue('G' . $column, $lap['keterangan'])
						->setCellValue('H' . $column, $lap['tanggal_input'])
						->setCellValue('I' . $column, $lap['terakhir_diubah']);
					$column++;
				}
			}
			$writer = new Xlsx($excel);
			$fileName = bin2hex(random_bytes(12));

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
			exit;
		} else {
			$this->session->set_flashdata('error', 'Tidak ada data ditemukan.');
			redirect('laporan');
		}
	}
	private function _barang_masuk($laporan)
	{
		$excel = new Spreadsheet();
		$excel->getProperties()->setCreator('Dendi Nuryadi');
		$excel->getProperties()->setLastModifiedBy('Dendi Nuryadi');
		$excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Kode Transaksi Barang Masuk')
			->setCellValue('C1', 'Nama Barang')
			->setCellValue('D1', 'Nama Penerima')
			->setCellValue('E1', 'Jumlah Masuk')
			->setCellValue('F1', 'Tanggal Masuk')
			->setCellValue('G1', 'Keterangan')
			->setCellValue('H1', 'Tanggal Di Input');
		$column = 2;
		$no = 1;
		if (!empty($laporan)) {
			if (is_array($laporan)) {
				foreach ($laporan as $lap) {
					$excel->setActiveSheetIndex(0)
						->setCellValue('A' . $column, $no++)
						->setCellValue('B' . $column, $lap['kode_masuk'])
						->setCellValue('C' . $column, $lap['nama_barang'] . ' - ' . $lap['kode_barang'])
						->setCellValue('D' . $column, $lap['nama_penerima'] . ' - ' . $lap['jenis_penerima'])
						->setCellValue('E' . $column, $lap['jumlah_masuk'])
						->setCellValue('F' . $column, $lap['tanggal_masuk'])
						->setCellValue('G' . $column, $lap['keterangan_masuk'])
						->setCellValue('H' . $column, $lap['tanggal_input']);
					$column++;
				}
			}
			$writer = new Xlsx($excel);
			$fileName = bin2hex(random_bytes(12));

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
			exit;
		} else {
			$this->session->set_flashdata('error', 'Tidak ada data ditemukan.');
			redirect('laporan');
		}
	}
	private function _barang_keluar($laporan)
	{
		$excel = new Spreadsheet();
		$excel->getProperties()->setCreator('Dendi Nuryadi');
		$excel->getProperties()->setLastModifiedBy('Dendi Nuryadi');
		$excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Kode Transaksi Barang Keluar')
			->setCellValue('C1', 'Nama Barang')
			->setCellValue('D1', 'Jumlah Keluar')
			->setCellValue('E1', 'Tanggal Keluar')
			->setCellValue('F1', 'Keterangan')
			->setCellValue('G1', 'Tanggal Di Input');
		$column = 2;
		$no = 1;
		if (!empty($laporan)) {
			if (is_array($laporan)) {
				foreach ($laporan as $lap) {
					$excel->setActiveSheetIndex(0)
						->setCellValue('A' . $column, $no++)
						->setCellValue('B' . $column, $lap['kode_keluar'])
						->setCellValue('C' . $column, $lap['nama_barang'] . ' - ' . $lap['kode_barang'])
						->setCellValue('D' . $column, $lap['jumlah_keluar'])
						->setCellValue('E' . $column, $lap['tanggal_keluar'])
						->setCellValue('F' . $column, $lap['keterangan_keluar'])
						->setCellValue('G' . $column, $lap['tanggal_input']);
					$column++;
				}
			}
			$writer = new Xlsx($excel);
			$fileName = bin2hex(random_bytes(12));

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
			header('Cache-Control: max-age=0');

			$writer->save('php://output');
			exit;
		} else {
			$this->session->set_flashdata('error', 'Tidak ada data ditemukan.');
			redirect('laporan');
		}
	}
}
