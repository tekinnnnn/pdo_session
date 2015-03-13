<?php
include 'config.php';
if ($tekin->login_check()) {
    echo "<script>window.location.href = 'admin.php';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kayıt Ol</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<form action="kontrol.php" method="POST" autocomplete="off">
		<fieldset class="login-form kayit">
			<legend>
				<a href="giris.php">Giriş Yap</a>
			</legend>
			<h3>Kayıt Ol</h3>
			<hr>
			<input type="text" name="adi" placeholder="Adınız" required> <input
				type="text" name="soyadi" placeholder="Soyadınız.." required> <input
				type="text" name="email" placeholder="E-Mail" required> <input
				type="password" name="sifre" placeholder="Şifre" required> <input
				type="text" name="gsoru" placeholder="Gizli Sorunuz" required>

			<button type="submit" name="kayit" value="kayit" class="btn">Kayıt Ol</button>
		</fieldset>
	</form>

</body>
</html>