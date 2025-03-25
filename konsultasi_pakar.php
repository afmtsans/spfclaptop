<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Konsultasi Ke Teknisi Pakar</strong></div>
  <div class="card-body">
    <p>Anda dapat melakukan konsultasi secara langsung kepada pakar / teknisi melalui whatsapp.</p>
    <div class="table-responsive">
<table class="table table-bordered" id="myTable">
    <thead>
      <tr align="center">
        <th width="30px">No.</th>
        
        <th>Nama Lengkap</th>
        <th>No. Hp</th>
        
        <th width="90px">Whatsapp</th>
      </tr>
    </thead>
    <tbody>
		<!-- letakkan proses menampilkan disini -->
        <?php
            $no=1;
            $sql = "SELECT*FROM users where role='Admin' ORDER BY username ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
        
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['no_hp']; ?></td>
        
                <td align="center">
                    <a class="btn btn-success" href="https://wa.me/62<?php echo $row['no_hp']; ?>">
                        <i class="fab fa-whatsapp"></i>
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