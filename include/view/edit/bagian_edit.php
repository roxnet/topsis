<div class="col-sm-8 col-sm-offset-3">  
<h2 class="text-center">Form Edit Data Bagian</h2> 
    <div class="panel-group">
        <div class="panel panel-default" style="padding:10px">


            <?php
            $id_bagian=$_GET['id_bagian'];
            $edit=("select * from bagian where id_bagian='$id_bagian'");
            $hasil = mysqli_query($db_link,$edit);


            ?>
            <form class="form-inline text-center panel panel-default" action="bagian_edit_proses.php" method="post" >
                <div class="form-group">
                    <?php
                    while($row=mysqli_fetch_array($hasil)){
                    ?>
                    <input type="hidden" name="id_bagian" value="<?php echo $id_bagian;?>"/>
                            
                    <label class="control-label " for="name">Nama Bagian : </label>
                    <input class="form-control"  type="text" name="bagian" value="<?php echo $row['bagian'];?>" />
                </div>
                       
                    <?php
                    }
                    ?>
                
            </form>
             <div class="panel-heading"  style="margin:10px">
					<div class="row">
						<div class="col-sm-12 col-sm-offer-2">
							<center><button type="button" id="simpan" class="btn btn-success">SIMPAN</button>
                            <button type="button" id="cancel" onclick="window.history.go(-1);" class="btn btn-danger">CANCEL</button></center>
						</div>
					</div>
			</div>
        </div>
    </div>
</div>




<div id="hasil" class="alert alert-success" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Bagian Berhasil Disimpan.
</div>

<div id="gagal" class="alert alert-danger" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Gagal!</strong> Bagian Gagal Disimpan.
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 $(document).ready(function () {
          $("#simpan").click(function () {
            var id_bagian = $('input[name=id_bagian]').val();
            var bagian = $('input[name=bagian]').val();
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bagian.php",
              data: 'crud=update&id_bagian=' + id_bagian + '&bagian=' + bagian,
              success: function (respons) {
                  if (respons='berhasil'){
                        $("#hasil").show(respons);setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $("#gagal").show(respons);setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
              }
            });
          });
      });
</script>