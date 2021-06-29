<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");

if (post("pesan")) {
    $nomor = post("nomor");
    $pesan = post("pesan");

    //toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendMSG($nomor, $pesan);
    if ($res['status'] == "true") {
        toastr_set("success", "Pesan terkirim");
    } else {
        toastr_set("error", $res['msg']);
    }
}
?>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Pesan</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <label> Nomor </label>
                <input value="082220090060" class="form-control" type="text" name="nomor" placeholder="08xxxxxxxx" required>
                <br>
                <label> Pesan </label>
                <input class="form-control" type="text" name="pesan" required>
                <br>
                <button class="btn btn-success" type="submit">Kirim</button>
            </form>
        </div>
    </div>

              

   