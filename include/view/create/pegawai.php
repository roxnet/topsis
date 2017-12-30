<?php
    $query = "SELECT max(no_pegawai) as maxKode FROM pegawai";
    $hasil = mysqli_query($db_link,$query);
    $data  = mysqli_fetch_array($hasil);
    $nopegawai = $data['maxKode'];
    $noUrut = (int) substr($nopegawai, 3, 3);
    $noUrut++;
    $char = "P-";
    $newID = $char . sprintf("%04s", $noUrut);
?>

<div class="col-sm-8 col-sm-offset-3">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">TAMBAH PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="no_pegawai">NO PEGAWAI :</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="id_pegawai" size="8" value="<?php echo $newID;?>" readonly/>
                                <input type="hidden" name="no_pegawai" autocomplete="off" value="<?php echo $newID;?>"/>
                            </div>
                        </div>
                        <div class="form-group" id="nama_group">
                            <label class="control-label col-sm-4" for="nama_pegawai">NAMA PEGAWAI :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai" >
                            </div>
                        </div>
                        <div class="form-group" id="tempat_group">
                            <label class="control-label col-sm-4" for="tempat_lahir">TEMPAT LAHIR :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" >
                            </div>
                        </div>
                        <div class="form-group" id="tgl_lhr_group">
                            <label class="control-label col-sm-4" for="tanggal_lahir">TANGGAL LAHIR :</label>
                            <div class="col-sm-3">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="jekel_group">
                            <label class="control-label col-sm-4" for="jekel">JENIS KELAMIN :</label>
                            <div class="col-sm-6 radio">
                                <label class="col-sm-4"><input type="radio" class="radio-inline" style="width:20px; height:20px;" id="jekel" name="jekel" value="L">&nbsp; Laki-laki</label>
                                <label class="col-sm-5"><input type="radio"  class="radio-inline" style="width:20px; height:20px;" id="jekel" name="jekel" value="P">&nbsp; Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group" id="agama_group">
                            <label class="control-label col-sm-4" for="agama">AGAMA :</label>
                            <div class="col-sm-4">
                                <select  class="form-control" name="agama" id="agama">  
                                    <option value="">- Pilih Agama -</option>  
                                    <option value="Islam">Islam</option>  
                                    <option value="Kristen">Kristen</option>  
                                    <option value="Katolik">Katolik</option>  
                                    <option value="Hindu">Hindu</option>  
                                    <option value="Budha">Budha</option>  
                                </select>   
                            </div>
                        </div>
                        <div class="form-group" id="status_group">
                            <label class="control-label col-sm-4" for="status">STATUS PERKAWINAN :</label>
                            <div class="col-sm-4">
                                <select  class="form-control" name="status" id="status">  
                                    <option value="">- Pilih Status Perkawinan -</option>  
                                    <option value="Kawin">Kawin</option>  
                                    <option value="Belum kawin">Belum kawin</option>  
                                    <option value="Cerai hidup">Cerai hidup</option>  
                                    <option value="Cerai mati">Cerai mati</option>  
                                </select>    
                            </div>
                        </div>
                        <div class="form-group" id="no_telp_group">
                            <label class="control-label col-sm-4" for="no_telp">NO TELPONE :</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telpone" >
                            </div>
                        </div>
                        <div class="form-group" id="alamat_group">
                            <label class="control-label col-sm-4" for="alamat">ALAMAT :</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="" id="alamat" name="alamat" placeholder="Alamat Tinggal" ></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="tgl_msk_group">
                            <label class="control-label col-sm-4" for="tanggal_masuk">TANGGAL MASUK :</label>
                            <div class="col-sm-3">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" >
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
            if (nama_pegawai=='' || nama_pegawai==null) {

                $("#nama_group").addClass("form-group has-error has-feedback");
                $("#nama_kriteria").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Nama Pegawai Tidak Boleh Kosong");
                $("#required").show();
                }
            if (tempat_lahir=='' || tempat_lahir==null) {

                $("#tempat_group").addClass("form-group has-error has-feedback");
                $("#tempat_lahir").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Tempat Lahir Tidak Boleh Kosong");
                $("#required").show();
            }
            if (tanggal_lahir=='' || tanggal_lahir==null) {

                $("#tgl_lhr_group").addClass("form-group has-error has-feedback");
                $("#tanggal_lahir").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Tanggal Lahir Tidak Boleh Kosong");
                $("#required").show();
            }
            if (jekel=='' || jekel==null) {

                $("#jekel_group").addClass("form-group has-error has-feedback");
                $("#jekel").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Jenis Kelamin Tidak Boleh Kosong");
                $("#required").show();
            }
            if (agama=='' || agama==null) {

                $("#agama_group").addClass("form-group has-error has-feedback");
                $("#agama").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Agama Tidak Boleh Kosong");
                $("#required").show();
            }
             if (status=='' || status==null) {

                $("#status_group").addClass("form-group has-error has-feedback");
                $("#status").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Status Perkawinan Tidak Boleh Kosong");
                $("#required").show();
            }
             if (no_telp=='' || no_telp==null) {

                $("#no_telp_group").addClass("form-group has-error has-feedback");
                $("#no_telp").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Nomor Telpone Tidak Boleh Kosong");
                $("#required").show();
            }
             if (alamat=='' || alamat==null) {

                $("#alamat_group").addClass("form-group has-error has-feedback");
                $("#alamat").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Alamat Pegawai Tidak Boleh Kosong");
                $("#required").show();
            }
             if (tanggal_masuk=='' || tanggal_masuk==null) {

                $("#tgl_msk_group").addClass("form-group has-error has-feedback");
                $("#tanggal_masuk").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $('#pesan_required').text("Tanggal Masuk Tidak Boleh Kosong");
                $("#required").show();
            }
            else{
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_pegawai.php",
              data: 'crud=tambah&no_pegawai=' + no_pegawai +
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
                        $('#pesan_berhasil').text("Pegawai Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Pegawai Gagal Ditambah");
                        $("#gagal").show();
                        setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
                  
              }
            });
            }
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