<?php
	require'login_process.php';

	if( isset($_SESSION["admin"])) {
		header("Location: ../backend/admin.php");
		exit;
	} else if (isset($_SESSION["staffGudang"])){
		header("Location: ../backend/staff_gudang.php");
		exit;
	} else if (isset($_SESSION["staffKantor"])){
		header("Location: ../backend/satff_kantor.php");
		exit;
	}
	
	
    if(isset($_POST["login"])){
        login($_POST);
    }
	
?>

<!doctype html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Sistem Informasi Manajemen Stok <br> PT. Alvian Putra Jaya</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<form action="" method="POST" class="login-form">
							<div class="form-group">
								<input name="email" id="email" type="text" class="form-control rounded-left" placeholder="Masukkan Email" required>
							</div>
							<div class="form-group d-flex">
								<input name="password" id="password" type="password" class="form-control rounded-left" placeholder="Masukkan Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3" name="login" id="login">Masuk</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-100 text-md-right">
									<a href="#">Lupa Password ? </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>