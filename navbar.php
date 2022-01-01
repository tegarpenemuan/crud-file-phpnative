<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top" style="box-shadow: rgba(0, 0, 0, 0.176) 0px 16px 48px 0px;">
    <div class="container">
        <a class="navbar-brand" href="index.php">Data Mahasiswa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav ml-auto">
                    <?php if (@$_SESSION["login"]) { ?>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <!-- <li class="nav-item">
                            <a class="btn btn-primary" href="">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary" href="">Register</a>
                        </li> -->
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-2 p-3 bagde-primary">
    <h4>Selamat Datang <?php echo @$_SESSION["name"]; ?></h4>
</div>