<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil diubah atau tidak
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
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
						<h4 class="text-center text-white py-3">Ubah data mahasiswa</h4>
					</div>
					<div class="card-body  border border-success border-bottom-0 p-5 ">

						<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
							<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="text" name="nrp" placeholder="NRP" required autocomplete="off" value="<?= $mhs["nrp"]; ?>">
								<label for="floatingInput">NRP</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="text" name="nama" placeholder="Nama" required autocomplete="off" value="<?= $mhs["nama"]; ?>">
								<label for="floatingInput">Nama</label>
							</div>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="email" name="email" placeholder="Email" required autocomplete="off" value="<?= $mhs["email"]; ?>">
								<label for="floatingInput">Email</label>
							</div>
							<div class="form-group form-floating mt-2 mb-3">
								<input class="form-control" type="text" name="jurusan" placeholder="Jurusan" required autocomplete="off" value="<?= $mhs["jurusan"]; ?>">
								<label for="floatingInput">Jurusan</label>
							</div>
							<img src="img/<?= $mhs['gambar']; ?>" width="40"> <br>
							<div class="form-group form-floating mt-2">
								<input class="form-control" type="file" name="gambar">
								<label class="p-2" for="floatingInput">Upload gambar</label>
							</div>
							<div class="form-group form-floating pt-4">
								<button class="w-100 btn btn-primary" type="submit" name="submit">Ubah Data!</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card-footer bg-success ">
					<p class="text-center text-white">Silahkan Isi Data Dengan Benar</p>
				</div>
			</div>
		</div>
	</div>

</body>

</html>