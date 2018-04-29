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

                                        <?php
                                        if ($_SESSION['admin'] == 1) {
                                            echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Area</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option disabled selected>-----</option>
                                                        <option value="181">Area Pekanbaru</option>
                                                        <option value="182">Area Dumai</option>
                                                        <option value="183">Area Tanjungpinang</option>
                                                        <option value="184">Area Rengat</option>
                                                    </select>
                                                </div>';
                                        } elseif ($_SESSION['admin'] == 2) {
                                            if ($_SESSION['unit'] == 183) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option disabled selected>-----</option>
                                                        <option value="18301">Bintan Center</option>
                                                        <option value="18302">Kijang</option>
                                                        <option value="18303">Tg Uban</option>
                                                        <option value="18304">Belakang Padang</option>
                                                        <option value="18305">Tg Balai Karimun</option>
                                                        <option value="18306">Tg Batu</option>
                                                        <option value="18307">Dabosingkep</option>
                                                        <option value="18308">Natuna</option>
                                                        <option value="18309">Tanjungpinang Kota</option>
                                                        <option value="18310">Anambas</option>
                                                    </select>
                                                </div>';
                                            }
                                        } elseif ($_SESSION['admin'] == 3) {
                                            if ($_SESSION['unit'] == 18301) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18301" readonly selected>Bintan Center</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18302) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18302" readonly selected>Kijang</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18303) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18303" readonly selected>Tg Uban</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18304) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18304" readonly selected>Belakang Padang</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18305) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18305" readonly selected>Tg Balai Karimun</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18306) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18306" readonly selected>Tg Batu</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18307) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18307" readonly selected>Dabosingkep</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18308) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18308" readonly selected>Natuna</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18309) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18309" readonly selected>Tanjungpinang Kota</option>
                                                    </select>
                                                </div>';
                                            } elseif ($_SESSION['unit'] == 18310) {
                                                echo '  
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Rayon</label>
                                                    <select class="form-control" name="unit" id="unit" required>
                                                        <option value="18310" readonly selected>Anambas</option>
                                                    </select>
                                                </div>';
                                            }
                                        }

                                        if ($_SESSION['admin'] == 1) {
                                            echo '<div class="form-group col-lg-6">
                                                    <label>Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                        <option value="2" readonly selected>Admin Area</option>
                                                    </select>
                                                </div>';
                                        } elseif ($_SESSION['admin'] == 2) {
                                            echo '<div class="form-group col-lg-6">
                                                    <label>Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                        <option value="3" readonly selected>Admin Rayon</option>
                                                    </select>
                                                </div>';
                                        } elseif ($_SESSION['admin'] == 3) {
                                            echo '<div class="form-group col-lg-6">
                                                    <label>Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                    <option disabled selected>-----</option>
                                                        <option value="4">Petugas Aktivasi</option>
                                                        <option value="5">Petugas Posko</option>
                                                    </select>
                                                </div>';
                                        }
                                        ?>

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