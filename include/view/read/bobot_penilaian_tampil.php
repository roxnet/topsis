<div class="col-sm-10 col-sm-offset-2">  
	<h2 class="text-center">DAFTAR JABATAN PEGAWAI</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
            <br/>
                    <div class="form-group col-sm-offset-4" >
                            <label class="control-label col-sm-2" for="jabatan"><h4>Jabatan : </h4></label>
                        <div class="col-sm-4">
                                <select  class="form-control" name="pilih_jabatan" id="pilih_jabatan">
                                <option> - </option>
                                <option value="all">ALL</option>
                                <option value="manager">Manager</option>
                                <option value="HRD">HRD</option>
                                <option value="koordinator">Koordinator</option>
                                <option value="karyawan">Karyawan</option>
                            </select> 
                        </div>
                    </div>
                    <br/><br/>
        <div id="hidden">
			
             </div>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" id="tambah" class="btn btn-success">TAMBAH BOBOT PENILAIAN</button>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $("#tambah").click(function () {
           		window.location.replace("index.php?navigasi=bobot_penilaian&crud=tambah");
          });
		$("#pilih_jabatan").on('change',function () {
            var pilih_jabatan= $(this).val();
           	$.ajax({
					type: "GET",
					url: "../include/view/read/bobot_penilaian_tampil2.php",

					data: 'id_jabatan='+pilih_jabatan,
					success: function (respons) {
                        $('#hidden').html(respons);
                        
                    }
               });
        });

	 });
</script>