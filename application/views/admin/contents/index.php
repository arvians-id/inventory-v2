 <!-- partial -->
 <div class="content-wrapper">
 	<div class="page-header">
 		<h3 class="page-title">
 			<span class="page-title-icon bg-gradient-primary text-white mr-2">
 				<i class="mdi mdi-home"></i>
 			</span> Dashboard
 		</h3>
 	</div>
 	<div class="row">
 		<div class="col-md-4 stretch-card grid-margin">
 			<div class="card bg-gradient-danger card-img-holder text-white">
 				<div class="card-body">
 					<img src="<?= base_url() ?>assets/template/purple/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
 					<h4 class="font-weight-normal mb-3">Total Barang <i class="mdi mdi-database mdi-24px float-right"></i>
 					</h4>
 					<h2 class="mb-5"><?= $data_barang ?></h2>
 				</div>
 			</div>
 		</div>
 		<div class="col-md-4 stretch-card grid-margin">
 			<div class="card bg-gradient-info card-img-holder text-white">
 				<div class="card-body">
 					<img src="<?= base_url() ?>assets/template/purple/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
 					<h4 class="font-weight-normal mb-3">Transaksi Barang Masuk <i class=" mdi mdi-format-horizontal-align-right mdi-24px float-right"></i>
 					</h4>
 					<h2 class="mb-5"><?= $transaksi_masuk ?></h2>
 				</div>
 			</div>
 		</div>
 		<div class="col-md-4 stretch-card grid-margin">
 			<div class="card bg-gradient-success card-img-holder text-white">
 				<div class="card-body">
 					<img src="<?= base_url() ?>assets/template/purple/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
 					<h4 class="font-weight-normal mb-3">Transaksi Barang Keluar<i class=" mdi mdi-format-horizontal-align-left mdi-24px float-right"></i>
 					</h4>
 					<h2 class="mb-5"><?= $transaksi_keluar ?></h2>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- content-wrapper ends -->
