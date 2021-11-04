<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <?php
  include("koneksi.php");
  ?>
</head>

<body class="bg-gradient-primary">
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-4">
					<div class="text-center">
						<h1 class="h4 text-gray-900 mt-4 mb-4">Create an Account!</h1>
					</div>
					<form class="user" method="post" action="">
						<div class="form-group">
							<input type="text" inputmode="numeric" class="form-control form-control-user" name="noHp" pattern="^08[0-9]{9,}$" maxlength="13" title="Masukkan Nomor Handphone yang valid!" placeholder="Nomor Handphone Valid" required /><br/>
							<input type="password" class="form-control form-control-user" name="pin" pattern="[0-9]{6}" maxlength="6" inputmode="numeric" title="PIN harus terdiri dari 6 digit angka" placeholder="PIN..." required /><br/>
						</div>
						<div class="form-group">
							<input type="text" name="nama" class="form-control form-control-user" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$" placeholder="Nama Lengkap..." title="Harus huruf, minimal 4 huruf" required /><br/>
							<input type="email" name="email" class="form-control form-control-user" placeholder="E-Mail..." required /><br/>
							<input type="date" name="tglLahir" class="form-control form-control-user" required/><br/>
							<textarea name="alamat" class="form-control form-control-user" placeholder="Alamat..." required></textarea><br/>
						</div>
						<button class="btn btn-primary btn-user btn-block" type="submit" name="submit">Daftar</button>
					</form>
					<?php
					if (isset($_POST['submit'])) {
						$hp = $_POST['noHp'];
						$id = "09" . strval($hp);
						$pin = $_POST['pin'];
						
						$nama = $_POST['nama'];
						$email = $_POST['email'];
						$tglLahir = $_POST['tglLahir'];
						$tglLahir = date("Y-m-d", strtotime($tglLahir));
						$alamat = $_POST['alamat'];
						
						$qReg = mysqli_query($db, "INSERT INTO user (id_user, nama, pin, no_hp, email, alamat, tgl_Lahir) VALUE ('$id', '$nama', '$pin', '$hp', '$email', '$alamat', '$tglLahir')");
						if ($qReg) {
							echo "<meta http-equiv='refresh' content='0; url=login.php'>";
						}
					}
					?>
				  <hr>
				  <div class="text-center">
					<a class="small" href="login.php">Already have an account? Login!</a>
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
