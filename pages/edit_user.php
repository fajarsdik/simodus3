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

        $id_user = $_REQUEST['id_user'];
        $username = $_REQUEST['username'];
        $nama = $_REQUEST['nama'];
        $nip = $_REQUEST['nip'];
        $unit = $_REQUEST['unit'];
        $admin = $_REQUEST['admin'];

        $query = mysqli_query($config, "UPDATE tbl_user SET username='$username', nama='$nama', "
                . "nip='$nip', unit='$unit', admin='$admin' WHERE id_user='$id_user'");

        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! Data berhasil diperbarui';
            header("Location: ./admin.php?page=usr");
            die();
        } else {
            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
            echo '<script language="javascript">window.history.back();</script>';
        }
    } else {

        if (isset($_SESSION['errQ'])) {
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert"  class="alert alert-success">
                            ' . $errQ . '
                          </div>';
            unset($_SESSION['errQ']);
        }
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php echo 'Edit User ' . $_SESSION['username']; ?>
                            </div>

                            <?php
                            
                            $id_user = mysqli_real_escape_string($config, $_REQUEST['id_user']);

                            $query = mysqli_query($config, "SELECT id_user, username, nama, nip, unit, admin FROM tbl_user WHERE id_user='$id_user'");
                            list($id_user, $username, $nama, $nip, $unit, $admin) = mysqli_fetch_array($query);
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=usr&act=edit" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="username">Username</label>
                                            <input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>">
                                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="nama">Nama</label>
                                            <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="nip">NIP</label>
                                            <input class="form-control" type="text" name="nip" id="nip" value="<?php echo $nip; ?>" required>
                                        </div>

                                        <?php
                                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
                                            echo ' 
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Kode Unit</label>
                                                    <input class="form-control" type="number" name="unit" id="unit" value="' . $unit . '" required>
                                                </div>';
                                        } else {

                                            if ($_SESSION['admin'] == $admin) {
                                                echo ' 
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Kode Unit</label>
                                                    <input class="form-control" type="number" name="unit" id="unit" value="' . $unit . '" readonly required>
                                                </div>';
                                            } else {
                                                echo ' 
                                                <div class="form-group col-lg-6">
                                                    <label for="unit">Kode Unit</label>
                                                    <input class="form-control" type="number" name="unit" id="unit" value="' . $unit . '" readonly required>
                                                </div>';
                                            }
                                        }

                                        if ($admin == 1) {
                                            $level = "Super Admin";
                                        } elseif ($admin == 2) {
                                            $level = "Admin Area";
                                        } elseif ($admin == 3) {
                                            $level = "Admin Rayon";
                                        } elseif ($admin == 4) {
                                            $level = "Petugas Aktivasi";
                                        } elseif ($admin == 5) {
                                            $level = "Petugas Posko";
                                        }
                                        
                                        if ($_SESSION['admin'] == 1) {
                                            echo '
                                                <div class="form-group col-lg-6">
                                                    <label for="admin">Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                        <option value="' . $admin . '" readonly selected>' . $level . '</option>
                                                    </select>
                                                </div>';
                                        } elseif ($_SESSION['admin'] == 2) {
                                            echo '
                                                <div class="form-group col-lg-6">
                                                    <label for="admin">Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                        <option value="' . $admin . '" readonly selected>' . $level . '</option>
                                                        <option value="2">Admin Area</option>
                                                        <option value="3">Admin Rayon</option>
                                                        <option value="4">Petugas Aktivasi</option>
                                                        <option value="5">Petugas Posko</option>
                                                    </select>
                                                </div>';
                                        } elseif ($_SESSION['admin'] == 3) {
                                            echo '
                                                <div class="form-group col-lg-6">
                                                    <label for="admin">Level User</label>
                                                    <select class="form-control" name="admin" id="admin" required>
                                                        <option value="' . $admin . '" readonly selected>' . $level . '</option>
                                                        <option value="3">Admin Rayon</option>
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