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

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
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
						<?php
						if (isset($_SESSION['id_user'])) {
							$id = $_SESSION['id_user'];
							$sql = mysqli_query($db, "SELECT * FROM user WHERE id_user = $id");
							while ($user = mysqli_fetch_array($sql)) {
						?>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Home</h1>
							<span class="d-none d-sm-inline-block text-xs">Terakhir Login: <?php echo date("d F Y", strtotime($user['lastLogin'])); ?></span>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary">Profile</h6>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<div class="col-sm-12">
												<table width="100%">
													<tr>
														<td width="135px" align="center">
															<img src="profile/<?php echo $user['profile_img']; ?>" width="95px" height="95px" class="img-fluid px-6 px-sm-7 mt-1 mb-2" />
														</td>
														<td valign="middle"><big><?php echo $user['nama']; ?></big></td>
													</tr>
												</table>
												<br/>
												<table class="table">
													<tr>
														<td width="35%">Address:</td>
														<td><?php echo $user['alamat'];?></td>
													</tr>
													<tr>
														<td width="35%">E-Mail:</td>
														<td><?php echo $user['email'];?></td>
													</tr>
													<tr>
														<td width="35%">Phone Number:</td>
														<td><?php echo $user['no_hp'];?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="card shadow mb-4">
											<div class="card-header py-3" align="center">
												<h6 class="m-0 font-weight-bold text-primary">Rekening</h6>
											</div>
											<div class="card-body">
												<center>
													<?php echo $user['id_user']; ?>
												</center>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card shadow mb-4">
											<div class="card-header py-3" align="center">
												<h6 class="m-0 font-weight-bold text-primary">Balance</h6>
											</div>
											<div class="card-body">
												<center>
													Rp. <?php echo number_format($user['saldo'], 2,",","."); ?>
												</center>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="card shadow mb-4">
											<div class="card-header py-3" align="center">
												<h6 class="m-0 font-weight-bold text-primary">Last Transaction</h6>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
													<?php
														}
													}
													$transaction = mysqli_query($db, "SELECT * FROM `transaksi` WHERE id_user = '$id' LIMIT 2");
													if (mysqli_num_rows($transaction) > 0) {
														while($trans = mysqli_fetch_array($transaction)) {
													?>
														<tr class="table-<?php if ($trans['kategori'] == 'debit') {echo 'success';} else echo 'danger'?>">
															<td>
																<?php 
																if ($trans['kategori'] == 'debit') {
																	echo "Menerima Rp. " . $trans['nominal'] . " dari " . $trans['target_user'];
																}
																else {
																	echo "Mengirim Rp. " . $trans['nominal'] . " ke " . $trans['target_user'];
																}
																?>
															</td>
															<td width="20%" class="text-xs"><?php echo date("d M Y", strtotime($trans['tanggal']));?></td>
														</tr>
													<?php 
														}
													}
													?>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
						
							</div>
						</div>
						
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; NakoPay 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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