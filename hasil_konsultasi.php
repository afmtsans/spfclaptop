<!-- proses menampilkan data Hasil konsultasi -->
<?php 
    // Mengambil id
    $idkonsultasi = $_GET['idkonsultasi'];

    // Periksa koneksi ke database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Query SQL untuk mendapatkan detail basis aturan
    $sql = "SELECT * FROM konsultasi
            WHERE idkonsultasi = '$idkonsultasi'";
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
                    <div class="card-header bg-primary text-white border-dark"><strong>Detail Hasil Konsultasi</strong></div>
                        <div class="card-body">

                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama'] ?>" name="nama" readonly>
                            <label for="">Tipe Laptop</label>
                            <input type="text" class="form-control" value="<?php echo $row['tipelaptop'] ?>" name="tipelaptop" readonly>
                        </div>

                        <!-- Tabel gejala gejala -->
                        <label for="">Gejala gejala kerusakan nya</label>
                        <div class="table-responsive">
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
                                    $sql = "SELECT detail_konsultasi.idkonsultasi,detail_konsultasi.idgejala,gejala.nmgejala
                                            FROM detail_konsultasi INNER JOIN gejala ON detail_konsultasi.idgejala = gejala.idgejala 
                                            WHERE idkonsultasi = '$idkonsultasi'";
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
                                    
                                ?>

                            </tbody>
                        </table>
                        </div>

                            <!-- KERUSAKAN -->
                        <label for="">Hasil Konsultasi kerusakan nya</label>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px">No.</th>
                                    <th>Kerusakan</th>
                                    <th>Persentase</th>
                                    <th>Solusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- proses menampilkan disini -->
                                <?php
                                    // Query SQL untuk mendapatkan detail gejala pada basis aturan
                                    $sql = "SELECT detail_kerusakan.idkonsultasi, detail_kerusakan.idkerusakan,kerusakan.nmkerusakan,
                                                    kerusakan.solusi, detail_kerusakan.persentase
                                            FROM detail_kerusakan INNER JOIN kerusakan ON detail_kerusakan.idkerusakan = kerusakan.idkerusakan 
                                            WHERE idkonsultasi = '$idkonsultasi'
                                            ORDER BY persentase DESC";
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
                                    <td><?php echo $row['nmkerusakan']; ?></td>
                                    <td><?php echo $row['persentase']. "%"; ?></td>
                                    <td><?php echo $row['solusi']; ?></td>
                                </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>

                            </tbody>
                        </table>
                        </div>
                        <a class="btn btn-success" href="?page=konsultasipakar">
                        Konsultasi Lebih Lanjut
                    </a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

