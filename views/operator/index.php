<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");


?>


                    <!-- DataTales Example -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Tambah Operator
                    </button>
                    <br>
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Operator</h6>
                            <a class="btn btn-danger float-right" href="<?php echo $baseUrl."operator/delete_all"?>" style="margin:5px">Hapus Semua</a>
                            <!-- <a class="btn btn-info float-right" href="export_excel.php" style="margin:5px">Export Semua (excel)</a>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" style="margin:5px" data-target="#import">
                                Import Excel
                            </button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Click</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM operator");
                                        } else {
                                            $u = $_SESSION['id'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM operator WHERE user_id='$u'");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['number'] . '</td>';
                                            echo '<td>' . $row['clicks'] . '</td>';

                                            echo '<td><a class="btn btn-danger" href="'.$baseUrl.'operator/edit?id=' . $row['id'] . '">Edit</a> <a class="btn btn-danger" href="'.$baseUrl.'operator/delete?id=' . $row['id'] . '">Hapus</a></td>';
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $baseUrl."operator/insert"?>" method="POST">
                        <label> Name </label>
                        <input type="text" name="name" required class="form-control">
                        <br>
                        <label> Number </label>
                        <input type="number" name="number" required class="form-control" placeholder="08xxxxxxxx">
                        <br>
                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    