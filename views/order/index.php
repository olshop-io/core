<?php
include_once("../../helper/koneksi.php");
include_once("../../helper/function.php");
include_once("../../helper/routers.php");

?>





                    <!-- DataTales Example -->
                    <div class="row">
                            <div class="col-sm-10" style="float: left;">

                            </div>    
                            <div class="col-sm-2" style="float: right;">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                    Parsing
                                </button>
                            </div>

                      
                    </div>
                    <br>
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary" >Data Order</h6> 
                        </div>
                        <div class="card-body">
                                 
                            <div id="result-parse" class="modal-body" style="display: none;" >
                                    <label> Nama </label>
                                    <input id="nama" type="text" name="nama"  value="" class="form-control" required>
                                    <br>

                                    <label> No Hp </label>
                                    <input id="phone" type="text" name="phone"  value="" class="form-control" required>
                                    <br>

                                    <label> Email </label>
                                    <input id="email" type="text" name="email"  value="" class="form-control" required>
                                    <br>

                                    <label> Alamat </label>
                                    <textarea id="alamat" class="form-control"></textarea>
                                    <br>

                                    <label> Kecamatan </label>
                                    <input id="kecamatan" type="text" name="kecamatan"  value="" class="form-control" required>
                                    <br>

                                    <label> Kota </label>
                                    <input id="kota" type="text" name="kecamatan"  value="" class="form-control" required>
                                    <br>

                                    <label> Order </label>
                                    
                                    <br>
                            </div>                   
                        </div>
                    </div>

              
    <!-- Modal -->
    <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            
      
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Parse data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="parse-body" class="modal-body">
                   
                        
                        <textarea id="text_parse"  required class="form-control" style="height: 220px;"></textarea>
                        <br>
                       
                      
                </div>
                <div id="parse-footer" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="parse" type="button" class="btn btn-primary" >Simpan</button>
                    </form>
                </div>
                <div id="loading-parse" style="display:none;">
                    <div class="modal-body"><h4 style="text-align: center;margin: 50px auto;">Loading ....</h4></div>
                </div>    
            </div>
        </div>
    </div>

   <script src="vendor/jquery/jquery.min.js"></script>

   <script type="text/javascript">
       
     $('#parse').click( () => {
         var textparse = $("#text_parse").val();
         var textinput = textparse.split("\n"); 

         var resNama = textinput[0].split(":");
         if(resNama[0] =="Nama")
         {
            $("#nama").val(resNama[1]);
         }

         var resNohp = textinput[1].split(":");
         if(resNohp[0] =="No hp")
         {
            $("#phone").val(resNohp[1]);
         }

         var resEmail = textinput[2].split(":");
         if(resEmail[0] =="Email")
         {
            $("#email").val(resEmail[1]);
         }

         var resAlamat = textinput[3].split(":");
         if(resAlamat[0] =="Alamat")
         {
            $("#alamat").val(resAlamat[1]);
         }

         var resKec = textinput[4].split(":");
         if(resKec[0] =="Kecamatan")
         {
            $("#kecamatan").val(resKec[1]);
         }

         var resKota = textinput[5].split(":");
         if(resKota[0] =="Kota")
         {
            $("#kota").val(resKota[1]);
         }
         
         $("#parse-body").hide();
         $("#parse-footer").hide();
         $("#loading-parse").show();
         
        setTimeout(() => { 
           $("#exampleModal").modal('hide');
           $("#result-parse").show();
        }, 4000);


         
            
     }); 
   </script>