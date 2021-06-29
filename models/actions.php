
<?php 
include_once("./helper/function.php");
include_once("./helper/koneksi.php");
session_start();




function insertAutoPlay(){
  global $koneksi;
    $keyword = post("keyword");
    $response = post("response");
    $case_sensitive = post("case_sensitive");
  if ($keyword) {
    

    if ($case_sensitive == "") {
        $case_sensitive = "0";
    } else {
        $case_sensitive = "1";
    }
      
      mysqli_query($koneksi, "INSERT INTO autoreply(`keyword`, `response`, `case_sensitive`)
            VALUES('$keyword', '$response', '$case_sensitive')");
    
      toastr_set("success", "Sukses menambahkan autoreply");
   }
}

function insertNomor($u){
   global $koneksi;
    if (post("nama"))
    {
        $nama = post("nama");
        $nomor = post("nomor");
        $pesan = post("pesan");
        
        $count = countDB("nomor", "nomor", $nomor);

        if ($count == 0) {
            $q = mysqli_query($koneksi, "INSERT INTO nomor(`nama`, `nomor`,`pesan`, `make_by`)
                VALUES('$nama', '$nomor','$pesan', '$u')");
            toastr_set("success", "Sukses input nomor");
        } else {
            toastr_set("error", "Nomor telah ada sebelumnya");
        }
   }
}


function insertOperator(){
   global $koneksi;

    if (post("name")) {
        $name = post("name");
        $number = post("number");
        $u = $_SESSION['id'];
        $count = countDB("operator", "number", $number);

        if ($count == 0) {
            $q = mysqli_query($koneksi, "INSERT INTO operator(`name`,`number`,`clicks`, `user_id`,`created_at`)
                VALUES('$name', '$number',0, '$u', date('Y-m-d H:i:s') )");
            toastr_set("success", "Sukses input operator");
        } else {
            toastr_set("error", "operator telah ada sebelumnya");
        }
    }

}

function insertDomain()
{
    global $koneksi;
    if (post("name"))
    {
        $name = post("name");
        $u = $_SESSION['id'];
        $count = countDB("domain", "name", $name);
        
        if ($count == 0) {
            $q = mysqli_query($koneksi, "INSERT INTO domain(`name`,`user_id`,`created_at`)
                VALUES('$name','$u', date('Y-m-d H:i:s') )");
            toastr_set("success", "Sukses input domain");
        } else {
            toastr_set("error", "domain telah ada sebelumnya");
        }
    }

}


function insertUser(){
    global $koneksi;
    if (post("username"))
    {
        $u = post("username");
        $p = sha1(post("password"));
        $l = post("level");

        $count = countDB("account", "username", $u);

        if ($count == 0) {
            $q = mysqli_query($koneksi, "INSERT INTO account(`username`, `password`, `level`)
            VALUES('$u', '$p', '$l')");
            toastr_set("success", "Sukses membuat user");
        } else {
            toastr_set("error", "Username telah terpakai");
        }
    }


}

function updateBlast($id_blast){
    global $koneksi;
    $q = mysqli_query($koneksi, "UPDATE `pesan` SET `status`='MENUNGGU JADWAL' WHERE `id_blast`='$id_blast' AND `status`='GAGAL'");
    toastr_set("success", "Sukses mengirim ulang blast");
           
}

function hapusBlast(){
   global $koneksi;
   $q = mysqli_query($koneksi, "DELETE FROM pesan WHERE `status`='TERKIRIM' AND `tiap_bulan`='0'");
   toastr_set("success", "Sukses menghapus pesan");
    
}

