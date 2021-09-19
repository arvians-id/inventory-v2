<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?></title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/purple/assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/purple/assets/vendors/css/vendor.bundle.base.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/template/purple/assets/css/style.css">
	<!-- End layout styles -->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/template/purple/assets/images/favicon.ico" />
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				<div class="row flex-grow">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left p-4 shadow-sm">
							<div class="brand-logo text-center">
								<img src="<?= base_url() ?>assets/image/logo.jpeg">
							</div>
							<h4>Hello! let's get started</h4>
							<h6 class="font-weight-light">Sign in to continue.</h6>
							<hr>

							<?php if ($this->session->flashdata('success')) : ?>
								<div class="alert alert-success" role="alert">
									<?= $this->session->flashdata('success'); ?>
								</div>
							<?php elseif ($this->session->flashdata('error')) : ?>
								<div class="alert alert-danger" role="alert">
									<?= $this->session->flashdata('error'); ?>
								</div>
							<?php endif; ?>

							<form method="POST">
								<div class="form-group">
									<input type="text" name="username" class="form-control form-control-lg <?= !form_error('username') ?: 'is-invalid' ?>" value="<?= set_value('username') ?>" placeholder="Username">
									<div class="invalid-feedback">
										<?= form_error('username') ?>
									</div>
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control form-control-lg <?= !form_error('password') ?: 'is-invalid' ?>" placeholder="Password">
									<div class="invalid-feedback">
										<?= form_error('password') ?>
									</div>
								</div>
								<div class="mt-3">
									<button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
	<!-- plugins:js -->
	<script src="<?= base_url() ?>assets/template/purple/assets/vendors/js/vendor.bundle.base.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/off-canvas.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/hoverable-collapse.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/misc.js"></script>
</body>

</html>
