<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");


if (post("keyword")) {
    $keyword = post("keyword");
    $response = post("response");
    $case_sensitive = post("case_sensitive");

    if ($case_sensitive == "") {
        $case_sensitive = "0";
    } else {
        $case_sensitive = "1";
    }

    // $q = mysqli_query($koneksi, "INSERT INTO autoreply(`keyword`, `response`, `case_sensitive`)
    //         VALUES('$keyword', '$response', '$case_sensitive')");
     $q = mysqli_query($koneksi, "UPDATE autoreply SET keyword = '$keyword', response= '$response', case_sensitive ='$case_sensitive' WHERE id='$id'");
    toastr_set("success", "Sukses update autoreply");
    redirect($baseUrl."autoreply");
}


?>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Autoreply</h6>
    </div>
    <div class="card-body">
            <div class="modal-body">
                <form action="" method="POST">
                    <label> Keyword </label>
                    <input type="text" name="keyword"  value="<?php echo $edit['keyword'];?>" class="form-control" required>
                    <br>
                    <label> Response </label>
                    <textarea name="response" class="form-control" required><?php echo $edit['response'];?></textarea>
                    <br>
                    
                    <div class="form-check">
                        <?php if($edit['case_sensitive'] ==1){?>
                        <input type="checkbox" name="case_sensitive" class="form-check-input" id="exampleCheck1" checked>
                    <?php }else{ ?>
                         <input type="checkbox" name="case_sensitive" class="form-check-input" id="exampleCheck1">
                    <?php }?>    
                        <label class="form-check-label" for="exampleCheck1">Case Sensitive ?</label>
                    
                    </div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo $baseUrl.'autoreply';?>" class="btn btn-secondary" >Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

    </div>
</div>
