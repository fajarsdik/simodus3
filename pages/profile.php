<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    $unit = $_SESSION['unit'];
    $id_user = $_SESSION['id_user'];

    $query = mysqli_query($config, "SELECT * FROM tbl_user WHERE id_user='$id_user' && unit='$unit'");

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_array($query)) {
            
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
            
            ?> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profil User</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="well">
                                <table class="table table-responsive">
                                    <thead class="red lighten-5 red-text">
                                        <h3><strong>Data User</strong></h3>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td width="22%">Username</td>
                                            <td width="1%">:</td>
                                            <td width="86%"><?php echo $row['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="22%">Nama</td>
                                            <td width="1%">:</td>
                                            <td width="86%"><?php echo $row['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="22%">NIP</td>
                                            <td width="1%">:</td>
                                            <td width="86%"><?php echo $row['nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="22%">Kode Unit</td>
                                            <td width="1%">:</td>
                                            <td width="86%"><?php echo $row['unit']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="22%">Level User</td>
                                            <td width="1%">:</td>
                                            <td width="86%"><?php echo $level; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-action"> 
                                    <?php echo ' 
                                            <a href="?page=usr&act=edit&id_user=' . $row['id_user'] . '" class="btn btn-info"> Edit Data<i class="material-icons"></i></a>';
                                    ?>
                                </div>


                                <?php
                                if (isset($_REQUEST['submit'])) {
                                    $unit = $_SESSION['unit'];

                                    $cek_aktivasi = mysqli_query($config, "SELECT aktivasi FROM tbl_metdum_pakai WHERE id_meter='$id_meter' && unit LIKE '$unit%'");
                                    list($aktivasi) = mysqli_fetch_array($cek_aktivasi);

                                    if ($aktivasi == "non aktif") {

                                        $update_stok = mysqli_query($config, "UPDATE tbl_metdum_stok SET status='ready', tgl_pakai=NULL, no_meter_rusak='' WHERE no_dummy='$no_dummy' && unit LIKE '$unit%'");

                                        $query = mysqli_query($config, "DELETE FROM tbl_metdum_pakai WHERE id_meter='$id_meter' && unit LIKE '$unit%'");

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
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Meter sudah aktivasi dan data tidak bisa dihapus!';
                                        unset($_SERVER['errQ']);
                                    }
                                }
                            }
                        }
                    }
                    ?> </div>
            </div>
        </div>

