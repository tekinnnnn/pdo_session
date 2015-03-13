<?php
require_once 'config.php';

if (isset($_POST["giris"])) {
    $tekin->login("giris", "email", "password", "hatirla");
} elseif (isset($_POST["kayit"])) {
    $tekin->register("kayit", "email", "sifre", "adi", "soyadi", "gsoru");
} elseif (isset($_POST["sifirla"]) && isset($_POST["gsoru"]) && isset($_POST["email"])) {
    $tekin->update_open("sifirla", "gsoru", "email");
} elseif (isset($_POST["ssifirla"]) && isset($_POST["password"]) && isset($_POST["repassword"])) {
    $tekin->update("ssifirla", "password", "repassword");
} elseif (isset($_GET["logout"])) {
    $tekin->logout();
}

?>
<meta charset="utf-8">