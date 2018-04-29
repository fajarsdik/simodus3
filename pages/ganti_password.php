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
        $pass_lama = $_REQUEST['pass_lama'];
        $pass_baru = $_REQUEST['pass_baru'];
        $unit = $_REQUEST['unit'];
        $admin = $_REQUEST['admin'];

        if (strlen($pass_baru) < 5) {
            echo '<script language="javascript">
                    window.alert("Password baru minimal harus 5 karakter!");
                    window.location.href="./admin.php?page=gpw";
                  </script>';
        } else {

            $query = mysqli_query($config, "SELECT password FROM tbl_user WHERE id_user='$id_user' AND password=MD5('$pass_lama')");

            if (mysqli_num_rows($query) > 0) {
                $do = mysqli_query($config, "UPDATE tbl_user SET password=MD5('$pass_baru') WHERE id_user='$id_user'");

                if ($do == true) {
                    echo '<script language="javascript">
                            window.alert("SUKSES! Password berhasil diganti");
                            window.location.href="../logout.php";
                          </script>';
                } else {
                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                    header("Location: ./admin.php?page=gpw");
                    die();
                }
            } else {
                echo '<script language="javascript">
                        window.alert("ERROR! Password lama tidak sesuai. Anda mungkin tidak memiliki akses ke halaman ini");
                        window.location.href="../logout.php";
                      </script>';
            }
        }
    } else {

        if (isset($_SESSION['succAdd'])) {
            $succAdd = $_SESSION['succAdd'];
            echo '<div id="alert"  class="alert alert-success">
                    ' . $succAdd . '
                  </div>';
            unset($_SESSION['succAdd']);
        }

        if (isset($_SESSION['errQ'])) {
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert"  class="alert alert-danger">
                    ' . $errQ . '
                  </div>';
            unset($_SESSION['errQ']);
        }
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ganti Password</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php echo 'Ganti Password ' . $_SESSION['username']; ?>
                            </div>

                            <?php
                            $id_user = $_SESSION['id_user'];

                            $query = mysqli_query($config, "SELECT id_user, username, nama, nip, unit, admin FROM tbl_user WHERE id_user='$id_user'");
                            list($id_user, $username, $nama, $nip, $unit, $admin) = mysqli_fetch_array($query);
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=gpw" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="username">Username</label>
                                            <input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>">
                                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" readonly required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="nama">Nama</label>
                                            <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $nama; ?>" readonly required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="pass_lama">Password Lama</label>
                                            <input class="form-control" type="password" name="pass_lama" id="pass_lama" value="" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="pass_baru">Password Baru</label>
                                            <input class="form-control" type="password" name="pass_baru" id="pass_baru" value="" required>
                                        </div>

                                    </div>    

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                            <p></p>
                                            <p style="color: red">*Setelah menekan tombol "Simpan", Anda akan diminta melakukan Login ulang.</p>
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