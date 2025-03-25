<?php 
//koneksi database
include "config.php";

if (isset($_POST['submit'])) {
    //mengambil data
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);
    
    //cek apakah username sudah ada
    $checkUserQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUserQuery);
    
    if ($result->num_rows > 0) {
        //username sudah ada
        echo "<script>alert('Username sudah digunakan');</script>";
    } else {
        //proses simpan
        $sql = "INSERT INTO users VALUES (Null, '$nama', '$no_hp', '$username', '$pass', 'User')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Registrasi berhasil!');
            window.location.href='login.php';
          </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('assets/img/pexels-madebymath-331684.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            margin: 3;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .password-container {
            position: relative;
        }
        .password-container input {
            padding-right: 40px; /* Beri ruang untuk ikon mata */
            width: 100%; /* Sesuaikan dengan kebutuhan Anda */
        }
        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

    </style>
</head>
<body>




<div class="container-fluid" style="margin-top:150px">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
                <div class=" text-info text-center text-border-dark">
                        <strong>SPFC KERUSAKAN LAPTOP</strong>
                        </div>
            <form method="POST">
                <div class="card border-dark">
                
                    <div class="card-header bg-info text-light text-center border-dark">
                        
                        <strong>REGISTRASI AKUN BARU</strong>
                    </div>
                    <div class="card-body border">
                    <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Hp / Whatsapp</label>
                            <input type="text" class="form-control" name="no_hp" maxlength="15" required>
                        </div>
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" name="username" maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="password-container">
                            <input type="password" id="password" class="form-control" name="pass" maxlength="200" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <img src="assets/img/eye2.png" alt="Toggle Password Visibility" width="30" height="20"
                                </span>
                            </div></br>

                               
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <label for="">Sudah punya akun?</label>
                        <a href="login.php">Masuk</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JQuery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        }
    </script>
</body>
</html>