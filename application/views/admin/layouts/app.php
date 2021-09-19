<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?= base_url() ?>assets/template/purple/assets/images/favicon.ico" />
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/purple/assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/purple/assets/css/style.css">
	<!-- Datatable -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
</head>

<body>
	<div class="container-scroller">
		<!-- Nav -->
		<?php $this->load->view('admin/components/navigation') ?>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- Side -->
			<?php $this->load->view('admin/components/sidebar') ?>
			<!-- Main -->
			<div class="main-panel">
				<?php $this->load->view($view) ?>
				<?php $this->load->view('admin/components/footer') ?>
			</div>
		</div>
	</div>
	<script src="<?= base_url() ?>assets/template/purple/assets/vendors/js/vendor.bundle.base.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/off-canvas.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/hoverable-collapse.js"></script>
	<script src="<?= base_url() ?>assets/template/purple/assets/js/misc.js"></script>

	<!-- Datatable -->
	<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				responsive: true,
				autoWidth: true,

			});
		});
	</script>
</body>

</html>
