<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?= $this->uri->segment(2) == 'create' ? 'Tambah' : 'Ubah' ?> Barang </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $this->uri->segment(2) == 'create' ? 'Create' : 'Update' ?> Barang</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Kode Barang</label>
							<input type="text" name="kode_barang" class="form-control" value="<?= $kode_barang ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<input type="text" name="nama_barang" class="form-control <?= !form_error('nama_barang') ?: 'is-invalid' ?>" value="<?= set_value('nama_barang', isset($data_barang) ? $data_barang['nama_barang'] : '') ?>" placeholder="Nama Barang Baru">
							<div class="invalid-feedback">
								<?= form_error('nama_barang') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Tempat Barang</label>
							<input type="text" name="tempat_barang" class="form-control <?= !form_error('tempat_barang') ?: 'is-invalid' ?>" value="<?= set_value('tempat_barang', isset($data_barang) ? $data_barang['tempat_barang'] : '') ?>" placeholder="Tempat Barang Disimpan">
							<div class="invalid-feedback">
								<?= form_error('tempat_barang') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Spesifikasi Barang</label>
							<input type="text" name="spesifikasi" class="form-control <?= !form_error('spesifikasi') ?: 'is-invalid' ?>" value="<?= set_value('spesifikasi', isset($data_barang) ? $data_barang['spesifikasi'] : '') ?>" placeholder="Nama Barang Baru">
							<div class="invalid-feedback">
								<?= form_error('spesifikasi') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Keterangan (Optional)</label>
							<input type="text" name="keterangan" class="form-control <?= !form_error('keterangan') ?: 'is-invalid' ?>" value="<?= set_value('keterangan', isset($data_barang) ? $data_barang['keterangan'] : '') ?>" placeholder="Keterangan Tentang Barang Ini">
							<div class="invalid-feedback">
								<?= form_error('keterangan') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Photo <?= $this->uri->segment(2) == 'create' ? '(Optional)' : '(Abaikan jika tidak ingin diubah)' ?></label>
							<input type="file" name="photo" class="form-control">
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
