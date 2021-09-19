<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Ubah Profil </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Update Profile</li>
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

					<form class="forms-sample" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control <?= !form_error('username') ?: 'is-invalid' ?>" value="<?= set_value('username', $user['username']) ?>" placeholder="Your Username">
							<div class="invalid-feedback">
								<?= form_error('username') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Password (Kosongkan jika tidak ingin diubah) </label>
							<input type="password" name="password" class="form-control <?= !form_error('password') ?: 'is-invalid' ?>" value="<?= set_value('password') ?>" placeholder="Your Password">
							<div class="invalid-feedback">
								<?= form_error('password') ?>
							</div>
						</div>
						<div class="form-group">
							<label>Photo (Kosongkan jika tidak ingin diubah)</label>
							<input type="file" name="photo" class="form-control">
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
