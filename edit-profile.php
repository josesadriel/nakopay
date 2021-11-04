<html>
	<head>
		<?php include('koneksi.php'); ?>
		<title>Profile</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
	<body>
		<?php
			session_start();
			if (empty($_SESSION['id_user'])) {
				header('Location: login.php');
			}
			$idUser = $_SESSION['id_user'];
			$cekUser = mysqli_query($db, "SELECT * FROM user WHERE id_user = '$idUser'");
			$result = mysqli_num_rows($cekUser);
			if ($result > 0) {
				while($user = mysqli_fetch_assoc($cekUser)) {
		?>
		<form action="" method="post">
			<div>
				<h2>Edit Profile</h2>
				<b>Nama</b>:<br/>
				<input type="text" name="namaBaru" value="<?php echo $user['nama']; ?>" disabled/><br/>
				<b>Alamat</b>:<br/>
				<textarea name="alamatBaru" placeholder="<?php echo $user['alamat']; ?>"></textarea><br/>
			</div>
			<div>
				<h2>Ganti PIN</h2>
				<b>PIN Lama</b>:<br/>
				<input type="password" pattern="[0-9]*" name="pinLama" inputmode="numeric"/><br/>
				<b>PIN Baru</b>:<br/>
				<input type="password" pattern="[0-9]*" name="pinBaru" inputmode="numeric"/><br/>
				<b>Konfirmasi PIN Baru</b>:<br/>
				<input type="password" pattern="[0-9]*" name="validPin" inputmode="numeric"/><br/>
			</div>
			<input type="submit" value="Submit" name="edit"/>
		</form>
		<?php
					$gantiPIN = false;
					if (isset($_POST['pinLama'])) {
						$pinLama = $_POST['pinLama'];
						if ($pinLama == $user['pin']) {
							$gantiPIN = true;
						}
					}
				}
			}
		?>
		<?php
			if (isset($_POST['edit'])) {
				if (isset($_POST['alamatBaru'])) {
					$alamat = $_POST['alamatBaru'];
				}
				if ($gantiPIN == true) {
					$pinBaru = $_POST['pinBaru'];
					$vpinBaru = $_POST['validPin'];
					if ($pinBaru == $vpinBaru) {
						if (isset($alamat)) {
							$qeProfile = mysqli_query($db, "UPDATE user SET alamat = '$alamat', pin = '$pinBaru'");
							if ($qeProfile) {
								header('Location: profile.php');
							}
						}
						else if (!isset($alamat)) {
							$qeProfile = mysqli_query($db, "UPDATE user SET pin = '$pinBaru'");
							if ($qeProfile) {
								header('Location: profile.php');
							}
						}
					}
					else echo "PIN baru dengan konfirmasi PIN tidak sama!";
				}
				else if ($gantiPIN == false) {
					if (isset($alamat)) {
						$qeProfile = mysqli_query($db, "UPDATE user SET alamat = '$alamat'");
						if ($qeProfile) {
							header('Location: profile.php');
						}
					}
				}
			}
		?>
		<br/>
		<a href="home.php" title="home">< Home</a>
	</body>
</html>