<?php
include("koneksi.php");
session_start();
$tanggal = date("Y-m-d");
$id = $_SESSION['id_user'];
$updateLast = mysqli_query($db, "UPDATE `user` SET lastLogin = '$tanggal' WHERE id_user = '$id'");
if ($updateLast){
	session_destroy();
	header("Location: login.php");
}
?>