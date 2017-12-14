<?php
            $id_pegawai=$_GET['id_pegawai'];
            $edit=("select * from user where id_pegawai='$id_pegawai'");
            $hasil = mysqli_query($db_link,$edit);
            $row=mysqli_fetch_array($hasil);
			
			$pegawai=("SELECT A.no_pegawai,A.nama, B.id_pegawai from pegawai A
            LEFT JOIN jabatan_pegawai B ON A.no_pegawai=B.id_pegawai WHERE B.id_pegawai='".$id_pegawai."'");
            $pegawai_query = mysqli_query($db_link,$pegawai);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH USER</h2></div>
                <div class="panel-body">
               <form class="form-horizontal">
                    <div class="form-group">
                        <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai;?>"/>
                                
                        <label class="control-label col-sm-3" for="name">No Pegawai : </label>
                         <div class="col-sm-8">
                            <select  class="form-control" name="id_pegawai" id="id_pegawai" >  
                                    <?php
                                       while ($pegawai_tampil=mysqli_fetch_assoc($pegawai_query)){
                                           echo "<option value='".$pegawai_tampil['no_pegawai']."'";
                                           if ($row['id_pegawai']==$pegawai_tampil['no_pegawai']) echo "selected='selected'";
                                           echo ">".$pegawai_tampil['no_pegawai']." - ".$pegawai_tampil['nama']."</option>";
                                       }
                                    ?>
                                </select> 
                        </div>
					</div>
						
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="user_name">Username : </label>
                         <div class="col-sm-8">
                            <input class="form-control"  type="text" name="user_name" value="<?php echo $row['user_name'];?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password">Password : </label>
                         <div class="col-sm-8">
                            <input class="form-control"  type="text" name="password" value="<?php echo $row['password'];?>" />
                        </div>
                    </div>
										
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="hak_akses">Hak akses :</label>
                        <div class="col-sm-8"> 
                           <select  class="form-control" name="hak_akses" id="hak_akses">  
                              <option value="manager" <?php   if ($row['hak_akses']=='manager') echo "selected='selected'"; ?>>Manager</option>
                              <option value="HRD" <?php if ($row['hak_akses']=='HRD') echo "selected='selected'"; ?>>HRD</option>
                              <option value="koordinator" <?php if ($row['hak_akses']=='koordinator') echo "selected='selected'"; ?>>Koordinator</option>
                              <option value="karyawan" <?php if ($row['hak_akses']=='karyawan') echo "selected='selected'"; ?>>Karyawan</option>
                           </select> 
                        </div>
                    </div>
                </form>
             </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="button" id="simpan" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=user&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 $(document).ready(function () {
          $("#simpan").click(function () {
            var id_pegawai= $('select[name=id_pegawai]').val();
			var user_name = $('input[name=user_name]').val();
            var password = $('input[name=password]').val();
            var hak_akses= $('select[name=hak_akses]').val();
           
            $.ajax({
                type: "POST",
                url: "../include/kontrol/kontrol_user.php",
                data: 'crud=update&user_name='+user_name+'&password='+password+'&hak_akses='+hak_akses+'&id_pegawai=' + id_pegawai,
                success: function (respons) {
                    if (respons=='berhasil'){
                            $('#pesan_berhasil').text("User Berhasil Dirubah");
                            $("#hasil").show();
                            setTimeout(function(){
                                $("#hasil").hide(); 
                            }, 2000);
                    }
                    else {
                            $('#pesan_gagal').text("User Gagal Dirubah");
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