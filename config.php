<?php
include 'class.php';

$host = "localhost";
$db = "kullanici_giris";
$table = "kullanicilar";
$user = "root";
$pass = "";

global $tekin;

$tekin = new session($host, $db, $table, $user, $pass);

?>