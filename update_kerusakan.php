<?php 

//mengambil id
$idkerusakan=$_GET['id'];
 
if(isset($_POST['update'])){
    $nmkerusakan=$_POST['nmkerusakan'];
    $keterangan=$_POST['keterangan'];
    $solusi=$_POST['solusi'];

    // proses update
    $sql = "UPDATE kerusakan SET nmkerusakan='$nmkerusakan', keterangan='$keterangan', solusi='$solusi'  WHERE idkerusakan='$idkerusakan'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=kerusakan");
    }
}

$sql = "SELECT * FROM kerusakan WHERE idkerusakan='$idkerusakan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Data Gejala</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Kode Krusakan</label>
                        <input type="text" class="form-control" name="kdkerusakan" value="<?php echo $row['kdkerusakan'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Krusakan</label>
                        <input type="text" class="form-control" name="nmkerusakan" value="<?php echo $row['nmkerusakan'] ?>" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="<?php echo $row['keterangan'] ?>" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Solusi</label>
                        <input type="text" class="form-control" name="solusi" value="<?php echo $row['solusi'] ?>" maxlength="200" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=kerusakan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>