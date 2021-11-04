<?php
  include("koneksi.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mutasi Rekening | NakoPay</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
	<div id="wrapper">

        <?php include("sidebar.php"); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <?php include("topBar.php"); ?>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
							  <h6 class="m-0 font-weight-bold text-primary">Mutasi</h6>
							</div>
							<div class="card-body">
								<form method="post" action="">
									<div class="d-flex">
										<input type="number" name="search" class="form-control form-control-user col-sm-2 mr-2" value="<?= $_POST['search'] ?? '' ?>"style="display:inline" />
										<input type="submit" name="cari" class="btn btn-primary" value="Cari"/>
									</div>
								</form>
								<br/>
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>ID Transaksi</th>
												<th>Keterangan</th>
												<th>Tanggal</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$id = $_SESSION['id_user'];
											if (isset($_POST['search']) && $_POST['search'] != '') {
												$q = $_POST['search'];
												$dataSql = mysqli_query($db, "SELECT * FROM `transaksi` WHERE `id_user` = '$id' AND id_transaksi = '$q'");
											}
											else $dataSql = mysqli_query($db, "SELECT * FROM `transaksi` WHERE `id_user` = '$id' ORDER BY `tanggal` DESC");
											if (mysqli_num_rows($dataSql) > 0) {
												while($data = mysqli_fetch_array($dataSql)) {
											?>
											<tr class="table-<?php if ($data['kategori'] == 'debit') {echo 'success';} else echo 'danger'?>">
												<td><?php echo $data['id_transaksi']; ?></td>
												<td><?php echo $data['deskripsi']; ?></td>
												<td><?php echo date("d-m-Y H:i:s", strtotime($data['tanggal'])); ?></td>
											</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; Your Website 2019</span>
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
