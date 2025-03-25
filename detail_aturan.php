<!-- proses menampilkan data disini -->
<?php 
    // Mengambil id
    $idaturan = $_GET['id'];
    // Periksa koneksi ke database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query SQL untuk mendapatkan detail basis aturan
    $sql = "SELECT basis_aturan.idaturan, basis_aturan.idkerusakan, kerusakan.nmkerusakan, kerusakan.keterangan
            FROM basis_aturan INNER JOIN kerusakan ON basis_aturan.idkerusakan = kerusakan.idkerusakan
            WHERE basis_aturan.idaturan = '$idaturan'";
    $result = $conn->query($sql);
    // Periksa apakah query berhasil dieksekusi
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }
    // Fetch hasil query
    $row = $result->fetch_assoc();
?>
<!-- Tampilan -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Detail Basis Aturan</strong></div>
                        <div class="card-body">

                        <div class="form-group">
                            <label for="">Kerusakan</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmkerusakan'] ?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" value="<?php echo $row['keterangan'] ?>" name="ket" readonly>
                        </div>

                        <!-- Tabel gejala gejala -->
                        <label for="">Gejala gejala kerusakan nya</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px">No.</th>
                                    <th>Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- proses menampilkan disini -->
                                <?php
                                    // Query SQL untuk mendapatkan detail gejala pada basis aturan
                                    $sql = "SELECT detail_basis_aturan.idaturan, detail_basis_aturan.idgejala, gejala.nmgejala
                                            FROM detail_basis_aturan INNER JOIN gejala ON detail_basis_aturan.idgejala = gejala.idgejala 
                                            WHERE detail_basis_aturan.idaturan = '$idaturan'";
                                    $result = $conn->query($sql);
                                    // Periksa apakah query berhasil dieksekusi
                                    if ($result === false) {
                                        die("Error executing query: " . $conn->error);
                                    }
                                    $no = 1;
                                    // Fetch hasil query dan tampilkan dalam tabel
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $row['nmgejala']; ?></td>
                                </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>

                            </tbody>
                        </table>
                     
                        <a class="btn btn-danger" href="?page=aturan">Kembali</a>  
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>