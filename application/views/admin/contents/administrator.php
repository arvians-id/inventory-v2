<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Daftar Admin </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrator</li>
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
						<a href="<?= base_url('administrator/create') ?>" class="btn btn-primary">Tambah</a>
					</p>
					<table id="example" class="table table-striped display responsive nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th class="text-center">Photo</th>
								<th>Username</th>
								<th>Dibuat</th>
								<th>Terakhir Diubah</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($users as $user) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td class="text-center"><img src="<?= base_url() ?>assets/image/<?= $user['photo']  ?>" width="50"></td>
									<td><?= $user['username'] ?></td>
									<td><?= $user['created_at'] ?></td>
									<td><?= $user['updated_at'] ?></td>
									<td>
										<?php if ($user['id'] != $this->session->userdata('id')) : ?>
											<a href="<?= base_url('administrator/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('WARNING! Yakin ingin menghapus data ini?')">Hapus</a>
										<?php endif ?>
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
