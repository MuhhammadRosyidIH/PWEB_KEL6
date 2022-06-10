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

// Menangkap data session
$user = $_SESSION["nama_user"];

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

    <title>GAMEAJA.TAPS</title>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar stiky-top navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1" style="margin-left: 40px;">Halo, selamat datang (Customer)! <span style="margin-left: 10px;">:</span> <strong><?=strtoupper($user)?></strong></span>
            <div style="margin-right: 40px;">
                <a class="btn btn-danger" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;" href="logout.php" onclick="return confirm('Apakah anda ingin keluar?');">logout<i class="bi bi-box-arrow-right ms-2"></i></a>
            </div>
        </div>
    </nav>    

    <!-- JUDUL TENGAH -->
    <div class="container" style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
        <h4><strong>GAMEAJA.TAPS</strong></h4>
    </div>

    <!-- Pemanggilan Card & Load more-->
    <div id="datatampil">

    </div>


    <div class="footer" align="center" style="margin-bottom: 50px;">
        <button class="tombol btn btn-secondary load-more"><i class="bi bi-arrow-clockwise me-2"></i>Load More</button>
    </div>

</body>

    <!-- Script JQuery -->
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>


    <!-- Script AJAX (CRUD) -->
    <script type="text/javascript">

        // Mengambil data dengan menggunakan AJAX (READ)
        $.ajax({
            url: "data_tampil.php",
            success: function(val) {
                $('#datatampil').html(val);
            },
        });
    </script>
</html>