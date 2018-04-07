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
                                                <option value=" ' . $unit_area . ' "> ' . $admin_area . '</option>
                                            </select>
                                        </div>';
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
                                }

                                if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
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
                                        <select class = "form-control" name = "rayon" id = "rayon" readonly>
                                            <option value=" ' . $_SESSION['unit'] . ' "> ' . $admin_rayon . '</option>
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

            $area = $_REQUEST['area']; echo $area;
            $rayon = $_REQUEST['rayon']; echo $rayon;
            $tgl_awal = $_REQUEST['tgl_awal']; echo $tgl_awal;
            $tgl_akhir = $_REQUEST['tgl_akhir']; echo $tgl_akhir;
            $unit = $_SESSION['unit'];

            echo ' 
            <div class = "panel panel-primary">
                <div class = "panel-heading"><i class = "fa fa-file-o"></i>
                    Hasil Pencarian
                </div>
                <div class = "panel-body">
                    <div class = "table-responsive">
                        <table width = "100%" class = "table table-striped table-bordered table-hover" id = "dataTables-1">
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
                                    <th width = "5%" style = "text-align: center">Stand Dummy</th>
                                    <th width = "5%" style = "text-align: center">Stand Kembali</th>
                                    <th width = "5%" style = "text-align: center">Pemakaian Dummy</th>
                                    <th width = "5%" style = "text-align: center">Tgl Kembali</th>
                                    <th width = "5%" style = "text-align: center">Posko</th>
                                </tr>
                            </thead>
                            <tbody>';
            
            
            //query mencari data
            $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai a LEFT JOIN tbl_aktivasi b ON a.id_meter = b.id_meter LEFT JOIN tbl_metdum_kbl c ON a.id_meter = c.id_meter "
                    . "WHERE a.tgl_pakai BETWEEN '2018-04-02' AND '2018-04-03' ORDER BY a.tgl_pakai DESC");

            if (mysqli_num_rows($query) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo' 
                        <tr>
                            <td style = "text-align: center">' . $no++ . '</td>
                            <td style = "text-align: center">' . $row['tgl_pakai'] . '</td>
                            <td style = "text-align: center">' . $row['id_pelanggan'] . '</td>
                            <td style = "text-align: center">' . $row['no_meter_rusak'] . '</td>
                         
                        </tr>';
                }
            } else {
                echo ' 
                    <tr>
                        <td colspan="13"><center>Tidak ada data yang ditemukan.</center></td>
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

            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-file-o"></i>
                    Hasil Pencarian
                </div>
                <div class="panel-body">
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

                        </table>
                    </div>
                    <!--/.table-responsive -->
                </div>
                <!--/.panel-body -->
            </div>
            <!--/.panel -->
        </div>
        <!--/.col-lg-12 -->
        <?php
    }
}
?>