<?php
error_reporting();
/*
MySQL Bağlantısı
*/
$mysqli = new mysqli("localhost", "admin", "123123", "filmpedia");
if ($mysqli -> connect_errno) {
    echo 'Veritabanina baglanilamiyor ...' . $mysqli -> connect_error;
    exit();
}

$mysqli->query("SET NAMES utf8");
$mysqli->query("SET CHARACTER SET utf8");
$mysqli->query("SET COLLATION_CONNECTION='utf8_general_ci'");
?>