<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    $id_meter = $_REQUEST['id_meter'];
    $unit = $_SESSION['unit'];

    $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE id_meter='$id_meter' && unit LIKE '$unit%'");

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_array($query)) {

            if ($row['merk_meter_rusak'] == 14) {
                $merk_meter_rusak = 'Hexing';
            } else if ($row['merk_meter_rusak'] == 86) {
                $merk_meter_rusak = 'Smart Meter';
            } else if ($row['merk_meter_rusak'] == 45) {
                $merk_meter_rusak = 'Sanxing';
            } else if ($row['merk_meter_rusak'] == 22) {
                $merk_meter_rusak = 'Star';
            } else if ($row['merk_meter_rusak'] == 60) {
                $merk_meter_rusak = 'FDE';
            } else if ($row['merk_meter_rusak'] == 32) {
                $merk_meter_rusak = 'Itron';
            } else if ($row['merk_meter_rusak'] == 34) {
                $merk_meter_rusak = 'Glomet';
            } else if ($row['merk_meter_rusak'] == 01) {
                $merk_meter_rusak = 'Hexing (Lama)';
            } else if ($row['merk_meter_rusak'] == 50) {
                $merk_meter_rusak = 'Cannet';
            } else {
                $merk_meter_rusak = 'Merk lain';
            }

            if ($row['alasan_rusak'] == 1) {
                $alasan_rusak = "Token tidak dapat dimasukkan";
            } else if ($row['alasan_rusak'] == 2) {
                $alasan_rusak = "Sisa kredit pada kWh meter hilang/bertambah saat listrik padam";
            } else if ($row['alasan_rusak'] == 3) {
                $alasan_rusak = "Kerusakan pada keypad";
            } else if ($row['alasan_rusak'] == 4) {
                $alasan_rusak = "LCD mati/rusak";
            } else if ($row['alasan_rusak'] == 5) {
                $alasan_rusak = "kWh Meter rusak (akibat petir/terbakar)";
            } else if ($row['alasan_rusak'] == 6) {
                $alasan_rusak = "Sisa kredit tidak bertambah saat kredit baru dimasukkan";
            } else if ($row['alasan_rusak'] == 7) {
                $alasan_rusak = "Baut tutup terminal patah";
            } else if ($row['alasan_rusak'] == 8) {
                $alasan_rusak = "Tegangan dibawah 180V tidak bisa hidup";
            } else if ($row['alasan_rusak'] == 9) {
                $alasan_rusak = "Micro switch rusak / tidak keluar tegangan";
            } else if ($row['alasan_rusak'] == 10) {
                $alasan_rusak = "ID meter pada display dan nameplate tidak sama";
            } else if ($row['alasan_rusak'] == 11) {
                $alasan_rusak = "Sisa kredit tidak berkurang";
            } else if ($row['alasan_rusak'] == 12) {
                $alasan_rusak = "Display overload tanpa beban";
            } else if ($row['alasan_rusak'] == 13) {
                $alasan_rusak = "Terminal kWh meter rusak";
            } else if ($row['alasan_rusak'] == 14) {
                $alasan_rusak = "Meter periksa/tutup dibuka lampu tetap nyala";
            } else if ($row['alasan_rusak'] == 15) {
                $alasan_rusak = "Timbul rusak";
            } else if ($row['alasan_rusak'] == 16) {
                $alasan_rusak = "kWh minus";
            } else if ($row['alasan_rusak'] == 17) {
                $alasan_rusak = "kWh bertambah";
            } else if ($row['alasan_rusak'] == 18) {
                $alasan_rusak = "Lain-lain";
            }
            ?> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hapus Data Pemakaian Dummy</h1>
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
                                    ?>
                                    <div class="well">
                                        <table class="table table-responsive">
                                            <thead class="red lighten-5 red-text">
                                                <div id="12"  class="alert alert-danger">
                                                    Apakah Anda yakin akan menghapus data ini?
                                                </div>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $no_dummy = $row['no_dummy'];
                                                $no_meter_rusak = $row['no_meter_rusak'];
                                                ?>

                                                <tr>
                                                    <td width="22%">No. Dummy</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $no_dummy ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">No. Meter Rusak</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $no_meter_rusak ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Merk Meter Rusak</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $merk_meter_rusak; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Alasan Rusak</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $alasan_rusak; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Tanggal Pakai</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $tgl = date('d M Y ', strtotime($row['tgl_pakai'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Petugas Pasang</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['ptgs_pasang'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Sisa Pulsa</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['sisa_pulsa'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">No. HP Pelanggan</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['no_hp_plg'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Stand Dummy</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['std_dummy'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-action"> <?php echo ' 
                                            <a href="?page=mdg&act=del&submit=yes&id_meter=' . $row['id_meter'] . '" class="btn btn-danger">HAPUS <i class="material-icons"></i></a>
                                            <a href="?page=mdg" class="btn btn-default">BATAL <i class="material-icons"></i></a>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_REQUEST['submit'])) {
                                    $unit = $_SESSION['unit'];

                                    $cek_aktivasi = mysqli_query($config, "SELECT aktivasi FROM tbl_metdum_pakai WHERE id_meter='$id_meter' && unit LIKE '$unit%'");
                                    list($aktivasi) = mysqli_fetch_array($cek_aktivasi);

                                    if ($aktivasi == "non aktif") {

                                        $update_stok = mysqli_query($config, "UPDATE tbl_metdum_stok SET status='ready', tgl_pakai=NULL, no_meter_rusak='' WHERE no_dummy='$no_dummy' && unit LIKE '$unit%'");

                                        $query = mysqli_query($config, "DELETE FROM tbl_metdum_pakai WHERE id_meter='$id_meter' && unit LIKE '$unit%'");

                                        if ($query == true) {
                                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                                            header("Location: ./admin.php?page=mdg");
                                            die();
                                        } else {
                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                            echo '<script language="javascript">
                                                    window.location.href=" ./admin.php?page=mdg&act=del&id_meter=' . $id_meter . '";
                                                  </script>';
                                        }
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Meter sudah aktivasi dan data tidak bisa dihapus!';
                                        unset($_SERVER['errQ']);
                                    }
                                }
                            }
                        }
                    }
                    ?> </div>
            </div>
        </div>

