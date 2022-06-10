<?php
// Set SESSION
session_start();

// Cek sudah login atau belum
if(isset($_SESSION["login"])){
    if(isset($_SESSION["customer"])){
        header("Location: customer/data.php");
        exit;
    } elseif(isset($_SESSION["admin"])){
        header("Location: admin/data.php");
        exit;
    }
    
}


// Koneksi ke conn.php
require "conn.php";

// Tombol Login di cek
if(isset($_POST["login"])){

    // Mencari akun customer yang sesuai di database
    $email = $_POST["email"];
    $password = $_POST["password"];
    $emailresult = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$email'");
    $cekemail = mysqli_fetch_assoc($emailresult);

    // Cek email Customer
    if($cekemail["email"] === "customer@gmail.com"){
        
        // Membongkar data menjadi array
        $user = $cekemail;

        if(password_verify($password, $user["password_hash"])){
            
            // Mengirim data SESSION
            $_SESSION["nama_user"] = $_POST["nama_lengkap"];
            $_SESSION["login"] = true;
            $_SESSION["customer"] = true;
            
            header("Location: customer/data.php");
            exit;
        } else {
            echo "<script>
                alert('Password yang diinputkan salah');
                </script>";
        }
    } 
    
    // Cek email Admin
    elseif(mysqli_num_rows($emailresult) === 1) {
        
        // Membongkar data menjadi array
        $user = $cekemail;

        if(password_verify($password, $user["password_hash"])){
            
            // Mengirim data SESSION
            $_SESSION["user"] = $user;
            $_SESSION["login"] = true;
            $_SESSION["admin"] = true;

            header("Location: admin/data.php");
            exit;
        } else {
            echo "<script>
                alert('Password yang diinputkan salah');
                </script>";
        }

    } else {
        echo "<script>
                alert('Username/email tidak ditemukan');
                alert('Gunakan email : customer@gmail.com ; password : Customer123_ sementara untuk login');
            </script>";
    }

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

    <title>Login GAMEAJA.TAPS</title>
</head>
<body>

    <!-- FORM LOGIN -->
    <center>
        <div class="card" style="width: 18rem; margin-top: 100px">
            <div class="card-body">
                <h5 class="card-title" style="margin-top: 10px; text-align: center">LOGIN DULU!</h5>
                    <form action="" method="POST">
                        <div calss="container" style="text-align: left;">

                        <!-- INPUT LABEL -->
                            <div class="mb-3" style="margin-top: 50px;">
                                <label for="InputEmail" class="form-label">Email :</label>
                                <input type="email" title="Masukkan Email" name="email" class="form-control" id="InputEmail" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="InputName" class="form-label">Nama Lengkap :</label>
                                <input type="text"  title="Masukkan Nama Lengkap" name="nama_lengkap" class="form-control" id="InputName" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="InputPassword" class="form-label">Password :</label>
                                <input type="password"  title="Masukkan Password" name="password" class="form-control" id="InputPassword" required>
                            </div>

                        </div>

                        <!-- TOMBOL -->
                        <button type="submit" name="login" class="btn btn-primary" name="login" width="40px"><i class="bi bi-box-arrow-in-left me-2"></i>Login</button>
                        <a class="btn btn-danger" style="margin-left: 10px;" href="keluar.php">Kembali<i class="bi bi-box-arrow-right ms-2"></i></a>   
                    </form>
            </div>  
        </div>
    </center>
</body>
</html>