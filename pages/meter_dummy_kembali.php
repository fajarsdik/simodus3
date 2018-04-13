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
                include "hapus_meter_kembali.php";
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
                            <?php
                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 5) {
                                echo '
                                      <a href="?page=mdk&act=add" class="btn btn-primary">Tambah Data</a>
                                 ';
                            }
                            ?>
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
                            
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                            ' . $_SESSION['nama'] . '
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
                                <tr>';

                //script untuk mencari data
                $unit = $_SESSION['unit'];

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl WHERE no_dummy LIKE '$cari%' || lokasi_posko LIKE '%$cari%' || nama_cc LIKE '%$cari%' "
                        . "&& unit LIKE '$unit%'"
                        . "ORDER by tgl_kembali DESC LIMIT $curr, $limit");

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

                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) {

                            echo ' <div class="row"><a class="btn btn-warning" href="?page=mdk&act=edit&id_meter=' . $row['id_meter'] . '">
                                    <i class="fa fa-edit"> Edit</i></a></div></br>
                                   <div class="row"> ';
                        } else {
                            echo '<i class="glyphicon glyphicon-ban-circle"></i></a>';
                        }
                        echo '
                                    </td> 
                                </tr> 
                            </tbody>';
                    }
                } else {
                    echo '<tr><td colspan="6"><center><p class="add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                }
                echo '</table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';

                $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl WHERE no_dummy='$cari%' || lokasi_posko LIKE '%$cari%' || nama_cc LIKE '%$cari%' "
                        . "&& unit LIKE '$unit%'");
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

                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                        <?php echo $_SESSION['nama']; ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-1">

                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">Tanggal Kembali</th>
                                        <th width="5%" style="text-align: center">No. Dummy</th>
                                        <th width="5%" style="text-align: center">Stand Bongkar</th>
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
                                                <tr>';

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
                                                

                                                <td style="text-align: center">' . $row['no_dummy'] . '</td>
                                                <td style="text-align: center">' . $row['stand'] . '</td>
                                                <td style = "text-align: center">' . $row['lokasi_posko'] . '</td>
                                                <td style = "text-align: center">' . $row['nama_cc'] . '</td>
                                                <td style = "text-align: center">';

                                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3) {

                                                echo ' <div class = "row"><a class = "btn btn-warning" href = "?page=mdk&act=edit&id_meter=' . $row['id_meter'] . '">
                                            <i class = "fa fa-edit"> Edit</i></a></div></br>
                                            <div class = "row">';
                                            } else {
                                                echo '<i class = "glyphicon glyphicon-ban-circle"></i></a>';
                                            }
                                            echo '
                                            </td>
                                            </tr>
                                            </tbody>';
                                        }
                                    } else {
                                        echo '<tr><td colspan = "6"><center><p class = "add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                    }
                                    ?>
                            </table>
                        </div>
                        <!--/.table-responsive -->

                        <?php
                        $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl WHERE unit LIKE '$unit%'");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata / $limit);

                        echo '<br/><!--Pagination START -->
                                            <ul class = "pagination">';

                        if ($cdata > $limit) {

                            //first and previous pagging
                            if ($pg > 1) {
                                $prev = $pg - 1;
                                echo '<li><a href = "?page=mdk&pg=1"><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li><a href = "?page=mdk&pg=' . $prev . '"><i class = "fa fa-angle-left"></i></a></li>';
                            } else {
                                echo '<li class = "disabled"><a href = ""><i class = "fa fa-angle-double-left"></i></a></li>
                                            <li class = "disabled"><a href = ""><i class = "fa fa-angle-left"></i></a></li>';
                            }

                            //perulangan pagging
                            for ($i = 1; $i <= $cpg; $i++)
                                if ($i != $pg) {
                                    echo '<li><a href = "?page=mdk&pg=' . $i . '"> ' . $i . ' </a></li>';
                                } else {
                                    echo '<li><a href = "?page=mdk&pg=' . $i . '"> ' . $i . ' </a></li>';
                                }

                            //last and next pagging
                            if ($pg < $cpg) {
                                $next = $pg + 1;
                                echo '<li><a href = "?page=mdk&pg=' . $next . '"><i class = "fa fa-angle-right"></i></a></li>
                                            <li><a href = "?page=mdk&pg=' . $cpg . '"><i class = "fa fa-angle-double-right"></i></a></li>';
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
            </div>


            <?php
        }
    }
}
?>