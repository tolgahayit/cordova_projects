<?php
include("session.php");
?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilmPedia Giriş</title>

    <!--BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">

    <?php
    if (isset($_SESSION["yonetici"])) {
        header('Location: ana-sayfa.php');
        exit;
    }

    include("config.php");

    if ($_POST) {
        //veritabanı sorgulaması yapılacak eğer kullanıcı sisteme kayıtlı ise ana sayfaya yönlendirecek.
        $eposta = $_POST["eposta"];
        $sifre = md5($_POST["sifre"]);

        //print_r($_POST);

        //böyle bir kullanıcı var mı yok mu?
        $veriler = $mysqli->query("select * from yoneticiler where eposta='$eposta' and sifre='$sifre'");
        if (mysqli_num_rows($veriler)) {
            //giriş başarılı mesajı gösterilir
            echo '<div class="container"><div class="alert alert-success text-center" role="alert">
            Giriş başarılı yönlendiriliyorsunuz...
          </div></div>';

            //3 sn sonra yönlendirici kod eklenir Bkz. header() fonksiyonu
            header("Refresh:3; url=ana-sayfa.php", true, 303);

            //Kullanıcı SESSION kaydı yedeklenir
            $row = mysqli_fetch_array($veriler);
            $_SESSION["yonetici"] = $row;
        } else {
            echo '<div class="container"><div class="alert alert-danger text-center" role="alert">
            Sistemde böyle bir kullanıcı yoktur!
          </div></div>';
        }
    }
    ?>
</head>

<body class="d-flex flex-column h-100">
    <div class="container">
        <div class="row">
            <h1 class="text-center">Yönetici Giriş Ekranı</h1>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="" method="POST" class="row g-3 needs-validation mt-4" novalidate>
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Eposta Adresi</label>
                        <input type="email" name="eposta" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Lütfen e-posta adresinizi kontrol ediniz.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Şifre</label>
                        <input name="sifre" type="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Beni hatırla</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block">Gönder</button>
                    </div>

                </form>
            </div>
            <div class="col"></div>

        </div>

    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">FilmPedia &copy; 2020. Tüm hakkı saklıdır.</span>
        </div>
    </footer>
</body>

<script src="js/custom.js"></script>

<!--BootStrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</html>