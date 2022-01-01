<?php
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if (mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION["name"] = $row["username"];

			// cek remember me
			if (isset($_POST['remember'])) {
				// buat cookie
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}

			header("Location: index.php");
			exit;
		}
	}

	$error = true;
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
				<?php if (isset($error)) : ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<p>username / password salah</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
				<div class="card" style="box-shadow: rgba(0, 0, 0, 0.176) 0px 16px 48px 0px;">
					<div class="card-header rounded-top bg-success" style="height: 70px !important;">
						<h4 class="text-center text-white py-3">Silahkan Login</h4>
					</div>
					<div class="card-body  border border-success border-bottom-0 p-5 ">
						<form action="" method="post">
							<div class="form-group form-floating">
								<input class="form-control" type="text" name="username" placeholder="Username" required autocomplete="off">
								<label for="floatingInput">Username</label>
							</div>
							<div class="form-group form-floating pt-2">
								<input class="form-control" type="password" name="password" placeholder="Password" required autocomplete="off">
								<label for="floatingInput">Password</label>
							</div>
							<div class="form-group">
								<input type="checkbox" name="remember" id="remember">
								<label for="remember">Remember me</label>
							</div>
							<div class="form-group mt-4">
								<button class="btn btn-success w-100" type="submit" name="login">Login</button>
							</div>
						</form>
						<div class="d-flex justify-content-between pt-2">
							<a href="http://localhost/crud_image_native/registrasi.php">Daftar</a>
							<a href="">Lupa Password</a>
						</div>
					</div>
					<div class="card-footer bg-success ">
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