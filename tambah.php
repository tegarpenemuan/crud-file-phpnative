<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil di tambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}
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

	<title>Hello, world!</title>
</head>

<body>
	<?php include_once('navbar.php'); ?>

	<div class=" container mt-5">

		<div class="row justify-content-center pt-5">
			<div class="col-md-5">
				<div class="card" style="box-shadow: rgba(0, 0, 0, 0.176) 0px 16px 48px 0px;">
					<div class="card-header rounded-top bg-success" style="height: 70px !important;">
						<h4 class="text-center text-white py-3">Tambah data mahasiswa</h4>
					</div>
					<div class="card-body  border border-success border-bottom-0 p-5 ">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="text" name="nrp" placeholder="NRP" required autocomplete="off">
								<label for="floatingInput">NRP</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="text" name="nama" placeholder="Nama" required autocomplete="off">
								<label for="floatingInput">Nama</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="email" name="email" placeholder="Email" required autocomplete="off">
								<label for="floatingInput">Email</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="text" name="jurusan" placeholder="Jurusan" required autocomplete="off">
								<label for="floatingInput">Jurusan</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="file" name="gambar" required>
								<label class="p-2" for="floatingInput">Upload gambar</label>
							</div>
							<div class="form-group form-floating pt-4">
								<button class="w-100 btn btn-primary" type="submit" name="submit">Tambah Data!</button>
							</div>
						</form>
					</div>
					<div class="card-footer bg-success ">
						<p class="text-center text-white">Silahkan Isi Data Dengan Benar</p>
					</div>
				</div>
			</div>
		</div>

		<script src="bootstrap5/plugin/jquery-3.5.1.min.js"></script>
		<!-- <script src="bootstrap5/plugin/popper.min.js"></script> -->
		<script src="https://unpkg.com/@popperjs/core@2"></script>
		<script src="bootstrap5/js/bootstrap.min.js"></script>
</body>

</html>