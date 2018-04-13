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
                include "tambah_meter_pakai.php";
                break;
            case 'edit':
                include "edit_meter_pakai.php";
                break;
            case 'del':
                include "hapus_meter_pakai.php";
                break;
        }
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
                    <h1 class = "page-header">Pemakaian Meter Dummy</h1>
                </div>
            </div>
            <!-- Akhir Judul -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-13 col-md-8">
                            <?php
                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5) {
                                echo '
                                      <a href="?page=mdg&act=add" class="btn btn-primary">Tambah Data</a>
                                 ';
                            }
                            ?>
                        </div>
                        <form method="post" action="?page=mdg">
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="?page=mdg"><a href="?page=mdg" class="alert-link">&times;</a></button>
                        <p>Hasil pencarian untuk kata kunci <strong>" ' . stripslashes($cari) . ' "</strong>
                    </div>
                            
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                            ' . $_SESSION['nama'] . '
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">
                                <thead>
                                <tr>
                                        <th width="5%" style="text-align: center">Tanggal Pakai</th>
                                        <th width="5%" style="text-align: center">No. Dummy</th>
                                        <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                        <th width="5%" style="text-align: center">Merk Meter Rusak</th>
                                        <th width="5%" style="text-align: center">Alasan Rusak</th>
                                        <th width="5%" style="text-align: center">Petugas Pasang</th>
                                        <th width="5%" style="text-align: center">Sisa Pulsa</th>
                                        <th width="5%" style="text-align: center">No. HP Plg</th>
                                        <th width="5%" style="text-align: center">Stand Dummy</th>
                                        <th width="5%" style="text-align: center">Call Center</th>
                                        <th width="5%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>';

                //script untuk mencari data
                $unit = $_SESSION['unit'];

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE no_dummy='$cari' || no_meter_rusak='$cari%'||"
                        . "ptgs_pasang LIKE '%$cari%' || sisa_pulsa='$cari%' || no_hp_plg='$cari%' || std_dummy LIKE '$cari%'"
                        . " && unit LIKE '$unit%' ORDER by tgl_pakai DESC LIMIT $curr, $limit");

                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        echo ' 
                            <tr>';

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


                        //merk tipe tahun otomatis  dibagian tampilan aja      
                        $no_meter_rusak = $row['no_meter_rusak'];
                        $pot12 = substr($no_meter_rusak, 0, 2);
                        $pot34 = substr($no_meter_rusak, 2, 2);
                        $pjg_seri = strlen($no_meter_rusak);

                        $queryseri = mysqli_query($config, "SELECT * FROM tbl_seri_meter WHERE panjang=$pjg_seri && seri12=$pot12");
                        $rowseri = mysqli_fetch_array($queryseri);
                        $merk_meter_rusak = $rowseri['merk'];
                        $tipe_meter_rusak = $rowseri['tipe'];
                        $tahun_meter_rusak = $rowseri['tahun'];

                        echo '<td style="text-align: center">' . $merk_meter_rusak . '</td>
                        <td style="text-align: center">' . $alasan_rusak . '</td>
                            
                        <td style = "text-align: center">' . $row['ptgs_pasang'] . '</td>
                        <td style = "text-align: center">' . $row['sisa_pulsa'] . '</td>
                        <td style = "text-align: center">' . $row['no_hp_plg'] . '</td>
                        <td style = "text-align: center">' . $row['std_dummy'] . '</td>
                        <td style = "text-align: center">' . $row['nama_cc'] . '</td>
                        <td style = "text-align: center">';

                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) {

                            echo ' <div class = "row"><a class = "btn btn-warning" href = "?page=mdg&act=edit&id_meter=' . $row['id_meter'] . '">
                        <i class = "fa fa-edit"> Edit</i></a></div></br>
                        <div class = "row">
                        <a class = "btn btn-danger" href = "?page=mdg&act=del&id_meter=' . $row['id_meter'] . '">
                        <i class = "fa fa-trash-o"> Delete</i></a></div>';
                        
                        }
                        echo '
                        </td>
                        </tr>
                        </tbody>';
                    }
                } else {
                    echo '<tr><td colspan = "10"><center><p class = "add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                }
                echo '</table><br/><br/>
                        </div>
                        </div>
                        <!--Row form END -->';

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE no_dummy='$cari' || no_meter_rusak='$cari%'||"
                        . "ptgs_pasang LIKE '%$cari%' || sisa_pulsa='$cari%' || no_hp_plg='$cari%' || std_dummy LIKE '$cari%'"
                        . " && unit LIKE '$unit%'");
                $cdata = mysqli_num_rows($query);
                $cpg = ceil($cdata / $limit);

                echo '<!--Pagination START -->
                        <ul class = "pagination">';

                if ($cdata > $limit) {

                    //first and previous pagging
                    if ($pg > 1) {
                        $prev = $pg - 1;
                        echo '<li><a href = "?page=mdg&pg=1"><i class = "fa fa-angle-double-left"></i></a></li>
                        <li><a href = "?page=mdg&pg=' . $prev . '"><i class = "fa fa-angle-left"></i></a></li>';
                    } else {
                        echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-double-left"></i></a></li>
                        <li class = "disabled"><a href = ""><i class = "fa fa-angle-left"></i></a></li>';
                    }

                    //perulangan pagging
                    for ($i = 1; $i <= $cpg; $i++)
                        if ($i != $pg) {
                            echo '<li><a href = "?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                        } else {
                            echo '<li><a href = "?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                        }

                    //last and next pagging
                    if ($pg < $cpg) {
                        $next = $pg + 1;
                        echo '<li><a href = "?page=mdg&pg=' . $next . '"><i class = "fa fa-angle-right"></i></a></li>
                        <li><a href = "?page=mdg&pg=' . $cpg . '"><i class = "fa fa-angle-double-right"></i></a></li>';
                    } else {
                        echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-right"></i></a></li>
                        <li class = "disabled"><a href = ""><i class = "fa fa fa-angle-double-right"></i></a></li>';
                    }
                    echo '
                        </ul>
                        <!--Pagination END -->';
                } else {
                    echo '';
                }
            } else {
                ?>

                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                        <?php echo $_SESSION['nama']; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">

                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">Tanggal Pakai</th>
                                        <th width="5%" style="text-align: center">No. Dummy</th>
                                        <th width="5%" style="text-align: center">No. Meter Rusak</th>
                                        <th width="5%%" style="text-align: center">Merk Meter Rusak</th>
                                        <th width="5%" style="text-align: center">Alasan Rusak</th>
                                        <th width="5%" style="text-align: center">Petugas Pasang</th>
                                        <th width="5%" style="text-align: center">Sisa Pulsa</th>
                                        <th width="5%" style="text-align: center">No. HP Plg</th>
                                        <th width="5%" style="text-align: center">Stand Dummy</th>
                                        <th width="5%" style="text-align: center">Call Center</th>
                                        <th width="5%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //script untuk menampilkan data
                                    $unit = $_SESSION['unit'];

                                    $no = 1;

                                    $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE unit LIKE '$unit%' ORDER by tgl_pakai DESC LIMIT $curr, $limit");
                                    if (mysqli_num_rows($query) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '
                                            <tr>';

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
                                            <td style = "text-align: center">' . $d . " " . $nm . " " . $y . ' <hr/> ' . $h . ":" . $i . ":" . $s . '</td>
                                            <td style = "text-align: center">' . $row['no_dummy'] . '</td>
                                            <td style = "text-align: center">' . $row['no_meter_rusak'] . '</td>';

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
                                            } else {
                                                $alasan_rusak = "Lain-lain";
                                            }


                                            //merk tipe tahun otomatis  dibagian tampilan aja      
                                            $no_meter_rusak = $row['no_meter_rusak'];
                                            $pot12 = substr($no_meter_rusak, 0, 2);
                                            $pot34 = substr($no_meter_rusak, 2, 2);
                                            $pjg_seri = strlen($no_meter_rusak);

                                            $queryseri = mysqli_query($config, "SELECT * FROM tbl_seri_meter WHERE panjang=$pjg_seri && seri12=$pot12");
                                            $rowseri = mysqli_fetch_array($queryseri);
                                            $merk_meter_rusak = $rowseri['merk'];
                                            $tipe_meter_rusak = $rowseri['tipe'];
                                            $tahun_meter_rusak = $rowseri['tahun'];


                                            echo '<td style = "text-align: center">' . $merk_meter_rusak . '</td>
                                            <td style = "text-align: center">' . $alasan_rusak . '</td>
                                            <td style = "text-align: center">' . $row['ptgs_pasang'] . '</td>
                                            <td style = "text-align: center">' . $row['sisa_pulsa'] . '</td>
                                            <td style = "text-align: center">' . $row['no_hp_plg'] . '</td>
                                            <td style = "text-align: center">' . $row['std_dummy'] . '</td>
                                            <td style = "text-align: center">' . $row['nama_cc'] . '</td>
                                            <td style = "text-align: center">';


                                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) {

                                                $id_meter = $row['id_meter'];

                                                $cek_aktivasi = mysqli_query($config, "SELECT aktivasi FROM tbl_metdum_pakai WHERE id_meter='$id_meter'");
                                                list($aktivasi) = mysqli_fetch_array($cek_aktivasi);

                                                if ($aktivasi == "non aktif") {

                                                    echo ' <div class = "row"><a class = "btn btn-warning" href = "?page=mdg&act=edit&id_meter=' . $row['id_meter'] . '">
                                            <i class = "fa fa-edit"> Edit</i></a></div></br>
                                            <div class = "row">
                                            <a class = "btn btn-danger" href = "?page=mdg&act=del&id_meter=' . $row['id_meter'] . '">
                                            <i class = "fa fa-trash-o"> Delete</i></a></div>';
                                                } else {
                                                    echo '<btn class = "btn btn-success" disabled><i class = "glyphicon glyphicon-ban-circle"></i> Aktif</btn>';
                                                }
                                            } else {
                                                echo '<i class = "glyphicon glyphicon-ban-circle" disabled></i>';
                                            }
                                            echo '
                                            </td>
                                            </tr>
                                            </tbody>';
                                        }
                                    } else {
                                        echo '<tr><td colspan = "10"><center><p class = "add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                    }
                                    ?>
                            </table>
                        </div>
                        <!--/.table-responsive -->

                        <?php
                        $unit = $_SESSION['unit'];

                        $query = mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE unit LIKE '$unit%'");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata / $limit);

                        echo '<br/><!--Pagination START -->
                                            <ul class = "pagination">';

                        if ($cdata > $limit) {

                            //first and previous pagging
                            if ($pg > 1) {
                                $prev = $pg - 1;
                                echo '<li><a href = "?page=mdg&pg=1"><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li><a href = "?page=mdg&pg=' . $prev . '"><i class = "fa fa-angle-left"></i></a></li>';
                            } else {
                                echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li class = "disabled"><a href = ""><i class = "fa fa-angle-left"></i></a></li>';
                            }

                            //perulangan pagging
                            for ($i = 1; $i <= $cpg; $i++)
                                if ($i != $pg) {
                                    echo '<li><a href = "?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                                } else {
                                    echo '<li><a href = "?page=mdg&pg=' . $i . '"> ' . $i . ' </a></li>';
                                }

                            //last and next pagging
                            if ($pg < $cpg) {
                                $next = $pg + 1;
                                echo '<li><a href = "?page=mdg&pg=' . $next . '"><i class = "fa fa-angle-right"></i></a></li>
                                            <li><a href = "?page=mdg&pg=' . $cpg . '"><i class = "fa fa-angle-double-right"></i></a></li>';
                            } else {
                                echo '<li class = "disabled"><a href = "#"><i class = "fa fa-angle-right"></i></a></li>
                                            <li class = "disabled"><a href = "#"><i class = "fa fa-angle-double-right"></i></a></li>';
                            }
                            echo '
                                            </ul>
                                            <!--Pagination END -->';
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
}
?>