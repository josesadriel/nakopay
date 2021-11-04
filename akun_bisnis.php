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
                        <h1 class="h3 mb-0 text-gray-800">Register Akun Bisnis</h1>
                        <span class="d-none d-sm-inline-block text-xs">Terakhir Login: <?php echo date("d F Y", strtotime($profile['lastLogin'])); ?></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Transfer ke Rekening</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <b>Nomor Rekening</b>:<br/>
                                        <input type="number" name="noRek" class="form-control form-control-user" value="<?php echo $profile['id_user']; ?>" readonly /><br/>
                                        <input type="hidden" name="noHp" value="<?php echo $profile['no_hp']; ?>" />
                                        <b>Nama Perusahaan</b>:<br/>
                                        <input type="text" name="nama_usaha" class="form-control form-control-user" required/><br/>
                                        <input type="submit" name="e" value="Submit" class="btn btn-primary" />
                                    </form>
                                    <?php
                                    if (isset($_POST['e'])) {
                                        $id = $_POST['noRek'];
                                        $noHp = $_POST['noHp'];
                                        $usaha = $_POST['nama_usaha'];
										$api = rand();
										$api = md5($api);
	
                                        $inputSql = mysqli_query($db, "INSERT INTO `akun_bisnis` (id_user, noHp, nama_usaha, api_key) VALUES ('$id', '$noHp', '$usaha', '$api')");
                                        if ($inputSql) {
                                            $updateSql = mysqli_query($db, "UPDATE `user` SET `status` = 'bisnis' WHERE id_user = '$id'");
                                            $_SESSION['status'] = "bisnis";
                                            echo "<meta http-equiv='refresh' content='0; url=home.php'>";
                                        }
                                    }
                                    ?>
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