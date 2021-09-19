<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Daftar Barang </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Barang</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
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

					<p class="class-description">
						<a href="<?= base_url('data-barang/create') ?>" class="btn btn-primary">Tambah</a>
					</p>
					<table id="example" class="table table-striped display responsive nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th>Photo</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Tempat Barang</th>
								<th>Spesifikasi Barang</th>
								<th>Stok</th>
								<th>Keterangan</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data_barang as $barang) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td class="text-center">
										<a href="javascript:void(0);" class="open-modal">
											<img src="<?= base_url() ?>assets/image/<?= $barang['photo']  ?>" data-photo="<?= $barang['photo']  ?>" width="50">
										</a>
									</td>
									<td><?= $barang['kode'] ?></td>
									<td><?= $barang['nama_barang'] ?></td>
									<td><?= $barang['tempat_barang'] ?></td>
									<td><?= $barang['spesifikasi'] ?></td>
									<td><?= $barang['stok'] ?></td>
									<td><?= $barang['keterangan'] ?></td>
									<td class="text-center">
										<a href="<?= base_url('data-barang/update/' . $barang['id_barang']) ?>" class="btn btn-primary btn-sm">Ubah</a>
										<a href="<?= base_url('data-barang/delete/' . $barang['id_barang']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('WARNING! Jika anda menghapus data ini, data barang masuk & keluar yang berhubungan dengan data ini akan ikut terhapus.')">Hapus</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content-wrapper ends -->
<!-- Modal -->
<div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="openModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img class="img-fluid mx-auto d-block" id="modal-photo">
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(function() {
		$('.open-modal').on('click', function() {
			let filename = $(this).children().data('photo')
			$('#openModal').modal('show')

			$('#modal-photo').attr('src', "<?= base_url() ?>assets/image/" + filename);
		})
	});
</script>
