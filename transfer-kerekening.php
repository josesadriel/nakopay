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

    <title>Transfer ke Rekening</title>

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
						}
						if (isset($_SESSION['id_user'])) {
							$id = $_SESSION['id_user'];
							$sql = mysqli_query($db, "SELECT * FROM user WHERE id_user = $id");
							while ($user = mysqli_fetch_array($sql)) {
								$balance = $user['saldo'];
						?>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Transfer</h1>
							<span class="d-none d-sm-inline-block text-xs">Terakhir Login: <?php echo date("d F Y", strtotime($user['lastLogin'])); ?></span>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="card shadow mb-4">
										<div class="card-header py-3">
											<h6 class="m-0 font-weight-bold text-primary">Transfer ke Rekening</h6>
										</div>
										<div class="card-body">
											<form action="" method="post">
												<div class="form-group d-sm-flex align-items-center">
													<input type="text" class="form-control form-control-user col-sm-7 mr-2" id="targetId" name="targetId" value="<?= $fixTarget ?? '' ?>" pattern="^09[0-9]{13}$" placeholder="Masukkan Nomor Rekening Tujuan..." title="Nomor Rekening harus berupa 15 digit angka!" maxlength="15" style="display:inline" required />
													<button type="button" id="cari" class="btn btn-info btn-icon-split btn-sm" onclick="location.href='?target=' + document.getElementById('targetId').value">
														<span class="icon text-white-50">
															<i class="fas fa-search"></i>
														</span>
														<span class="text">Cari</span>
													</button>
													<button type="button" id="batalkan" class="btn btn-danger btn-icon-split btn-sm" onclick="location.href='transfer-kerekening.php'" style="display:none">
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
													<input type="number" class="form-control form-control-user col-sm-7" name="nominal" placeholder="Nominal Pengiriman..." title="Masukkan nominal yang ingin dikirim!" required />
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
														$rekTarget = $_POST['targetId'];
														$nominal = $_POST['nominal'];
														$id = $_SESSION['id_user'];
														$cobaRand = rand(10,99);
														$transferId1 = "0" . strval(date("jnyHis")) . $cobaRand;
														$transferId2 = "1" . strval(date("jnyHis")) . $cobaRand;
														$deskripsi1 = "Transfer Rp. " . $nominal . " ke " . $rekTarget;
                                                        $deksripsi2 = "Menerima uang Rp. " . $nominal . " dari " . $id;
														
														$sendSql = mysqli_query($db, "UPDATE `user` SET `saldo` = `saldo` + '$nominal' WHERE id_user = '$rekTarget'");
														$decreaseSql = mysqli_query($db, "UPDATE `user` SET `saldo` = `saldo` - '$nominal' WHERE id_user = '$id'");
														$insertLog = mysqli_query($db, "INSERT INTO `transaksi` (id_transaksi, id_user, target_user, nominal, kategori, deskripsi) VALUES ('$transferId1', '$id', '$rekTarget', '$nominal', 'credit', '$deskripsi1'), ('$transferId2', '$rekTarget', '$id', '$nominal', 'debit', '$deksripsi2')");
														if ($sendSql && $decreaseSql && $insertLog) {
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
					$cekUser = mysqli_query($db, "SELECT * FROM user WHERE id_user = '$target' AND NOT id_user = '$id'");
					if(mysqli_num_rows($cekUser) > 0) {
						while($target = mysqli_fetch_array($cekUser)) {
				?>
						<!-- Target Ditemukan -->
						<div class="modal fade" id="targetUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Profil Target</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="table-responsive">
											<div class="col-sm-12">
												<table width="100%">
													<tr>
														<td width="135px" align="center">
															<img src="profile/<?php echo $target['profile_img']; ?>" width="95px" height="95px" class="img-fluid px-6 px-sm-7 mt-1 mb-2" />
														</td>
														<td valign="middle">
															<big><?php echo $target['nama']; ?></big>
															<br/>
															<?php echo $target['id_user'];?><br/>
														</td>
													</tr>
												</table>
												<br/>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<form action="transfer-kerekening.php" method="post">
											<input type="hidden" name="targetId" value="<?php echo $target['id_user'];?>"/>
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
										<h5 class="modal-title" id="exampleModalLabel">Profil Target</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										Tidak ditemukan
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