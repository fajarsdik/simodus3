<?php
ob_start();
//cek session
session_start();

if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else {
    ?>

    <!-- Include Head START -->
    <?php include('../include/head.php'); ?>
    <!-- Include Head END -->

    <body>

        <div id="wrapper">

            <!-- Top Navbar -->
            <?php include('../include/navbar.php'); ?>
            <!-- End Top Navbar -->

            <?php
            if (isset($_REQUEST['page'])) {
                $page = $_REQUEST['page'];
                switch ($page) {
                    case 'mon':
                        include "monitoring.php";
                        break;
                    case 'mdk':
                        include "meter_dummy_kembali.php";
                        break;
                    case 'mdg':
                        include "meter_dummy_pakai.php";
                        break;
                    case 'atv':
                        include "aktivasi_meter.php";
                        break;
                    case 'his_atv':
                        include "histori_aktivasi.php";
                        break;
                    case 'usr':
                        include "user.php";
                        break;
                    case 'pro':
                        include "profil.php";
                        break;
                    case 'about':
                        include "about.php";
                        break;
                    case 'lpd':
                        include "laporan_dummy.php";
                        break;

                   
                    case 'coms':
                        include "comingsoon.php";
                        break;
                    
                    
                    
                }
            } else {
                
                $unit =$_SESSION['unit'];
                $username =$_SESSION['username'];
                
                ?>

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                            <?php
                            echo "Selamat datang  ,.$username.";
                            ?>
                            
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">

                        <?php
                        $unit = $_SESSION['unit'];

                        //menghitung jumlah meter dummy
                        $jml_dummy = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit LIKE '$unit%'"));

                        //menghitung jumlah dummy terpasang
                        $dummy_terpasang = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit LIKE '$unit%' && status=''"));

                        //menghitung jumlah dummy standby
                        $dummy_standby = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_metdum_stok WHERE unit LIKE '$unit%' && status='ready'"));

                        //menghitung jumlah meter belum diaktivasi
                        $belum_aktivasi = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE unit LIKE '$unit%' && aktivasi='non aktif'"));

                        //menghitung jumlah meter belum kembali
                        $belum_kembali = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_metdum_pakai WHERE unit LIKE '$unit%' && aktivasi='aktif' && kembali='belum'"));
                        ?>
                        
                        <div class="col-lg-12">
                            <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-arrow-circle-o-up fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php echo '<div class="huge">' . $dummy_terpasang . '</div>'; ?>
                                            <div>Dummy Terpasang</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-check-square-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php echo '<div class="huge">' . $dummy_standby . '</div>'; ?>
                                            <div>Dummy Standby</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php echo '<div class="huge">' . $jml_dummy . '</div>'; ?>
                                            <div>Jumlah Meter Dummy</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="row">
                    
                    <?php
                        if ($belum_aktivasi > 0) {

                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3 || $_SESSION['admin'] == 4) {
                                ?>

                                <div class="col-lg-3 col-md-6">
                                    <div class="panel panel-red">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-exclamation fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <?php echo '<div class="huge">' . $belum_aktivasi . '</div>'; ?>
                                                    <div>Meter Belum Aktivasi</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="?page=atv">
                                            <div class="panel-footer">
                                                <span class="pull-left">Lihat detail</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            

                            <?php
                        }
                    }
                    ?>
                    
                    <?php
                        if ($belum_kembali > 0) {

                            if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2 || $_SESSION['admin'] == 3 || $_SESSION['admin'] == 4) {
                                ?>

                                <div class="col-lg-3 col-md-6">
                                    <div class="panel panel-red">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-exclamation fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <?php echo '<div class="huge">' . $belum_kembali . '</div>'; ?>
                                                    <div>Meter Belum Kembali</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="?page=mdk&act=add">
                                            <div class="panel-footer">
                                                <span class="pull-left">Lihat detail</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            <?php
                        }
                    }
                    ?>
                    </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /#page-wrapper -->

            <?php } ?>

        </div> 

        <!-- Include Footer START -->
        <?php include('../include/footer.php'); ?>
        <!-- Include Footer END -->

    </body>  
<?php }
?>