<?php include("koneksi.php"); session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-4">
					<div class="text-center">
						<h1 class="h4 text-gray-900 mt-4 mb-4">Welcome Back!</h1>
					</div>
					<form class="user" method="post" action="">
						<div class="form-group">
							<input type="text" class="form-control form-control-user" id="exampleInputNomor" aria-describedby="nomorHelp" name="noHp" title="Masukkan Nomor Handphone" placeholder="Masukkan Nomor Handphone..." pattern="^08[0-9]{9,}$" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control form-control-user" name="pin" pattern="[0-9]{6}" maxlength="6" inputmode="numeric" title="PIN harus terdiri dari 6 digit angka" placeholder="PIN..." required />
						</div>
						<input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Login"/>
					</form>
					<?php
						if (isset($_POST['submit'])) {
							$noHp = $_POST['noHp'];
							$pin = $_POST['pin'];
							
							$cekLogin = mysqli_query($db, "SELECT * FROM user WHERE no_hp = '$noHp' AND pin = '$pin'");
							$result = mysqli_num_rows($cekLogin);
							if ($result > 0) {
								while($user = mysqli_fetch_assoc($cekLogin)) {
									$_SESSION['id_user'] = $user['id_user'];
									$_SESSION['status'] = $user ['status'];
								}
								echo "<meta http-equiv='refresh' content='0; url=home.php'>";
							}
						}
					?>
					<hr>
					<div class="text-center">
						<a class="small" href="forgot-password.html">Forgot Password?</a>
					</div>
					<div class="text-center">
						<a class="small" href="register.php">Create an Account!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
