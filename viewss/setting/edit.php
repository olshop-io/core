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
         redirect("pengaturan");
    // } else {
    //     toastr_set("error", "nomor telah ada sebelumnya");
    // }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OLSHOP.IO - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  include('./views/layout/sidebar.php');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php  include('./views/layout/navbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

         
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
                                    <a href="pengaturan" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php  include('./views/layout/footer.php');?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php  include('./views/layout/logout.php');?>

    <!-- Modal -->
    

   <!-- Modal -->
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        <?php

        toastr_show();

        ?>

      
   
             
            
     
      
    </script>
</body>

</html>