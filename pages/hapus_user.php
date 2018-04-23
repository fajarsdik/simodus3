<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    $id_user = $_REQUEST['id_user'];
    $unit = $_SESSION['unit'];

    $query = mysqli_query($config, "SELECT * FROM tbl_user WHERE id_user='$id_user' && unit LIKE '$unit%'");

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_array($query)) {
            ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hapus User</h1>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php echo $_SESSION['nama']; ?>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    if (isset($_SESSION['errQ'])) {
                                        $errQ = $_SESSION['errQ'];
                                        echo '<div id="alert"  class="alert alert-success">
                                                ' . $errQ . '
                                                </div>';
                                        unset($_SESSION['errQ']);
                                    }

                                    if ($row['admin'] == 2) {
                                        $level = "Admin Area";
                                    } elseif ($row['admin'] == 3) {
                                        $level = "Admin Rayon";
                                    } elseif ($row['admin'] == 4) {
                                        $level = "Petugas Aktivasi";
                                    } elseif ($row['admin'] == 5) {
                                        $level = "Petugas Posko";
                                    }
                                    ?>
                                    <div class="well">
                                        <table class="table table-responsive">
                                            <thead class="red lighten-5 red-text">
                                            <div id="12"  class="alert alert-danger">
                                                Apakah Anda yakin akan menghapus data ini?
                                            </div>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="22%">Username</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['username'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Nama</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">NIP</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['nip'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Kode Unit</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['unit'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Level</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $level ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-action"> <?php echo ' 
                                            <a href="?page=usr&act=del&submit=yes&id_user=' . $row['id_user'] . '" class="btn btn-danger">HAPUS <i class="material-icons"></i></a>
                                            <a href="?page=usr" class="btn btn-default">BATAL <i class="material-icons"></i></a>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_REQUEST['submit'])) {

                                    $query = mysqli_query($config, "DELETE FROM tbl_user WHERE id_user='$id_user' && unit LIKE '$unit%'");

                                    if ($query == true) {
                                        $_SESSION['succDel'] = 'SUKSES! User berhasil dihapus<br/>';
                                        header("Location: ./admin.php?page=usr");
                                        die();
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">
                                                    window.location.href=" ./admin.php?page=mdg&act=del&id_user=' . $id_user . '";
                                                  </script>';
                                    }
                                }
                            }
                        }
                    }
                    ?> </div>
            </div>
        </div>

