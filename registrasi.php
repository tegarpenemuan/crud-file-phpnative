<?php
require 'functions.php';

if (isset($_POST["register"])) {

	if (registrasi($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				document.location.href = 'login.php';
			  </script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!doctype html>
<html lang="en">

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
						<h4 class="text-center text-white py-3">Silahkan Daftar</h4>
					</div>
					<div class="card-body border border-success border-bottom-0 p-5">
						<form action="" method="post">
							<div class="form-group form-floating">
								<input class="form-control" type="text" name="username" placeholder="Username" required autocomplete="off">
								<label for="floatingInput">Username</label>
							</div>
							<div class="form-group form-floating pt-2">
								<input class="form-control" type="password" name="password" placeholder="Password" required autocomplete="off">
								<label for="floatingInput">Password</label>
							</div>
							<div class="form-group form-floating pt-2">
								<input class="form-control" type="password" name="password2" placeholder="Konfirmasi Password" required autocomplete="off">
								<label for="floatingInput">Konfirmasi Password</label>
							</div>
							<div class="form-group mt-4">
								<button class="btn btn-success w-100" type="submit" name="register" data-toggle="tooltip" data-placement="right" title="Halo, Tooltip berada di kanan">Register</button>
							</div>
						</form>
					</div>
					<div class="card-footer bg-success">
						<p class="text-center text-white">Silahkan Isi Data Dengan Benar</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="bootstrap5/plugin/jquery-3.5.1.min.js"></script>
	<!-- <script src="bootstrap5/plugin/popper.min.js"></script> -->
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap5/js/bootstrap.min.js"></script>

	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>

	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 5000);
	</script>
</body>

</html>