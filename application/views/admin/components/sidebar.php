<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item nav-profile">
			<a href="#" class="nav-link">
				<div class="nav-profile-image">
					<img src="<?= base_url() ?>assets/image/<?= $this->session->userdata('photo') ?>" alt="profile">
					<span class="login-status online"></span>
				</div>
				<div class="nav-profile-text d-flex flex-column">
					<span class="font-weight-bold mb-2"><?= ucfirst($this->session->userdata('username')) ?></span>
					<span class="text-secondary text-small">Administrator</span>
				</div>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('home') ?>">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<li class="nav-item <?= activeMenu(['data-barang', 'administrator', 'penerima'], ['update', 'create'], 'active') ?>">
			<a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false" aria-controls="data-master">
				<span class="menu-title">Data Master</span>
				<i class="menu-arrow"></i>
				<i class="mdi mdi-database menu-icon"></i>
			</a>
			<div class="collapse <?= activeMenu(['data-barang', 'administrator', 'penerima'], ['update', 'create'], 'show') ?>" id="data-master">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link <?= activeMenu(['administrator'], ['create'], 'active') ?>" href="<?= base_url('administrator') ?>">Data Admin</a></li>
					<li class="nav-item"> <a class="nav-link <?= activeMenu(['penerima'], ['create'], 'active') ?>" href="<?= base_url('penerima') ?>">Data Penerima</a></li>
					<li class="nav-item"> <a class="nav-link <?= activeMenu(['data-barang'], ['update', 'create'], 'active') ?>" href="<?= base_url('data-barang') ?>">Data Barang</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?= activeMenu(['barang-masuk', 'barang-keluar'], ['update', 'create'], 'active') ?>">
			<a class="nav-link" data-toggle="collapse" href="#data-transaksi" aria-expanded="false" aria-controls="data-transaksi">
				<span class="menu-title">Data Transaksi</span>
				<i class="menu-arrow"></i>
				<i class="mdi mdi-format-horizontal-align-center menu-icon"></i>
			</a>
			<div class="collapse <?= activeMenu(['barang-masuk', 'barang-keluar'], ['update', 'create'], 'show') ?>" id="data-transaksi">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link <?= activeMenu(['barang-masuk'], ['create', 'update'], 'active') ?>" href="<?= base_url('barang-masuk') ?>">Barang Masuk</a></li>
					<li class="nav-item"> <a class="nav-link <?= activeMenu(['barang-keluar'], ['create', 'update'], 'active') ?>" href="<?= base_url('barang-keluar') ?>">Barang Keluar</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('laporan') ?>">
				<span class="menu-title">Kelola Laporan</span>
				<i class="mdi mdi-book-multiple menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#lainnya" aria-expanded="false" aria-controls="lainnya">
				<span class="menu-title">Lainnya</span>
				<i class="menu-arrow"></i>
				<i class="mdi mdi-view-dashboard menu-icon"></i>
			</a>
			<div class="collapse" id="lainnya">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="<?= base_url('profile') ?>">Profile</a></li>
					<li class="nav-item"> <a class="nav-link" href="<?= base_url('logout') ?>">Logout</a></li>
				</ul>
			</div>
		</li>
	</ul>
</nav>
