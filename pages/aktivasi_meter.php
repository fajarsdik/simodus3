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
            case 'eam':
                include "aktivasi.php";
                break;
        }
    } else {
        ?>

        <div id = "page-wrapper">
            <div class = "row">
                <div  class = "col-lg-12">
                    <h1 class = "page-header">Aktivasi Meter Pengganti</h1>
                </div>
            </div>
            <!-- Akhir Judul -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pemakaian Dummy
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#aktivasi_meter" data-toggle="tab">Aktivasi Meter</a>
                        </li>
                        <li><a href="#histori_aktivasi" data-toggle="tab">Histori Aktivasi</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="aktivasi_meter">
                            <?php include 'aktivasi_meter_tab.php' ?>
                        </div>
                        <!--/.panel-body -->

                        <div class = "tab-pane fade" id = "histori_aktivasi"> 

                        </div>
                    </div>
                    <!--/.panel -->
                <?php }
                ?>
            </div>




        </div>


    </div>
    <!--/.col-lg-12 -->
    </div>


    <?php
}
?>