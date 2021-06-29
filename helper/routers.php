<?php
include_once("function.php");
include_once("./models/actions.php");

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$path = $uriSegments[1];
$baseUrl = base_url();
$imgPhoto = $baseUrl."img/undraw_profile.svg";
$access = cekSession();
if($access == true)
{
   
 
    switch($path) 
    {
      case 'login':
        redirect($baseUrl."dashboard");
      break;    
      case 'dashboard':
        $title = "Dashboard";
        $content = "./views/dashboard/main.php";
      break;

      case 'autoreply': // get
         $id = get("id");
         
         if($uriSegments[2] =='insert'){
            $title = "Autos Replay";
            $insert = insertAutoPlay();
            redirect($baseUrl."autoreply");

         }else if($uriSegments[2] =='edit'){
              $title = "Edit Auto Replay";
              $edit  = getDataByID("autoreply", "id", $id);
              $content = "./views/message/edit.php"; 

         }else if($uriSegments[2] =='delete'){    
              $delete  = removeDataByID("autoreply", "id", $id);
              toastr_set("success", "Sukses menghapus autoreply");
              redirect($baseUrl."autoreply");
            
         }else{
            $title = "Auto Replay";
            $content = "./views/message/auto_reply.php";
         } 
        
      break;

      case 'nomor':
          $id = get("id");
          if($uriSegments[2] =='insert'){

            $title = "Nomor";
            $u = $_SESSION['username'];
            $insert = insertNomor($u);
            redirect($baseUrl."nomor");

          }else if($uriSegments[2] =='edit'){
              $title = "Edit Nomor";
              $edit  = getDataByID("nomor", "id", $id);
              $content = "./views/nomor/edit.php";
          }else if($uriSegments[2] =='delete'){ 
              $delete  = removeDataByID("nomor", "id", $id);
              toastr_set("success", "Sukses menghapus nomor");
              redirect($baseUrl."nomor");
          }else if($uriSegments[2] =='delete_all'){  
              $delete  = removeDataAll("nomor");
              toastr_set("success", "Sukses menghapus semua nomor");
              redirect($baseUrl."nomor"); 
          }else{
            $title = "Nomor";
            $content = "./views/nomor/index.php";
          } 

        
      break;

      case 'operator':
          $id = get("id");
          if($uriSegments[2] =='insert'){

            $title = "Operator";
            
            $insert = insertOperator();
            redirect($baseUrl."operator");
 
          }else if($uriSegments[2] =='edit'){
              $title = "Edit Operator";
              $edit  = getDataByID("operator", "id", $id);
              $content = "./views/operator/edit.php";
          }else if($uriSegments[2] =='delete'){ 
              $delete  = removeDataByID("operator", "id", $id);
              toastr_set("success", "Sukses menghapus operator");
              redirect($baseUrl."operator");

          }else if($uriSegments[2] =='delete_all'){ 
              $delete  = removeDataAll("operator");
              toastr_set("success", "Sukses menghapus semua operator");
              redirect($baseUrl."operator"); 
          }else{
            $title = "Operator";
            $content = "./views/operator/index.php";

          } 

       
      break;

      case 'domain':
          $id = get("id");
           
          if($uriSegments[2] =='insert'){

            $title = "Domain";
           
            $insert = insertDomain();
            redirect($baseUrl."domain");
 
          }else if($uriSegments[2] =='edit'){
              $title = "Edit Domain";
              $edit  = getDataByID("domain", "id", $id);
              $content = "./views/domain/edit.php";
          }else if($uriSegments[2] =='delete'){ 
              $delete  = removeDataByID("domain", "id", $id);
              toastr_set("success", "Sukses menghapus domain");
              redirect($baseUrl."domain");

          }else if($uriSegments[2] =='delete_all'){ 
              $delete  = removeDataAll("domain");
              toastr_set("success", "Sukses menghapus semua domain");
              redirect($baseUrl."domain"); 
          }else{
             $title = "Domain";
             $content = "./views/domain/index.php";

          } 

       
      break;

      case 'sendbyall':
         $id_blast = get("id");
         if($uriSegments[2] =='hd'){

           $delete = hapusBlast();
           redirect($baseUrl."sendbyall"); 
         }else if($uriSegments[2] =='ku'){ 
            
            $update = updateBlast($id_blast); 
            redirect($baseUrl."sendbyall"); 

         }else if($uriSegments[2] =='delete'){  
            $delete  = removeDataByID("pesan", "id", $id);
            toastr_set("success", "Sukses menghapus pesan");
            redirect($baseUrl."sendbyall");
         }else{ 
          $title = "Send By All";
          $content = "./views/kirim/sendbyall.php";
        }
      break;

      case 'sendbyone':
        $title = "Send By One";
        $content = "./views/kirim/sendbyone.php";
      break;

      case 'pengaturan':
        $title = "Pengaturan";
        $content = "./views/setting/pengaturan.php";
      break;

      case 'user':
        $id = get("id");
        if($uriSegments[2] =='insert'){
           
            $title = "User";
            $insert = insertUser();
            redirect($baseUrl."pengaturan");

         }else if($uriSegments[2] =='edit'){
              $title = "Edit User";
              $edit  = getDataByID("account", "id", $id);
              $content = "./views/setting/edit.php";

         }else if($uriSegments[2] =='delete'){
              $delete  = removeDataByID("account", "id", $id);
              toastr_set("success", "Sukses menghapus account");
              redirect($baseUrl."pengaturan");   
         } 
      break;

      case 'link':

        $id = get("id");
           
          if($uriSegments[2] =='add'){

            $title = "Tambah Link";
           
            // $insert = insertLink();
            // redirect($baseUrl."link");
            $content = "./views/link/create.php";
          }else if($uriSegments[2] =='edit'){
              $title = "Edit Link";
              $edit  = getDataByID("link", "id", $id);
              $content = "./views/link/edit.php";
          }else if($uriSegments[2] =='delete'){ 
              $delete  = removeDataByID("link", "id", $id);
              toastr_set("success", "Sukses menghapus link");
              redirect($baseUrl."link");

          }else if($uriSegments[2] =='delete_all'){ 
              $delete  = removeDataAll("link");
              toastr_set("success", "Sukses menghapus semua link");
              redirect($baseUrl."link"); 
          }else{
             $title = "Link";
             $content = "./views/link/index.php";

          } 
      break;

      case 'penjualan':
            $title = "Penjualan";
            $content = "./views/order/index.php";

      break;

       case 'usertype':
            $title = "User Type";
            $content = "./views/user/typeuser.php";

      break;

      case 'logout':
          session_destroy();
          redirect($baseUrl."login");
      break;

     
     
      default:
       $title = "Dashboard";
        $content = "./views/dashboard/main.php";
      break;
      
      
   }


 
   include("./views/layout/app.php");
    

}else{

    if($path ==""){ redirect($baseUrl."login");}
    if($path =="login")
    {
        include('./views/auth/login.php');
    }   
  
   
}  