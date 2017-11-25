<?php
    $query = "SELECT max(id_bagian) as maxKode FROM bagian";
    $hasil = mysqli_query($db_link,$query);
    $data  = mysqli_fetch_array($hasil);
    $kodeBarang = $data['maxKode'];
    $noUrut = (int) substr($kodeBarang, 3, 3);
    $noUrut++;
    $char = "B-";
    $newID = $char . sprintf("%04s", $noUrut);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH BAGIAN</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">ID BAGIAN :</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="id_bagian" disabled autocomplete="off" size="8" value="<?php echo $newID;?>"/>
                                <input type="hidden" name="id_bagian" autocomplete="off" value="<?php echo $newID;?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="bagian">BAGIAN :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_bagian" placeholder="Nama Bagian" required>
                            </div>
                        </div>
                    </form>
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="button" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=bagian&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="../vendor/jquery/jquery.min.js"></script>

<script>
 $(document).ready(function () {
          $("#tambah").click(function () {
            var id_bagian = $('input[name=id_bagian]').val();
            var bagian = $('input[name=bagian]').val();
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bagian.php",
              data: 'crud=tambah&id_bagian=' + id_bagian + '&bagian=' + bagian,
              success: function (respons) {
                  if (respons=='berhasil'){
                        $('#pesan_berhasil').text("Bagian Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Bagian Gagal Ditambah");
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