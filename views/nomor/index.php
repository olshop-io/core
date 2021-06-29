<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");



?>


                    <!-- DataTales Example -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        Tambah Nomor
                    </button>
                    <br>
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Data Nomor</h6>
                            <a class="btn btn-danger float-right" href="<?php echo $baseUrl."nomor/delete_all"?>" style="margin:5px">Hapus Semua</a>
                            <a class="btn btn-info float-right" href="export_excel.php" style="margin:5px">Export Semua (excel)</a>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" style="margin:5px" data-target="#import">
                                Import Excel
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Nomor</th>
                                            <th>Pesan Default</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor");
                                        } else {
                                            $u = $_SESSION['username'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by='$u'");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['nama'] . '</td>';
                                            echo '<td>' . $row['nomor'] . '</td>';
                                            echo '<td>' . $row['pesan'] . '</td>';
                                            echo '<td><a class="btn btn-danger" href="'.$baseUrl.'nomor/edit?id=' . $row['id'] . '">Edit</a> <a class="btn btn-danger" href="'.$baseUrl.'nomor/delete?id=' . $row['id'] . '">Hapus</a></td>';
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Nomor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $baseUrl."nomor/insert"?>" method="POST">
                        <label> Nama </label>
                        <input type="text" name="nama" required class="form-control">
                        <br>
                        <label> Nomor Telepon </label>
                        <input type="text" name="nomor" required class="form-control" placeholder="08xxxxxxxx">
                        <br>
                        <label>Pesan </label>
                        <input type="text" name="pesan" required class="form-control" placeholder="pesan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Nomor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="import_excel.php" method="POST" enctype="multipart/form-data">
                        <label> File (.xlsx) </label>
                        <input type="file" name="file" required class="form-control">
                        <br>
                        <label> Mulai dari Baris ke </label>
                        <input type="text" name="a" required class="form-control" value="2">
                        <br>
                        <label> Kolom Nama ke </label>
                        <input type="text" name="b" required class="form-control" value="1">
                        <br>
                        <label> Kolom Nomor ke </label>
                        <input type="text" name="c" required class="form-control" value="2">
                        <br>
                        <label> Kolom pesan ke </label>
                        <input type="text" name="d" required class="form-control" value="3">
                        <br>
                        <p> Download file contoh <a href="excel/contoh.xlsx" target="_blank">disini</a> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 