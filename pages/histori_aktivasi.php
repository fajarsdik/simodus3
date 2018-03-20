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

    <div id = "page-wrapper">
        <div class = "row">
            <div  class = "col-lg-12">
                <h1 class = "page-header">Histori Aktivasi</h1>
            </div>
        </div>
        <!-- Akhir Judul -->
        <?php
        $query = mysqli_query($config, "SELECT dft_aktivasi FROM tbl_sett");
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

        <?php
        if (isset($_REQUEST['submit'])) {
            $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
            echo '
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="?page=his_atv"><a href="?page=his_atv" class="alert-link">&times;</a></button>
                        <p>Hasil pencarian untuk kata kunci <strong>" ' . stripslashes($cari) . ' "</strong>
                    </div>
                            
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                            ' . $_SESSION['nama'] . '
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-13 col-md-8">
                                            <form method="post" action="?page=atv">
                                                <div class="col-xs-6 col-sm-4 input-group custom-search">
                                                    <input id="cari" name="cari" type="text" class="form-control" placeholder="Pencarian...">
                                                    <input type="submit" name="submit" class="hidden">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">
                                <thead>
                                <tr>
                                    <th width="5%" style="text-align: center">No. Dummy</th>
                                    <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                    <th width="5%" style="text-align: center">Merk Meter Rusak</th>
                                    <th width="5%" style="text-align: center">No. Meter Baru</th>
                                    <th width="5%" style="text-align: center">Merk Meter Baru</th>
                                    <th width="5%" style="text-align: center">ID Pelanggan</th>
                                    <th width="5%" style="text-align: center">Tanggal Aktivasi</th>
                                    <th width="5%" style="text-align: center">Petugas Aktivasi</th>
                                    <th width="5%" style="text-align: center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>';

            //script untuk mencari data
            $unit = $_SESSION['unit'];

            $query = mysqli_query($config, "SELECT * FROM tbl_aktivasi WHERE no_dummy LIKE '%$cari%' || no_meter_rusak LIKE '%$cari%'||"
                            . "no_meter_baru LIKE '%$cari%' || id_pelanggan LIKE '%$cari%' || nama LIKE '%$cari%' && unit='$unit%' "
                    . "ORDER by tgl_aktivasi DESC LIMIT $curr, $limit");

            if (mysqli_num_rows($query) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    echo ' 
                        <tr>
                        <td style="text-align: center">' . $row['no_dummy'] . '</td>
                        <td style="text-align: center">' . $row['no_meter_rusak'] . '</td>';

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
                    } else {
                        $merk_meter_rusak = 'Merk Lain';
                    }

                    echo '<td style="text-align: center">' . $merk_meter_rusak . '</td>';

                    echo '<td style="text-align: center">' . $row['no_meter_baru'] . '</td>';

                    if ($row['merk_meter_baru'] == 14) {
                        $merk_meter_baru = 'Hexing';
                    } else if ($row['merk_meter_baru'] == 86) {
                        $merk_meter_baru = 'Smart Meter';
                    } else if ($row['merk_meter_baru'] == 45) {
                        $merk_meter_baru = 'Sanxing';
                    } else if ($row['merk_meter_baru'] == 22) {
                        $merk_meter_baru = 'Star';
                    } else if ($row['merk_meter_baru'] == 60) {
                        $merk_meter_baru = 'FDE';
                    } else if ($row['merk_meter_baru'] == 32) {
                        $merk_meter_baru = 'Itron';
                    } else if ($row['merk_meter_baru'] == 34) {
                        $merk_meter_baru = 'Glomet';
                    } else if ($row['merk_meter_baru'] == 01) {
                        $merk_meter_baru = 'Hexing (Lama)';
                    } else {
                        $merk_meter_baru = 'Merk Lain';
                    }

                    echo '<td style="text-align: center">' . $merk_meter_baru . '</td>';
                    echo '<td style="text-align: center">' . $row['id_pelanggan'] . '</td>';

                    $y = substr($row['tgl_aktivasi'], 0, 4);
                    $m = substr($row['tgl_aktivasi'], 5, 2);
                    $d = substr($row['tgl_aktivasi'], 8, 2);
                    $h = substr($row['tgl_aktivasi'], 11, 2);
                    $i = substr($row['tgl_aktivasi'], 14, 2);
                    $s = substr($row['tgl_aktivasi'], 17, 2);

                    if ($m == "01") {
                        $nm = "Januari";
                    } elseif ($m == "02") {
                        $nm = "Februari";
                    } elseif ($m == "03") {
                        $nm = "Maret";
                    } elseif ($m == "04") {
                        $nm = "April";
                    } elseif ($m == "05") {
                        $nm = "Mei";
                    } elseif ($m == "06") {
                        $nm = "Juni";
                    } elseif ($m == "07") {
                        $nm = "Juli";
                    } elseif ($m == "08") {
                        $nm = "Agustus";
                    } elseif ($m == "09") {
                        $nm = "September";
                    } elseif ($m == "10") {
                        $nm = "Oktober";
                    } elseif ($m == "11") {
                        $nm = "November";
                    } elseif ($m == "12") {
                        $nm = "Desember";
                    }
                    echo '
                        <td style="text-align: center">' . $d . " " . $nm . " " . $y . ' <hr/> ' . $h . ":" . $i . ":" . $s . '</td>
                        <td style="text-align: center">' . $row['nama'] . '</td>
                        <td style="text-align: center">';

                    echo '<a class="btn btn-success">
                        <i class="fa fa-check"></i> Aktif</a>';

                    echo '
                            </td> 
                        </tr> 
                    </tbody>';
                }
            } else {
                echo '<tr><td colspan="9"><center><p class="add">Tidak ada data yg sudah diaktivasi.</p></center></td></tr>';
            }
            echo '</table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';

            $query = mysqli_query($config, "SELECT * FROM tbl_aktivasi");
            $cdata = mysqli_num_rows($query);
            $cpg = ceil($cdata / $limit);

            echo '<!-- Pagination START -->
                          <ul class="pagination">';

            if ($cdata > $limit) {

                //first and previous pagging
                if ($pg > 1) {
                    $prev = $pg - 1;
                    echo '<li><a href="?page=his_atv&pg=1"><i class="fa fa-angle-double-left"></i></a></li>
                                  <li><a href="?page=his_atv&pg=' . $prev . '"><i class="fa fa-angle-left"></i></a></li>';
                } else {
                    echo '<li class="disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                                  <li class="disabled"><a href=""><i class="fa fa-angle-left"></i></a></li>';
                }

                //perulangan pagging
                for ($i = 1; $i <= $cpg; $i++)
                    if ($i != $pg) {
                        echo '<li><a href="?page=his_atv&pg=' . $i . '"> ' . $i . ' </a></li>';
                    } else {
                        echo '<li><a href="?page=his_atv&pg=' . $i . '"> ' . $i . ' </a></li>';
                    }

                //last and next pagging
                if ($pg < $cpg) {
                    $next = $pg + 1;
                    echo '<li><a href="?page=his_atv&pg=' . $next . '"><i class="fa fa-angle-right"></i></a></li>
                                  <li><a href="?page=his_atv&pg=' . $cpg . '"><i class="fa fa-angle-double-right"></i></a></li>';
                } else {
                    echo '<li class="disabled"><a href=""><i class="fa fa-angle-right"></i></a></li>
                                  <li class="disabled"><a href=""><i class="fa fa fa-angle-double-right"></i></a></li>';
                }
                echo '
                        </ul>
                        <!-- Pagination END -->';
            } else {
                echo '';
            }
        } else {
            ?>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                    <?php echo $_SESSION['nama']; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-13 col-md-10">
                                    <form method="post" action="?page=his_atv">
                                        <div class="col-xs-6 col-sm-4 input-group custom-search">
                                            <input id="cari" name="cari" type="text" class="form-control" placeholder="Pencarian...">
                                            <input type="submit" name="submit" class="hidden">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">

                            <thead>
                                <tr>
                                    <th width="5%" style="text-align: center">No. Dummy</th>
                                    <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                    <th width="5%" style="text-align: center">Merk Meter Rusak</th>
                                    <th width="5%" style="text-align: center">No. Meter Baru</th>
                                    <th width="5%" style="text-align: center">Merk Meter Baru</th>
                                    <th width="5%" style="text-align: center">ID Pelanggan</th>
                                    <th width="5%" style="text-align: center">Tanggal Aktivasi</th>
                                    <th width="5%" style="text-align: center">Petugas Aktivasi</th>
                                    <th width="5%" style="text-align: center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                //script untuk menampilkan data
                                $unit = $_SESSION['unit'];

                                $no = 1;

                                $query = mysqli_query($config, "SELECT * FROM tbl_aktivasi WHERE unit LIKE '$unit%' ORDER by tgl_aktivasi DESC LIMIT $curr, $limit");
                                if (mysqli_num_rows($query) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo ' 
                                                <tr>
                                                <td style="text-align: center">' . $row['no_dummy'] . '</td>
                                                <td style="text-align: center">' . $row['no_meter_rusak'] . '</td>';

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
                                        } else {
                                            $merk_meter_rusak = 'Merk Lain';
                                        }

                                        echo '<td style="text-align: center">' . $merk_meter_rusak . '</td>';

                                        echo '<td style="text-align: center">' . $row['no_meter_baru'] . '</td>';

                                        if ($row['merk_meter_baru'] == 14) {
                                            $merk_meter_baru = 'Hexing';
                                        } else if ($row['merk_meter_baru'] == 86) {
                                            $merk_meter_baru = 'Smart Meter';
                                        } else if ($row['merk_meter_baru'] == 45) {
                                            $merk_meter_baru = 'Sanxing';
                                        } else if ($row['merk_meter_baru'] == 22) {
                                            $merk_meter_baru = 'Star';
                                        } else if ($row['merk_meter_baru'] == 60) {
                                            $merk_meter_baru = 'FDE';
                                        } else if ($row['merk_meter_baru'] == 32) {
                                            $merk_meter_baru = 'Itron';
                                        } else if ($row['merk_meter_baru'] == 34) {
                                            $merk_meter_baru = 'Glomet';
                                        } else if ($row['merk_meter_baru'] == 01) {
                                            $merk_meter_baru = 'Hexing (Lama)';
                                        } else {
                                            $merk_meter_baru = 'Merk Lain';
                                        }

                                        echo '<td style="text-align: center">' . $merk_meter_baru . '</td>';
                                        echo '<td style="text-align: center">' . $row['id_pelanggan'] . '</td>';

                                        $y = substr($row['tgl_aktivasi'], 0, 4);
                                        $m = substr($row['tgl_aktivasi'], 5, 2);
                                        $d = substr($row['tgl_aktivasi'], 8, 2);
                                        $h = substr($row['tgl_aktivasi'], 11, 2);
                                        $i = substr($row['tgl_aktivasi'], 14, 2);
                                        $s = substr($row['tgl_aktivasi'], 17, 2);

                                        if ($m == "01") {
                                            $nm = "Januari";
                                        } elseif ($m == "02") {
                                            $nm = "Februari";
                                        } elseif ($m == "03") {
                                            $nm = "Maret";
                                        } elseif ($m == "04") {
                                            $nm = "April";
                                        } elseif ($m == "05") {
                                            $nm = "Mei";
                                        } elseif ($m == "06") {
                                            $nm = "Juni";
                                        } elseif ($m == "07") {
                                            $nm = "Juli";
                                        } elseif ($m == "08") {
                                            $nm = "Agustus";
                                        } elseif ($m == "09") {
                                            $nm = "September";
                                        } elseif ($m == "10") {
                                            $nm = "Oktober";
                                        } elseif ($m == "11") {
                                            $nm = "November";
                                        } elseif ($m == "12") {
                                            $nm = "Desember";
                                        }
                                        echo '
                                                <td style="text-align: center">' . $d . " " . $nm . " " . $y . ' <hr/> ' . $h . ":" . $i . ":" . $s . '</td>
                                                <td style="text-align: center">' . $row['nama'] . '</td>
                                                <td style="text-align: center">';


                                        echo '<a class="btn btn-success">
                                                    <i class="fa fa-check"></i> Aktif</a>';

                                        echo '
                                                </td> 
                                            </tr> 
                                        </tbody>';
                                    }
                                } else {
                                    echo '<tr><td colspan="9"><center><p class="add">Tidak ada data yg sudah diaktivasi.</p></center></td></tr>';
                                }
                                ?> 
                        </table>
                    </div>
                    <!--/.table-responsive -->

                    <?php
                    $query = mysqli_query($config, "SELECT * FROM tbl_aktivasi");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata / $limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if ($cdata > $limit) {

                        //first and previous pagging
                        if ($pg > 1) {
                            $prev = $pg - 1;
                            echo '<li><a href="?page=his_atv&pg=1"><i class="fa fa-angle-double-left"></i></a></li>
                                  <li><a href="?page=his_atv&pg=' . $prev . '"><i class="fa fa-angle-left"></i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                                  <li class="disabled"><a href=""><i class="fa fa-angle-left"></i></a></li>';
                        }

                        //perulangan pagging
                        for ($i = 1; $i <= $cpg; $i++)
                            if ($i != $pg) {
                                echo '<li><a href="?page=his_atv&pg=' . $i . '"> ' . $i . ' </a></li>';
                            } else {
                                echo '<li><a href="?page=his_atv&pg=' . $i . '"> ' . $i . ' </a></li>';
                            }

                        //last and next pagging
                        if ($pg < $cpg) {
                            $next = $pg + 1;
                            echo '<li><a href="?page=his_atv&pg=' . $next . '"><i class="fa fa-angle-right"></i></a></li>
                                  <li><a href="?page=his_atv&pg=' . $cpg . '"><i class="fa fa-angle-double-right"></i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                  <li class="disabled"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>';
                        }
                        echo '
                        </ul>
                        <!-- Pagination END -->';
                    } else {
                        echo '';
                    }
                    ?>
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