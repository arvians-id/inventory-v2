<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?= $this->uri->segment(2) == 'create' ? 'Tambah' : 'Ubah' ?> Barang Masuk </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $this->uri->segment(2) == 'create' ? 'Create' : 'Update' ?> Barang Masuk</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample" method="POST">
						<div class="form-group">
							<label>Kode Transaksi Barang Masuk</label>
							<input type="text" class="form-control <?= form_error('kode_masuk') ? 'is-invalid' : '' ?>" name="kode_masuk" value="<?= $kode_masuk ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Masuk</label>
							<input type="date" class="form-control <?= form_error('tanggal_masuk') ? 'is-invalid' : '' ?>" name="tanggal_masuk" value="<?= set_value('tanggal_masuk') ?>">
							<div class="invalid-feedback"><?= form_error('tanggal_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Barang</label>
							<select class="form-control <?= form_error('kode_barang') ? 'is-invalid' : '' ?>" name="kode_barang">
								<option value="" disabled selected>Pilih Barang</option>
								<?php foreach ($data_barang as $barang) : ?>
									<option value="<?= $barang['kode'] ?>" data-stok="<?= $barang['stok'] ?>" <?= set_value('kode_barang') != $barang['kode'] ?: 'selected' ?>><?= $barang['nama_barang'] . ' &mdash; ' . $barang['kode'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('kode_barang') ?></div>
						</div>
						<div class="form-group">
							<label>Penerima</label>
							<select class="form-control <?= form_error('penerima_id') ? 'is-invalid' : '' ?>" name="penerima_id">
								<option value="" disabled selected>Pilih Penerima</option>
								<?php foreach ($data_penerima as $penerima) : ?>
									<option value="<?= $penerima['id_penerima'] ?>" <?= set_value('penerima_id') != $penerima['id_penerima'] ?: 'selected' ?>><?= $penerima['nama_penerima'] . ' &mdash; ' . $penerima['jenis_penerima'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('penerima_id') ?></div>
						</div>
						<div class="form-group">
							<label>Stok Awal</label>
							<input type="number" class="form-control <?= form_error('stok_awal') ? 'is-invalid' : '' ?>" name="stok_awal" value="<?= set_value('stok_awal') ?>" readonly>
							<div class="invalid-feedback"><?= form_error('stok_awal') ?></div>
						</div>
						<div class="form-group">
							<label>Jumlah Masuk</label>
							<input type="text" class="form-control <?= form_error('jumlah_masuk') ? 'is-invalid' : '' ?>" name="jumlah_masuk" value="<?= set_value('jumlah_masuk') ?>" min="0" autocomplete="off" <?= set_value('kode_barang') ?: 'readonly' ?>>
							<div class="invalid-feedback"><?= form_error('jumlah_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Total Stok Barang</label>
							<input type="number" class="form-control <?= form_error('stok') ? 'is-invalid' : '' ?>" name="stok" value="<?= set_value('stok') ?>" readonly>
							<div class="invalid-feedback"><?= form_error('stok') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya (Optional)</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= set_value('keterangan') ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(function() {
		$('[name="kode_barang"]').on('change', function() {
			let dataStok = $(this).find(':selected').data('stok');
			let jmlMasuk = $('[name="jumlah_masuk"]');

			if (jmlMasuk.val() == '') {
				$('[name="stok_awal"]').val(dataStok);
				$('[name="stok"]').val(dataStok);
			} else {
				$('[name="stok_awal"]').val(dataStok);
				dataStok = dataStok + parseInt(jmlMasuk.val());
				$('[name="stok"]').val(dataStok).trigger('change');
			}

			jmlMasuk.removeAttr('readonly')
		})
		$('[name="jumlah_masuk"]').on('keyup', function() {
			let jmlMasuk = parseInt($(this).val());
			let stokAwal = parseInt($('[name="stok_awal"]').val());
			let totalStok = $('[name="stok"]');

			if ($(this).val() == '') {
				totalStok.val(stokAwal);
			} else {
				stokAwal += jmlMasuk;
				totalStok.val(stokAwal);
			}
		})
	})
</script>
