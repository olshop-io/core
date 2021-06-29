<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");



if ($_SESSION['level'] != 1) {
    echo "Tidak diizinkan akses halaman ini";
    exit;
}




if (post("chunk")) {
    $chunk = post("chunk");
    $wa = post("wa");
    $api_key = post("api_key");
    $nomor = post("nomor");
    mysqli_query($koneksi, "UPDATE pengaturan SET chunk = '$chunk', wa_gateway_url = '$wa', api_key='$api_key', nomor='$nomor' WHERE id='1'");
    toastr_set("success", "Sukses edit pengaturan");
}

if (get("act") == "gapi") {
    $api_key = sha1(date("Y-m-d H:i:s") . rand(100000, 999999));
    mysqli_query($koneksi, "UPDATE pengaturan SET api_key='$api_key' WHERE id='1'");
    toastr_set("success", "Sukses generate api key baru");
}

?>


                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                Tambah User
                            </button>
                            <br>
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>Level</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $q = mysqli_query($koneksi, "SELECT * FROM account");
                                                while ($row = mysqli_fetch_assoc($q)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['id'] . '</td>';
                                                    echo '<td>' . $row['username'] . '</td>';
                                                    if ($row['level'] == 1) {
                                                        echo '<td>Super Admin</td>';
                                                    }else if ($row['level'] == 2) {
                                                        echo '<td>Admin</td>';
                                                    }else{
                                                       echo '<td>CS</td>';
                                                    }
                                                    echo '<td><a class="btn btn-danger" href="'.$baseUrl.'user/edit?id=' . $row['id'] . '">Edit</a> <a class="btn btn-danger" href="'.$baseUrl.'user/delete?id=' . $row['id'] . '">Hapus</a></td>';
                                                    echo '</tr>';
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                                </div>
                                <div class="row mb-5">
                                    <div class="card shadow offset-1 col-10" style="width: 18rem;margin: 32px auto;">
                                        <div id="cardimg" style="margin: 10px auto;">
                                        </div>
                                        <div class="card-body">
                                            <div id="cardimg" class="text-center p-3" >

                                            </div>
                                            <h5 class="card-title"><span class="text-dark">Status :</span>
                                                <p class="log"></p>
                                            </h5>
                                            <div class="text-center">

                                                <button id="logout" href="#" class="btn btn-danger mt-6">logout</button>
                                                <button id="scanqrr" href="#" class="btn btn-primary mt-6">Scan qr</button>
                                                <button id="cekstatus" href="#" class="btn btn-success mt-6">Cek Koneksi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <hr>
                                    <form action="" method="post">
                                        <label> URL Whatsapp Gateway </label>
                                        <input type="text" class="form-control" name="wa" value="<?= url_wa() ?>">
                                        <p class="text-muted">*isi domainmu , contoh : http://domainmu/</p>
                                        <br>
                                        <label> Nomor Whatsapp Yang Terkoneksi </label>
                                        <input type="text" class="form-control" name="nomor" value="<?= getSingleValDB("pengaturan", "id", "1", "nomor") ?>">
                                        <p class="text-muted">*isi nomor yang di scan di atas</p>
                                        <br>
                                        <label> Batas Pengiriman per menit </label>
                                        <input type="text" class="form-control" name="chunk" value="<?= getSingleValDB("pengaturan", "id", "1", "chunk") ?>">
                                        <br>
                                        <!-- <label> API Key </label>
                                        <input type="text" class="form-control" name="api_key" readonly value="<?= getSingleValDB("pengaturan", "id", "1", "api_key") ?>">
                                        <br> -->
                                        <button class="btn btn-success"> Simpan </button>
                                        <!-- <a class="btn btn-primary" href="pengaturan.php?act=gapi"> Generate New API Key </a> -->
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


               

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $baseUrl."user/insert"?>" method="POST">
                        <label> Username </label>
                        <input type="text" name="username" required class="form-control">
                        <br>
                        <label> Password </label>
                        <input type="password" name="password" required class="form-control">
                        <br>
                        <label for="exampleFormControlSelect1">Level</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="level">
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">CS</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

   
