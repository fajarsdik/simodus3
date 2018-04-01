<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
        </script>';
    die();
} else {

    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Meter Dummy Terpasang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-hover" id="monitoring">
                                    <thead>
                                        <tr>
                                            <th width="7%" style="text-align: center">Unit</th>
                                            <th width="5%" style="text-align: center">No. Dummy</th>
                                            <th width="12%" style="text-align: center">No. Meter Rusak</th>
                                            <th width="12%" style="text-align: center">Hari Layanan</th>
                                            <th width="12%" style="text-align: center">Tgl Pakai</th>
                                            <th width="12%" style="text-align: center">Tgl Aktivasi</th>
                                            <th width="12%" style="text-align: center">Tgl Kembali</th>
                                            <th width="12%" style="text-align: center">Lama Standby</th>
                                            <th width="10%" style="text-align: center">Posko</th>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <?php
                                            //script untuk menampilkan data
                                            $unit = $_SESSION['unit'];

                                            $query = mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit LIKE '$unit%' && status='' ORDER BY unit, tgl_pakai ASC");
                                            if (mysqli_num_rows($query) > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                    <td style="text-align: center"><?= $row['unit'] ?></td>
                                                    <td style="text-align: center"><?= $row['no_dummy'] ?></td>
                                                    <td style="text-align: center"><?= $row['no_meter_rusak'] ?></td>

                                                    <?php
                                                    if (!empty($row['tgl_pakai']) && $row['tgl_kembali'] < $row['tgl_pakai']) {
                                                        $awal = date_create($row['tgl_pakai']);
                                                        $akhir = date_create();
                                                        $hari_layanan = date_diff($awal, $akhir);

                                                        echo '   
                                                    <td style="text-align: center">' . $hari_layanan->d . ' hari ' . $hari_layanan->h . ' jam</td>';
                                                    } else {
                                                        echo '   
                                                    <td style="text-align: center"> </td>';
                                                    }

                                                    //perhitungan tgl pakai
                                                    if (empty($row['tgl_pakai'])) {
                                                        echo '<td style="text-align: center"> </td>';
                                                    } else {

                                                        $y = substr($row['tgl_pakai'], 0, 4);
                                                        $m = substr($row['tgl_pakai'], 5, 2);
                                                        $d = substr($row['tgl_pakai'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                    }

                                                    //perhitungan tgl aktivasi
                                                    if ($row['tgl_aktivasi'] < $row['tgl_pakai']) {
                                                        echo '<td style="text-align: center"></td>';
                                                    } elseif (empty($row['tgl_pakai'])) {
                                                        echo '<td style="text-align: center"></td>';
                                                    } else {

                                                        $y = substr($row['tgl_aktivasi'], 0, 4);
                                                        $m = substr($row['tgl_aktivasi'], 5, 2);
                                                        $d = substr($row['tgl_aktivasi'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                    }

                                                    //perhitungan tgl kembali
                                                    if ($row['tgl_kembali'] < $row['tgl_aktivasi'] || $row['tgl_kembali'] < $row['tgl_pakai']) {
                                                        echo '<td style="text-align: center"> </td>';
                                                    } elseif (empty($row['tgl_aktivasi'])) {
                                                        echo '<td style="text-align: center"> </td>';
                                                    } else {

                                                        $y = substr($row['tgl_kembali'], 0, 4);
                                                        $m = substr($row['tgl_kembali'], 5, 2);
                                                        $d = substr($row['tgl_kembali'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                    }

                                                    //perhitungan lama standby
                                                    if (!empty($row['tgl_pakai']) && $row['tgl_kembali'] > $row['tgl_pakai']) {
                                                        $awal = date_create($row['tgl_kembali']);
                                                        $akhir = date_create();
                                                        $lama_standby = date_diff($awal, $akhir);
                                                        echo
                                                        '<td style="text-align: center">' . $lama_standby->d . ' hari ' . $lama_standby->h . ' jam</td>';
                                                    } else {
                                                        echo '   
                                                    <td style="text-align: center"> </td>';
                                                    }
                                                    echo '<td style="text-align: center"> ' . $row['posko'] . ' </td>
                                                </tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Row form END -->


                        </div>
                        <!--/.panel-body -->
                    </div>
                    <!--/.panel -->
                </div>

                <!--/.col-lg-6 -->
            </div>
            <!--/.row -->
        </div>
        <?php
    } else {
        if ($_SESSION['admin'] == 3 || $_SESSION['admin'] == 4 || $_SESSION['admin'] == 5) {
            ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Meter Dummy Terpasang</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-hover" id="monitoring">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center">No. Dummy</th>
                                                <th width="12%" style="text-align: center">No. Meter Rusak</th>
                                                <th width="12%" style="text-align: center">Hari Layanan</th>
                                                <th width="12%" style="text-align: center">Tgl Pakai</th>
                                                <th width="12%" style="text-align: center">Tgl Aktivasi</th>
                                                <th width="12%" style="text-align: center">Tgl Kembali</th>
                                                <th width="12%" style="text-align: center">Lama Standby</th>
                                                <th width="10%" style="text-align: center">Posko</th>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <?php
                                                //script untuk menampilkan data
                                                $unit = $_SESSION['unit'];

                                                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit LIKE '$unit%' && status='' ORDER BY tgl_pakai ASC");
                                                if (mysqli_num_rows($query) > 0) {
                                                    $no = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>

                                                        <td style="text-align: center"><?= $row['no_dummy'] ?></td>
                                                        <td style="text-align: center"><?= $row['no_meter_rusak'] ?></td>

                                                        <?php
                                                        if (!empty($row['tgl_pakai']) && $row['tgl_kembali'] < $row['tgl_pakai']) {
                                                            $awal = date_create($row['tgl_pakai']);
                                                            $akhir = date_create();
                                                            $hari_layanan = date_diff($awal, $akhir);

                                                            echo '   
                                                    <td style="text-align: center">' . $hari_layanan->d . ' hari ' . $hari_layanan->h . ' jam</td>';
                                                        } else {
                                                            echo '   
                                                    <td style="text-align: center"> </td>';
                                                        }

                                                        //perhitungan tgl pakai
                                                        if (empty($row['tgl_pakai'])) {
                                                            echo '<td style="text-align: center"> </td>';
                                                        } else {

                                                            $y = substr($row['tgl_pakai'], 0, 4);
                                                            $m = substr($row['tgl_pakai'], 5, 2);
                                                            $d = substr($row['tgl_pakai'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                        }

                                                        //perhitungan tgl aktivasi
                                                        if ($row['tgl_aktivasi'] < $row['tgl_pakai']) {
                                                            echo '<td style="text-align: center"></td>';
                                                        } elseif (empty($row['tgl_pakai'])) {
                                                            echo '<td style="text-align: center"></td>';
                                                        } else {

                                                            $y = substr($row['tgl_aktivasi'], 0, 4);
                                                            $m = substr($row['tgl_aktivasi'], 5, 2);
                                                            $d = substr($row['tgl_aktivasi'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                        }

                                                        //perhitungan tgl kembali
                                                        if ($row['tgl_kembali'] < $row['tgl_aktivasi'] || $row['tgl_kembali'] < $row['tgl_pakai']) {
                                                            echo '<td style="text-align: center"> </td>';
                                                        } elseif (empty($row['tgl_aktivasi'])) {
                                                            echo '<td style="text-align: center"> </td>';
                                                        } else {

                                                            $y = substr($row['tgl_kembali'], 0, 4);
                                                            $m = substr($row['tgl_kembali'], 5, 2);
                                                            $d = substr($row['tgl_kembali'], 8, 2);

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
                                                    <td style="text-align: center">' . $d . " " . $nm . " " . $y . '</td>';
                                                        }

                                                        //perhitungan lama standby
                                                        if (!empty($row['tgl_pakai']) && $row['tgl_kembali'] > $row['tgl_pakai']) {
                                                            $awal = date_create($row['tgl_kembali']);
                                                            $akhir = date_create();
                                                            $lama_standby = date_diff($awal, $akhir);
                                                            echo
                                                            '<td style="text-align: center">' . $lama_standby->d . ' hari ' . $lama_standby->h . ' jam</td>';
                                                        } else {
                                                            echo '   
                                                    <td style="text-align: center"> </td>';
                                                        }
                                                        echo '<td style="text-align: center"> ' . $row['posko'] . ' </td>
                                                </tr>';
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Row form END -->


                            </div>
                            <!--/.panel-body -->
                        </div>
                        <!--/.panel -->
                    </div>

                    <!--/.col-lg-6 -->
                </div>
                <!--/.row -->
            </div>
            <?php
        }
    }
}
?>