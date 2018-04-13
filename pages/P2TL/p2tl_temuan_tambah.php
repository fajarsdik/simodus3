<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {


    if (isset($_SESSION['errQ'])) {
        $errQ = $_SESSION['errQ'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errQ . '
                          </div>';
        unset($_SESSION['errQ']);
    }
    if (isset($_SESSION['errV'])) {
        $errV = $_SESSION['errV'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errV . '
                          </div>';
        unset($_SESSION['errV']);
    }
    if (isset($_SESSION['errEmpty'])) {
        $errEmpty = $_SESSION['errEmpty'];
        echo '<div id="alert"  class="alert alert-warning">
                            ' . $errEmpty . '
                          </div>';
        unset($_SESSION['errEmpty']);
    }


    if (isset($_REQUEST['submit'])) {
 
        $tgl_temuan = $_REQUEST['tgl_temuan'];
        $no_ba = $_REQUEST['no_ba'];
        $idpel = $_REQUEST['idpel'];
        $nama_temuan = $_REQUEST['nama_temuan'];
        $alamat = $_REQUEST['alamat'];
        $tarif = $_REQUEST['tarif'];
        $daya = $_REQUEST['daya'];
        $tipe_temuan = $_REQUEST['tipe_temuan'];
        $dengan_cara = $_REQUEST['dengan_cara'];
        $unit = $_SESSION['unit'];
            
        $query = mysqli_query($config,"INSERT INTO tbl_p2tl_temuan (id_temuan,tgl_temuan,no_ba,idpel,nama_temuan,alamat,tarif,daya,tipe_temuan,dengan_cara,unit)
                VALUES('','$tgl_temuan','$no_ba','$idpel','$nama_temuan','$alamat','$tarif','$daya','$tipe_temuan','$dengan_cara','$unit')");



        if ($query == true) {
            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
            header("Location: ./admin.php?page=pet");
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
                    <h1 class="page-header">Tambah Temuan P2TL</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user fa-fw"></i>
                                <?php echo $_SESSION['nama']; ?>
                            </div>

                            <?php
                            $unit = $_SESSION['unit'];
                            ?>

                            <div class="panel-body">
                                <form role="form" method="POST" action="?page=pet&act=add" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="no_ba">No.Berita Acara P2TL</label>
                                            <input class="form-control" type="text" name="no_ba" id="no_ba" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="tgl_temuan">Tanggal Temuan</label>
                                            <input class="form-control" type="date" name="tgl_temuan" id="tgl_temuan" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="idpel">Idpel</label>
                                            <input class="form-control" type="text" name="idpel" id="idpel" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="nama_temuan">Nama</label>
                                            <input class="form-control" type="nama_temuan" name="nama_temuan" id="nama_temuan" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="alamat">Alamat</label>
                                            <input class="form-control" type="text" name="alamat" id="alamat" required>
                                        </div>
                                                                                
                                        <div class="form-group col-lg-6">
                                            <label for="daya">Tarif</label>
                                            <input class="form-control" type="tarif" name="tarif" id="tarif" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="daya">Daya</label>
                                            <input class="form-control" type="text" name="daya" id="daya" required>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label>Tipe Temuan</label>
                                            <select class="form-control" name="tipe_temuan" id="tipe_temuan" required>
                                                <option disabled selected>-----</option>
                                                <option value="P1">P1</option>
                                                <option value="P2">P2</option>
                                                <option value="P3">P3</option>
                                                <option value="P4">P4</option>
                                                <option value="K2">K2</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="dengan_cara">Dengan Cara</label>
                                            <input class="form-control" type="text" name="dengan_cara" id="dengan_cara" required>
                                        </div>
                                    </div>    

                                    <?php
                                    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 3 || $_SESSION['admin'] == 6) {
                                        echo '
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <button type="submit" name="submit" class="btn btn-primary"> Simpan</button>
                                                    <a href="?page=pet" class="btn btn-default"> Batal</a>
                                                </div>
                                            </div>
                                         ';
                                    }
                                    ?>

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