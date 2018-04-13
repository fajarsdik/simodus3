<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {

    if (isset($_REQUEST['submit'])) {

        $id_meter = $_REQUEST['id_meter'];
        $no_dummy = $_REQUEST['no_dummy'];
        $nama = $_SESSION['nama'];
        $id_user = $_SESSION['id_user'];
        $unit = $_SESSION['unit'];

        $query = mysqli_query($config, "UPDATE tbl_metdum_stok SET tgl_pakai=NULL, tgl_aktivasi=NULL, "
                . "tgl_kembali=NULL, status='ready', no_meter_rusak=NULL, posko=NULL WHERE unit ='$unit' && no_dummy='$no_dummy'");

        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! Meter berhasil di Reset!';
            header("Location: ./admin.php?page=set");
            die();
        } else {
            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
            echo '<script language="javascript">window.history.back();</script>';
        }
        
    } else {
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reset Status Dummy</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        
                        if (isset($_SESSION['succAdd'])) {
                            $succAdd = $_SESSION['succAdd'];
                            echo '<div id="alert"  class="alert alert-success">
                            ' . $succAdd . '
                          </div>';
                            unset($_SESSION['succAdd']);
                        }

                        if (isset($_SESSION['succDel'])) {
                            $succDel = $_SESSION['succDel'];
                            echo '<div id="alert"  class="alert alert-success">
                            ' . $succDel . '
                          </div>';
                            unset($_SESSION['succDel']);
                        }
                        ?>

                        <div class = "panel panel-primary">
                            <div class = "panel-heading">
                                <?php echo $_SESSION['nama'];
                                ?>
                            </div>

                            <?php
                            
                            $unit = $_SESSION['unit'];

                            $query_stok = mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit='$unit' ORDER BY no_dummy");
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=set" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label>Pilih No. Dummy Untuk Siap Digunakan Kembali</label>
                                            <select class="form-control" name="no_dummy" id="no_dummy" required>
                                                <option disabled selected>-----</option>
                                                <?php
                                                if (mysqli_num_rows($query_stok) > 0) {
                                                    while ($row = mysqli_fetch_array($query_stok)) {
                                                        ?>
                                                        <option value="<?php echo $row['no_dummy'] ?>"><?php echo $row['no_dummy'] ?></option> <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>    

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="submit" class="btn btn-primary"> Reset</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <?php
    }
}
?>