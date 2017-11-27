 <?php
            $no_pegawai=$_GET['no_pegawai'];
            $edit=("select * from pegawai where no_pegawai='$no_pegawai'");
            $hasil = mysqli_query($db_link,$edit);
            $row=mysqli_fetch_array($hasil);
?>
<div class="col-sm-8 col-sm-offset-3">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">EDIT PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="no_pegawai">NO PEGAWAI :</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="id_pegawai" size="8" value="<?php echo $no_pegawai;?>" readonly/>
                                <input type="hidden" name="no_pegawai" autocomplete="off" value="<?php echo $no_pegawai;?>"/>
                            </div>
                        </div>
                        <div class="form-group" id="nama_group">
                            <label class="control-label col-sm-4" for="nama_pegawai">NAMA PEGAWAI :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai"  value="<?php echo $row['nama'];?>" >
                            </div>
                        </div>
                        <div class="form-group" id="tempat_group">
                            <label class="control-label col-sm-4" for="tempat_lahir">TEMPAT LAHIR :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $row['tempat_lahir'];?>">
                            </div>
                        </div>
                        <div class="form-group" id="tgl_lhr_group">
                            <label class="control-label col-sm-4" for="tanggal_lahir">TANGGAL LAHIR :</label>
                            <div class="col-sm-3">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $row['tanggal_lahir'];?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="jekel_group">
                            <label class="control-label col-sm-4" for="jekel">JENIS KELAMIN :</label>
                            <div class="col-sm-6 radio">
                                <label class="col-sm-4"><input type="radio" class="radio-inline" style="width:20px; height:20px;" id="jekel" name="jekel" value="L" <?php if($row['jekel']=='L') echo "checked='checked'";?>>&nbsp; Laki-laki</label>
                                <label class="col-sm-5"><input type="radio"  class="radio-inline" style="width:20px; height:20px;" id="jekel" name="jekel" value="P" <?php if($row['jekel']=='P') echo "checked='checked'";?>>&nbsp; Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group" id="agama_group">
                            <label class="control-label col-sm-4" for="agama">AGAMA :</label>
                            <div class="col-sm-4">
                                <select  class="form-control" name="agama" id="agama">  
                                    <option value="">- Pilih Agama -</option>  
                                    <option value="Islam" <?php if($row['agama']=='Islam') echo "selected='selected'";?>>Islam</option>  
                                    <option value="Kristen" <?php if($row['agama']=='Kristen') echo "selected='selected'";?>>Kristen</option>  
                                    <option value="Katolik" <?php if($row['agama']=='Katolik') echo "selected='selected'";?>>Katolik</option>  
                                    <option value="Hindu" <?php if($row['agama']=='Hindu') echo "selected='selected'";?>>Hindu</option>  
                                    <option value="Budha" <?php if($row['agama']=='Budha') echo "selected='selected'";?>>Budha</option>  
                                </select>   
                            </div>
                        </div>
                        <div class="form-group" id="status_group">
                            <label class="control-label col-sm-4" for="status">STATUS PERKAWINAN :</label>
                            <div class="col-sm-4">
                                <select  class="form-control" name="status" id="status">  
                                    <option value="">- Pilih Status Perkawinan -</option>  
                                    <option value="Kawin" <?php if($row['status_perkawinan']=='Kawin') echo "selected='selected'";?>>Kawin</option>  
                                    <option value="Belum kawin" <?php if($row['status_perkawinan']=='Belum kawin') echo "selected='selected'";?>>Belum kawin</option>  
                                    <option value="Cerai hidup" <?php if($row['status_perkawinan']=='Cerai hidup') echo "selected='selected'";?>>Cerai hidup</option>  
                                    <option value="Cerai mati" <?php if($row['status_perkawinan']=='Cerai mati') echo "selected='selected'";?>>Cerai mati</option>  
                                </select>    
                            </div>
                        </div>
                        <div class="form-group" id="no_telp_group">
                            <label class="control-label col-sm-4" for="no_telp">NO TELPONE :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telpone" value="<?php echo $row['no_telp'];?>">
                            </div>
                        </div>
                        <div class="form-group" id="alamat_group">
                            <label class="control-label col-sm-4" for="alamat">ALAMAT :</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="" id="alamat" name="alamat" placeholder="Alamat Tinggal"><?php echo $row['alamat'];?></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="tgl_msk_group">
                            <label class="control-label col-sm-4" for="tanggal_masuk">TANGGAL MASUK :</label>
                            <div class="col-sm-3">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $row['tgl_masuk'];?>">
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
					<button type="button" id="tambah" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=pegawai&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/moment.js"></script>
<script src="../vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
 $(document).ready(function () {
          $("#tambah").click(function () {
            var no_pegawai = $('input[name=no_pegawai]').val();
            var nama_pegawai = $('input[name=nama_pegawai]').val();
            var tempat_lahir = $('input[name=tempat_lahir]').val();
            var tanggal_lahir = $('input[name=tanggal_lahir]').val();
            var jekel = $('input[name=jekel]').val();
            var agama = $('select[name=agama]').val();
            var status = $('select[name=status]').val();
            var no_telp = $('input[name=no_telp]').val();
            var alamat = $('textarea[name=alamat]').val();
            var tanggal_masuk = $('input[name=tanggal_masuk]').val();
            
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_pegawai.php",
              data: 'crud=update&no_pegawai=' + no_pegawai +
                 '&nama_pegawai=' + nama_pegawai+
                 '&tempat_lahir='+tempat_lahir+
                 '&tanggal_lahir='+tanggal_lahir+
                 '&jekel='+jekel+
                 '&agama='+agama+
                 '&status='+status+
                 '&no_telp='+no_telp+
                 '&alamat='+alamat+
                 '&tanggal_masuk='+tanggal_masuk,
              success: function (respons) {
                  if (respons=='berhasil'){
                        $('#pesan_berhasil').text("Pegawai Berhasil Dirubah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Pegawai Gagal Dirubah");
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
