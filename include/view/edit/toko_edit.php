 <?php
            $id_toko=$_GET['id_toko'];
            $edit=("select * from toko where id_toko='$id_toko'");
            $hasil = mysqli_query($db_link,$edit);
            $row=mysqli_fetch_array($hasil);

?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH TOKO</h2></div>
                <div class="panel-body">
           
               <form class="form-horizontal">
                    <div class="form-group" id="nama_group">
                        <input type="hidden" name="id_toko" value="<?php echo $id_toko;?>"/>   
                        <label class="control-label col-sm-3" for="name">Nama Toko : </label>
                         <div class="col-sm-8">
                            <input class="form-control" id="nama_toko" type="text" name="nama_toko" value="<?php echo $row['nama_toko'];?>" />
                        </div>
                    </div>
                    <div class="form-group" id='alamat_toko'>  
                        <label class="control-label col-sm-3" for="alamat">Alamat Toko : </label>
                         <div class="col-sm-8">
                            <input class="form-control"  type="text" name="alamat_toko" value="<?php echo $row['alamat_toko'];?>" />
                        </div>
                    </div>
                </form>
             </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="button" id="simpan" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=toko&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 $(document).ready(function () {
          $("#simpan").click(function () {
            var id_toko = $('input[name=id_toko]').val();
            var nama_toko = $('input[name=nama_toko]').val();
            var alamat_toko = $('input[name=alamat_toko]').val();
           
            if (nama_toko=='' || nama_toko==null) {

                $("#nama_group").addClass("form-group has-error has-feedback");
                $("#nama_toko").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Nama Toko Tidak Boleh Kosong");
                  $("#required").show();
                }
               
            else{
            $.ajax({
                type: "POST",
                url: "../include/kontrol/kontrol_toko.php",
                data: 'crud=update&id_toko=' + id_toko + '&nama_toko='+nama_toko+'&alamat_toko='+alamat_toko,
                success: function (respons) {
                    if (respons=='berhasil'){
                            $('#pesan_berhasil').text("Toko Berhasil Dirubah");
                            $("#hasil").show();
                            setTimeout(function(){
                                $("#hasil").hide(); 
                            }, 2000);
                    }
                    else {
                            $('#pesan_gagal').text("Toko Gagal Dirubah");
                            $("#gagal").show();
                            setTimeout(function(){
                                $("#gagal").hide(); 
                            }, 2000);

                    }
                }
            });
            }
          });
      });
</script>
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">