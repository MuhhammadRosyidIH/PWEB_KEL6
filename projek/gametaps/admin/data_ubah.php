<?php
// Set SESSION
session_start();

// Cek sudah login atau belum
if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit;
}

// Koneksi dengan database
require '../conn.php';

// Backup
$id_game = $_SESSION["id_game"];
$genre = $_SESSION["genre"];
$nama_game = $_SESSION["nama_game"];
$tanggal_rilis = $_SESSION["tanggal_rilis"];
$deskripsi_game = $_SESSION["deskripsi_game"];
$link_game = $_SESSION["link_game"];

$query = "UPDATE galeri_game SET
                    id_genre_game = '$genre',
                    nama_game = '$nama_game',
                    tanggal_rilis = '$tanggal_rilis',
                    deskripsi_game = '$deskripsi_game',
                    link_game = '$link_game'
                    WHERE id_galeri_game = $id_game
                    ";
mysqli_query($conn, $query);

$cek = mysqli_affected_rows($conn);
if($cek > 0){
    echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href = 'data.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal diubah');
        </script>
    ";
}


?>