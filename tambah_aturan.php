<?php

if(isset($_POST['simpan'])){

    //ambil data
    $nmkerusakan=$_POST['nmkerusakan'];
	
    // validasi nama penyakit
    $sql = "SELECT basis_aturan.idaturan,basis_aturan.idkerusakan,kerusakan.nmkerusakan
            FROM basis_aturan INNER JOIN kerusakan ON basis_aturan.idkerusakan=kerusakan.idkerusakan
             WHERE nmkerusakan='$nmkerusakan'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Basis Aturan tersebut sudah ada!</strong>
            </div>
        <?php
    }else{

        // mengambil data kerusakan
        $sql = "SELECT * FROM kerusakan WHERE nmkerusakan='$nmkerusakan'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idkerusakan=$row['idkerusakan'];
        
	    //proses simpan basis_aturan
        $sql = "INSERT INTO basis_aturan VALUES (Null,'$idkerusakan')";
        mysqli_query($conn,$sql);

        // mengamnil id gejala
        $idgejala=$_POST['idgejala'];

        // mengambil data aturan
        $sql = "SELECT * FROM basis_aturan ORDER BY idaturan DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idaturan=$row['idaturan'];

        //proses simpan detail_basis_aturan
        $jumlah = count($idgejala);
        $i=0;
        while($i < $jumlah){
            $idgejalanee=$idgejala[$i];
            $sql = "INSERT INTO detail_basis_aturan VALUES ($idaturan,'$idgejalanee')";
            mysqli_query($conn,$sql);
            $i++;
        }
        
        header("Location:?page=aturan");
       
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis</strong></div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Pilih Kerusakan</label>
                        <select class="form-control chosen" data-placeholder="Pilih Kerusakan" name="nmkerusakan">
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM kerusakan ORDER BY kdkerusakan ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['nmkerusakan']; ?>"><?php echo $row['nmkerusakan']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
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
                                    <th>Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                    $sql = "SELECT*FROM gejala ORDER BY idgejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" 
                                            name="<?php echo 'idgejala[]'; ?>" 
                                            value="<?php echo $row['idgejala']; ?>" ></td>
                                        <td><?php echo $no++; ?></td>
                                        
                                        <td><?php echo $row['kdgejala']; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                    </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=aturan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>

 <script type="text/javascript">
    function validasiForm(){

        //validasi kerusakan
        var nmkerusakan = document.forms["Form"]["nmkerusakan"].value;
        if(nmkerusakan==""){
            alert("Pilih Kerusakan!");
            return false;
        }
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