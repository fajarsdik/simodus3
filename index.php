<?php
ob_start();
session_start();

//cek session
if (isset($_SESSION['admin'])) {
    header("Location: pages/admin.php");
    die();
}
require('include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SIMODUS</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title center">SIMODUS</h3>
                        </div>
                        <div class="panel-body">

                            <?php
                            if (isset($_REQUEST['submit'])) {

                                $username = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['username'])));
                                $password = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['password'])));

                                $query = mysqli_query($config, "SELECT id_user, username, nama, nip, unit, admin, sdum_tambah, sdum_aktivasi, sdum_kembali, sp2tl FROM tbl_user WHERE username=BINARY'$username' AND password=MD5('$password')");

                                if (mysqli_num_rows($query) > 0) {
                                    list($id_user, $username, $nama, $nip, $unit, $admin,$sdum_tambah, $sdum_aktivasi, $sdum_kembali, $sp2tl) = mysqli_fetch_array($query);

                                    session_start();

                                    //buat session
                                    $_SESSION['id_user'] = $id_user;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['nama'] = $nama;
                                    $_SESSION['nip'] = $nip;
                                    $_SESSION['unit'] = $unit;
                                    $_SESSION['admin'] = $admin;
                                    
                                    //menu dummy
                                    $_SESSION['sdum_tambah'] = $sdum_tambah;
                                    $_SESSION['sdum_aktivasi'] = $sdum_aktivasi;
                                    $_SESSION['sdum_kembali']=$sdum_kembali;
                                    
                                    //menu p2tl
                                    $_SESSION['sp2tl'] = $sp2tl;

                                    header("Location: pages/admin.php");
                                    die();
                                } else {

                                    echo '<script language="javascript">
                                            window.alert("ERROR! Username atau Password salah!");
                                            window.location.href="index.php";
                                        </script>';
                                    die();
                                }
                            } else {
                                ?>
                                <form method="POST" action="">

                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" required autocomplete="off">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Masuk</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>

    </body>

</html>