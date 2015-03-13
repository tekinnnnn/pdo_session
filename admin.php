<?php
include 'config.php';

if (! $tekin->login_check()) {
    echo "<script>window.location.href = './';</script>";
} else {
echo "Hoşgeldiniz " . $_SESSION["u_name"] . " " . $_SESSION["u_sname"] . ' <a href="kontrol.php?logout">Çıkış Yap</a>';
print_r($_SESSION);
}
?>
<meta charset="utf-8">
