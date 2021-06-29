<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");


if (post("nama")) {
    $nama = post("nama");
    $nomor = post("nomor");
    $pesan = post("pesan");
    // $count = countDB("nomor", "nomor", $nomor);

    // if ($count == 0) {
        // $q = mysqli_query($koneksi, "INSERT INTO domain(`name`,`user_id`,`created_at`)
        //     VALUES('$name','$u', date('Y-m-d H:i:s') )");
         $id = $edit['id'];
         $q = mysqli_query($koneksi, "UPDATE nomor SET nama = '$nama', nomor= '$nomor', pesan ='$pesan' WHERE id='$id'");
         toastr_set("success", "Sukses update nomor");
         redirect($baseUrl."nomor");
    // } else {
    //     toastr_set("error", "nomor telah ada sebelumnya");
    // }
}



?>



         
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Edit Nomor</h6>
                            
                           
                        </div>
                        <div class="card-body">
                             <div class="modal-body">
                                <form action="" method="POST">
                                    <label> Nama </label>
                                    <input type="text" name="nama" value="<?php echo $edit['nama'];?>"  class="form-control" required>
                                    <br>

                                    <label> Nomor </label>
                                    <input type="text" name="nomor" value="<?php echo $edit['nomor'];?>"  class="form-control" required>
                                    <br>

                                     <label> Pesan </label>
                                    <input type="text" name="pesan" value="<?php echo $edit['pesan'];?>"  class="form-control" required>
                                    <br>
                                   
                      
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary" href="<?php echo $baseUrl.'nomor';?>" >Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                