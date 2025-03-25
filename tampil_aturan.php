<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Basis Aturan</strong></div>
  <div class="card-body">
<a class="btn btn-primary mb-2" href="?page=aturan&action=tambah">Tambah</a>
<div class="table-responsive">
<table class="table table-bordered" id="myTable">
    <thead>
      <tr align="center">
        <th width="30px">No.</th>
        <th>Kerusakan</th>
        <th>Keterangan</th>
        <th width="150px">Aksi</th>
      </tr>
    </thead>
    <tbody>
		<!-- letakkan proses menampilkan disini -->
        <?php
            $no=1;
            $sql = "SELECT basis_aturan.idaturan,basis_aturan.idkerusakan, 
            kerusakan.nmkerusakan, kerusakan.keterangan FROM basis_aturan INNER JOIN kerusakan 
            ON basis_aturan.idkerusakan=kerusakan.idkerusakan ORDER BY nmkerusakan ASC";

            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $row['nmkerusakan']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td align="center">
                    <a class="btn btn-primary" href="?page=aturan&action=detail&id=<?php echo $row['idaturan']; ?>">
                        <i class="fas fa-list"></i>
                    </a>
                    <a class="btn btn-warning" href="?page=aturan&action=update&id=<?php echo $row['idaturan']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus&id=<?php echo $row['idaturan']; ?>">
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