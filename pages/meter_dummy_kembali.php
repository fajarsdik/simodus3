<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {

    if (isset($_REQUEST['act'])) {
        $act = $_REQUEST['act'];
        switch ($act) {
            case 'add':
                include "tambah_meter_kembali.php";
                break;
            case 'edit':
                include "edit_meter_kembali.php";
                break;
            case 'del':
                include "hapus_meter_pakai.php";
                break;
        }
    } else {

        $query = mysqli_query($config, "SELECT metdum_kbl FROM tbl_sett");
        list($metdum_kembali) = mysqli_fetch_array($query);

        //pagging
        $limit = $metdum_kembali;
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
                    <h1 class = "page-header">Pengembalian Meter Dummy</h1>
                </div>
            </div>
            <!-- Akhir Judul -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-13 col-md-8">
                            <a href="?page=mdk&act=add" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <form method="post" action="?page=mdk">
                            <div class="col-xs-4 col-xs-offset-7 col-md-3 col-md-offset-4 input-group custom-search">
                                <input id="cari" name="cari" type="text" class="form-control" placeholder="Pencarian...">
                                <input type="submit" name="submit" class="hidden">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['succAdd'])) {
                $succAdd = $_SESSION['succAdd'];
                echo '<div id="alert"  class="alert alert-success">
                            ' . $succAdd . '
                          </div>';
                unset($_SESSION['succAdd']);
            }
            if (isset($_SESSION['succEdit'])) {
                $succEdit = $_SESSION['succEdit'];
                echo '<div id="alert"  class="alert alert-success">
                            ' . $succEdit . '
                          </div>';
                unset($_SESSION['succEdit']);
            }
            if (isset($_SESSION['succDel'])) {
                $succDel = $_SESSION['succDel'];
                echo '<div id="alert"  class="alert alert-success">
                            ' . $succDel . '
                          </div>';
                unset($_SESSION['succDel']);
            }

            if (isset($_REQUEST['submit'])) {
                $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                echo '
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="?page=mdk"><a href="?page=mdk" class="alert-link">&times;</a></button>
                        <p>Hasil pencarian untuk kata kunci <strong>" ' . stripslashes($cari) . ' "</strong>
                    </div>
                            
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                            ' . $nama . '
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">
                                <thead>
                                <tr>
                                    <th width="5%" style="text-align: center">No. Dummy</th>
                                        <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                        <th width="5%%" style="text-align: center">Merk Meter Rusak</th>
                                        <th width="5%" style="text-align: center">Alasan Rusak</th>
                                        <th width="5%" style="text-align: center">Tanggal Pakai</th>
                                        <th width="5%" style="text-align: center">Petugas Pasang</th>
                                        <th width="5%" style="text-align: center">Sisa Pulsa</th>
                                        <th width="5%" style="text-align: center">No. HP Plg</th>
                                        <th width="5%" style="text-align: center">Stand Dummy</th>
                                        <th width="5%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>';

                //script untuk mencari data
                $unit = $_SESSION['unit'];

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE no_dummy LIKE '%$cari%' || no_meter_rusak LIKE '%$cari%'||"
                        . "ptgs_pasang LIKE '%$cari%' || sisa_pulsa LIKE '%$cari%' || no_hp_plg LIKE '%$cari%' || std_dummy LIKE '%$cari%'"
                        . " && unit LIKE '$unit%' ORDER by tgl_pakai DESC LIMIT $curr, $limit");

                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        echo ' 
                            <tr>
                            <td style="text-align: center">' . $row['no_dummy'] . '</td>
                            <td style="text-align: center">' . $row['no_meter_rusak'] . '</td>';

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

                        echo '<td style="text-align: center">' . $alasan_rusak . '</td>';

                        $y = substr($row['tgl_pakai'], 0, 4);
                        $m = substr($row['tgl_pakai'], 5, 2);
                        $d = substr($row['tgl_pakai'], 8, 2);
                        $h = substr($row['tgl_pakai'], 11, 2);
                        $i = substr($row['tgl_pakai'], 14, 2);
                        $s = substr($row['tgl_pakai'], 17, 2);

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
                            <td style="text-align: center">' . $d . " " . $nm . " " . $y . ' <br/><hr/> ' . $h . ":" . $i . ":" . $s . '</td>
                            <td style="text-align: center">' . $row['ptgs_pasang'] . '</td>
                            <td style="text-align: center">' . $row['sisa_pulsa'] . '</td>
                            <td style="text-align: center">' . $row['no_hp_plg'] . '</td>
                            <td style="text-align: center">' . $row['std_dummy'] . '</td>
                            <td style="text-align: center">';

                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5) {

                            echo ' <div class="row"><a class="btn btn-warning" href="?page=mdg&act=edit&id_meter=' . $row['id_meter'] . '">
                                                        <i class="fa fa-edit"> Edit</i></a></div></br>
                                                    <div class="row">    
                                                    <a class="btn btn-danger" href="?page=mdg&act=del&id_meter=' . $row['id_meter'] . '">
                                                        <i class="fa fa-trash-o"> Delete</i></a></div>';
                        } else {
                            echo '<i class="glyphicon glyphicon-ban-circle"></i></a>';
                        }
                        echo '
                                    </td> 
                                </tr> 
                            </tbody>';
                    }
                } else {
                    echo 'echo <tr><td colspan="10"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                }
                echo '</table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl");
                $cdata = mysqli_num_rows($query);
                $cpg = ceil($cdata / $limit);

                echo '<!-- Pagination START -->
                          <ul class="pagination">';

                if ($cdata > $limit) {

                    //first and previous pagging
                    if ($pg > 1) {
                        $prev = $pg - 1;
                        echo '<li><a href="?page=mdk&pg=1"><i class="fa fa-angle-double-left"></i></a></li>
                                  <li><a href="?page=mdk&pg=' . $prev . '"><i class="fa fa-angle-left"></i></a></li>';
                    } else {
                        echo '<li class="disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                                  <li class="disabled"><a href=""><i class="fa fa-angle-left"></i></a></li>';
                    }

                    //perulangan pagging
                    for ($i = 1; $i <= $cpg; $i++)
                        if ($i != $pg) {
                            echo '<li><a href="?page=mdk&pg=' . $i . '"> ' . $i . ' </a></li>';
                        } else {
                            echo '<li><a href="?page=mdk&pg=' . $i . '"> ' . $i . ' </a></li>';
                        }

                    //last and next pagging
                    if ($pg < $cpg) {
                        $next = $pg + 1;
                        echo '<li><a href="?page=mdk&pg=' . $next . '"><i class="fa fa-angle-right"></i></a></li>
                                  <li><a href="?page=mdk&pg=' . $cpg . '"><i class="fa fa-angle-double-right"></i></a></li>';
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
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">

                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">No. Dummy</th>
                                        <th width="5%" style="text-align: center">Stand Bongkar</th>
                                        <th width="5%" style="text-align: center">Tanggal Kembali</th>
                                        <th width="5%" style="text-align: center">Lokasi Posko</th>
                                        <th width="5%" style="text-align: center">Nama Call Center</th>
                                        <th width="5%" style="text-align: center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //script untuk menampilkan data
                                    $unit = $_SESSION['unit'];

                                    $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl WHERE unit LIKE '$unit%' ORDER by tgl_kembali DESC LIMIT $curr, $limit");
                                    if (mysqli_num_rows($query) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo ' 
                                                <tr>
                                                <td style="text-align: center">' . $row['no_dummy'] . '</td>
                                                <td style="text-align: center">' . $row['stand'] . '</td>';

                                            $y = substr($row['tgl_kembali'], 0, 4);
                                            $m = substr($row['tgl_kembali'], 5, 2);
                                            $d = substr($row['tgl_kembali'], 8, 2);
                                            $h = substr($row['tgl_kembali'], 11, 2);
                                            $i = substr($row['tgl_kembali'], 14, 2);
                                            $s = substr($row['tgl_kembali'], 17, 2);

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
                                                <td style="text-align: center">' . $row['lokasi_posko'] . '</td>
                                                <td style="text-align: center">' . $row['nama_cc'] . '</td>
                                                <td style="text-align: center">';

                                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5) {

                                                echo ' <div class="row"><a class="btn btn-warning" href="?page=mdk&act=edit&id_meter=' . $row['id_meter'] . '">
                                                        <i class="fa fa-edit"> Edit</i></a></div></br>
                                                    <div class="row">    
                                                    <a class="btn btn-danger" href="?page=mdk&act=del&id_meter=' . $row['id_meter'] . '">
                                                        <i class="fa fa-trash-o"> Delete</i></a></div>';
                                            } else {
                                                echo '<i class="glyphicon glyphicon-ban-circle"></i></a>';
                                            }
                                            echo '
                                                </td> 
                                            </tr> 
                                        </tbody>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="10"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                    }
                                    ?>
                            </table>
                        </div>
                        <!--/.table-responsive -->

                        <?php
                        $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata / $limit);

                        echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                        if ($cdata > $limit) {

                            //first and previous pagging
                            if ($pg > 1) {
                                $prev = $pg - 1;
                                echo '<li><a href="?page=mdg&pg=1"><i class="fa fa-angle-double-left"></i></a></li>
                                  <li><a href="?page=mdg&pg=' . $prev . '"><i class="fa fa-angle-left"></i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                                  <li class="disabled"><a href=""><i class="fa fa-angle-left"></i></a></li>';
                            }

                            //perulangan pagging
                            for ($i = 1; $i <= $cpg; $i++)
                                if ($i != $pg) {
                                    echo '<li><a href="?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                                } else {
                                    echo '<li><a href="?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                                }

                            //last and next pagging
                            if ($pg < $cpg) {
                                $next = $pg + 1;
                                echo '<li><a href="?page=mdg&pg=' . $next . '"><i class="fa fa-angle-right"></i></a></li>
                                  <li><a href="?page=mdg&pg=' . $cpg . '"><i class="fa fa-angle-double-right"></i></a></li>';
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
            </div>


            <?php
        }
    }
}
?>