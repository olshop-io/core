<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");


if (post("username")) {
    $username = post("username");
    $password = post("password");
    $level = post("level");
    // $count = countDB("nomor", "nomor", $nomor);

    // if ($count == 0) {
        // $q = mysqli_query($koneksi, "INSERT INTO domain(`name`,`user_id`,`created_at`)
        //     VALUES('$name','$u', date('Y-m-d H:i:s') )");
         $id = $edit['id'];

         if($password !="")
         {
            
         $q = mysqli_query($koneksi, "UPDATE account SET username = '$username', password= '$password', level ='$level' WHERE id='$id'");
         }else{
            $q = mysqli_query($koneksi, "UPDATE account SET username = '$username', level ='$level' WHERE id='$id'");
         }
         toastr_set("success", "Sukses update user");
         redirect($baseUrl."pengaturan");
    // } else {
    //     toastr_set("error", "nomor telah ada sebelumnya");
    // }
}



?>



         
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Edit User</h6>
                            
                           
                        </div>
                        <div class="card-body">
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <label> Username </label>
                                        <input type="text" name="username" value="<?php echo $edit['username'];?>" required class="form-control">
                                        <br>
                                        <label> Password </label>
                                        <input type="password" name="password" class="form-control">
                                        <br>
                                        <label for="exampleFormControlSelect1">Level</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="level">

                                          <?php if($edit['level'] =='1'){?>  
                                            <option value="1" selected>Super Admin</option>
                                            <option value="2">Admin</option>
                                            <option value="3">CS</option>
                                          <?php }else if($edit['level'] =='2'){ ?>
                                            <option value="1">Super Admin</option>
                                            <option value="2" selected>Admin</option>
                                            <option value="3">CS</option>
                                           <?php }else{?>
                                             <option value="1">Super Admin</option>
                                            <option value="2">Admin</option>
                                            <option value="3" selected>CS</option>
                                           <?php }?>
                                        </select>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo $baseUrl."pengaturan"?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                        </div>
                    </div>

               
