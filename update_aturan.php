
<!--  -->
<?php

//proses menampilkan kerusakan
$idaturan=$_GET['id'];

$sql = "SELECT basis_aturan.idaturan,basis_aturan.idkerusakan,kerusakan.nmkerusakan 
        FROM basis_aturan INNER JOIN kerusakan
        ON basis_aturan.idkerusakan=kerusakan.idkerusakan
        WHERE idaturan='$idaturan'";
$result = $conn->query($sql);
// Periksa apakah query berhasil dieksekusi
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
$row = $result->fetch_assoc();

//PROSES UPDATE
if(isset($_POST['update'])){
    $idgejala=$_POST['idgejala'];

    //proses simpan detail_basis_aturan
    if($idgejala!=Null){
        $jumlah = count($idgejala);
        $i=0;
        while($i < $jumlah){
            $idgejalanee=$idgejala[$i];
            $sql = "INSERT INTO detail_basis_aturan VALUES ($idaturan,'$idgejalanee')";
            mysqli_query($conn,$sql);
            $i++;
        }
    }
    
    header("Location:?page=aturan");
}
?>

<!--  -->
<!-- TAMPILAN -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Basis Aturan</strong></div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Pilih Kerusakan</label>
                        <input type="text" class="form-control" value="<?php echo $row['nmkerusakan']; ?>" name="nmkerusakan" readonly>
                    </div>
                    
                    <!-- tabel gejala -->
                    <div class="form-group">
                    <label for="">Pilih Gejala-Gejalanya</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px"></th>
                                    <th width="30px">No.</th>
                                    <th width="40px">Kode Gejala</th>
                                    <th>Gejala</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                    $sql = "SELECT*FROM gejala ORDER BY idgejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {

                                        $idgejala=$row['idgejala'];
                                        //cek ke tabel basis aturan
                                        $sql2 = "SELECT * FROM detail_basis_aturan WHERE idaturan='$idaturan' AND idgejala='$idgejala'";
                                        $result2 = $conn->query($sql2);
                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result2 === false) {
                                            die("Error executing query: " . $conn->error);
                                        }
                                        if ($result2->num_rows > 0) {

                                            //jika ditemukan maka tampilkan                                        
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" 
                                            disabled></td>
                                        <td><?php echo $no++; ?></td>
                                        
                                        <td><?php echo $row['kdgejala']; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                        <td align="center">
                                        <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" 
                                            href="?page=aturan&action=hapus_gejala&idaturan=<?php echo $idaturan; ?> &idgejala=<?php echo $idgejala; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        </td>
                                    </tr>
                                <?php
                                        } else {
                                            //jika ngga ceklis aktif hapus mati

                                ?>
                                            <tr>
                                                <td align="center"><input type="checkbox" class="check-item" 
                                                    name="<?php echo 'idgejala[]'; ?>" 
                                                    value="<?php echo $row['idgejala']; ?>" ></td>
                                                <td><?php echo $no++; ?></td>
                                                
                                                <td><?php echo $row['kdgejala']; ?></td>
                                                <td><?php echo $row['nmgejala']; ?></td>
                                                <td align="center">
                                                    <i class="fas fa-trash-alt"></i>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=aturan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>