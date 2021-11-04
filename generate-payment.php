<?php
include("koneksi.php");
if (isset($_POST['e'])) {
	$kode = $_POST['kode'];
	$callback = $_POST['callback'];
	$item = $_POST['item'];
	$nominal = $_POST['nominal'];
	$akun = $_POST['akun'];
	$namaUser = $_POST['username'];

	$searchAkun = mysqli_query($db, "SELECT * FROM `akun_bisnis` WHERE noHp = '$akun'");
	if (mysqli_num_rows($searchAkun) > 0) {
		$noRek = "09".$akun;
		$inputKode = mysqli_query($db, "INSERT INTO `payment` (kode, item, nominal, pemilik, username) VALUES ('$kode', '$item', '$nominal', '$noRek', '$namaUser')");
		if ($inputKode) {
			echo "<meta http-equiv='refresh' content='0; url=" . $callback . "?kode=" . $kode . "&item=" . $item . "&nominal=" . $nominal ."'>";
		}
	}
}
?>