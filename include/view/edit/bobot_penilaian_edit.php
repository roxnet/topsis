 <?php
    $kriteria=("SELECT id_kriteria,nama_kriteria FROM kriteria");
    $kriteria_query = mysqli_query($db_link,$kriteria);
    
    $id_bagian=$_GET['id_bagian'];
    $jabatan=$_GET['jabatan'];
     $edit=("select * from bobot_penilaian where id_bagian='$id_bagian' AND jabatan='".$jabatan."' ");
        $hasil = mysqli_query($db_link,$edit);
        $row=mysqli_fetch_assoc($hasil);

?>


<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH BOBOT PENILAIAN</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                   
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
                        <label class="control-label col-sm-4" for="tgl_jabat">Bobot Kriteria :</label>
                    </div>
                    <?php
                        $b=1;

                        while ($kriteria_tampil=mysqli_fetch_assoc($kriteria_query)){
                             $edit_bobot=("select id_kriteria,bobot from bobot_penilaian where id_bagian='$id_bagian'
                                AND id_kriteria='".$kriteria_tampil['id_kriteria']."'
                                AND jabatan='".$jabatan."'");
                                $hasil_bobot = mysqli_query($db_link,$edit_bobot);
                                $row_bobot=mysqli_fetch_assoc($hasil_bobot);
                            echo '
                             <div class="form-group">
                            <label class="control-label col-sm-4 col-sm-offset-1" for="bobot">'.$kriteria_tampil["nama_kriteria"].' : </label>
                            <div class="col-sm-3">
                                    <input type="hidden" class="form-control" id="bobot" name="kriteria'.$b.'" value="'.$row_bobot["id_kriteria"].'" >
                                    <input type="text" class="form-control" id="bobot" name="bobot'.$b.'" placeholder="BOBOT" value="'.$row_bobot['bobot'].'" >
                            </div>
                            </div>   ';
                        $b++;
                        }
                    ?>
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
        var bobotcount=<?php echo $b; ?>;
            bobotcount=bobotcount-1;
          $("#tambah").click(function () {
            var bagian ='<?php echo $id_bagian; ?>';
            var jabatan= $('select[name=jabatan]').val();
            var count=1;
            var bobot=[];
            var bobotstring='';
            var kriteria=[];
            var kriteriastring='';
        while (count<=bobotcount){
            bobot[count]=$('input[name=bobot'+count+']').val();
            bobotstring=bobotstring+'&bobot'+count+'='+bobot[count];

            kriteria[count]=$('input[name=kriteria'+count+']').val();
            kriteriastring=kriteriastring+'&kriteria'+count+'='+kriteria[count];
            count++;
        }
            
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bobot_penilaian.php",
              data: 'crud=update&count='+bobotcount+
                    '&bagian=' +bagian+
                    '&jabatan='+jabatan+
                    bobotstring+kriteriastring,
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