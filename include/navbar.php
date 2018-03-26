<?php
//cek session
if (!empty($_SESSION['admin'])) {
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../pages/admin.php">SIMODUS</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-toggle">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="../pages/admin.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="?page=mon"><i class="fa fa-table fa-fw"></i> Monitoring Dummy</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fax fa-fw"></i> Meter Dummy<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?page=mdg">Pemakaian Dummy</a>
                            </li>
                            <li>
                                <a href="#">Aktivasi Meter Pengganti <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="?page=atv">Aktivasi Meter</a>
                                    </li>
                                    <li>
                                        <a href="?page=his_atv">Histori Aktivasi</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=mdk">Dummy Kembali</a>
                            </li>
                            <li>
                                <a href="?page=lpd">Laporan</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                   
                   
                    <?php
                    //admin 10 untuk sayid
                    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 10) {
                        echo '
                            
                        <li>
                        <a><i class="fa fa-fax fa-fw"></i> Ganti Meter tanpa dummy<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="?page=egm">Entri Data Ganti Meter</a>
                            </li>

                        </ul>                        
                        </li>
                       
                         ';
                    }
                    ?>
                    <?php
                    //admin 10 untuk sayid
                    if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
                        echo '
                            
                        <li>
                        <a><i class="fa fa-fax fa-fw"></i> Administrator<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="?page=tud">Tambah User</a>
                            </li>

                        </ul>                        
                        </li>
                       
                         ';
                    }
                    ?>
                    <li>
                        <a href="?page=about"><i class="glyphicon glyphicon-info-sign"></i> About</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <?php
} else {
    header("Location: ../");
    die();
}
?>