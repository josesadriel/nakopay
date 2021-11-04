<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Register Akun Bisnis</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    </head>
    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php include("topBar.php"); ?>
                </nav>
                <?php
                if (isset($_SESSION['id_user'])) {
                    $id = $_SESSION['id_user'];
                    $cekSql = mysqli_query($db, "SELECT * FROM `user` WHERE id_user = '$id'");
                    while ($profile = mysqli_fetch_array($cekSql)) {
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Developer</h1>
                        <span class="d-none d-sm-inline-block text-xs">Terakhir Login: <?php echo date("d F Y", strtotime($profile['lastLogin'])); ?></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">API Key</h6>
                                </div>
                                <div class="card-body">
									<?php
									$accBisnis = mysqli_query($db, "SELECT `api_key` FROM `akun_bisnis` WHERE `id_user` = '$profile[id_user]'");
									if (mysqli_num_rows($accBisnis) > 0) {
										while ($api = mysqli_fetch_array($accBisnis)) {
									?>
                                    <div class="d-flex">
										<input type="text" class="form-control col-md-9" id="api_key" value="<?php echo $api['api_key']; ?>" readonly />
										<button onclick="copyTxt()" class="btn btn-primary ml-3">
											<span>
												<i class="far fa-copy"></i>
											</span>
											<span class="text">
												Copy
											</span>
										</button>
									</div>
									<script>
									function copyTxt() {
										
										  var copyText = document.getElementById("api_key");

										  /* Select the text field */
										  copyText.select();
										  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

										  /* Copy the text inside the text field */
										  document.execCommand("copy");

										  /* Alert the copied text */
										  alert("Copied the text: " + copyText.value);
									}
									</script>
									<?php
										}
									}
									?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
							<div class="card shadow mb-4">
								<a href="#vakun" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="vakun">
									<h6 class="m-0 font-weight-bold text-primary">Cara Membuat Virtual Akun</h6>
								</a>
								<div class="collapse in" id="vakun">
									<div class="card-body">
										
									</div>
								</div>
							</div>
							<div class="card shadow mb-4">
								<a href="#dokumentasi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dokumentasi">
									<h6 class="m-0 font-weight-bold text-primary">Dokumentasi</h6>
								</a>
								<div class="collapse in" id="dokumentasi">
									<div class="card-body">
										<b>NakoPay API</b> hanya dapat digunakan untuk melakukan pengecekan pembayaran.<br/>
										Untuk melihat hasilnya, harus memiliki atribut sebagai berikut:<br/>
										<ul class="mt-2">
											<li><b>api = {API_KEY}</b>, berupa kode akses. Saat ini API_KEY anda adalah <span id="api"></span>
												<script>document.getElementById('api').innerHTML = document.getElementById('api_key').value;</script>
											</li>
											<li><b>q = {NOMOR_VIRTUAL_AKUN}</b>, berfungsi untuk melakukan pencarian nomor virtual akun</li>
										</ul><br/>
										Untuk menampilkan semua kode virtual akun yang dibuat:<br/>
										<div id="contoh1" class="bg-secondary p-2"></div>
										<br/>
										Untuk menampilkan kode virtual akun dengan keyword:<br/>
										<div id="contoh2" class="bg-secondary p-2"></div>
										<script>
										document.getElementById('contoh1').innerHTML = "<a class='text-white' href='http://nakopay.000webhostapp.com/api-transaksi.php?api=" + document.getElementById('api_key').value +"'>http://nakopay.000webhostapp.com/api-transaksi.php?api=" + document.getElementById('api_key').value + "</a>";
										document.getElementById('contoh2').innerHTML = "<a class='text-white' href='http://nakopay.000webhostapp.com/api-transaksi.php?api=" + document.getElementById('api_key').value +"'>http://nakopay.000webhostapp.com/api-transaksi.php?api=" + document.getElementById('api_key').value + "q={NOMOR_VIRTUAL_AKUN}</a>";
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; NakoPay 2019</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>