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
        
        $unit = $_SESSION['unit'];
        
    } else {
        ?>

        <div id = "page-wrapper">
            <div class = "row">
                <div class = "col-lg-12">
                    <h1 class = "page-header">Laporan Dummy</h1>
                </div>
            </div>

            <div class = "row">
                <div class = "panel panel-primary">
                    <div class = "panel-heading">
                        <i class = "fa fa-search"></i> Pencarian Data
                    </div>
                    <div class = "panel-body">
                        <form role = "form" method = "POST" action = "?page=lpd" enctype = "multipart/form-data">
                            <div class = "row">
                                <div class = "form-group col-lg-3">
                                    <label>Area</label>
                                    <select class = "form-control" name = "area" id = "area" required>
                                        <option>Tanjungpinang</option>
                                    </select>
                                </div>
                                <div class = "form-group col-lg-3">
                                    <label>Rayon</label>
                                    <select class = "form-control" name = "rayon" id = "rayon" required>
                                        <option>Bintan Center</option>
                                    </select>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "form-group col-lg-3">
                                    <label for = "tgl_awal">Mulai Tanggal</label>
                                    <input class = "form-control" type = "date" name = "tgl_awal" id = "tgl_awal" required>
                                </div>
                                <div class = "form-group col-lg-3">
                                    <label for = "tgl_akhir">Sampai Tanggal</label>
                                    <input class = "form-control" type = "date" name = "tgl_akhir" id = "tgl_akhir" required>
                                </div>
                            </div>
                            <button type = "submit" class = "btn btn-default"><i class = "fa fa-search"></i> Cari</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class = "row">
                <div class = "panel panel-primary">
                    <div class = "panel-heading">
                        <i class = "fa fa-search"></i> Hasil Pencarian
                    </div>
                    <div class = "panel-body">

                    </div>
                </div>
            </div>

        </div> 
        <?php
    }
    ?>



    <?php
}    