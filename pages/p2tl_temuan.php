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
                include "p2tl_temuan_tambah.php";
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
                    <h1 class = "page-header">Temuan P2TL</h1>
                </div>
            </div>
            <!-- Akhir Judul -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-13 col-md-8">
                            <?php
                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3 || $_SESSION['admin'] == 6) {
                                echo '
                                      <a href="?page=pet&act=add" class="btn btn-primary">Tambah Data</a>
                                 ';
                            }
                            ?>
                        </div>
                        <form method="post" action="?page=pet">
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" href="?page=pet"><a href="?page=pet" class="alert-link">&times;</a></button>
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
                                <tr>';

                //script untuk mencari data
                $unit = $_SESSION['unit'];

                $query = mysqli_query($config, "SELECT * FROM tbl_p2tl_temuan WHERE no_ba='$cari' || no_meter_rusak='$cari%'||"
                        . "alamat LIKE '%$cari%' || sisa_pulsa='$cari%' || no_hp_plg='$cari%' || std_dummy LIKE '$cari%'"
                        . " && unit LIKE '$unit%' ORDER by tgl_temuan ASC LIMIT $curr, $limit");

                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        echo ' 
                            <tr>';

                        $y = substr($row['tgl_temuan'], 0, 4);
                        $m = substr($row['tgl_temuan'], 5, 2);
                        $d = substr($row['tgl_temuan'], 8, 2);
                        $h = substr($row['tgl_temuan'], 11, 2);
                        $i = substr($row['tgl_temuan'], 14, 2);
                        $s = substr($row['tgl_temuan'], 17, 2);

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
                            <td style="text-align: center">' . $row['no_ba'] . '</td>
                            <td style="text-align: center">' . $row['idpel'] . '</td>';

                        

                        echo '<td style="text-align: center">' . $row['nama_temuan'] . '</td>
                        <td style = "text-align: center">' . $row['alamat'] . '</td>
                        <td style = "text-align: center">' . $row['sisa_pulsa'] . '</td>
                        <td style = "text-align: center">' . $row['no_hp_plg'] . '</td>
                        <td style = "text-align: center">' . $row['std_dummy'] . '</td>
                        <td style = "text-align: center">' . $row['nama_cc'] . '</td>
                        <td style = "text-align: center">';

                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5|| $_SESSION['admin'] == 6) {

                            echo ' <div class = "row"><a class = "btn btn-warning" href = "?page=pet&act=edit&id_temuan=' . $row['id_temuan'] . '">
                        <i class = "fa fa-edit"> Edit</i></a></div></br>
                        <div class = "row">
                        <a class = "btn btn-danger" href = "?page=pet&act=del&id_temuan=' . $row['id_temuan'] . '">
                        <i class = "fa fa-trash-o"> Delete</i></a></div>';
                        } else {
                            echo '<i class = "glyphicon glyphicon-ban-circle"></i>';
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

                $query = mysqli_query($config, "SELECT * FROM tbl_p2tl_temuan WHERE no_ba='$cari' || idpel='$cari%'||"
                        . "alamat LIKE '%$cari%' || sisa_pulsa='$cari%' || no_hp_plg='$cari%' || std_dummy LIKE '$cari%'"
                        . " && unit LIKE '$unit%'");
                $cdata = mysqli_num_rows($query);
                $cpg = ceil($cdata / $limit);

                echo '<!--Pagination START -->
                        <ul class = "pagination">';

                if ($cdata > $limit) {

                    //first and previous pagging
                    if ($pg > 1) {
                        $prev = $pg - 1;
                        echo '<li><a href = "?page=pet&pg=1"><i class = "fa fa-angle-double-left"></i></a></li>
                        <li><a href = "?page=pet&pg=' . $prev . '"><i class = "fa fa-angle-left"></i></a></li>';
                    } else {
                        echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-double-left"></i></a></li>
                        <li class = "disabled"><a href = ""><i class = "fa fa-angle-left"></i></a></li>';
                    }

                    //perulangan pagging
                    for ($i = 1; $i <= $cpg; $i++)
                        if ($i != $pg) {
                            echo '<li><a href = "?page=pet&pg=' . $i . '"> ' . $i . ' </a></li>';
                        } else {
                            echo '<li><a href = "?page=pet&pg=' . $i . '"> ' . $i . ' </a></li>';
                        }

                    //last and next pagging
                    if ($pg < $cpg) {
                        $next = $pg + 1;
                        echo '<li><a href = "?page=pet&pg=' . $next . '"><i class = "fa fa-angle-right"></i></a></li>
                        <li><a href = "?page=pet&pg=' . $cpg . '"><i class = "fa fa-angle-double-right"></i></a></li>';
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
                                        <th width="10%" style="text-align: center">Tanggal Temuan</th>
                                        <th width="5%" style="text-align: center">No BA</th>
                                        <th width="5%" style="text-align: center">Idpel</th>
                                        <th width="5%%" style="text-align: center">Nama</th>
                                        <th width="5%" style="text-align: center">Alamat</th>
                                        <th width="5%" style="text-align: center">Tarif</th>
                                        <th width="5%" style="text-align: center">Daya</th>
                                        <th width="5%" style="text-align: center">Temuan</th>
                                        <th width="10%" style="text-align: center">Dengan Cara</th>
                                        <th width="5%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //script untuk menampilkan data
                                    $unit = $_SESSION['unit'];

                                    $no = 1;

                                    $query = mysqli_query($config, "SELECT * FROM tbl_p2tl_temuan WHERE unit LIKE '$unit%' ORDER by tgl_temuan ASC LIMIT $curr, $limit");
                                    if (mysqli_num_rows($query) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '
                                            <tr>';

                                            $y = substr($row['tgl_temuan'], 0, 4);
                                            $m = substr($row['tgl_temuan'], 5, 2);
                                            $d = substr($row['tgl_temuan'], 8, 2);
                                            $h = substr($row['tgl_temuan'], 11, 2);
                                            $i = substr($row['tgl_temuan'], 14, 2);
                                            $s = substr($row['tgl_temuan'], 17, 2);

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
                                            <td style = "text-align: center">' . $d . " " . $nm . " " . $y . ' </td>
                                            <td style = "text-align: center">' . $row['no_ba'] . '</td>
                                            <td style = "text-align: center">' . $row['idpel'] . '</td>
                                            <td style = "text-align: center">' . $row['nama_temuan']. '</td>
                                            <td style = "text-align: center">' . $row['alamat'] . '</td>
                                            <td style = "text-align: center">' . $row['tarif'] . '</td>
                                            <td style = "text-align: center">' . $row['daya'] . '</td>
                                            <td style = "text-align: center">' . $row['tipe_temuan'] . '</td>
                                            <td style = "text-align: center">' . $row['dengan_cara'] . '</td>
                                            <td style = "text-align: center">';


//                                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5) {
//
//                                                $id_temuan = $row['id_temuan'];
//
//                                                $cek_aktivasi = mysqli_query($config, "SELECT aktivasi FROM tbl_p2tl_temuan WHERE id_temuan='$id_temuan'");
//                                                list($aktivasi) = mysqli_fetch_array($cek_aktivasi);
//
//                                                if ($aktivasi == "non aktif") {
//
//                                                    echo ' <div class = "row"><a class = "btn btn-warning" href = "?page=pet&act=edit&id_temuan=' . $row['id_temuan'] . '">
//                                            <i class = "fa fa-edit"> Edit</i></a></div></br>
//                                            <div class = "row">
//                                            <a class = "btn btn-danger" href = "?page=pet&act=del&id_temuan=' . $row['id_temuan'] . '">
//                                            <i class = "fa fa-trash-o"> Delete</i></a></div>';
//                                                } else {
//                                                    echo '<btn class = "btn btn-success" disabled><i class = "glyphicon glyphicon-ban-circle"></i> Aktif</btn>';
//                                                }
//                                            } else {
//                                                echo '<i class = "glyphicon glyphicon-ban-circle" disabled></i>';
//                                            }
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

                        $query = mysqli_query($config, "SELECT * FROM tbl_p2tl_temuan WHERE unit LIKE '$unit%'");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata / $limit);

                        echo '<br/><!--Pagination START -->
                                            <ul class = "pagination">';

                        if ($cdata > $limit) {

                            //first and previous pagging
                            if ($pg > 1) {
                                $prev = $pg - 1;
                                echo '<li><a href = "?page=pet&pg=1"><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li><a href = "?page=pet&pg=' . $prev . '"><i class = "fa fa-angle-left"></i></a></li>';
                            } else {
                                echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li class = "disabled"><a href = ""><i class = "fa fa-angle-left"></i></a></li>';
                            }

                            //perulangan pagging
                            for ($i = 1; $i <= $cpg; $i++)
                                if ($i != $pg) {
                                    echo '<li><a href = "?page=pet&pg=' . $i . '"> ' . $i . ' </a></li>';
                                } else {
                                    echo '<li><a href = "?page=pet&pg=' . $i . '"> ' . $i . ' </a></li>';
                                }

                            //last and next pagging
                            if ($pg < $cpg) {
                                $next = $pg + 1;
                                echo '<li><a href = "?page=pet&pg=' . $next . '"><i class = "fa fa-angle-right"></i></a></li>
                                            <li><a href = "?page=pet&pg=' . $cpg . '"><i class = "fa fa-angle-double-right"></i></a></li>';
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