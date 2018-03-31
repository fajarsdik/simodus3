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
        $no_meter_rusak = $_REQUEST['no_meter_rusak'];
        $alasan_rusak = $_REQUEST['alasan_rusak'];
        $tgl_pakai = date("Y-m-d");
        $ptgs_pasang = $_REQUEST['ptgs_pasang'];
        $sisa_pulsa = $_REQUEST['sisa_pulsa'];
        $no_hp_plg = $_REQUEST['no_hp_plg'];
        $std_dummy = $_REQUEST['std_dummy'];
        $nama = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];

        //validasi input data
        if (!preg_match("/^[0-9]*$/", $no_dummy)) {
            $_SESSION['no_meter'] = 'Form Nomor Meter harus diisi angka!';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            if (!preg_match("/^[0-9]*$/", $no_meter_rusak)) {
                $_SESSION['no_meter_rusak'] = 'Form Nomor Meter Rusak harus diisi angka!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $alasan_rusak)) {
                    $_SESSION['alasan_rusak'] = 'Form Alasan Rusak hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $ptgs_pasang)) {
                        $_SESSION['ptgs_pasang'] = 'Form Petugas Pasang hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $sisa_pulsa)) {
                            $_SESSION['sisa_pulsa'] = 'Isi dengan angka';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if (!preg_match("/^[0-9]*$/", $no_hp_plg)) {
                                $_SESSION['no_hp_plg'] = 'Form Nomor HP Pelanggan harus diisi angka!';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $std_dummy)) {
                                    $_SESSION['std_dummy'] = 'Isi dengan angka';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_metdum_pakai SET no_meter_rusak='$no_meter_rusak', alasan_rusak='$alasan_rusak', "
                                            . "ptgs_pasang='$ptgs_pasang', sisa_pulsa='$sisa_pulsa', no_hp_plg='$no_hp_plg', std_dummy='$std_dummy' WHERE id_meter='$id_meter'");

                                    if ($query == true) {
                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil diperbarui';
                                        header("Location: ./admin.php?page=mdg");
                                        die();
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
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
                    <h1 class="page-header">Edit Data Pemakaian Dummy</h1>
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

                            $query = mysqli_query($config, "SELECT no_dummy, no_meter_rusak, alasan_rusak, ptgs_pasang, sisa_pulsa, no_hp_plg, std_dummy, nama, id_user FROM tbl_metdum_pakai WHERE id_meter='$id_meter'");
                            list($no_dummy, $no_meter_rusak, $alasan_rusak, $ptgs_pasang, $sisa_pulsa, $no_hp_plg, $std_dummy, $nama, $id_user) = mysqli_fetch_array($query);
                            
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=mdg&act=edit" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <input type="hidden" name="id_meter" value="<?php echo $id_meter; ?>">
                                            <label>Alasan Rusak</label>
                                            <select class="form-control" name="alasan_rusak" id="alasan_rusak" value='<?php echo $row['alasan_rusak']; ?>' required>
                                                <option disabled selected>-----</option>
                                                <option value="1">Token tidak dapat dimasukkan</option>
                                                <option value="2">Sisa kredit pada kWh meter hilang/bertambah saat listrik padam</option>
                                                <option value="3">Kerusakan pada keypad</option>
                                                <option value="4">LCD mati/rusak</option>
                                                <option value="5">kWh Meter rusak (akibat petir/terbakar)</option>
                                                <option value="6">Sisa kredit tidak bertambah saat kredit baru dimasukkan</option>
                                                <option value="7">Baut tutup terminal patah</option>
                                                <option value="8">Tegangan dibawah 180V tidak bisa hidup</option>
                                                <option value="9">Micro switch rusak / tidak keluar tegangan</option>
                                                <option value="10">ID meter pada display dan nameplate tidak sama</option>
                                                <option value="11">Sisa kredit tidak berkurang</option>
                                                <option value="12">Display overload tanpa beban</option>
                                                <option value="13">Terminal kWh meter rusak</option>
                                                <option value="14">Meter periksa/tutup dibuka lampu tetap nyala</option>
                                                <option value="15">Timbul rusak</option>
                                                <option value="16">kWh minus</option>
                                                <option value="17">kWh bertambah</option>
                                                <option value="18">Lain-lain</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="no_meter_rusak">No. Meter Rusak</label>
                                            <input class="form-control" type="number" name="no_meter_rusak" id="no_meter_rusak" value="<?php echo $no_meter_rusak; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="ptgs_pasang">Petugas Pasang</label>
                                            <input class="form-control" type="text" name="ptgs_pasang" id="ptgs_pasang" value="<?php echo $ptgs_pasang; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="sisa_pulsa">Sisa Pulsa</label>
                                            <input class="form-control" type="text" name="sisa_pulsa" id="sisa_pulsa" value="<?php echo $sisa_pulsa; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="no_hp_plg">No. HP Pelanggan</label>
                                            <input class="form-control" type="number" name="no_hp_plg" id="no_hp_plg" value="<?php echo $no_hp_plg; ?>" required>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="std_dummy">Stand Dummy</label>
                                            <input class="form-control" type="text" name="std_dummy" id="std_dummy" value="<?php echo $std_dummy; ?>" required>
                                        </div>
                                    </div>    

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                            <a href="?page=mdg" class="btn btn-default"> Batal</a>
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