<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");

 




?>


                    <!-- DataTales Example -->
                    <a href="<?php echo $baseUrl."link/add"?>" class="btn btn-primary btn-block">
                       Tambah Link
                    </a>
                    <br>
                    <div class="card shadow mb-4">

                       

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Link</h6>
                            <a class="btn btn-danger float-right" href="<?php $baseUrl."link/delete_all"?>" style="margin:5px">Hapus Semua</a>
                          
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Domain</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM link");
                                        } else {
                                            $u = $_SESSION['id'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM link WHERE user_id='$u'");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['title'] . '</td>';
                                            echo '<td>' . $row['slug'] . '</td>';
                                            echo '<td>' . getSingleValDB("domain", "id", $row['domain_id'], "name"). '</td>';

                                            echo '<td><a class="btn btn-danger" href="link/edit?id=' . $row['id']. '">Edit</a> <a class="btn btn-danger" href="link/delete?id=' . $row['id'] . '">Hapus</a></td>';
                                            echo '</tr>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

 