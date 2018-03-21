<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    $id_meter = $_REQUEST['id_meter'];

    $query = mysqli_query($config, "SELECT * FROM tbl_metdum_kbl WHERE id_meter='$id_meter'");

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_array($query)) {
            ?> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hapus Data Pengembalian Dummy</h1>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php echo $_SESSION['nama']; ?>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    if (isset($_SESSION['errQ'])) {
                                        $errQ = $_SESSION['errQ'];
                                        echo '<div id="alert"  class="alert alert-success">
                                                ' . $errQ . '
                                                </div>';
                                        unset($_SESSION['errQ']);
                                    }
                                    ?>
                                    <div class="well">
                                        <table class="table table-responsive">
                                            <thead class="red lighten-5 red-text">
                                            <div id="12"  class="alert alert-danger">
                                                Apakah Anda yakin akan menghapus data ini?
                                            </div>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td width="22%">No. Dummy</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['no_dummy'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Stand Bongkar</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?= $row['stand'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Tanggal Kembali</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $tgl = date('d M Y ', strtotime($row['tgl_kembali'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Lokasi Posko</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['lokasi_posko'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="22%">Nama Call Center</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%"><?php echo $row['nama_cc'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-action"> <?php echo ' 
                                            <a href="?page=mdk&act=del&submit=yes&id_meter=' . $row['id_meter'] . '" class="btn btn-danger">HAPUS <i class="material-icons"></i></a>
                                            <a href="?page=mdk" class="btn btn-default">BATAL <i class="material-icons"></i></a>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_REQUEST['submit'])) {
                                    $unit = $_SESSION['unit'];

                                    $update_stok = mysqli_query($config, "UPDATE tbl_metdum_stok SET status='', tgl_kembali=NULL, posko='' WHERE no_dummy='$no_dummy' && unit LIKE '$unit%'");

                                    $query = mysqli_query($config, "DELETE FROM tbl_metdum_kbl WHERE id_meter='$id_meter'");
                                    
                                    if ($query == true) {
                                        $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                                        header("Location: ./admin.php?page=mdg");
                                        die();
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">
                                                    window.location.href=" ./admin.php?page=mdg&act=del&id_meter=' . $id_meter . '";
                                                  </script>';
                                    }
                                }
                            }
                        }
                    }
                    ?> </div>
            </div>
        </div>

