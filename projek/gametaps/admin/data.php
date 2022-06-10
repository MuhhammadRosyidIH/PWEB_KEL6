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
$user = $_SESSION["user"];
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
            <span class="navbar-brand mb-0 h1" style="margin-left: 40px;">Halo, selamat datang (Admin)! <span style="margin-left: 10px;">:</span> <strong><?=strtoupper($user["nama"])?></strong></span>
            <div style="margin-right: 40px;">
                <a class="btn btn-primary" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;" data-bs-toggle="modal" data-bs-target="#formtambah"> <i class="bi bi-plus-square me-2"></i>Tambah</a>
                <a class="btn btn-danger" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;" href="logout.php" onclick="return confirm('Apakah anda ingin keluar?');">logout<i class="bi bi-box-arrow-right ms-2"></i></a>
            </div>
        </div>
    </nav>    

    <!-- JUDUL TENGAH -->
    <div class="container" style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
        <h4><strong>GAMEAJA.TAPS</strong></h4>
    </div>

    <!-- Form tambah menggunakan modal -->
    <div class="modal fade" id="formtambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama_game" class="form-label">Nama Game *</label>
                            <input type="text" name="nama_game" class="form-control" id="nama_game" title="Nama Game" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre game</label>
                            <select name="genre" class="form-select" aria-label="Default select" id="genre" title="Genre game">
                                <option value="1" selected>Action</option>
                                <option value="2">Fighting</option>
                                <option value="3">First Person Shooter (FPS)</option>
                                <option value="4">Third Person Shooter (TPS)</option>
                                <option value="5">Real Time Strategy (RTS)</option>
                                <option value="6">Role Playing Game (RPG)</option>
                                <option value="7">Adventure</option>
                                <option value="8">Simulation</option>
                                <option value="9">Sport</option>
                                <option value="10">Racing</option>
                                <option value="11">Multiplayer</option>
                            </select>    
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_rilis" class="form-label">Tanggal Rilis</label>
                            <input name="tanggal_rilis"type="date" title="Masukan Tanggal Rilis" class="form-control" id="tanggal_rilis" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_game" class="form-label">Deskripsi Game *</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi_game" title="Deskripsi Game" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="link_game" class="form-label">Link Game *</label>
                            <input type="text" name="link_game" class="form-control" id="link_game" title="Link Game" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i>Kembali</button>
                            <button type="submit" name="simpan" class="btn btn-success" id="tambah" onclick="return confirm('Apakah anda yakin data yang diinputkan sudah benar?');"><i class="bi bi-save me-2"></i>Simpan Game Baru</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
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

        // Jika tombol simpan film baru ditekan (CREATE)
        $("#tambah").click(function(){

            // Mengambil value dari tiap form
            $nama_game = $("#nama_game").val().toUpperCase();
            $genre = $("#genre").val();
            $tanggal_rilis = $("#tanggal_rilis").val();
            $deskripsi_game = $("#deskripsi_game").val();
            $link_game = $("#link_game").val();
            
            // Koneksi dengan ajax
            $.ajax({
                url: "tambah.php",
                method: "POST",
                data: {
                    nama_game: $nama_game,
                    genre: $genre,
                    tanggal_rilis: $tanggal_rilis,
                    deskripsi_game: $deskripsi_game,
                    link_game: $link_game,
                },

                // Jika sukses maka menampilkan tampil data
                success: function(_){
                    $.ajax({
                        url: "data_tampil.php",
                        success: function(val) {
                            $('#datatampil').html(val);
                        },
                    });
                }
            });
        });
    </script>
</html>