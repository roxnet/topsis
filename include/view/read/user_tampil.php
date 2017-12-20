<div class="col-sm-8 col-sm-offset-3">  
	<h2 class="text-center">DAFTAR USER</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">No Pegawai</th>
						<th class="text-center">Username</th>
						<th class="text-center">Password</th>
						<th class="text-center">Hak Akses</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "select * from user order by id_pegawai";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>{$data['id_pegawai']}</td>
									<td>{$data['user_name']}</td>
                                    <td>{$data['password']}</td>
									<td>";
									if($data['hak_akses']==0){
										echo "Admin";
									}
									else if($data['hak_akses']==1){
										echo "Manager";
									}
									else if($data['hak_akses']==2){
										echo "HRD";
									}
									else if($data['hak_akses']==3){
										echo "Koordinator";
									}
									else if($data['hak_akses']==4){
										echo "Pegawai";
									}
									echo "</td>
									<td>
										  <a class='btn btn-primary ubah' ref='".$data['id_pegawai']."'>Ubah</a>&nbsp;";
									if ($data['hak_akses']<>0){
										echo "<a class='btn btn-danger hapus' ref='".$data['id_pegawai']."' nama='".$data['id_pegawai']."'>Hapus</a>";
									}
                                    echo "</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" id="tambah" class="btn btn-success">TAMBAH USER</button>
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
           		window.location.replace("index.php?navigasi=user&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_pegawai=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=user&crud=edit&id_pegawai="+id_pegawai);
		});

		$('.hapus').click(function() {
    		var id_pegawai =$(this).attr('ref');
			var nama=$(this).attr('nama');
			 if (confirm('Yakin menghapus User '+id_pegawai+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_user.php",
					data: 'crud=hapus&id_pegawai='+id_pegawai,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("User Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("User Gagal Dihapus");
								$("#gagal").show();
								setTimeout(function(){
									$("#gagal").hide(); 
									window.location.reload(1);
								}, 2000);
							
						}
					}
					});
			 }
			
		});
		 
	 });
</script>