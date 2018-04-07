<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {
    ?>

    <div id="page-wrapper">
        <div class = "row">
            <div class = "col-lg-12">
                <h1 class = "page-header">Laporan Dummy</h1>
            </div>
        </div>

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
                                        $admin_area = "Dumai";
                                        break;
                                }

                                if ($_SESSION['admin'] == 1 && $_SESSION['unit'] == $unit_area) {
                                    echo '<div class = "row">
                                        <div class = "form-group col-lg-3">
                                            <label>Area</label>
                                            <select class= "form-control" name="area" id="area" required>
                                                <option value="" disabled selected>-----</option>
                                                <option value="181">Pekanbaru</option>
                                                <option value="182">Dumai</option>
                                                <option value="183">Tanjungpinang</option>
                                                <option value="184">Rengat</option>
                                            </select>
                                        </div>';
                                } else {
                                    echo '<div class="row">
                                        <div class="form-group col-lg-3">
                                            <label>Area</label>
                                            <select class = "form-control" name="area" id="area" readonly>
                                                <option value=" ' . $_SESSION['admin'] . ' "> ' . $admin_area . '</option>
                                            </select>
                                        </div>';
                                }

                                $unit_rayon = $_SESSION['unit'];

                                switch ($unit_rayon) {
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
                                }

                                if ($_SESSION['unit'] == $unit_rayon) {
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
                                    <option value="183010">Anambas</option>
                                </select>
                            </div>';
                                } else {
                                    echo '<div class = "form-group col-lg-3">
                                <label>Rayon</label>
                                <select class = "form-control" name = "rayon" id = "rayon" required>
                                    <option value=" ' . $unit_rayon . ' "> ' . $unit_rayon . '</option>
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
                            <button type = "submit" class = "btn btn-default"><i class = "fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
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
        <!-- Hasil Pencarian -->
        <div class = "row">
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <i class = "fa fa-search"></i> Hasil Pencarian
                </div>

                <div class = "panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">
                            <thead>
                                <tr>
                                    <th width="5%" style="text-align: center">No.</th>
                                    <th width="5%" style="text-align: center">Tgl Pakai</th>
                                    <th width="5%" style="text-align: center">ID Pelanggan</th>
                                    <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                    <th width="5%" style="text-align: center">Merk Meter Rusak</th>
                                    <th width="5%" style="text-align: center">Alasan Rusak</th>
                                    <th width="5%" style="text-align: center">Sisa Pulsa</th>
                                    <th width="5%" style="text-align: center">No. Dummy</th>
                                    <th width="5%" style="text-align: center">Stand Dummy</th>
                                    <th width="5%" style="text-align: center">Stand Kembali</th>
                                    <th width="5%" style="text-align: center">Pemakaian Dummy</th>
                                    <th width="5%" style="text-align: center">Tgl Kembali</th>
                                    <th width="5%" style="text-align: center">Posko</th>
                                </tr>
                            </thead>
                            <tbody>';

        
        // query mencari laporan
        $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai a JOIN tbl_aktivasi b ON a.id_meter = b.id_meter "
                . "JOIN tbl_metdum_kbl c ON a.id_meter = c.id_meter BETWEEN '$tgl_awal' AND '$tgl_akhir' WHERE a.unit LIKE '$rayon%' ORDER BY a.tgl_pakai");

        if (mysqli_num_rows($query) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>
                        <td style="text-align: center">' . $no . '</td>
                        <td style="text-align: center">' . $row['a.tgl_pakai'] . '</td>
                        <td style="text-align: center">' . $row['b.id_pelanggan'] . '</td>
                        <td style="text-align: center">' . $row['a.no_meter_rusak'] . '</td>';

                        if ($row['a.merk_meter_rusak'] == 14) {
                            $merk_meter_rusak = 'Hexing';
                        } else if ($row['a.merk_meter_rusak'] == 86) {
                            $merk_meter_rusak = 'Smart Meter';
                        } else if ($row['a.merk_meter_rusak'] == 45) {
                            $merk_meter_rusak = 'Sanxing';
                        } else if ($row['a.merk_meter_rusak'] == 22) {
                            $merk_meter_rusak = 'Star';
                        } else if ($row['a.merk_meter_rusak'] == 60) {
                            $merk_meter_rusak = 'FDE';
                        } else if ($row['a.merk_meter_rusak'] == 32) {
                            $merk_meter_rusak = 'Itron';
                        } else if ($row['a.merk_meter_rusak'] == 34) {
                            $merk_meter_rusak = 'Glomet';
                        } else if ($row['a.merk_meter_rusak'] == 01) {
                            $merk_meter_rusak = 'Hexing (Lama)';
                        } else if ($row['a.merk_meter_rusak'] == 50) {
                            $merk_meter_rusak = 'Cannet';
                        } else {
                            $merk_meter_rusak = 'Merk Lain';
                        }

                        echo '
                            <td style = "text-align: center">' . $merk_meter_rusak . '</td>';

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

                        echo '
                            <td style = "text-align: center">' . $merk_meter_rusak . '</td>';

                        echo ' 
                            </tr>';
                            }
                        } else {
                            echo '<tr><td colspan = "10"><center><p class = "add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                        }
                        echo ' 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir hasil pencarian data -->';
                        
    } else {
        ?>

        Tes



        <?php
    }
}    