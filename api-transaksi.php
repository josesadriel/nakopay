<?php
include("koneksi.php");
if (isset($_GET['api'])) {
	$api = $_GET['api'];
	$noRek = "";
	$cekApi = mysqli_query($db, "SELECT * FROM `akun_bisnis` WHERE `api_key` = '$api'");
	if (mysqli_num_rows($cekApi) > 0) {
		while ($user = mysqli_fetch_array($cekApi)) {
			$noRek = $user['id_user'];
		}
	}
    $keyword = $_GET['q'] ?? '';
    if (isset($_GET['q']) && $_GET['q'] != '') {
        $transaksi = mysqli_query($db, "SELECT `payment`.*, `akun_bisnis`.`api_key` FROM `payment` INNER JOIN `akun_bisnis` ON `payment`.`pemilik` = `akun_bisnis`.`id_user` WHERE `payment`.`pemilik` = '$noRek' AND `payment`.`kode` = '$keyword' AND `akun_bisnis`.`api_key` = '$api';");
    }
    else $transaksi = mysqli_query($db, "SELECT `payment`.* FROM `payment` INNER JOIN `akun_bisnis` ON `payment`.`pemilik` = `akun_bisnis`.`id_user` WHERE `akun_bisnis`.`api_key` = '$api';");
    if (mysqli_num_rows($transaksi) > 0) {
        while ($dTrans = mysqli_fetch_array($transaksi)) {
            $item[] = array (
                "kode" => $dTrans["kode"],
                "nominal" => $dTrans["nominal"],
                "status" => $dTrans["status"],
                "date" => $dTrans["dibuat"],
                "username" => $dTrans["username"]
            );
        }
    }
    else {
        $item[] = array(
            "kode" => null,
            "nominal" => null,
            "status" => null,
            "date" => null,
            "username" => null
        );
    }
    $data = mysqli_query($db, "SELECT `payment`.* FROM `payment` INNER JOIN `akun_bisnis` ON `payment`.`pemilik` = `akun_bisnis`.`id_user` WHERE `akun_bisnis`.`api_key` = '$api';");
    if (mysqli_num_rows($data) > 0) {
        $json = array (
            'result' => 'Sukses',
            'item' => $item
        );
    }
    else {
        $json = array (
            'result' => 'Gagal',
            'error' => 'Data tidak ditemukan'
        );
    }
    echo json_encode($json);
} 