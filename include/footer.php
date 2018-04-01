<?php
//cek session
if (!empty($_SESSION['admin'])) {
    ?>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
        $(document).ready(function () {
            $('#monitoring').DataTable({
                responsive: true
            });
        });
    </script>

    <script>
    // tooltip demo
        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    // popover demo
        $("[data-toggle=popover]")
                .popover();

    //jquery untuk menampilkan pemberitahuan
        $("#alert").alert().delay(1500).fadeOut('slow');

    //jquery modal
        $(document).ready(function () {
            $('.modal-trigger').leanModal();
        });

    </script>


    <?php
} else {
    header("Location: ../");
    die();
}
?>
