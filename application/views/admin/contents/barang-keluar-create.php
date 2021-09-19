<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?= $this->uri->segment(2) == 'create' ? 'Tambah' : 'Ubah' ?> Barang Keluar </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $this->uri->segment(2) == 'create' ? 'Create' : 'Update' ?> Barang Keluar</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample" method="POST">
						<div class="form-group">
							<label>Kode Transaksi Barang Keluar</label>
							<input type="text" class="form-control <?= form_error('kode_keluar') ? 'is-invalid' : '' ?>" name="kode_keluar" value="<?= $kode_keluar ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Keluar</label>
							<input type="date" class="form-control <?= form_error('tanggal_keluar') ? 'is-invalid' : '' ?>" name="tanggal_keluar" value="<?= set_value('tanggal_keluar') ?>">
							<div class="invalid-feedback"><?= form_error('tanggal_keluar') ?></div>
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
							<label>Stok Awal</label>
							<input type="number" class="form-control <?= form_error('stok_awal') ? 'is-invalid' : '' ?>" name="stok_awal" value="<?= set_value('stok_awal') ?>" readonly>
							<div class="invalid-feedback"><?= form_error('stok_awal') ?></div>
						</div>
						<div class="form-group">
							<label>Jumlah Keluar</label>
							<input type="text" class="form-control <?= form_error('jumlah_keluar') ? 'is-invalid' : '' ?>" name="jumlah_keluar" value="<?= set_value('jumlah_keluar') ?>" min="0" autocomplete="off" <?= set_value('kode_barang') ?: 'readonly' ?>>
							<div class="invalid-feedback"><?= form_error('jumlah_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Sisa Stok Barang</label>
							<input type="number" class="form-control <?= form_error('stok') ? 'is-invalid' : '' ?>" name="stok" value="<?= set_value('stok') ?>" readonly>
							<small class="text-danger" style="display: none;" id="show-alert">Total stok tidak bisa kurang dari 0</small>
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
			let jmlKeluar = $('[name="jumlah_keluar"]');

			if (jmlKeluar.val() == '') {
				$('[name="stok_awal"]').val(dataStok);
				$('[name="stok"]').val(dataStok);
			} else {
				$('[name="stok_awal"]').val(dataStok);
				dataStok -= parseInt(jmlKeluar.val());
				$('[name="stok"]').val(dataStok).trigger('change');
				dataStok >= 0 ? $('#show-alert').hide() : $('#show-alert').show();
			}

			jmlKeluar.removeAttr('readonly')
		})
		$('[name="jumlah_keluar"]').on('keyup', function() {
			let jmlKeluar = parseInt($(this).val());
			let stokAwal = parseInt($('[name="stok_awal"]').val());

			if ($(this).val() == '') {
				$('[name="stok"]').val(stokAwal);
			} else {
				stokAwal -= jmlKeluar;
				$('[name="stok"]').val(stokAwal);
				stokAwal >= 0 ? $('#show-alert').hide() : $('#show-alert').show();
			}
		})
	})
</script>
