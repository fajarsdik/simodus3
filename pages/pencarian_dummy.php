
<div class = "row">
    <div class = "panel panel-primary">
        <div class = "panel-heading">
            <i class = "fa fa-search"></i> Pencarian Data
        </div>
        <div class = "panel-body">
            <form role = "form" method = "POST" action = "?page=lpd" enctype = "multipart/form-data">

                <?php
                $unit_area = substr($_SESSION['unit'], 0, 3);

                switch ($unit_area) {
                    case '181' :
                        $admin_area = "Pekanbaru";
                        break;
                    case '182' :
                        $admin_area = "Dumai";
                        break;
                    case '183' :
                        $admin_area = "Tanjungpinang";
                        break;
                    case '184' :
                        $admin_area = "Dumai";
                        break;
                }

                if ($_SESSION['admin'] == 1 && $_SESSION['unit'] == $unit_area) {
                    echo '<div class = "row">
                                <div class = "form-group col-lg-3">
                                    <label>Area</label>
                                    <select class = "form-control" name = "area" id = "area" required>
                                        <option value="181">Pekanbaru</option>
                                        <option value="182">Dumai</option>
                                        <option value="183">Tanjungpinang</option>
                                        <option value="184">Rengat</option>
                                    </select>
                                </div>';
                } else {
                    echo '<div class = "row">
                                <div class = "form-group col-lg-3">
                                    <label>Area</label>
                                    <select class = "form-control" name = "area" id = "area" readonly>
                                        <option value=" ' . $_SESSION['admin'] . ' "> ' . $admin_area . '</option>
                                    </select>
                                </div>';
                }

                $unit_rayon = $_SESSION['unit'];

                switch ($unit_rayon) {
                    case '18301' :
                        $admin_rayon = "Bintan Center";
                        break;
                    case '18302' :
                        $admin_rayon = "Kijang";
                        break;
                    case '18303' :
                        $admin_rayon = "Tg Uban";
                        break;
                    case '18304' :
                        $admin_rayon = "Belakang Padang";
                        break;
                    case '18305' :
                        $admin_rayon = "Tg Balai Karimun";
                        break;
                    case '18306' :
                        $admin_rayon = "Tg Batu";
                        break;
                    case '18307' :
                        $admin_rayon = "Dabosingkep";
                        break;
                    case '18308' :
                        $admin_rayon = "Natuna";
                        break;
                    case '18309' :
                        $admin_rayon = "Tanjungpinang Kota";
                        break;
                    case '18310' :
                        $admin_rayon = "Anambas";
                        break;
                }

                if ($_SESSION['unit'] == $unit_rayon) {
                    echo '<div class = "form-group col-lg-3">
                                <label>Rayon</label>
                                <select class = "form-control" name = "rayon" id = "rayon" required>
                                    <option value="18301">Bintan Center</option>
                                    <option value="18302">Kijang</option>
                                    <option value="18303">Tg Uban</option>
                                    <option value="18304">Belakang Padang</option>
                                    <option value="18305">Tg Balai Karimun</option>
                                    <option value="18306">Tg Batu</option>
                                    <option value="18307">Dabosingkep</option>
                                    <option value="18308">Natuna</option>
                                    <option value="18309">Tanjungpinang Kota</option>
                                    <option value="183010">Anambas</option>
                                </select>
                            </div>';
                } else {
                    echo '<div class = "form-group col-lg-3">
                                <label>Rayon</label>
                                <select class = "form-control" name = "rayon" id = "rayon" required>
                                    <option value=" ' . $unit_rayon . ' "> ' . $unit_rayon . '</option>
                                </select>
                            </div>';
                }
                ?>

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
