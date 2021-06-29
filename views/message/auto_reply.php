<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");




?>


       
      

            



    <!-- DataTales Example -->
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
        Tambah Autoreply 
    </button>
    <br>
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Autoreply</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Keyword</th>
                            <th>Response</th>
                            <th>Case Sensitive</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q = mysqli_query($koneksi, "SELECT * FROM autoreply");

                        while ($row = mysqli_fetch_assoc($q)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['keyword'] . '</td>';
                            echo '<td>' . $row['response'] . '</td>';
                            if ($row['case_sensitive'] == "0") {
                                echo '<td><span class="badge badge-primary">Non Sensitive</span></td>';
                            } else {
                                echo '<td><span class="badge badge-danger">Sensitive</span></td>';
                            }
                            echo '<td><a class="btn btn-danger" href="'.$baseUrl.'autoreply/edit?id=' . $row['id'] . '">Edit</a> <a class="btn btn-danger" href="'.$baseUrl.'autoreply/delete?id=' . $row['id'] . '">Hapus</a></td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Autoreply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $baseUrl."autoreply/insert";?>" method="POST">
                    <label> Keyword </label>
                    <input type="text" name="keyword" required class="form-control">
                    <br>
                    <label> Response </label>
                    <textarea name="response" class="form-control" required></textarea>
                    <br>
                    <div class="form-check">
                        <input type="checkbox" name="case_sensitive" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Case Sensitive ?</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>


    