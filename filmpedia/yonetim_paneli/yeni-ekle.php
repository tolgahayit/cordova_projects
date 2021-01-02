<?php
include("session.php");
?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Listesi</title>

    <!--BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/custom.css">

    <?php
    if (!isset($_SESSION["yonetici"])) {
        header('Location: index.php');
        exit;
    }

    if ($_GET["cikis-yap"] == "ok") {
        // mevcut tüm SESSION'ları sil
        session_unset();
        header('Location: index.php');
        exit;
    }

    include("config.php");

    $sonuc = false;
    if ($_POST) {
        //diğer inputlar
        $film_adi = $_POST["film_adi"];
        $aciklama = nl2br($_POST["aciklama"]);
        $imdb_link = $_POST["imdb_link"];

        //dosya kaydetme
        $hedef_klasor = "afisler/";
        $hedef_dosya = $hedef_klasor . basename($_FILES["afis_url"]["name"]);

        if (move_uploaded_file($_FILES["afis_url"]["tmp_name"], $hedef_dosya)) {
            $afis_url = $hedef_dosya;
        }

        $mysqli->query("insert into filmler (adi, aciklama, afis_url, imdb_link) values ('$film_adi', '$aciklama', '$afis_url', '$imdb_link')");
        $sonuc = true;
    }
    ?>
</head>

<body class="d-flex flex-column h-100">
    <div class="container">
        <?php 
        if($sonuc){
        ?>
        <div class="alert alert-success text-center" role="alert">
            Film Ekleme Başarılı
        </div>
        <?php 
        }
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-top">
                    FilmPedia
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="ana-sayfa.php">Film Listesi</a>
                        <a class="nav-link" href="?cikis-yap=ok">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container mt-4 bg-light">
        <div class="card border-dark mb-3">
            <div class="card-header">Yeni Film Ekle</div>
            <div class="card-body text-dark">
                <div class="row">
                    <div class="col">
                        <form action="" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                            <div>
                                <label for="filmAdi" class="form-label">Film Adı</label>
                                <input type="text" name="film_adi" class="form-control" id="filmAdi" required>
                                <div class="invalid-feedback">
                                    Lütfen filmin adını giriniz.
                                </div>
                            </div>
                            <div>
                                <label for="filmOzeti" class="form-label">Film Özeti</label>
                                <textarea class="form-control" name="aciklama" id="filmOzeti" cols="30" rows="10"></textarea>
                            </div>
                            <div>
                                <label for="filmAfis" class="form-label">Film Afişi</label>
                                <input type="file" name="afis_url" class="form-control" id="filmAfis">
                            </div>
                            <div>
                                <label for="imdb" class="form-label">IMDB Link</label>
                                <input type="text" name="imdb_link" class="form-control" id="imdb">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Film Ekle</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
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