<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Kerusakan</strong></div>
  <div class="card-body">
<a class="btn btn-primary mb-2" href="?page=kerusakan&action=tambah">Tambah</a>
<div class="table-responsive">
<table class="table table-bordered" id="myTable">
    <thead>
      <tr align="center">
        <th width="30px">No.</th>
        <th width="40px">Kode Kerusakan</th>
        <th>Kerusakan</th>
        <th>Keterangan</th>
        <th>Solusi</th>
        <th width="90px">Aksi</th>
      </tr>
    </thead>
    <tbody>
		<!-- letakkan proses menampilkan disini -->
        <?php
            $no=1;
            $sql = "SELECT*FROM kerusakan ORDER BY idkerusakan ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td align="center"><?php echo $row['kdkerusakan']; ?></td>
                <td><?php echo $row['nmkerusakan']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td><?php echo $row['solusi']; ?></td>
                <td align="center">
                    <a class="btn btn-warning" href="?page=kerusakan&action=update&id=<?php echo $row['idkerusakan']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=kerusakan&action=hapus&id=<?php echo $row['idkerusakan']; ?>">
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