<?php 

//mengambil id
$idusers=$_GET['id'];
 
if(isset($_POST['update'])){
    $role=$_POST['role'];
    $nama=$_POST['nama'];
    $no_hp=$_POST['no_hp'];
    $pass=md5($_POST['pass']);

    // proses update
    $sql = "UPDATE users SET nama='$nama', no_hp='$no_hp', role='$role', pass='$pass'  WHERE idusers='$idusers'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}

$sql = "SELECT * FROM users WHERE idusers='$idusers'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Data Users</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $row['nama'] ?>" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Hp</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo $row['no_hp'] ?>" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="pass" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Hak Akses</label>
                        <select class="form-control chosen" data-placeholder="Pilih Hak Akses" name="role">
                            <option value="<?php echo $row['role'] ?>"><?php echo $row['role'] ?></option>
                            <option value="Admin">Admin</option>
                            <option value="Teknisi">Teknisi</option>
                            <option value="User">User</option>
                            
                        </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=users">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>