<?php
include 'config.php';
if ($tekin->login_check()) {
    echo "<script>window.location.href = 'admin.php';</script>";
}

if (! $tekin->pass_updatable_check()) {
    echo "<script>alert('3 dakika içerisinde işlem yapmadınız. Tekrar gizli soru doğrulama sayfasına yönlendiriliyorsunuz...');</script>";
    echo "<script>window.location.href = 'sifirla.php';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Şifremi Sıfırla</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<form action="kontrol.php" method="POST" autocomplete="off">
		<fieldset class="login-form kayit">
			<legend>
				<a href="kayit.php">Kayıt Ol</a>
			</legend>
			<h3>Şifremi Sıfırla</h3>
			<hr>
			<input type="password" name="password"
				placeholder="Yeni şifrenizi girin.." required> <input
				type="password" name="repassword"
				placeholder="Yeni şifrenizi tekrar girin.." required>

			<button type="submit" name="ssifirla" value="ssifirla" class="btn">Şifremi
				Sıfırla</button>
			<div class="warn">3 dakika içerisinde şifrenizi sıfırlamanız
				gerekmektedir!</div>
		</fieldset>
	</form>

</body>
</html>