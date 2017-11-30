 <?php
    $kriteria=("SELECT id_kriteria,nama_kriteria FROM kriteria");
    $kriteria_query = mysqli_query($db_link,$kriteria);
   
            
?>


<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH JABATAN PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group" id="pegawai">
                            <label class="control-label col-sm-4" for="kriteria">Nama Kriteria : </label>
                            <div class="col-sm-6">
                                 <select  class="form-control" name="kriteria" id="kriteria">  
                                    <?php
                                       while ($kriteria_tampil=mysqli_fetch_assoc($kriteria_query)){
                                           echo "<option value='".$kriteria_tampil['id_kriteria']."'>".$kriteria_tampil['nama_kriteria']."</option>";
                                       }
                                    ?>
                                </select> 
                            </div>
                        </div>
                   
                    <div class="form-group">
                            <label class="control-label col-sm-4" for="jabatan">Jabatan : </label>
                            <div class="col-sm-6">
                                 <select  class="form-control" name="jabatan" id="jabatan">  
                                   <option value="manager">Manager</option>
                                   <option value="HRD">HRD</option>
                                   <option value="koordinator">Koordinator</option>
                                   <option value="karyawan">Karyawan</option>
                                </select> 
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="control-label col-sm-4" for="tgl_jabat">Bobot :</label>
                            <div class="col-sm-6">
                                    <input type="text" class="form-control" id="bobot" name="bobot" placeholder="BOBOT PENILAIAN" >
                            </div>
                        </div>
               
                    <div class="form-group">
                            <label class="control-label col-sm-4" for="status">Status : </label>
                            <div class="col-sm-6">
                                 <select  class="form-control" name="status" id="status">  
                                   <option value="1">Aktif</option>
                                   <option value="0">Tidak Aktif</option>
                                </select> 
                            </div>
                    </div>
                   </form>   
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="sumbit" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=bobot_penilaian&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 
 $(document).ready(function () {
      
          $("#tambah").click(function () {
            var kriteria = $('select[name=kriteria]').val();
            var jabatan= $('select[name=jabatan]').val();
            var bobot= $('input[name=bobot]').val();
            var status= $('select[name=status]').val();
            
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bobot_penilaian.php",
              data: 'crud=tambah&kriteria=' +kriteria+
                    '&jabatan='+jabatan+
                    '&status='+status+
                    '&bobot='+bobot,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Bobot Penilaian Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Bobot Penilaian Gagal Ditambah");
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