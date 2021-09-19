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
						<div class="form-group">
							<label>Kode Transaksi Barang Keluar</label><span class="text-danger"> *</span>
							<input type="text" class="form-control" value="<?= $barang_keluar['kode_keluar'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Barang</label>
							<input type="text" class="form-control" value="<?= $barang_keluar['nama_barang'] . ' &mdash; ' . $barang_keluar['kode_barang'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Keluar</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tanggal_keluar') ? 'is-invalid' : '' ?>" name="tanggal_keluar" value="<?= $barang_keluar['tanggal_keluar'] ?>">
							<div class="invalid-feedback"><?= form_error('tanggal_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Jumlah Keluar</label>
							<input type="text" class="form-control <?= form_error('jumlah_keluar') ? 'is-invalid' : '' ?>" name="jumlah_keluar" value="<?= $barang_keluar['jumlah_keluar'] ?>" min="0" autocomplete="off">
							<div class="invalid-feedback"><?= form_error('jumlah_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $barang_keluar['keterangan_keluar'] ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
