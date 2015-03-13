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
<title>Şifremi Unuttum</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<form action="kontrol.php" method="POST" autocomplete="off">
		<fieldset class="login-form kayit">
			<legend>
				<a href="kayit.php">Kayıt Ol</a>
			</legend>
			<h3>Şifremi Unuttum</h3>
			<hr>
			<input type="text" name="email" placeholder="E-Mail" required><input
				type="text" name="gsoru" placeholder="Gizli cevap" required>

			<button type="submit" name="sifirla" value="sifirla" class="btn">Şifremi
				Sıfırla</button>
		</fieldset>
	</form>

</body>
</html>