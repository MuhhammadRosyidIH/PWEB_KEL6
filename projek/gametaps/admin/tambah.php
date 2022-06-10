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

// Mengambil Variabel yang dikirim
$genre = $_POST["genre"];
$nama_game = $_POST["nama_game"];
$tanggal_rilis = $_POST["tanggal_rilis"];
$deskripsi_game = $_POST["deskripsi_game"];
$link_game = $_POST["link_game"];

// Tambah data ke database
$query = "INSERT INTO galeri_game
                VALUES
                ('', '$genre', '$nama_game', '$tanggal_rilis', '$deskripsi_game', '$link_game') 
                ";
mysqli_query($conn, $query);

?>