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
                include "tambah_user.php";
                break;
            case 'edit':
                include "edit_user.php";
                break;
            case 'del':
                include "hapus_user.php";
                break;
        }
    } else {
        ?>

        <div id = "page-wrapper">
            <div class = "row">
                <div  class = "col-lg-12">
                    <h1 class = "page-header">Management User</h1>
                </div>
            </div>
            <!-- Akhir Judul -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-13 col-md-8">
                            <?php
                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3) {
                                echo '
                                      <a href="?page=usr&act=add" class="btn btn-primary">Tambah User</a>
                                 ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <br/>

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
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                    <?php echo $_SESSION['nama']; ?>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="monitoring">

                            <thead>
                                <tr>
                                    <th width="1%" style="text-align: center">No.</th>
                                    <th width="5%" style="text-align: center">Username</th>
                                    <th width="5%" style="text-align: center">Nama</th>
                                    <th width="5%" style="text-align: center">Unit</th>
                                    <th width="2%" style="text-align: center">Level</th>
                                    <th width="3%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                //script untuk menampilkan data
                                $unit = $_SESSION['unit'];
                                $no = 1;

                                $query = mysqli_query($config, "SELECT * FROM tbl_user WHERE unit LIKE '$unit%' ORDER BY admin ASC");
                                if (mysqli_num_rows($query) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo '
                                            <tr>
                                                <td style = "text-align: center">' . $no++ . '</td>
                                                <td style = "text-align: center">' . $row['username'] . '</td>
                                                <td style = "text-align: center">' . $row['nama'] . '</td>
                                                <td style = "text-align: center">' . $row['unit'] . '</td>';

                                        if ($row['admin'] == 1) {
                                            $level = "Super Admin";
                                        } elseif ($row['admin'] == 2) {
                                            $level = "Admin Area";
                                        } elseif ($row['admin'] == 3) {
                                            $level = "Admin Rayon";
                                        } elseif ($row['admin'] == 4) {
                                            $level = "Petugas Aktivasi";
                                        } elseif ($row['admin'] == 5) {
                                            $level = "Petugas Posko";
                                        }

                                        echo '     
                                                <td style = "text-align: center">' . $level . '</td>';

                                        if ($_SESSION['admin'] == $row['admin']) {
                                            echo '  
                                                <td style = "text-align: center">
                                                    <div class = "row"><a class = "btn btn-warning" href = "?page=usr&act=edit&id_user=' . $row['id_user'] . '">
                                                        <i class = "fa fa-edit"> Edit</i></a>
                                                    </div> </br>';
                                        } else {
                                            echo '  
                                                <td style = "text-align: center">
                                                    <div class = "row"><a class = "btn btn-warning" href = "?page=usr&act=edit&id_user=' . $row['id_user'] . '">
                                                        <i class = "fa fa-edit"> Edit</i></a>
                                                    </div> </br>';
                                        }

                                        if ($_SESSION['admin'] == $row['admin']) {
                                            echo ' 
                                                </td>
                                            </tr>';
                                        } else {
                                            echo '     
                                                    <div class = "row">
                                                        <a class = "btn btn-danger" href = "?page=usr&act=del&id_user=' . $row['id_user'] . '">
                                                        <i class = "fa fa-trash-o"> Delete</i></a>
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                } else {
                                    echo '<tr><td colspan = "10"><center><p class = "add">Tidak ada data untuk ditampilkan.</p></center></td></tr>';
                                }
                                ?>
                            </tbody>
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