<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {

    if (isset($_REQUEST['submit'])) {

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $nama = $_REQUEST['nama'];
        $nip = $_REQUEST['nip'];
        $unit = $_REQUEST['unit'];
        $admin = $_REQUEST['admin'];


        $query = mysqli_query($config, "INSERT INTO tbl_user(id_user,username,password,nama,nip,unit,admin) "
                . "VALUES('','$username',MD5('$password'),'$nama','$nip','$unit','$admin')");


        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! User berhasil ditambahkan';
            header("Location: ./admin.php?page=usr");
            die();
        } else {
            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
            echo '<script language="javascript">window.history.back();</script>';
        }
    } else {
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah User</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                                <?php echo $_SESSION['nama']; ?>
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=usr&act=add" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="username">Username</label>
                                            <input class="form-control" type="text" name="username" id="username" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" id="password" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="nama">Nama</label>
                                            <input class="form-control" type="text" name="nama" id="nama" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="nip">NIP</label>
                                            <input class="form-control" type="text" name="nip" id="nip" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="unit">Kode Unit</label>
                                            <input class="form-control" type="number" name="unit" id="unit" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Level User</label>
                                            <select class="form-control" name="admin" id="admin" required>
                                                <option disabled selected>-----</option>
                                                <option value="2">Admin Area</option>
                                                <option value="3">Admin Rayon</option>
                                                <option value="4">Petugas Aktivasi</option>
                                                <option value="5">Petugas Posko</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                            <a href="?page=usr" class="btn btn-default"> Batal</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <?php
    }
}
?>