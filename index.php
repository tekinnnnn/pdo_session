<?php
include 'config.php';
$tekin->login_check();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kullanıcı İşlemleri</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<div class="login-form" style="text-align: center">
		<a class="btn block" href="giris.php">Giriş Yap</a> <a
			class="btn block" href="kayit.php">Kayıt Ol</a> <a class="btn block"
			href="sifirla.php">Şifremi Unuttum</a>
	</div>
</body>

</html>