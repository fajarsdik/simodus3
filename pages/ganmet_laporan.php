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
                        
                        <h1>Soon</h1> <hr/><br/>
                        
                        <!-- isi konten disini -->
                        <p>
                            Coming Soon
                        </p>
                        
                        
                        
                        <!-- akhir konten -->
                        
                    </div>
                </div>
                </div>
            </div>
                
    </div>
                        
 <?php   
}
