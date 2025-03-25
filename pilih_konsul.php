<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Riwayat Konsultasi User</strong></div>
  <div class="card-body">

<table class="table table-bordered" id="myTable">
    <thead>
      <tr align="center">
        <th width="40px">No.</th>
        <th width="700px">Nama</th>
        <th width="700px">Tipe Laptop</th>
        <th width="100px">Aksi</th>
      </tr> 
    </thead>
    <tbody>
		<!-- letakkan proses menampilkan disini -->
        <?php
            $no=1;
            $sql = "SELECT*FROM gejala ORDER BY nmgejala ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $row['nmgejala']; ?></td>
                <td align="center">
                    <a class="btn btn-warning" href="?page=gejala&action=update&id=<?php echo $row['idgejala']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=gejala&action=hapus&id=<?php echo $row['idgejala']; ?>">
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