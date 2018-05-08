<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {

    $query = mysqli_query($config, "SELECT metdum_pakai FROM tbl_sett");
    list($metdum_pakai) = mysqli_fetch_array($query);

    //pagging
    $limit = $metdum_pakai;
    $pg = @$_GET['pg'];
    if (empty($pg)) {
        $curr = 0;
        $pg = 1;
    } else {
        $curr = ($pg - 1) * $limit;
    }
    ?>

    <div id = "page-wrapper">
        <div class = "row">
            <div  class = "col-lg-12">
                <h1 class = "page-header">Laporan Meter Dummy</h1>
            </div>
        </div>
        <!-- Akhir Judul -->

        <div class = "row">
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <i class = "fa fa-search"></i> Pencarian Data
                </div>
                <div class = "panel-body">
                    <form method="POST" action="?page=lpd" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">

                                <?php
                                $unit_area = substr($_SESSION['unit'], 0, 3);

                                switch ($unit_area) {
                                    case '181' :
                                        $admin_area = "Pekanbaru";
                                        break;
                                    case '182' :
                                        $admin_area = "Dumai";
                                        break;
                                    case '183' :
                                        $admin_area = "Tanjungpinang";
                                        break;
                                    case '184' :
                                        $admin_area = "Rengat";
                                        break;
                                }

                                switch ($_SESSION['unit']) {
                                    case '18301' :
                                        $admin_rayon = "Bintan Center";
                                        break;
                                    case '18302' :
                                        $admin_rayon = "Kijang";
                                        break;
                                    case '18303' :
                                        $admin_rayon = "Tg Uban";
                                        break;
                                    case '18304' :
                                        $admin_rayon = "Belakang Padang";
                                        break;
                                    case '18305' :
                                        $admin_rayon = "Tg Balai Karimun";
                                        break;
                                    case '18306' :
                                        $admin_rayon = "Tg Batu";
                                        break;
                                    case '18307' :
                                        $admin_rayon = "Dabosingkep";
                                        break;
                                    case '18308' :
                                        $admin_rayon = "Natuna";
                                        break;
                                    case '18309' :
                                        $admin_rayon = "Tanjungpinang Kota";
                                        break;
                                    case '18310' :
                                        $admin_rayon = "Anambas";
                                        break;
                                    case '1845' :
                                        $admin_rayon = "Air Molek";
                                        break;
                                }

                                if ($_SESSION['admin'] == 2) {

                                    echo '<div class = "row">
                                        <div class = "form-group col-lg-3">
                                            <label>Area</label>
                                            <select class= "form-control" name="area" id="area" required>
                                                <option value="' . $_SESSION['unit'] . '" readonly selected>' . $admin_area . '</option>
                                            </select>
                                        </div>';

                                    if ($_SESSION['unit'] == 183) {

                                        echo '<div class = "form-group col-lg-3">
                                                <label>Rayon</label>
                                                <select class = "form-control" name = "rayon" id = "rayon" required>
                                                    <option value="" disabled selected>-----</option>
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
                                } if ($_SESSION['admin'] == 3) {
                                    echo '<div class = "row">
                                        <div class = "form-group col-lg-3">
                                            <label>Area</label>
                                            <select class= "form-control" name="area" id="area" required>
                                                <option value="' . $unit_area . '" readonly selected>' . $admin_area . '</option>
                                            </select>
                                        </div>';

                                    echo '<div class = "form-group col-lg-3">
                                            <label>Rayon</label>
                                            <select class = "form-control" name = "rayon" id = "rayon" required>
                                                <option value="' . $_SESSION['unit'] . '" readonly selected>' . $admin_rayon . '</option>
                                            </select>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-lg-12">
                                <div class = "form-group col-lg-3">
                                    <label for = "tgl_awal">Mulai Tanggal</label>
                                    <input class = "form-control" type = "date" name = "tgl_awal" id = "tgl_awal" required>
                                </div>
                                <div class = "form-group col-lg-3">
                                    <label for = "tgl_akhir">Sampai Tanggal</label> 
                                    <input class = "form-control" type = "date" name = "tgl_akhir" id = "tgl_akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button name="submit" type="submit" class = "btn btn-default"><i class = "fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_REQUEST['submit'])) {

            $area = $_REQUEST['area'];
            $rayon = $_REQUEST['rayon'];
            $tgl_awal = $_REQUEST['tgl_awal'];
            $tgl_akhir = $_REQUEST['tgl_akhir'];
            $unit = $_SESSION['unit'];

            echo ' 
            <div class = "panel panel-primary">
                <div class = "panel-heading"><i class = "fa fa-file-o"></i>
                    Hasil Pencarian
                </div>
                
                <div class = "panel-body">
                    <div class = "table-responsive">
                    <a href="proses_laporan_dummy.php?unit='. $rayon .'&tgl_awal='. $tgl_awal .'&tgl_akhir='. $tgl_akhir .'" class="btn btn-default">Export ke Excel</a>
                    <div class="row"></div><br/>
                        <table width = "100%" class = "table table-striped table-bordered table-hover" id = "monitoring-1">
                            <thead>
                                <tr>
                                    <th width = "5%" style = "text-align: center">No.</th>
                                    <th width = "5%" style = "text-align: center">Tgl Pakai</th>
                                    <th width = "5%" style = "text-align: center">ID Pelanggan</th>
                                    <th width = "5%" style = "text-align: center">No. Meter Rusak</th>
                                    <th width = "5%" style = "text-align: center">Merk Meter Rusak</th>
                                    <th width = "5%" style = "text-align: center">Alasan Rusak</th>
                                    <th width = "5%" style = "text-align: center">Sisa Pulsa</th>
                                    <th width = "5%" style = "text-align: center">No. Dummy</th>
                                    <th width = "5%" style = "text-align: center">Stand Pasang</th>
                                    <th width = "5%" style = "text-align: center">Stand Kembali</th>
                                    <th width = "5%" style = "text-align: center">Pemakaian Dummy</th>
                                    <th width = "5%" style = "text-align: center">Tgl Kembali</th>
                                    <th width = "5%" style = "text-align: center">Posko</th>
                                </tr>
                            </thead>
                            <tbody>';

            //query mencari data
            $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai a LEFT JOIN tbl_aktivasi b ON a.id_meter = b.id_meter RIGHT JOIN tbl_metdum_kbl c ON a.id_meter = c.id_meter "
                    . "WHERE a.tgl_pakai BETWEEN '$tgl_awal' AND '$tgl_akhir' && a.unit='$rayon' ORDER BY a.tgl_pakai DESC");

            if (mysqli_num_rows($query) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo' 
                        <tr>
                            <td style = "text-align: center">' . $no++ . '</td>
                            <td style = "text-align: center">' . $row['tgl_pakai'] . '</td>
                            <td style = "text-align: center">' . $row['id_pelanggan'] . '</td>
                            <td style = "text-align: center">' . $row['no_meter_rusak'] . '</td>';

                    //merk tipe tahun otomatis  dibagian tampilan aja      
                    $no_meter_rusak = $row['no_meter_rusak'];
                    $pot12 = substr($no_meter_rusak, 0, 2);
                    $pot34 = substr($no_meter_rusak, 2, 2);
                    $pjg_seri = strlen($no_meter_rusak);

                    $queryseri = mysqli_query($config, "SELECT * FROM tbl_seri_meter WHERE panjang='$pjg_seri' && seri12='$pot12'");
                    $rowseri = mysqli_fetch_array($queryseri);
                    $merk_meter_rusak = $rowseri['merk'];
                    $tipe_meter_rusak = $rowseri['tipe'];
                    $tahun_meter_rusak = $rowseri['tahun'];

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

                    if (empty($row['stand'])) {
                        $pem_dummy = 0;
                    } else if ($row['std_dummy'] > $row['stand']) {
                        $pem_dummy = "Periksa Stand Kembali";
                    } else {
                        $pem_dummy = $row['stand'] - $row['std_dummy'];
                    }

                    echo '<td style="text-align: center">' . $merk_meter_rusak . '</td>
                            <td style = "text-align: center">' . $alasan_rusak . '</td>
                            <td style = "text-align: center">' . $row['sisa_pulsa'] . '</td>
                            <td style = "text-align: center">' . $row['no_dummy'] . '</td>
                            <td style = "text-align: center">' . $row['std_dummy'] . '</td>
                            <td style = "text-align: center">' . $row['stand'] . '</td>
                            <td style = "text-align: center">' . $pem_dummy . '</td>
                            <td style = "text-align: center">' . $row['tgl_kembali'] . '</td>
                            <td style = "text-align: center">' . $row['lokasi_posko'] . '</td>
                    </tr>';
                }
            } else {
                echo '
                    <tr>
                        <td colspan = "13"><center>Tidak ada data yang ditemukan.</center></td>
                    </tr>';
            }

            echo '
                        </tbody>
                    </table>
                </div>
            <!--/.table-responsive -->
            </div>
        <!--/.panel-body -->
        </div>';
        } else {
            ?>

            <!--/.panel -->
        </div>
        <!--/.col-lg-12 -->
        <?php
    }
}
?>