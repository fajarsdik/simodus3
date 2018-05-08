<?php
require('../include/config.php');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=dummy.xls");

$unit = $_GET['unit'];
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

switch ($unit) {
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
?>

<h2>Pemakaian Dummy</h2>
<h3>Rayon <?= $admin_rayon ?></h3>


<table width="100%" border="1">
    <thead>
        <tr>
            <th width = "2%" style = "text-align: center">No.</th>
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
    <tbody>

        <?php
        $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai a LEFT JOIN tbl_aktivasi b ON a.id_meter = b.id_meter RIGHT JOIN tbl_metdum_kbl c ON a.id_meter = c.id_meter "
                . "WHERE a.tgl_pakai BETWEEN '$tgl_awal' AND '$tgl_akhir' && a.unit='$unit' ORDER BY a.tgl_pakai ASC");

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
        ?>

    </tbody>
</table>

