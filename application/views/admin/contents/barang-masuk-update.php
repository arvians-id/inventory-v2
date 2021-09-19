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

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<?= $this->session->flashdata('success'); ?>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger" role="alert">
							<?= $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>

					<form class="forms-sample" method="POST">
						<input type="hidden" name="kode_barang" value="<?= $barang_masuk['kode_barang'] ?>">
						<div class="form-group">
							<label>Kode Transaksi Barang Masuk</label><span class="text-danger"> *</span>
							<input type="text" class="form-control" value="<?= $barang_masuk['kode_masuk'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Barang</label>
							<input type="text" class="form-control" value="<?= $barang_masuk['nama_barang'] . ' &mdash; ' . $barang_masuk['kode_barang'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Masuk</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tanggal_masuk') ? 'is-invalid' : '' ?>" name="tanggal_masuk" value="<?= $barang_masuk['tanggal_masuk'] ?>">
							<div class="invalid-feedback"><?= form_error('tanggal_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Penerima</label>
							<select class="form-control <?= form_error('penerima_id') ? 'is-invalid' : '' ?>" name="penerima_id">
								<option value="" disabled selected>Pilih Penerima</option>
								<?php foreach ($data_penerima as $penerima) : ?>
									<option value="<?= $penerima['id_penerima'] ?>" <?= set_value('penerima_id') != $penerima['id_penerima'] ?: 'selected' ?> <?= $penerima['id_penerima'] != $barang_masuk['penerima_id'] ?: 'selected' ?>>
										<?= $penerima['nama_penerima'] . ' &mdash; ' . $penerima['jenis_penerima'] ?>
									</option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('penerima_id') ?></div>
						</div>
						<div class="form-group">
							<label>Jumlah Masuk</label>
							<input type="text" class="form-control <?= form_error('jumlah_masuk') ? 'is-invalid' : '' ?>" name="jumlah_masuk" value="<?= $barang_masuk['jumlah_masuk'] ?>" min="0" autocomplete="off">
							<div class="invalid-feedback"><?= form_error('jumlah_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $barang_masuk['keterangan_masuk'] ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
