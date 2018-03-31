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

        $id_meter = $_REQUEST['id_meter'];
        $no_dummy = $_REQUEST['no_dummy'];
        $lokasi_posko = $_REQUEST['lokasi_posko'];
        $nama_cc = $_REQUEST['nama_cc'];
        $stand = $_REQUEST['stand'];
        $nama = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];
        $unit = $_SESSION['unit'];

        $query = mysqli_query($config, "UPDATE tbl_metdum_kbl SET no_dummy='$no_dummy', lokasi_posko='$lokasi_posko', nama_cc='$nama_cc',"
                . "stand='$stand' WHERE id_meter='$id_meter'");

        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! Data berhasil diperbarui';
            header("Location: ./admin.php?page=mdk");
            die();
        } else {
            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
            echo '<script language="javascript">window.history.back();</script>';
        }
    } else {

        $id_meter = mysqli_real_escape_string($config, $_REQUEST['id_meter']);

        $query = mysqli_query($config, "SELECT no_dummy, no_meter_rusak, alasan_rusak, ptgs_pasang, sisa_pulsa, no_hp_plg, std_dummy, nama, id_user FROM tbl_metdum_pakai WHERE id_meter='$id_meter'");
        list($no_dummy, $no_meter_rusak, $alasan_rusak, $ptgs_pasang, $sisa_pulsa, $no_hp_plg, $std_dummy, $nama, $id_user) = mysqli_fetch_array($query);

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
                    <h1 class="page-header">Edit Data Pengembalian Dummy</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php echo $_SESSION['nama']; ?>
                            </div>

                            <?php
                            $id_meter = mysqli_real_escape_string($config, $_REQUEST['id_meter']);

                            $query = mysqli_query($config, "SELECT no_dummy, lokasi_posko, nama_cc, stand, tgl_kembali, nama, id_user FROM tbl_metdum_kbl WHERE id_meter='$id_meter'");
                            list($no_dummy, $lokasi_posko, $nama_cc, $stand, $tgl_kembali, $nama, $id_user) = mysqli_fetch_array($query);
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=mdk&act=edit" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <input type="hidden" name="id_meter" value="<?php echo $id_meter; ?>">
                                            <input type="hidden" name="no_dummy" value="<?php echo $no_dummy; ?>">
                                            <label for="stand">Stand Bongkar</label>
                                            <input class="form-control" type="text" name="stand" id="stand" value="<?php echo $stand; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="lokasi_posko">Lokasi Posko</label>
                                            <input class="form-control" type="text" name="lokasi_posko" id="lokasi_posko" value="<?php echo $lokasi_posko; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="nama_cc">Nama Call Center</label>
                                            <input class="form-control" type="text" name="nama_cc" id="nama_cc" value="<?php echo $nama_cc; ?>" required>
                                        </div>
                                    </div>    

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                            <a href="?page=mdk" class="btn btn-default"> Batal</a>
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