<?php
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

    $uname = $row5['username'];
?>

<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Riwayat Konsultasi</strong></div>
  <div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="myTable">
    <thead>
      <tr align="center">
        <th width="40px">No.</th>
        <th width="40px">Id konsultasi</th>
        <th width="200px">Tanggal</th>
        <th width="700px">Nama</th>
        <th width="700px">Tipe Laptop</th>
        <th width="200px">Aksi</th>
      </tr> 
    </thead>
    <tbody>
		<!-- letakkan proses menampilkan disini -->
        <?php
        
            $no=1;
            $sql = "SELECT*FROM konsultasi where username = '$uname' ORDER BY idkonsultasi ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $row['idkonsultasi']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['tipelaptop']; ?></td>
                <td align="center">
                    <a class="btn btn-warning" href="?page=riwayatkonsultasi&action=lihat&idkonsultasi=<?php echo $row['idkonsultasi']; ?>">
                        <i class="fas fa-list"></i>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=riwayatkonsultasi&action=hapus&idkonsultasi=<?php echo $row['idkonsultasi']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php
            }
            $conn->close();
        ?>
   </tbody>
</table>
</div>
</div>
</div>