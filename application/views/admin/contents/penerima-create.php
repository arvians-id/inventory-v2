<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?= $this->uri->segment(2) == 'create' ? 'Tambah' : 'Ubah' ?> Penerima </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $this->uri->segment(2) == 'create' ? 'Create' : 'Update' ?> Penerima</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<form class="forms-sample" method="POST">
						<div class="form-group">
							<label>Nama Penerima</label>
							<input type="text" name="nama_penerima" class="form-control <?= !form_error('nama_penerima') ?: 'is-invalid' ?>" value="<?= set_value('nama_penerima', isset($data_penerima) ? $data_penerima['nama_penerima'] : '') ?>" placeholder="Nama Penerima Baru">
							<div class="invalid-feedback">
								<?= form_error('nama_penerima') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Jenis Penerima</label>
							<select name="jenis_penerima" class="form-control <?= !form_error('jenis_penerima') ?: 'is-invalid' ?>">
								<option value="" selected disabled>Pilih Jenis</option>
								<option value="Bop" <?= set_value('jenis_penerima', isset($data_penerima) ? $data_penerima['jenis_penerima'] : '') == 'Bop' ? 'selected' : '' ?>>Bop</option>
								<option value="Boiler" <?= set_value('jenis_penerima', isset($data_penerima) ? $data_penerima['jenis_penerima'] : '') == 'Boiler' ? 'selected' : '' ?>>Boiler</option>
								<option value="Turbin" <?= set_value('jenis_penerima', isset($data_penerima) ? $data_penerima['jenis_penerima'] : '') == 'Turbin' ? 'selected' : '' ?>>Turbin</option>
							</select>
							<div class="invalid-feedback">
								<?= form_error('jenis_penerima') ?>
							</div>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
