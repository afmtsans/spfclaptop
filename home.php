<?php
//aktifkan session
session_start();

//koneksi database
include "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC LAPTOP</title>

    <!-- css -->
    <!-- boostrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- font -->
    <link rel="stylesheet" href="assets/css/all.css"> 

    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css"> 
<style>
    body {
            background-image: url('assets/img/lapt.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            margin: 3;
        }
</style>
</head>
<body>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-md bg-success navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">SPFC LAPTOP</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="home.php">Home</a>
        </li>
        <!-- Setting hak akses Teknisi -->
     
         <!-- 
        <li class="nav-item ">
            <a class="nav-link" href="?page=users">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=">Konsultasi</a>
        </li> -->


        <!-- Setting hak akses Admin -->
        <?php 
            if($_SESSION['role']=="Admin"){
            
        ?>
        <li class="nav-item ">
            <a class="nav-link" href="?page=users">Users</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="?page=gejala">Gejala</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=kerusakan">Kerusakan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=aturan">Basis Aturan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=datakonsultasi">Data Konsultasi</a>
        </li>

        <?php 
            }else{
        ?>
        <li class="nav-item">
            <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=konsultasipakar">Konsultasi Ke Pakar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=riwayatkonsultasi">Riwayat Konsultasi</a>
        </li>


        <?php 
            }
        ?>
        
        <li class="nav-item">
            <a class="nav-link" href="?page=logout">Logout</a>
        </li>


        </ul>
    </div>
    </nav>

    <!-- Cek status login -->
    <?php 
        if($_SESSION['status']!="y"){
            header("Location:login.php");
        }
    ?>
    <div class="container mt-2 mb-2">


        
        
        <!-- Setting menu -->
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "welcome.php";
        }elseif ($page=="gejala"){
            if ($action==""){
                include "tampil_gejala.php";
            }elseif ($action=="tambah"){
                include "tambah_gejala.php";
            }elseif ($action=="update"){
                include "update_gejala.php";
            }else{
                include "hapus_gejala.php";
            }
            //kerusakan
        }elseif ($page=="kerusakan"){
            if ($action==""){
                include "tampil_kerusakan.php";
            }elseif ($action=="tambah"){
                include "tambah_kerusakan.php";
            }elseif ($action=="update"){
                include "update_kerusakan.php";
            }else{
                include "hapus_kerusakan.php";
            }
        }elseif ($page=="aturan"){
            if ($action==""){
                include "tampil_aturan.php";
            }elseif ($action=="tambah"){
                include "tambah_aturan.php";
            }elseif ($action=="detail"){
                include "detail_aturan.php";
            }elseif ($action=="update"){
                include "update_aturan.php";
            }elseif ($action=="hapus_gejala"){
                include "hapusgej.php";
            }else{
                include "hapus_aturan.php";
            }

        }elseif ($page=="konsultasi"){
            if ($action==""){
                include "tampil_konsultasi.php";
            }else{
                include "hasil_konsultasi.php";
            }
        }elseif ($page=="konsultasipakar"){
            if ($action==""){
                include "konsultasi_pakar.php";
            }
        }elseif ($page=="riwayatkonsultasi"){
            if ($action==""){
                include "tampil_riwayat.php";
            }else if ($action=="lihat"){
                include "hasil_konsultasi.php";
            }else{
                include "hapus_konsultasi.php";
            }

        }elseif ($page=="datakonsultasi"){
            if ($action==""){
                include "data_konsultasi.php";
            }else if ($action=="hasil"){
                include "hasil_konsultasi.php";
            }else {
                include "hapus_datakonsultasi.php";
            }
        }elseif ($page=="users"){
            if ($action==""){
                include "tampil_users.php";
            }elseif ($action=="tambah"){
                include "tambah_users.php";
            }elseif ($action=="update"){
                include "update_users.php";
            }else{
                include "hapus_users.php";
            }
            
        }else{
            include "logout.php";
        }
        ?>
    </div>

     <!-- Footer -->
     <footer class="text-light pt-5 d-flex text-center">
            <span>Copyright &copy; 2024 
            Sistem Pakar Forward Chaining Kerusakan Laptop |
                <a href="#">
                Teknik Informatika Unpam</a></span>
        </footer>
    
<!-- jQuery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- JS -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/datatables.min.js"></script>
<!-- script data table -->
<script>
      $(document).ready(function() {
            $('#myTable').DataTable();
      } );
  </script>

<!-- font -->
<script src="assets/js/all.js"></script>
<!-- CHOOSE -->
<script src="assets/js/chosen.jquery.min.js"></script>
<script>
      $(function() {
        $('.chosen').chosen();
      });
</script>
   
</body>
</html>