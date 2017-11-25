 <?php
            $id_bagian=$_GET['id_bagian'];
            $edit=("select * from bagian where id_bagian='$id_bagian'");
            $hasil = mysqli_query($db_link,$edit);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH BAGIAN</h2></div>
                <div class="panel-body">
           
               <form class="form-horizontal">
                    <div class="form-group">
                        <?php
                            $row=mysqli_fetch_array($hasil);
                        ?>
                        <input type="hidden" name="id_bagian" value="<?php echo $id_bagian;?>"/>
                                
                        <label class="control-label col-sm-3" for="name">Nama Bagian : </label>
                         <div class="col-sm-8">
                            <input class="form-control"  type="text" name="bagian" value="<?php echo $row['bagian'];?>" />
                        </div>
                    </div>
                        
                </form>
             </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="button" id="simpan" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=bagian&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
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
                  if (respons=='berhasil'){
                        $('#pesan_berhasil').text("Bagian Berhasil Dirubah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Bagian Gagal Dirubah");
                        $("#gagal").show();
                        setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
              }
            });
          });
      });
</script>