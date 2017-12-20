<?php
$pegawai=("SELECT A.no_pegawai,A.nama from pegawai A
        LEFT JOIN user B ON A.no_pegawai=B.id_pegawai
		WHERE B.id_pegawai IS NULL ");
    $pegawai_query = mysqli_query($db_link,$pegawai);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH USER</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
						<div class="form-group" id="pegawai">
                            <label class="control-label col-sm-3" for="pegawai">No Pegawai : </label>
                            <div class="col-sm-8">
                            <select  class="form-control" name="pegawai" id="pegawai">  
                           	 	<?php
                            		while ($pegawai_tampil=mysqli_fetch_assoc($pegawai_query)){
                            			echo "<option value='".$pegawai_tampil['no_pegawai']."'>".$pegawai_tampil['no_pegawai']." - ".$pegawai_tampil['nama']."</option>";
                                	}
                            	?>
                            </select> 
                            </div>
                        </div>

												
                        <div class="form-group" id="nama_group">
                            <label class="control-label col-sm-3" for="user_name">Username :</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" require/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="password">Password :</label>
                            <div class="col-sm-8"> 
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" require/>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-sm-3" for="hak_akses">Hak Akses : </label>
                            <div class="col-sm-8">
                                 <select  class="form-control" name="hak_akses" id="hak_akses">  
                                   <option value="1">Manager</option>
                                   <option value="2">HRD</option>
                                   <option value="3">Koordinator</option>
                                   <option value="4">Karyawan</option>
                                </select> 
                            </div>
                        </div>

                    </form>
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="sumbit" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=user&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 
 $(document).ready(function () {
      
          $("#tambah").click(function () {
            var id_pegawai = $('select[name=pegawai]').val();
            var user_name = $('input[name=user_name]').val();
            var password= $('input[name=password]').val();
			var hak_akses= $('select[name=hak_akses]').val();
            if (user_name=='' || user_name==null) {

                $("#nama_group").addClass("form-group has-error has-feedback");
                $("#user_name").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Username Tidak Boleh Kosong");
                  $("#required").show();
                }
            else{
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_user.php",
              data: 'crud=tambah&id_pegawai=' +id_pegawai+ '&user_name=' + user_name + '&password=' +password+ '&hak_akses=' +hak_akses,
              success: function (respons) {
                  if (respons=='berhasil'){
                         $('#pesan_berhasil').text("User Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("User Gagal Ditambah");
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