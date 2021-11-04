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

    <title>Transfer ke NakoPay Virtual Account</title>

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
						if (isset($_POST['pilihan'])) {
							$opsi = $_POST['opsi'];
                            $fixTarget = $_POST['targetId'];
                            $fixNominal = $_POST['nominal'];
						}
						if (isset($_SESSION['id_user'])) {
							$id = $_SESSION['id_user'];
							$userSql = mysqli_query($db, "SELECT * FROM user WHERE id_user = $id");
							while ($user = mysqli_fetch_array($userSql)) {
                                $balance = $user['saldo'];
						?>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Transfer ke Virtual Account</h1>
							<span class="d-none d-sm-inline-block text-xs">Terakhir Login: <?php echo date("d F Y", strtotime($user['lastLogin'])); ?></span>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="card shadow mb-4">
										<div class="card-header py-3">
											<h6 class="m-0 font-weight-bold text-primary">Transfer ke Virutal Account</h6>
										</div>
										<div class="card-body">
											<form action="" method="post">
												<div class="form-group d-sm-flex align-items-center">
													<input type="text" class="form-control form-control-user col-sm-7 mr-2" id="targetId" name="targetId" value="<?= $fixTarget ?? '' ?>" pattern="^09[0-9]{13}$" placeholder="Masukkan Nomor Virtual Account..." title="Nomor Virtual Account harus berupa 15 digit angka!" maxlength="15" style="display:inline" required />
													<button type="button" id="cari" class="btn btn-info btn-icon-split btn-sm" onclick="location.href='?target=' + document.getElementById('targetId').value">
														<span class="icon text-white-50">
															<i class="fas fa-search"></i>
														</span>
														<span class="text">Cari</span>
													</button>
													<button type="button" id="batalkan" class="btn btn-danger btn-icon-split btn-sm" onclick="location.href='transfer-kevakun.php'" style="display:none">
														<span class="icon text-white-50">
															<i class="fas fa-times"></i>
														</span>
														<span class="text">Batal</span>
													</button>
												</div>
												<?php
												if (isset($opsi)) {
													echo "<script>";
													echo "document.getElementById('cari').style.display='none';";
													echo "document.getElementById('batalkan').style.display='inline';";
													echo "document.getElementById('targetId').readOnly=true;";
													echo "</script>";
												?>
												<div class="form-group">
                                                    <input type="hidden" name="norekPemilik" value="<?php echo $_POST['pemilik']; ?>" />
													<input type="number" class="form-control form-control-user col-sm-7" name="nominal" value="<?php echo $fixNominal; ?>" placeholder="Nominal Pengiriman..." title="Masukkan nominal yang ingin dikirim!" readonly required />
												</div>
												<button type="submit" name="kirim" class="btn btn-primary btn-icon-split btn-sm">
													<span class="icon text-white-100">
														<i class="fas fa-paper-plane"></i>
													</span>
													<span class="text">Kirim</span>
												</button>
												<?php
												}
												if (isset($_POST['kirim'])) {
													if ($_POST['nominal'] < $balance) {
                                                        $kode = $_POST['targetId'];
														$rekTarget = $_POST['norekPemilik'];
														$nominal = $_POST['nominal'];
														$id = $_SESSION['id_user'];
														$cobaRand = rand(10,99);
														$transferId1 = "0" . strval(date("jnyHis")) . $cobaRand;
                                                        $transferId2 = "1" . strval(date("jnyHis")) . $cobaRand;
                                                        $deskripsi1 = "Transfer via Virtual Account Rp. " . $nominal . " ke " . $kode;
                                                        $deksripsi2 = "Menerima uang melalui Virtual Account Rp. " . $nominal . " dari " . $id;
        
														$sendSql = mysqli_query($db, "UPDATE `user` SET `saldo` = `saldo` + '$nominal' WHERE id_user = '$rekTarget'");
														$decreaseSql = mysqli_query($db, "UPDATE `user` SET `saldo` = `saldo` - '$nominal' WHERE id_user = '$id'");
                                                        $insertLog = mysqli_query($db, "INSERT INTO `transaksi` (id_transaksi, id_user, target_user, nominal, kategori, deskripsi) VALUES ('$transferId1', '$id', '$kode', '$nominal', 'credit', '$deskripsi1'), ('$transferId2', '$rekTarget', '$id', '$nominal', 'debit', '$deksripsi2')");
                                                        $updatePayment = mysqli_query($db, "UPDATE `payment` SET `status` = 'lunas' WHERE kode = '$kode'");
														if ($sendSql && $decreaseSql && $insertLog && $updatePayment) {
															echo "<meta http-equiv='refresh' content='0; url=mutasi.php'>";
														}
													}
													else echo "Balance tidak cukup!";
												}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
						</div>
						<?php
							}
						}
						?>
					</div>
				</div>
				<!-- Modal -->
				<?php
				if (isset($_GET['target'])) {
					echo "<script>";
					echo "$(document).ready(function(){";
					echo "$('#targetUser').modal('show');";
					echo "}); </script>";
					
					$target = $_GET['target'];
					echo "<script>document.getElementById('targetId').value='$target';</script>";
					$cekUser = mysqli_query($db, "SELECT payment.*, akun_bisnis.nama_usaha FROM `payment` INNER JOIN `akun_bisnis` ON payment.pemilik = akun_bisnis.id_user WHERE kode = '$target' AND `status` = 'belum' AND NOT `pemilik` = '$id'");
					if(mysqli_num_rows($cekUser) > 0) {
						while($target = mysqli_fetch_array($cekUser)) {
				?>
						<!-- Target Ditemukan -->
						<div class="modal fade" id="targetUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="table-responsive">
											<div class="col-sm-12">
												<?php echo $target['kode']; ?><br/>
                                                <?php echo $target['nominal']; ?><br/>
                                                <?php echo $target['nama_usaha']; ?><br/>
                                                <?php echo $target['username']; ?><br/>
                                                <?php echo date("d F Y H:i", strtotime($target['dibuat'])); ?>
												<br/>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<form action="transfer-kevakun.php" method="post">
											<input type="hidden" name="targetId" value="<?php echo $target['kode'];?>"/>
                                            <input type="hidden" name="nominal" value="<?php echo $target['nominal']; ?>" />
                                            <input type="hidden" name="pemilik" value="<?php echo $target['pemilik']; ?>" />
											<input type="hidden" name="opsi" value="yes"/>
											<input type="submit" class="btn btn-primary" name="pilihan" value="Ya"/>
										</form>
										<button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
									</div>
								</div>
							</div>
						</div>
				<?php
						}
					}
					else {
				?>
						<!-- Target Tidak Ditemukan -->
						<div class="modal fade" id="targetUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										Nomor Virtual Account tidak ditemukan!
									</div>
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>
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