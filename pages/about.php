<?php
//cek session
if (empty($_SESSION['admin'])) {
    echo '<script language="javascript">
        window.alert("Anda harus login terlebih dahulu!");
        window.location.href="../index.php"
    </script>';
    die();
} else { ?>
    
    <div id = "page-wrapper">
            <div class = "row">
                <div class="col-lg-12"> 
                <div class = "panel">
                    <div class = "panel-body">
                        
                        <h1>Tentang</h1> <hr/><br/>
                        
                        <!-- isi konten disini -->
                        <p>
                            SIMODUS (Sistem Monitoring Dummy Terpadu)
                            <br>
                            <br style="">Kita tidak dapat menghindari meter yang rusak tetapi kita dapat mempersiapkan diri untuk menghadapinya.
                            <br>
                            <br>Meter dummy adalah meter sementara yang digunakan saat meter pelanggan dalam keadaan rusak. Cara ini adalah cara yang tepat dalam penanganan meter gangguan
                            <br>Dalam pelaksanaanya kita harus mampu melakukan pengawasan keberadaan meter dummy, untuk itulah SIMODUS ini ada.
                        </p>
                        
                        
                        
                        <!-- akhir konten -->
                        
                    </div>
                </div>
                </div>
            </div>
                
    </div>
                        
 <?php   
}
