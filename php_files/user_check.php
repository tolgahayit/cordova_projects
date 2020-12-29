<?php

$sonuc = false;

if ($_POST){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    /*
    MySQL Bağlantısı
    */
    $mysqli = new mysqli("localhost", "admin", "123123", "sample_app");
    if (!$mysqli) {
        echo 'Veritabanina baglanilamiyor ...' . $mysqli->error;
        exit();
    }


    /*
    gerek yok
    $mysqli->query("SET NAMES utf8");
    $mysqli->query("SET CHARACTER SET utf8");
    $mysqli->query("SET COLLATION_CONNECTION='utf8_general_ci'");*/


    //Kullanıcı sorgulama
    $data = $mysqli->query("select * from users where username='$username' and password='$password'");

    if (mysqli_num_rows($data)) {
        $sonuc = true;
    }
}

echo $sonuc;

mysqli_close($mysqli);