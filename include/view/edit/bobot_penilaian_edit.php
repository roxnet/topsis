 <?php
    $kriteria=("SELECT id_kriteria,nama_kriteria FROM kriteria");
    $kriteria_query = mysqli_query($db_link,$kriteria);
    $id_bobot=$_GET['id_bobot'];
     $edit=("select * from bobot_penilaian where id_bobot='$id_bobot'");
            $hasil = mysqli_query($db_link,$edit);
            $row=mysqli_fetch_array($hasil);
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
                                <input type="hidden" name="id_bobot" value="<?php echo $id_bobot;?>"/>
                                 <select  class="form-control" name="kriteria" id="kriteria">  
                                    <?php
                                       while ($kriteria_tampil=mysqli_fetch_assoc($kriteria_query)){
                                           echo "<option value='".$kriteria_tampil['id_kriteria']."'";
                                           if ($row['id_kriteria']==$kriteria_tampil['id_kriteria']) echo "selected='selected'";
                                           echo ">".$kriteria_tampil['nama_kriteria']."</option>";
                                       }
                                    ?>
                                </select> 
                            </div>
                        </div>
                   
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="jabatan">Jabatan : </label>
                        <div class="col-sm-6">
                                <select  class="form-control" name="jabatan" id="jabatan">  
                                <option value="manager" <?php   if ($row['jabatan']=='manager') echo "selected='selected'"; ?>>Manager</option>
                                <option value="HRD" <?php if ($row['jabatan']=='HRD') echo "selected='selected'"; ?>>HRD</option>
                                <option value="koordinator" <?php if ($row['jabatan']=='koordinator') echo "selected='selected'"; ?>>Koordinator</option>
                                <option value="karyawan" <?php if ($row['jabatan']=='karyawan') echo "selected='selected'"; ?>>Karyawan</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-4" for="tgl_jabat">Bobot :</label>
                            <div class="col-sm-6">
                                    <input type="text" class="form-control" id="bobot" name="bobot" value="<?php echo $row['bobot']; ?>" >
                            </div>
                        </div>
               
                     <div class="form-group">
                            <label class="control-label col-sm-4" for="status">Status : </label>
                            <div class="col-sm-6">
                                 <select  class="form-control" name="status" id="status">  
                                   <option value="1"  <?php   if ($row['status']==1) echo "selected='selected'"; ?>>Aktif</option>
                                   <option value="0"  <?php   if ($row['status']==0) echo "selected='selected'"; ?>>Tidak Aktif</option>
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
            var id_bobot=$('input[name=id_bobot]').val();
            var kriteria = $('select[name=kriteria]').val();
            var jabatan= $('select[name=jabatan]').val();
            var bobot= $('input[name=bobot]').val();
            var status= $('select[name=status]').val();
            
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bobot_penilaian.php",
              data: 'crud=update&id_bobot='+id_bobot+
                    '&kriteria=' +kriteria+
                    '&jabatan='+jabatan+
                    '&status='+status+
                    '&bobot='+bobot,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Bobot Penilaian Berhasil Dirubah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Bobot Penilaian Gagal Dirubah");
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