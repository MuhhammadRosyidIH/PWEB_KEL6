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

// Hapus data
$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM galeri_game WHERE id_galeri_game = $id");
$cek = mysqli_affected_rows($conn);
if (($cek) > 0) {
    echo "
        <script>
            document.location.href = 'data.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus');
        </script>
    ";
};
?>