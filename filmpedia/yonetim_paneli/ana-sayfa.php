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
    ?>
</head>

<body class="d-flex flex-column h-100">
    <div class="container">
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
        <?php 
        if(isset($_GET["sil"])){
            $id = $_GET["sil"];
            $veriler = $mysqli->query("select * from filmler where id=$id");
            $row = mysqli_fetch_array($veriler);

            $mysqli->query("delete from filmler where id=$id");
        ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $row["adi"]; ?> filmi silindi!
        </div>
        <?php 
        }
        ?>
        <div class="card border-dark mb-3">
            <div class="card-header">Film Listesi <a class="btn btn-secondary btn-sm float-end" href="yeni-ekle.php" role="button">Yeni Ekle</a></div>
            <div class="card-body text-dark">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="20%">Film Adı</th>
                            <th scope="col" width="43%">Film Özeti</th>
                            <th scope="col" width="20%">Film Afişi</th>
                            <th scope="col" width="10%">IMDB</th>
                            <th scope="col" width="7%">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $veriler = $mysqli->query("select * from filmler");
                        while ($row = mysqli_fetch_array($veriler)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $row["adi"]; ?></td>
                                <td><p><?php echo $row["aciklama"]; ?></p></td>
                                <td><img src="<?php echo $row["afis_url"]; ?>" class="img-fluid" style="max-height:300px;"></td>
                                <td><a href="<?php echo $row["imdb_link"]; ?>" target="_blank">Tıklayınız</a></td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="ana-sayfa.php?sil=<?php echo $row["id"]; ?>" role="button"><i class="bi bi-trash-fill"></i></a>
                                    <a class="btn btn-primary btn-sm" href="film-duzenle.php?id=<?php echo $row["id"]; ?>" role="button"><i class="bi bi-pencil-square"></i></a>
                                </td>
                            </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Toplam Film Sayısı:
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