 <?php

$get_user_cek=mysqli_query ($db_link,"SELECT A.id_toko,A.id_bagian FROM jabatan_pegawai A
                            INNER JOIN pegawai B ON A.id_pegawai=B.no_pegawai
                            INNER JOIN user c ON B.no_pegawai=c.id_pegawai
                            WHERE c.user_name=CASE WHEN $hak_akses=3 
                THEN '".$username."' ELSE c.user_name END ");
$get_toko_user=mysqli_fetch_assoc($get_user_cek);
   
    $sql_pegawai="SELECT B.id_jabatan,A.nama,D.bagian,C.nama_toko FROM pegawai A
                INNER JOIN jabatan_pegawai B ON A.no_pegawai=B.id_pegawai 
                INNER JOIN toko C ON B.id_toko=C.id_toko
                INNER JOIN bagian D ON B.id_bagian=D.id_bagian
                WHERE B.id_toko=CASE WHEN $hak_akses=3 THEN '".$get_toko_user['id_toko']."'
                ELSE B.id_toko END AND
                B.id_bagian=CASE WHEN $hak_akses=3 THEN '".$get_toko_user['id_bagian']."'
                ELSE B.id_bagian END
                ORDER BY A.no_pegawai";
$hasil_pegawai=mysqli_query($db_link,$sql_pegawai);

$b=0;        
?>


<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH PENILAIAN PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="jabatan">Nama Pegawai : </label>
                        <div class="col-sm-6">
                            <select  class="form-control" name="jabatan" id="jabatan">  
                                <option>-</option>
                            <?php
                                while ($pegawai_tampil=mysqli_fetch_assoc($hasil_pegawai)){
                                    echo "<option value='".$pegawai_tampil['id_jabatan']."'>".$pegawai_tampil['nama']." - ".$pegawai_tampil['nama_toko']." - ".$pegawai_tampil['bagian']."</option>";
                                }
                            ?>
                        </select> 
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-5" for="penilaian">Kriteria Penilaian :</label>
                    </div>
                        <div id="kriteria">
                        </div>
                     <div class="form-group">
                        <label class="control-label col-sm-5" for="tgl_penilaian">Tanggal Penilaian :</label>
                        <div class="col-sm-6">
                        <div class="input-group date datetimepicker1">
                            <input type="text" class="form-control" id="tgl_penilaian" name="tgl_penilaian" placeholder="Tanggal Penilaian" >
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
        $("#jabatan").click(function () {
            var jabatan= $(this).val();

           	$.ajax({
					type: "GET",
					url: "../include/view/create/penilaian2.php",

					data: 'id_jabatan='+jabatan,
					success: function (respons) {
                        $('#kriteria').html(respons);
                        
                    }
               });
        });
          $("#tambah").click(function () {
            
            var jabatan= $('select[name=jabatan]').val();
            var tgl_penilaian=$('input[name=tgl_penilaian]').val();
          penilaiancount=penilaiancount-1;
    var count=1;
            var penilaian=[];
            var penilaianstring='';
            var bobot=[];
            var bobotstring='';
			if ($('input[name=penilaian1]').val() < 0 ) {
                $("#id_group").addClass("form-group has-error has-feedback");
                $("#nama_kriteria").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Nilai Tidak Boleh Minus");
                $("#required").show();
             }

			
        while (count<=penilaiancount){
            bobot[count]=$('input[name=bobot'+count+']').val();
            penilaian[count]=$('input[name=penilaian'+count+']').val();
            bobotstring=bobotstring+'&bobot'+count+'='+bobot[count];
            penilaianstring=penilaianstring+'&nilai'+count+'='+penilaian[count];
            count++;
        }
            console.log(jabatan);
            console.log(tgl_penilaian);
            console.log(bobotstring);
            console.log(penilaianstring);
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_penilaian.php",
              data: 'crud=tambah&count='+penilaiancount+
                    '&tgl_nilai=' +tgl_penilaian+
                    '&jabatan='+jabatan+
                    bobotstring+penilaianstring,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Penilaian Pegawai Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Penilaian Pegawai Gagal Ditambah");
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
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">