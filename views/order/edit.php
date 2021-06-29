<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");


if (post("name")) {
    $name = post("name");
  
   
    $count = countDB("domain", "name", $name);

    if ($count == 0) {
        // $q = mysqli_query($koneksi, "INSERT INTO domain(`name`,`user_id`,`created_at`)
        //     VALUES('$name','$u', date('Y-m-d H:i:s') )");
         $id = $edit['id'];
         $q = mysqli_query($koneksi, "UPDATE domain SET name = '$name' WHERE id='$id'");
         toastr_set("success", "Sukses update domain");
         redirect($baseUrl."domain");
    } else {
        toastr_set("error", "domain telah ada sebelumnya");
    }
}



?>




         
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Edit Domain</h6>
                            
                           
                        </div>
                        <div class="card-body">
                             <div class="modal-body">
                                <form action="" method="POST">
                                    <label> Name </label>
                                    <input type="text" name="name" value="<?php echo $edit['name'];?>"  class="form-control" required>
                                    <br>
                                   
                      
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary" href="<?php echo $baseUrl."domain"?>" >Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
