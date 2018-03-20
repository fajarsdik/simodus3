<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {


    if (isset($_SESSION['errQ'])) {
        $errQ = $_SESSION['errQ'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errQ . '
                          </div>';
        unset($_SESSION['errQ']);
    }
    if (isset($_SESSION['errV'])) {
        $errV = $_SESSION['errV'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errV . '
                          </div>';
        unset($_SESSION['errV']);
    }
    if (isset($_SESSION['errEmpty'])) {
        $errEmpty = $_SESSION['errEmpty'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errEmpty . '
                          </div>';
        unset($_SESSION['errEmpty']);
    }


    if (isset($_REQUEST['submit'])) {


        $id_meter = $_REQUEST['id_meter'];
        $no_dummy = $_REQUEST['no_dummy'];
        $lokasi_posko = $_REQUEST['lokasi_posko'];
        $nama_cc = $_REQUEST['nama_cc'];
        $stand = $_REQUEST['stand'];
        $tgl_kembali = date("Y-m-d H:i:s");
        $nama = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];
        $unit = $_SESSION['unit'];

        //validasi input data
        if (!preg_match("/^[0-9]*$/", $no_dummy)) {
            $_SESSION['no_dummy'] = 'Form Nomor Dummy harus diisi angka!';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $stand)) {
                $_SESSION['stand'] = 'Form Stand Bongkar harus diisi angka!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $lokasi_posko)) {
                    $_SESSION['lokasi_posko'] = 'Form Lokasi Posko hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $nama_cc)) {
                        $_SESSION['nama_cc'] = 'Form Nama Call Center hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        $query = mysqli_query($config, "INSERT INTO tbl_metdum_kbl(id_meter,no_dummy,lokasi_posko,nama_cc,stand,tgl_kembali,nama,id_user,unit)
                                                   VALUES('$id_meter','$no_dummy','$lokasi_posko','$nama_cc','$stand','$tgl_kembali','$nama','$id_user','$unit')");

                        $query_kembali = mysqli_query($config, "UPDATE tbl_metdum_pakai SET kembali='sudah' WHERE id_meter='$id_meter'");

                        $query_tgl_aktivasi = mysqli_query($config, "UPDATE tbl_metdum_stok SET tgl_kembali='$tgl_kembali', status='ready', "
                                . "no_meter_rusak='', posko='$lokasi_posko' WHERE no_dummy='$no_dummy'");
                        
                        if ($query == true) {
                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                            header("Location: ./admin.php?page=mdk");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">window.history.back();</script>';
                        }
                    }
                }
            }
        }
    } else {
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Data Pengembalian Dummy</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                                <?php echo $_SESSION['nama']; ?>
                            </div>

                            <?php
                            $unit = $_SESSION['unit'];

                            $query_id = mysqli_query($config, "SELECT id_meter FROM tbl_metdum_pakai WHERE aktivasi='aktif' && kembali='belum' && unit LIKE '$unit%' ORDER BY tgl_pakai DESC");
                            list($id_meter) = mysqli_fetch_array($query_id);

                            $query_stok = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE aktivasi='aktif' && kembali='belum' && unit LIKE '$unit%' ORDER BY tgl_pakai DESC");
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=mdk&act=add" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <input type="hidden" name="id_meter" value="<?php echo $id_meter; ?>">
                                            <label>Pilih No. Dummy</label>
                                            <select class="form-control" name="no_dummy" id="no_dummy" required>
                                                <option disabled selected>-----</option>
                                                <?php
                                                if (mysqli_num_rows($query_stok) > 0) {
                                                    while ($row = mysqli_fetch_array($query_stok)) {
                                                        ?>
                                                        <option value="<?php echo $row['no_dummy'] ?>"><?php echo $row['no_dummy'] ?></option> <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="stand">Stand Bongkar</label>
                                            <input class="form-control" type="text" name="stand" id="stand" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="nama_cc">Nama Call Center</label>
                                            <input class="form-control" type="text" name="nama_cc" id="nama_cc" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="lokasi_posko">Lokasi Posko</label>
                                            <input class="form-control" type="text" name="lokasi_posko" id="lokasi_posko" required>
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