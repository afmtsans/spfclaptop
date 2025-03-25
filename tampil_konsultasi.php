<?php
//tanggal defaul skrng
date_default_timezone_set("Asia/Jakarta");

// roses menampilkan data Hasil konsultasi -->
    // Mengambil id
    $idusers = $_SESSION['idusers'];

    // Periksa koneksi ke database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query SQL untuk mendapatkan detail basis aturan
    $sql = "SELECT * FROM users where idusers = '$idusers'";
    $result5 = $conn->query($sql);
    // Periksa apakah query berhasil dieksekusi
    if ($result5 === false) {
        die("Error executing query: " . $conn->error);
    }
    // Fetch hasil query
    $row5 = $result5->fetch_assoc();

//PROSESSSSS
if(isset($_POST['proses'])){

    //Mengambil data dari form
    $idusers=$_POST['idusers'];
    $nama=$_POST['nama'];
    $tipelaptop=$_POST['tipelaptop'];
    $tgl=date("Y/m/d");

    //proses simpan konsultasi
    $sql = "INSERT INTO konsultasi VALUES (Null,'$idusers','$tgl','$nama', '$tipelaptop')";
    mysqli_query($conn,$sql);

    // mengambil gejala
    $idgejala=$_POST['idgejala'];

    // mengambil data konsultasi
    $sql = "SELECT * FROM konsultasi ORDER BY idkonsultasi DESC";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    $idkonsultasi=$row['idkonsultasi'];

    //proses simpan detail_konsultasi
    $jumlah = count($idgejala);
    $i=0;
    while($i < $jumlah){
        $idgejalanee=$idgejala[$i];
        $sql = "INSERT INTO detail_konsultasi VALUES ($idkonsultasi,'$idgejalanee')";
        mysqli_query($conn,$sql);
        $i++;
    }

    // Mengambil data dari kerusakan untuk di cek di basis aturan
  
        $sql = "SELECT*FROM kerusakan";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {

            $idkerusakan = $row['idkerusakan'];
            $jyes=0;

            //Mencari jumlah gejaja di basis aturan berdasarkan penyakitnya
            $sql2 = "SELECT COUNT(idkerusakan) AS jmlgejala
                    FROM basis_aturan INNER JOIN detail_basis_aturan 
                    ON basis_aturan.idaturan=detail_basis_aturan.idaturan
                    WHERE idkerusakan='$idkerusakan'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $jmlgejala=$row2['jmlgejala'];

            //Mencari gejala gejalanya pada basis aturan
            $sql3 = "SELECT idkerusakan,idgejala
                    FROM basis_aturan INNER JOIN detail_basis_aturan 
                    ON basis_aturan.idaturan=detail_basis_aturan.idaturan
                    WHERE idkerusakan='$idkerusakan'";
            $result3 = $conn->query($sql3);
            while($row3 = $result3->fetch_assoc()) {

                $idgejalane=$row3['idgejala'];
                
                //membandingkan apakah yg dipilih pd konsultasi sesuai/ada
                $sql4 = "SELECT idgejala
                    FROM detail_konsultasi
                    WHERE idkonsultasi='$idkonsultasi' AND idgejala='$idgejalane'";
                $result4 = $conn->query($sql4);
                if($result4->num_rows > 0){
                    $jyes=$jyes+1;
                }

            }


            //hitungan / proses mencari presentase
            if($jmlgejala > 0){
                $peluang = round(($jyes/$jmlgejala)*100,2);
            }else {
                $peluang = 0;
            }

            //simpan data detail kerusakan
            if($peluang > 0){
                $sql = "INSERT INTO detail_kerusakan VALUES ($idkonsultasi,'$idkerusakan','$peluang')";
                mysqli_query($conn,$sql);
            }

            header("Location:?page=konsultasi&action=hasil&idkonsultasi=$idkonsultasi");

            
        }

}
?>



<!-- TAMPILAN -->
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Konsultasi Kerusakan</strong></div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Username</label>
                        <input type="text" class="form-control" value="<?php echo $row5['username'] ?>"  name="idusers" readonly>
                        <label for="">Nama</label>
                        <input type="text" class="form-control" value="<?php echo $row5['nama'] ?>" name="nama" maxlength="50" readonly>
                        <label for="">Tipe Laptop</label>
                        <input type="text" class="form-control" name="tipelaptop" maxlength="50" required>
                    </div>
                    
                    <!-- tabel gejala -->
                    <div class="form-group">
                    <label for="">Pilih Gejala-Gejalanya</label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px">Pilih</th>
                                    <th width="30px">No.</th>
                                    <th>Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                    $sql = "SELECT*FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" 
                                            name="<?php echo 'idgejala[]'; ?>" 
                                            value="<?php echo $row['idgejala']; ?>" ></td>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                    </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit" name="proses" value="Proses">

                </div>
            </div>
        </form>
    </div>
</div>

 <script type="text/javascript">
    function validasiForm(){

       
        //validasi ceklisan
        var checkbox=document.getElementsByName('<?php echo 'idgejala[]'; ?>');

        var isChacked=false;

        for(var i=0; i<checkbox.length; i++){
            if(checkbox[i].checked){
                isChacked = true;
                break;
            }
        }

        //jika blm ada yg di checklist
        if(!isChacked){
            alert('Pilih setidaknya satu gejala!');
            return false;
        }

        return true;

    }
 </script>