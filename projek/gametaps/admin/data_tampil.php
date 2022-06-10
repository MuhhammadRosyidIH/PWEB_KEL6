<!-- Untuk menampilkan data -->

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

// Mengambil data game dari database
$gamesbase = mysqli_query($conn, "SELECT * FROM galeri_game"); 
while($game = mysqli_fetch_assoc($gamesbase)){

    // Mengambil id genre foreign key dari dalam tabel galeri game
    $id_genre = $game["id_genre_game"];
    $genre = mysqli_fetch_assoc(mysqli_query($conn, "SELECT genre FROM genre_game WHERE id_genre_game = $id_genre"));
    
    echo '
        <div class="wadah" style="display: none;">
            <div class="container card" style="width: 20%; margin-bottom: 40px; margin-left: 55px; float: left;">
                <div class="card-body" style="width: 100%; height: 200px;">
                    <h5 class="card-title" style="text-align: center; margin-top: 50px;">'. $game["nama_game"] .'</h5>   
                </div>
                <div class="container" style="position: relative; margin-top: -50px; margin-bottom: -30px;">
                    <p class="card-text" style="">Genre Game :<br>'. $genre["genre"] .'</p>
                </div> 
                <center style="margin-bottom: 30px; margin-top: 50px;">
                    <div class="detail_game d-flex justify-content-around" >
                        <a style="position: relative;" href="ubah.php?id='. $game["id_galeri_game"] .'" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <a style="width: 50%; position: relative;" href="detail_game.php?id='. $game["id_galeri_game"] .'" class="btn btn-success">Detail Game</a>
                        <a style="position: relative;" href="hapus.php?id='. $game["id_galeri_game"] .'" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                    </div>
                </center>
            </div>
        </div>
    ';

}
?>


<script>

    // === Script Load More === //

    // Tampil 4 card pertama
    $(".wadah").slice(0, 4).show()

    // Jika diklik
    $(".tombol").on("click",function(){

        // Maka akan menampilkan 8 card berikutnya
        $(".wadah:hidden").slice(0, 8).slideDown()
        if ($(".wadah:hidden").length == 0) {
            $(".tombol").fadeOut("slow")
        }
    })

</script>     