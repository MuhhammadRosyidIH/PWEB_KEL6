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

// Mengambil data game dari database
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $game = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM galeri_game WHERE id_galeri_game = '$id'"));
    $tahun = mysqli_fetch_assoc(mysqli_query($conn, "SELECT YEAR(tanggal_rilis) FROM galeri_game WHERE id_galeri_game = '$id'"));
    $bulan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MONTH(tanggal_rilis) FROM galeri_game WHERE id_galeri_game = '$id'"));
    $hari = mysqli_fetch_assoc(mysqli_query($conn, "SELECT DAY(tanggal_rilis) FROM galeri_game WHERE id_galeri_game = '$id'"));

    $tanggal = $hari['DAY(tanggal_rilis)'] . "-" . $bulan['MONTH(tanggal_rilis)'] . "-" . $tahun['YEAR(tanggal_rilis)'];
    
    // Mengambil foreign key genre
    $id_genre = $game["id_genre_game"];
    $genre = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM genre_game WHERE id_genre_game = '$id_genre'")); 
}

// Ketika tombol di tekan
if(isset($_POST["kembali"])){
    header("Location: data.php");
    exit;
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

    <title>Ubah Data Game <?=$game['nama_game']; ?></title>
</head>
<body>
    <nav class="navbar stiky-top navbar-light bg-light fixed-top">
        <div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
            <span class="navbar-brand mb-0 h1" style="margin-left: 40px;"><strong>UBAH DATA : <i><?=$game['nama_game']; ?></i></strong></span>
        </div>
    </nav> 
    <div class="container" style="margin-top: 100px;">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama_game" class="form-label">Nama Game :</label>
                        <input type="text" class="form-control" name="nama_game" id="nama_game" title="Nama game" value="<?=$game['nama_game']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre game :</label>
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
                        <label for="tanggal_rilis" class="form-label">Tanggal Rilis : (<?=$tanggal?>)</label>
                        <input type="date" class="form-control" name="tanggal_rilis" id="tanggal_rilis" title="Tanggal rilis" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_game" class="form-label">Deskripsi Game :</label>
                        <textarea name="deskripsi_game" class="form-control" id="deskripsi_game" title="Deskripsi Game" rows="3" required><?=$game['deskripsi_game']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link_game" class="form-label">Link Game :</label>
                        <input type="text" class="form-control" name="link_game" id="link_game" title="Link game" value="<?=$game['link_game']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id_game" id="id_game" value="<?=$id?>">
                        <a href="data.php" class="btn btn-danger"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                        <button class="btn btn-success ms-2" name="ubah" id="ubah" onclick="return confirm('Apakah anda yakin ingin mengubahnya?')"><i class="bi bi-save me-2"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php

// Jika tombol simpan ditekan
if(isset($_POST["ubah"])){
    
    // Mengambil Variabel yang dikirim
    $id_game = $_POST["id_game"];
    $genre = $_POST["genre"];
    $nama_game = $_POST["nama_game"];
    $tanggal_rilis = $_POST["tanggal_rilis"];
    $deskripsi_game = $_POST["deskripsi_game"];
    $link_game = $_POST["link_game"];

    var_dump($_POST["deskripsi_game"]);

    // Tambah data ke database
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
}

?>

</html>