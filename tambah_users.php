<?php

if(isset($_POST['simpan'])){
    //mengambil data
    
    $nama=$_POST['nama'];
    $no_hp=$_POST['no_hp'];
    $username=$_POST['username'];
    $pass=md5($_POST['pass']);
    $role=$_POST['role'];
	   
	//proses simpan
        $sql = "INSERT INTO users VALUES (Null,'$nama','$no_hp','$username','$pass','$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=users");
        }
    
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Users</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Hp</label>
                        <input type="text" class="form-control" name="no_hp" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="pass" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Hak Akses</label>
                        <select class="form-control chosen" data-placeholder="Pilih Hak Akses" name="role">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                            
                        </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=users">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>