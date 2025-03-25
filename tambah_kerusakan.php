<?php

if(isset($_POST['simpan'])){
    //mengambil data
    $kdkerusakan=$_POST['kdkerusakan'];
    $nmkerusakan=$_POST['nmkerusakan'];
    $keterangan=$_POST['keterangan'];
    $solusi=$_POST['solusi'];
	
   
	//proses simpan
        $sql = "INSERT INTO kerusakan VALUES (Null, '$kdkerusakan', '$nmkerusakan','$keterangan','$solusi')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=kerusakan");
        }
    
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Kerusakan</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Kode Kerusakan</label>
                        <input type="text" class="form-control" name="kdkerusakan" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kerusakan</label>
                        <input type="text" class="form-control" name="nmkerusakan" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Solusi</label>
                        <input type="text" class="form-control" name="solusi" maxlength="200" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=kerusakan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>