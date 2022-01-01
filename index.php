<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap5/fontawesome/css/all.css">

	<title>Hello, world!</title>
</head>

<body>
	<?php include_once('navbar.php'); ?>

	<div class=" container">
		<div class="row pt-3">
			<div class="col-md-12 col-sm-8">
				<div class="card" style="box-shadow: rgba(0, 0, 0, 0.176) 0px 16px 48px 0px;">
					<div class="card-header rounded-top bg-success" style="height: 70px !important;">
						<h4 class="text-center text-white py-3">Daftar Mahasiswa</h4>
					</div>
					<div class="card-body border border-success border-bottom-0 p-5">
						<div class="row">
							<div class="col-md-12 col-12">
								<a href="tambah.php" class="btn btn-primary mb-2">Tambah data</a>
							</div>
							<div class="col-md-12 col-12">
								<div class="input-group">
									<form action="" method="post">
										<div class="input-group">
											<div class="form-outline">
												<input id="search-input" type="search" name="keyword" class="form-control" placeholder="pencarian.." autocomplete="off" autofocus />
											</div>
											<button type="submit" name="cari" class="btn btn-primary">
												<i class="fas fa-search"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="table-responsive pt-4">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th nowrap>No.</th>
										<th nowrap>Aksi</th>
										<th nowrap>Gambar</th>
										<th nowrap>NRP</th>
										<th nowrap>Nama</th>
										<th nowrap>Email</th>
										<th nowrap>Jurusan</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($mahasiswa as $row) : ?>
										<tr>
											<td nowrap><?= $i; ?></td>
											<td nowrap>
												<a class="btn btn-primary btn-sm" href="ubah.php?id=<?= $row["id"]; ?>" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></a>
												<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash"></i></a>
											</td>
											<td nowrap><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
											<td nowrap><?= $row["nrp"]; ?></td>
											<td nowrap><?= $row["nama"]; ?></td>
											<td nowrap><?= $row["email"]; ?></td>
											<td nowrap><?= $row["jurusan"]; ?></td>
										</tr>
										<?php $i++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

						<div class="row">
							<div class="col-md-9 col-12">
								<caption>Jumlah : <?= $jumlahData ?> Data</caption>
							</div>
							<div class="col-md-3 col-12">
								<nav aria-label="...">
									<ul class="pagination">
										<li class="page-item">
											<a class="page-link" href="?halaman=1">awal</a>
										</li>

										<!-- untuk previus -->
										<?php if ($halamanAktif == 1) { ?>
											<li class="page-item disabled">
												<a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
											</li>
										<?php } else { ?>
											<li class="page-item">
												<a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
											</li>
										<?php } ?>

										<!-- untuk looping -->
										<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
											<?php if ($i == $halamanAktif) : ?>
												<li class="page-item active" aria-current="page">
													<a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
												</li>
											<?php else : ?>
												<li class="page-item">
													<a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
												</li>
											<?php endif; ?>
										<?php endfor; ?>

										<!-- untuk next -->
										<?php if ($halamanAktif == $jumlahHalaman) { ?>
											<li class="page-item disabled">
												<a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
											</li>
										<?php } else { ?>
											<li class="page-item">
												<a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
											</li>
										<?php } ?>

										<li class="page-item">
											<a class="page-link" href="?halaman=<?= $jumlahHalaman; ?>">akhir</a>
										</li>

									</ul>
								</nav>
							</div>
						</div>
					</div>
					<div class="card-footer bg-success">
						<p class="text-center text-white">Silahkan Isi Data Dengan Benar</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once('footer.php'); ?>

	<script src="bootstrap5/plugin/jquery-3.5.1.min.js"></script>
	<!-- <script src="bootstrap5/plugin/popper.min.js"></script> -->
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap5/js/bootstrap.min.js"></script>

	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>

</html>