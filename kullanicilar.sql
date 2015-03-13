-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Mar 2015, 01:42:20
-- Sunucu sürümü: 5.5.42
-- PHP Sürümü: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `kullanici_giris`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE latin5_bin NOT NULL,
  `sifre` varchar(32) COLLATE latin5_bin NOT NULL,
  `adi` varchar(50) COLLATE latin5_bin NOT NULL,
  `soyadi` varchar(50) COLLATE latin5_bin NOT NULL,
  `tarih` datetime NOT NULL,
  `gsoru` varchar(256) COLLATE latin5_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin5 COLLATE=latin5_bin;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `mail`, `sifre`, `adi`, `soyadi`, `tarih`, `gsoru`) VALUES
(1, 'mail@mail.com', '202cb962ac59075b964b07152d234b70', 'Tekin', 'Aydoğdu', '2015-03-11 11:22:03', 'qwe'),
(2, 'asd', '202cb962ac59075b964b07152d234b70', 'asd', 'asd', '2015-03-11 13:05:25', 'qwe'),
(12, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe', 'qwe', '2015-03-14 00:38:55', 'qwe'),
(13, 'zxc', '5fa72358f0b4fb4f2c5d7de8c9a41846', 'zxc', 'zxc', '2015-03-14 00:39:10', 'zxc');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
