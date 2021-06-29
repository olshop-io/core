<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");

 

if (post("title")) {
    $title = post("title");
    $slug = post("slug");
    $domain_id = post("domain_id");
    $chat_content = post("chat_content");
    $operatorid =  $_POST['operatorid'];
    $opqty =   $_POST['opqty'];
    $pixel_id = post("pixel_id");
    $pixel_event_id = post("pixel_event_id");
    $tag_manager_id = post("tag_manager_id");
    $loading =  post("loading");
    $status =  post("status");



    $u = $_SESSION['id'];
    $count = countDB("link", "slug", $slug);
    $date = date('Y-m-d H:i:s');
    if ($count == 0) {
        $q = mysqli_query($koneksi, "INSERT INTO link(`title`,`slug`,`domain_id`, `clicks`,`chat_content`,`pixel_id`,`pixel_event_id`,`pixel_event_data`,`gtm_id`,`loading`,`status`,`user_id`,`created_at`)
            VALUES('$title', '$slug','$domain_id','0','$chat_content','$pixel_id' ,'$pixel_event_id','','$tag_manager_id','$loading','$status','$u', '$date' )");

     $qF = mysqli_query($koneksi, "SELECT id FROM link WHERE user_id='$u'  ORDER BY id DESC LIMIT 1");
     $limit  = mysqli_fetch_assoc($qF); 
     $linkid = $limit['id'];
     

     $jml_operatorid = count($operatorid);
     $jml_opqty = count($opqty);
		if($jml_operatorid > 0 && $jml_opqty >0){
			for($i=0; $i<$jml_operatorid; $i++)
			{
                for($qt=0; $qt<$jml_opqty; $qt++)
			    {
				  $q = mysqli_query($koneksi, "INSERT INTO link_detail(`link_id`,`operator_id`,`op_qty`)VALUES('$linkid','$operatorid[$i]','$opqty[$qt]')");
				}  
			}
		}  

  

        toastr_set("success", "Sukses input link");
        redirect("link");
    } else {
        toastr_set("error", "Slug telah ada sebelumnya");
    }
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

                    <!-- DataTales Example -->
                    
                  
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" style="display: contents">Tambah Link</h6>
                          
                           
                        </div>
                        <div class="card-body">
                      <form action="" method="POST">
                        <label> Title </label>
                        <input type="text" name="title" id="title" required class="form-control">
                        <br>
                        <label> Slug </label>
                        <input type="text" name="slug" id="slug" required class="form-control" placeholder="">
                        <br>

                        <label> Domain </label>
                        <select class="form-control" name="domain_id" required>
                          <option value="0">Pilih Domain</option>
                           <?php
                                      
                                        $q = mysqli_query($koneksi, "SELECT * FROM domain");
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<option value="' . $row['id'] . '">';
                         
                                            echo '' . $row['name'] . '';
                                            echo '</option>';
                                        }

                                        ?>
                        </select>    
                        <br>
                         <label> Chat Konten </label>
                         <br>
                          <button type="button" class="btn btn-secondary" id="op_name">Insert Operator Name</button>
                          <button type="button" class="btn btn-secondary" id="op_number">Insert Operator Number</button>
                            <button type="button" class="btn btn-secondary" id="b">B</button>
                              <button type="button" class="btn btn-secondary" id="i">I</button>
                                <button type="button" class="btn btn-secondary" id="s">S</button>
                          <br>
                          <br>
                         <textarea class="form-control" required name="chat_content" id="chat_content" style="height:200px; "></textarea> 
                         <br>

                         <label> Operator </label>
                          <br>
                          <div class="input_fields_wrap">
	                          <select class="" name="operatorid[]" style="width: 200px;height: 30px;">
	                          <option>Pilih Operator</option>
	                           <?php
	                                      
	                                        $q = mysqli_query($koneksi, "SELECT * FROM operator");
	                                        while ($row = mysqli_fetch_assoc($q)) {
	                                            echo '<option value="' . $row['id'] . '">';
	                                            echo '' . $row['name'] . '';
	                                            echo '</option>';
	                                        }

	                                    

	                                        ?>
	                        </select>

	                        <input type="number" name="opqty[]" style="width: 50px;">
                        </div>   
                        <br>
                         <br>
                          <button type="button"  class="btn btn-primary" id="add_op">Tambah Operator</button>
                         <br>
                         <br>
                         <h3> Facebook Pixel </h3>
                         <br>
                         <div class="row">
                           <div class="col-sm-6">
                                <label> Pixel ID </label>
		                        <br>
		                        <input type="text" name="pixel_id" class="form-control" style="width: 250px;"> 
		                        <br>
                           </div>	
                           <div class="col-sm-6">
                                <label> Pixel Event </label>
		                        <br>
		                        <select name="pixel_event_id" class="form-control" style="width: 250px;">
                                    <option value="0">Pilih Pixel Event</option>
                                      <?php
                                      
                                        $q = mysqli_query($koneksi, "SELECT * FROM pixel_event");
                                        while ($row = mysqli_fetch_assoc($q)) {
                                         
                                             echo '<option value="' . $row['id'] . '">';
                                            echo '' . $row['name'] . '';
                                            echo '</option>';  
                                            
                                        }

                                        ?>
                                   
		                        </select> 
		                        <br>
                           </div>
                         </div>	

                          <br>
                         <br>
                         <br>
                         <h3> Google Tag Manager </h3>
                         <label> Tag Manager Id </label>
                        <input type="text" name="tag_manager_id" class="form-control" placeholder="">
                        <br>

                        <label> Loading Time </label>
                        <select class="form-control" name="loading">
                          <option value="0">0 Detik</option>
                          <option value="1">1 Detik</option>
                          <option value="2">2 Detik</option>
                          <option value="3">3 Detik</option>
                          <option value="4">4 Detik</option>
                          <option value="5">5 Detik</option>
                        </select>    
                        <br>
                        


                          <label> Status </label>
                           <br>
                          <input type="radio" name="status" checked value="1"> <b>Publish</b>
                           <br>
                          <input type="radio" name="status" value="0"> <b>Draft</b> 
                         
                       
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-secondary" href="link">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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

     $('#op_name').click( () => {
         var opname = "[operatorname]";
         $('#chat_content').append(opname);
            
     }); 

     $('#op_number').click( () => {
         var opnumber = "[operatornumber]";
         $('#chat_content').append(opnumber);
            
     });  

     $('#b').click( () => {
         var opnumber = "**";
         $('#chat_content').append(opnumber);
            
     });  

     $('#i').click( () => {
         var opnumber = "__";
         $('#chat_content').append(opnumber);
            
     });  

     $('#s').click( () => {
         var opnumber = "~~";
         $('#chat_content').append(opnumber);
            
     });



    var max_fields      = 100; //maximum input boxes allowed

	
	var x = 1; //initlal text box count
	$("#add_op").click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
             
             var inpt = '';

             inpt +='<div style="margin: 5px 0px 5px 0px;">';
             inpt +='<select class="" name="operatorid[]" style="width: 200px;height: 30px;">';
              inpt +='<option value="0">Pilih Operator</option>';
             <?php $q = mysqli_query($koneksi, "SELECT * FROM operator");
	                   while ($row = mysqli_fetch_assoc($q)) { ?>
              inpt +='<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>';
             
	         <?php }?>
	                                           

                 
             inpt +='</select>';

              inpt +='<input type="number" name="opqty" style="width: 50px;margin-left:4px;">';
	          inpt +='<a id="remove_field"   style="margin-left: 5px;curson:pointer;"><b>Hapus</b></a>';
             inpt +='</div>';
               

			$('.input_fields_wrap').append(inpt); //add input box
		}
	});
	
	$('.input_fields_wrap').on("click","#remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})

	// $("#title").keypress(function(){  
 //      $("#slug").val($("#title").val());  
 //    });  

    </script>
</body>

</html>