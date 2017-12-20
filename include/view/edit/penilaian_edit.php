 <?php
 $get_user_cek=mysqli_query ($db_link,"SELECT id_toko FROM jabatan_pegawai A
                            INNER JOIN user B ON A.no_pegawai=B.id_pegawai
                            WHERE B.user_name='".$username."' ");
$get_toko_user=mysqli_fetch_assoc($get_user_cek);

   $id_jabatan=$_GET['id_jabatan'];
    $kriteria=("SELECT C.id_bobot,D.nama_kriteria FROM bagian A
                INNER JOIN jabatan_pegawai B ON A.id_bagian=B.id_bagian
                INNER JOIN bobot_penilaian C ON A.id_bagian=C.id_bagian AND B.jabatan=C.jabatan
                INNER JOIN kriteria D ON C.id_kriteria=D.id_kriteria 
                WHERE B.id_jabatan='".$id_jabatan."'");
    $kriteria_query = mysqli_query($db_link,$kriteria);

    $sql_pegawai="SELECT B.id_jabatan,A.nama,C.tgl_penilaian FROM pegawai A
                INNER JOIN jabatan_pegawai B ON A.no_pegawai=B.id_pegawai
                INNER JOIN penilaian C ON B.id_jabatan=C.id_jabatan 
                WHERE  C.id_jabatan=$id_jabatan AND B.id_toko=CASE WHEN $hak_akses==3 THEN '".$get_toko_user['id_toko']."'
                ELSE B.id_toko END
                ORDER BY A.no_pegawai";
$hasil_pegawai=mysqli_query($db_link,$sql_pegawai);      
  $pegawai_tampil=mysqli_fetch_assoc($hasil_pegawai);
  $sql_tgl=mysqli_query($db_link,"SELECT DISTINCT tgl_penilaian FROM penilaian WHERE id_jabatan=$id_jabatan");
  $tampil_tgl=mysqli_fetch_assoc($sql_tgl);
?>


<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH PENILAIAN PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="jabatan">Nama Pegawai : </label>
                        <div class="col-sm-6">
                            <?php
                                
                                    echo "
                                    <input type=hidden name='id_jabatan' value='".$pegawai_tampil['id_jabatan']."'>
                                    <input type=text class='form-control' value='".$pegawai_tampil['nama']."' readonly>";
                                
                            ?> 
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-4" for="penilaian">Kriteria Penilaian :</label>
                    </div>
                    <?php
                        $b=1;

                        while ($kriteria_tampil=mysqli_fetch_assoc($kriteria_query)){
                             $edit_bobot=("SELECT B.id_bobot,nilai from penilaian A
                             INNER JOIN bobot_penilaian B ON A.id_bobot=B.id_bobot
                             INNER JOIN jabatan_pegawai C ON B.id_bagian=C.id_bagian AND A.id_jabatan=C.id_jabatan
                                 where A.id_jabatan='$id_jabatan'
                                AND B.id_bobot='".$kriteria_tampil['id_bobot']."'");
                                $hasil_bobot = mysqli_query($db_link,$edit_bobot);
                                $row_bobot=mysqli_fetch_assoc($hasil_bobot);
                            echo '
                             <div class="form-group">
                            <label class="control-label col-sm-4 col-sm-offset-1" for="bobot">'.$kriteria_tampil["nama_kriteria"].' : </label>
                            <div class="col-sm-3">
                                    <input type="hidden" class="form-control" id="bobot" name="bobot'.$b.'" value="'.$row_bobot["id_bobot"].'" >
                                    <input type="text" class="form-control" id="bobot" name="penilaian'.$b.'" placeholder="PENILAIAN" value="'.$row_bobot['nilai'].'" >
                            </div>
                            </div>   ';
                        $b++;
                        }
                        
                       
                    ?>
                     <div class="form-group">
                            <label class="control-label col-sm-4" for="tgl_penilain">Tanggal Penilaian :</label>
                            <div class="col-sm-6">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="tgl_penilain" name="tgl_penilaian" placeholder="Tanggal Penilaian" value="<?php echo $tampil_tgl['tgl_penilaian']; ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                   </form>   
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="sumbit" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=penilaian&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 
 $(document).ready(function () {
        var penilaiancount=<?php echo $b; ?>;
            penilaiancount=penilaiancount-1;
          $("#tambah").click(function () {
            var jabatan= $('input[name=id_jabatan]').val();
            var tgl_penilaian=$('input[name=tgl_penilaian]').val();
            var count=1;
            var penilaian=[];
            var penilaianstring='';
            var bobot=[];
            var bobotstring='';
        while (count<=penilaiancount){
            bobot[count]=$('input[name=bobot'+count+']').val();
            bobotstring=bobotstring+'&bobot'+count+'='+bobot[count];

            penilaian[count]=$('input[name=penilaian'+count+']').val();
            penilaianstring=penilaianstring+'&nilai'+count+'='+penilaian[count];
            count++;
        }
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_penilaian.php",
              data: 'crud=update&count='+penilaiancount+
                    '&tgl_nilai=' +tgl_penilaian+
                    '&jabatan='+jabatan+
                    bobotstring+penilaianstring,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Penilaian Pegawai Berhasil Dirubah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Penilaian Pegawai Gagal Dirubah");
                        $("#gagal").show();
                        setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
              }
              
            });
          });
          $(function () {
                $('.datetimepicker1').datetimepicker({
                viewMode: 'years',
                format: 'DD/MM/YYYY'
            }
                );
            });
      });
      
</script>