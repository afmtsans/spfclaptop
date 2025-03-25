<!-- proses login -->
<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    //mengambil data dari form
    $username=$_POST["username"];
    $pass=md5($_POST["pass"]);

    //cek username & password
    $sql = "SELECT*FROM users where username='$username' and pass='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        
        //jika login sukses
        //membuat sesi
        $_SESSION['idusers'] = $row["idusers"];
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['status'] = "y";
        
    
       header("Location:home.php");

    } else {
        //jika login gagal
        header("Location:?msg=n");
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

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

<!-- validasi login gagal -->
<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login gagal, username atau password salah!</strong>
    </div>
    <?php
    }       
}
?>



<div class="container-fluid" style="margin-top:150px">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <div class=" text-success text-center text-border-dark">
                        <strong>SPFC KERUSAKAN LAPTOP</strong>
                        
                    </div>
            <form method="POST">
                <div class="card border-dark">
                    <div class="card-header bg-success text-light text-center border-dark">
                        <strong>LOGIN</strong>
                    </div>
                    <div class="card-body border">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
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
                        <input type="submit" class="btn btn-success" name="submit" value="Login">
                        <label for="">Belum punya akun?</label>
                        <a href="register.php">Daftar sekarang</a>
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