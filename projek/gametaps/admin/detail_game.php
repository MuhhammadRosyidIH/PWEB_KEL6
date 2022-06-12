<?php

// Set SESSION
session_start();

// Cek sudah login atau belum
if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit;
}

// Koneksi ke conn.php
require "../conn.php";

// Cek tombol Download ditekan
if(isset($_POST["download"])){
    $game_title = $_POST["nama_game"];
    $link = "Location: ";
    $link .= $_POST["link_game"];

    // Cek ada link atau tidak
    if(isset($_POST["link_game"])){
        header($link);
        exit;
    } elseif(!isset($_POST["link_game"])){
        echo "
            <script>
                alert('Game $game_title tidak tersedia');
            </script>
            ";

    }
}

// Mengambil data game dari database
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $game = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM galeri_game WHERE id_galeri_game = '$id'"));
    $tanggal_rilis = mysqli_fetch_assoc(mysqli_query($conn, "SELECT YEAR(tanggal_rilis) FROM galeri_game WHERE id_galeri_game = '$id'"));

    // Mengambil foreign key genre
    $id_genre = $game["id_genre_game"];
    $genre = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM genre_game WHERE id_genre_game = '$id_genre'")); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Modul -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <title>Download Game <?=$game["nama_game"]?></title>
</head>
<body>
    <nav class="navbar stiky-top navbar-light bg-light">
        <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
            <span class="navbar-brand mb-0 h1" style="margin-left: 40px;"><strong><i><?=$game["nama_game"]?></i></strong></span>
        </div>
    </nav> 
    <div class="container" style="margin-top: 50px;">
        <div class="card">
            <div class="card-body">
                <div style="margin-top: 20px;">
                    <h5>Nama Game <span style="margin-left: 80px;">:</span><strong style="margin-left: 10px;">"<?=$game["nama_game"]?>"</strong></h5>
                </div>
                <div style="margin-top: 20px;">
                    <h5>Genre Game <span style="margin-left: 80px;">:</span><i style="margin-left: 10px;"><?=$genre["genre"]?></i></h5>
                </div>
                <div style="margin-top: 20px;">
                    <h5>Tahun Terbit <span style="margin-left: 80px;">:</span><a style="margin-left: 10px;"><?=$tanggal_rilis["YEAR(tanggal_rilis)"]?></a></h5>
                </div>
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <h5>Deskripsi Game <span style="margin-left: 51px;">:</span></h5>
                    <p style="font-style: italic; margin-top: 20px;" align="justify">"<?=$game['deskripsi_game']?>"</p>
                </div>
                <div class="d-flex">
                    <form action="" method="POST">
                        <input type="hidden" name="nama_game" value="<?=$game["nama_game"]?>">
                        <input type="hidden" name="link_game" value="<?=$game["link_game"]?>">
                        <a href="data.php" class="btn btn-danger" style=""><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                        <button class="btn btn-success" style="margin-left: 20px;" type="submit" name="download"><i class="bi bi-download me-2"></i>Link Download</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>