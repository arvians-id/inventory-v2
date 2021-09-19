<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Buat Laporan </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Create Laporan</li>
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
							<label>Laporan</label>
							<select class="form-control <?= form_error('laporan') ? 'is-invalid' : '' ?>" name="laporan">
								<option value="" disabled selected>Pilih Laporan</option>
								<option value="barang">Data Barang</option>
								<option value="barang_masuk">Barang Masuk</option>
								<option value="barang_keluar">Barang Keluar</option>
							</select>
							<div class="invalid-feedback"><?= form_error('laporan') ?></div>
						</div>
						<div class="form-group">
							<label>Dari</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('awal') ? 'is-invalid' : '' ?>" name="awal" value="<?= set_value('awal') ?>">
							<div class="invalid-feedback"><?= form_error('awal') ?></div>
						</div>
						<div class="form-group">
							<label>Sampai</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('akhir') ? 'is-invalid' : '' ?>" name="akhir" value="<?= set_value('akhir') ?>">
							<div class="invalid-feedback"><?= form_error('akhir') ?></div>
						</div>
						<div class="form-group">
							<label>Jenis Laporan</label>
							<select class="form-control <?= form_error('jenis_laporan') ? 'is-invalid' : '' ?>" name="jenis_laporan">
								<option value="" disabled selected>Pilih Jenis Laporan</option>
								<option value="print">Print</option>
								<option value="excel">Excel</option>
							</select>
							<div class="invalid-feedback"><?= form_error('jenis_laporan') ?></div>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
