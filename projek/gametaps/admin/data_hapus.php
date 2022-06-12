<?php
// Set SESSION
session_start();

// Cek sudah login atau belum
if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET["id"];
$_SESSION["id"] = $id;
header("Location: hapus.php");
?>

<input type="hidden" id="id_game" value="<?=$id?>">

<!-- Script JQuery -->
<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>


<!-- Script AJAX (CRUD) -->
<script type="text/javascript">

    // Mengambil value id
    var id_game = $("#id_game").val();

    // Koneksi dengan ajax (DELETE)
    $.ajax({
        url: "hapus.php",
        method: "POST",
        data: {
            id: id_game,
        },

    });
</script>