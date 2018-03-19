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
        $no_meter_rusak = $_REQUEST['no_meter_rusak'];
        $no_meter_baru = $_REQUEST['no_meter_baru'];
        $tgl_aktivasi = date("Y-m-d H:i:s");
        $sisa_pulsa = $_REQUEST['sisa_pulsa'];
        $id_pelanggan = $_REQUEST['id_pelanggan'];
        $nama = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];
        $unit = $_SESSION['unit'];

        $merk_meter_rusak = substr($no_meter_rusak, 0, 2);
        $merk_meter_baru = substr($no_meter_baru, 0, 2);

        $query = mysqli_query($config, "INSERT INTO tbl_aktivasi(id_meter,no_dummy,no_meter_rusak,merk_meter_rusak,"
                . "no_meter_baru,merk_meter_baru,id_pelanggan,tgl_aktivasi,nama,id_user,unit) "
                . "VALUES('$id_meter','$no_dummy','$no_meter_rusak','$merk_meter_rusak','$no_meter_baru',"
                . "'$merk_meter_baru','$id_pelanggan','$tgl_aktivasi','$nama','$id_user','$unit')");

        $query_aktivasi = mysqli_query($config, "UPDATE tbl_metdum_pakai SET aktivasi='aktif' "
                . "WHERE id_meter='$id_meter'");

        $query_tgl_aktivasi = mysqli_query($config, "UPDATE tbl_metdum_stok SET tgl_aktivasi='$tgl_aktivasi' "
                . "WHERE no_dummy='$no_dummy'");

        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! Meter berhasil di Aktivasi!';
            header("Location: ./admin.php?page=atv");
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
                    <h1 class="page-header">Aktivasi Meter Pengganti</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $_SESSION['nama']; ?>
                            </div>

                            <?php
                            $id_meter = mysqli_real_escape_string($config, $_REQUEST['id_meter']);

                            $query = mysqli_query($config, "SELECT no_dummy, no_meter_rusak, alasan_rusak, ptgs_pasang, sisa_pulsa, no_hp_plg, std_dummy, nama, id_user FROM tbl_metdum_pakai WHERE id_meter='$id_meter'");
                            list($no_dummy, $no_meter_rusak, $alasan_rusak, $ptgs_pasang, $sisa_pulsa, $no_hp_plg, $std_dummy, $nama, $id_user) = mysqli_fetch_array($query);
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=atv&act=eam" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <input type="hidden" name="id_meter" value="<?php echo $id_meter; ?>"> 
                                            <input type="hidden" name="no_dummy" value="<?php echo $no_dummy; ?>"> 
                                            <label for="no_meter_rusak">No. Meter Rusak</label>
                                            <input class="form-control" type="number" name="no_meter_rusak" id="no_meter_rusak" value="<?php echo $no_meter_rusak; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="sisa_pulsa">Sisa Pulsa</label>
                                            <input class="form-control" type="text" name="sisa_pulsa" id="sisa_pulsa" value="<?php echo $sisa_pulsa; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="no_meter_baru">No. Meter Baru</label>
                                            <input class="form-control" type="number" name="no_meter_baru" id="no_meter_baru" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="id_pelanggan">ID Pelanggan</label>
                                            <input class="form-control" type="number" name="id_pelanggan" id="id_pelanggan" required>
                                        </div>
                                    </div>    

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                            <a href="?page=atv" class="btn btn-default"> Batal</a>
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