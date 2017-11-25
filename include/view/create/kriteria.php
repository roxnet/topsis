
<?php
$query = "SELECT max(id_kriteria) as maxKode FROM kriteria";
$hasil = mysqli_query($db_link,$query);
$data  = mysqli_fetch_array($hasil);
$kodeBarang = $data['maxKode'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "K-";
$newID = $char . sprintf("%04s", $noUrut);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH KRITERIA</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group" >
                            <label class="control-label col-sm-3" for="id_kriteria">ID Kriteria :</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_kriteria" name="id_kriteria" placeholder="Id Kriteria" value="<?php echo $newID;?>" readonly/>
                            </div>
                        </div>
                        <div class="form-group" id="id_group">
                            <label class="control-label col-sm-3" for="nama_kriteria">Nama Kriteria :</label>
                            <div class="col-sm-8"> 
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama Kriteria"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="atribut">Atribut :</label>
                            <div class="col-sm-8"> 
                            <select  class="form-control" id="atribut" name="atribut">
                                <option value="">- Pilih Atribut -</option>  
 			                    <option value="K">Keuntungan</option>  
			                    <option value="B">Biaya</option>
                            </select>
                            </div>
                        </div>
                    </form>
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="sumbit" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=kriteria&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>

 $(document).ready(function () {
      
          $("#tambah").click(function () {
             var id_kriteria = $('input[name=id_kriteria]').val();
            var nama_kriteria = $('input[name=nama_kriteria]').val();
            var atribut= $('select[name=atribut]').val();
            if (nama_kriteria=='' || nama_kriteria==null) {

                $("#id_group").addClass("form-group has-error has-feedback");
                $("#nama_kriteria").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Nama Kriteria Tidak Boleh Kosong");
                  $("#required").show();
                }
            else{
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_kriteria.php",
              data: 'crud=tambah&id_kriteria='+id_kriteria+'&nama_kriteria=' + nama_kriteria + '&atribut=' +atribut,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Kriteria Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Kriteria Gagal Ditambah");
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