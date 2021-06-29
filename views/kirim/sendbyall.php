<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");

if (post("pesan")) {
    $username = $_SESSION['username'];
    $pesan = post("pesan");
    $jadwal = date("Y-m-d H:i:s", strtotime(post("tgl") . " " . post("jam")));
    if (!empty($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
        // Be sure we're dealing with an upload
        if (is_uploaded_file($_FILES['media']['tmp_name']) === false) {
            throw new \Exception('Error on upload: Invalid file definition');
        }

        // Rename the uploaded file
        $uploadName = $_FILES['media']['name'];
        $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));

        $allow = ['png', 'jpeg', 'pdf', 'jpg'];
        if (in_array($ext, $allow)) {
            if ($ext == "png") {
                $filename = round(microtime(true)) . mt_rand() . '.png';
            }

            if ($ext == "pdf") {
                $filename = round(microtime(true)) . mt_rand() . '.pdf';
            }

            if ($ext == "jpg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpg';
            }

            if ($ext == "jpeg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpeg';
            }
        } else {
            toastr_set("error", "Format png, jpg, pdf only");
            redirect("sendbyall");
            exit;
        }

        move_uploaded_file($_FILES['media']['tmp_name'], 'uploads/' . $filename);
        // Insert it into our tracking along with the original name
        $media = $base_url . "uploads/" . $filename;
    } else {
        $media = null;
    }

    if ($media == null) {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$jadwal', '$username')");
    } else {
        $nomor = serialize(getAllNumber());
        $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `media`, `jadwal`, `make_by`)
        VALUES('$nomor', '$pesan', '$media', '$jadwal', '$username')");
    }

    if (isset($_POST['target'])) {
        $n = $_POST['target'];
    } else {
        $n = getAllNumber();
    }

    $id_blast = getLastID("blast");
    if (post("tiap_bulan") == "on") {
        $tiap_bulan = "1";
        $last_month = date("m", strtotime("-1 month"));
    } else {
        $tiap_bulan = "0";
        $last_month = date("m", strtotime("-1 month"));
    }

    foreach ($n as $nn) {
        if ($media == null) {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `jadwal`, `tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        } else {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `media`, `jadwal`,`tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nn', '$pesan', '$media', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        }
    }

    toastr_set("success", "Sukses kirim pesan terjadwal");
}

if (post("pesan2")) {

    $username = $_SESSION['username'];
    //$pesan = post("pesan");
    $jadwal = date("Y-m-d H:i:s", strtotime(post("tgl") . " " . post("jam")));
    if (!empty($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
        // Be sure we're dealing with an upload
        if (is_uploaded_file($_FILES['media']['tmp_name']) === false) {
            throw new \Exception('Error on upload: Invalid file definition');
        }

        // Rename the uploaded file
        $uploadName = $_FILES['media']['name'];
        $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));

        $allow = ['png', 'jpeg', 'pdf', 'jpg'];
        if (in_array($ext, $allow)) {
            if ($ext == "png") {
                $filename = round(microtime(true)) . mt_rand() . '.png';
            }

            if ($ext == "pdf") {
                $filename = round(microtime(true)) . mt_rand() . '.pdf';
            }

            if ($ext == "jpg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpg';
            }

            if ($ext == "jpeg") {
                $filename = round(microtime(true)) . mt_rand() . '.jpeg';
            }
        } else {
            toastr_set("error", "Format png, jpg, pdf only");
            redirect("sendbyall");
            exit;
        }

        move_uploaded_file($_FILES['media']['tmp_name'], 'uploads/' . $filename);
        // Insert it into our tracking along with the original name
        $media = $base_url . "uploads/" . $filename;
    } else {
        $media = null;
    }

    // if ($media == null) {
    //     $nomor = serialize(getAllNumber());
    //     $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `jadwal`, `make_by`)
    //     VALUES('$nomor', '$pesan', '$jadwal', '$username')");
    // } else {
    //     $nomor = serialize(getAllNumber());
    //     $q = mysqli_query($koneksi, "INSERT INTO blast(`nomor`, `pesan`, `media`, `jadwal`, `make_by`)
    //     VALUES('$nomor', '$pesan', '$media', '$jadwal', '$username')");
    // }

    if (isset($_POST['target'])) {
        $t = $_POST['target'][0];
        $y = mysqli_query($koneksi, "SELECT * FROM nomor WHERE nomor = '$t'");

        $t = mysqli_fetch_assoc($y);
        $n = [$t];
    } else {
        $n = getAllNumberandmessage();
    }

    $id_blast = getLastID("blast");
    if (post("tiap_bulan") == "on") {
        $tiap_bulan = "1";
        $last_month = date("m", strtotime("-1 month"));
    } else {
        $tiap_bulan = "0";
        $last_month = date("m", strtotime("-1 month"));
    }

    foreach ($n as $nn) {
        $nomor = $nn['nomor'];
        $pesan = $nn['pesan'];

        if ($media == null) {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `jadwal`, `tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nomor', '$pesan', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        } else {
            $q = mysqli_query($koneksi, "INSERT INTO pesan(`id_blast`, `nomor`, `pesan`, `media`, `jadwal`,`tiap_bulan`, `last_month`, `make_by`)
            VALUES('$id_blast', '$nomor', '$pesan', '$media', '$jadwal', '$tiap_bulan', '$last_month', '$username')");
        }
    }

    toastr_set("success", "Sukses kirim pesan terjadwal");
}



?>


                    <!-- DataTales Example -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Kirim Pesan
                    </button>
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#kirimpesan2">
                        Kirim Pesan ( Pesan sesuai data nomor )
                    </button>
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display:contents">Data Pesan</h6>
                            <a class="btn btn-danger float-right" href="<?php echo $baseUrl."sendbyall/hd"?>">Hapus data (terkirim)</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nomor</th>
                                            <th>Pesan</th>
                                            <th>Media</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY id DESC");
                                        } else {
                                            $username = $_SESSION['username'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM pesan WHERE make_by='$username' ORDER BY id DESC");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['nomor'] . '</td>';
                                            echo '<td>' . $row['pesan'] . '</td>';
                                            echo '<td>' . $row['media'] . '</td>';
                                            echo '<td>' . $row['jadwal'] . '</td>';
                                            if ($row['status'] == "TERKIRIM") {
                                                echo '<td><span class="badge badge-success status-container-' . $row['id'] . '">Terkirim</span></td>';
                                            } else if ($row['status'] == "GAGAL") {
                                                echo '<td><span class="badge badge-danger status-container-' . $row['id'] . '">Gagal Terkirim</span></td>';
                                            } else if ($row['tiap_bulan'] == "1") {
                                                echo '<td><span class="badge badge-primary status-container-' . $row['id'] . '">Pengiriman Rutin Setiap Bulan</span></td>';
                                            } else {
                                                echo '<td><span class="badge badge-warning status-container-' . $row['id'] . '">Menunggu Jadwal / Pending</span></td>';
                                            }

                                            if ($row['status'] == "GAGAL") {
                                                echo '<td class="button-container-' . $row['id'] . '"><a style="margin:5px" class="btn btn-success" href="'.$baseUrl.'sendbyall/ku&id=' . $row['id_blast'] . '">Kirim Ulang</a><a style="margin:5px" class="btn btn-danger" href="'.$baseUrl.'sendbyall/delete?id=' . $row['id'] . '">Hapus</a></td>';
                                            } else {
                                                echo '<td class="button-container-' . $row['id'] . '"><a class="btn btn-danger" href="'.$baseUrl.'sendbyall/delete?id=' . $row['id'] . '">Hapus</a></td>';
                                            }
                                            echo '</tr>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label> Pesan * </label>
                        <textarea name="pesan" required class="form-control"></textarea>
                        <br>
                        <label> Media </label>
                        <input type="file" name="media" class="form-control">
                        <br>
                        <label> Tanggal Pengiriman * </label>
                        <input type="date" name="tgl" required class="form-control">
                        <br>
                        <label> Waktu Pengiriman * </label>
                        <input type="time" name="jam" required class="form-control">
                        <br>
                        <label>Target</label>
                        <br>
                        <select class="form-control js-example-basic-multiple" name="target[]" multiple="multiple" style="width: 100%">
                            <?php
                            if ($_SESSION['level'] == "1") {
                                $q = mysqli_query($koneksi, "SELECT * FROM nomor");
                            } else {
                                $u = $_SESSION['username'];
                                $q = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by='$u'");
                            }
                            while ($row = mysqli_fetch_assoc($q)) {
                                echo '<option value="' . $row['nomor'] . '">' . $row['nama'] . ' (' . $row['nomor'] . ')</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <p>*Kosongkan bila ingin mengirim ke semua kontak</p>
                        <br>
                        <br>
                        <div class="form-check">
                            <input type="checkbox" name="tiap_bulan" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Kirim tiap bulan</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="pesan1" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kirimpesan2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="pesan2" value="yo">
                        <label> Media </label>
                        <input type="file" name="media" class="form-control">
                        <br>
                        <label> Tanggal Pengiriman * </label>
                        <input type="date" name="tgl" required class="form-control">
                        <br>
                        <label> Waktu Pengiriman * </label>
                        <input type="time" name="jam" required class="form-control">
                        <br>
                        <label>Target</label>
                        <br>
                        <select class="form-control js-example-basic-multiple" name="target[]" multiple="multiple" style="width: 100%">
                            <?php
                            if ($_SESSION['level'] == "1") {
                                $q = mysqli_query($koneksi, "SELECT * FROM nomor");
                            } else {
                                $u = $_SESSION['username'];
                                $q = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by='$u'");
                            }
                            while ($row = mysqli_fetch_assoc($q)) {
                                echo '<option value="' . $row['nomor'] . '">' . $row['nama'] . ' (' . $row['nomor'] . ')</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <p>*Kosongkan bila ingin mengirim ke semua kontak</p>
                        <br>
                        <br>
                        <div class="form-check">
                            <input type="checkbox" name="tiap_bulan" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Kirim tiap bulan</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="kirimpesan2" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dropdownAutoWidth: true
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script>
        setInterval(sync, 4000);

        function sync() {
            let sync = localStorage.getItem('sync');
            if (sync == null) {
                sync = moment().format("YYYY-MM-DD HH:mm:ss");
                localStorage.setItem('sync', sync);
            }

            $.get("longpooling.php?lastsync=" + sync, function(data) {
                r = JSON.parse(data);

                jQuery.each(r, function(i, val) {
                    let id = val.id;
                    let id_blast = val.id_blast;
                    if (val.status == "GAGAL") {
                        $(".status-container-" + id).empty();
                        $(".status-container-" + id).html('Gagal Terkirim');
                        $(".status-container-" + id).addClass('badge-danger').removeClass('badge-warning');

                        $(".button-container-" + id).html('<a style="margin:5px" class="btn btn-success" href="kirim.php?act=ku&id=' + id_blast + '">Kirim Ulang</a><a style="margin:5px" class="btn btn-danger" href="hapus_pesan.php?id=' + id + '">Hapus</a>');
                    }

                    if (val.status == "TERKIRIM") {
                        $(".status-container-" + id).empty();
                        $(".status-container-" + id).html('Terkirim');
                        $(".status-container-" + id).addClass('badge-success').removeClass('badge-warning');

                        $(".button-container-" + id).html('<a style="margin:5px" class="btn btn-danger" href="hapus_pesan.php?id=' + id + '">Hapus</a>');
                    }
                    console.log(id);
                });

                localStorage.setItem('sync', moment().format("YYYY-MM-DD HH:mm:ss"));

            });
        }
    </script>
