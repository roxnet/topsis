<div class="col-sm-10 col-sm-offset-2">  
	<h2 class="text-center">DAFTAR PEGAWAI</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">NO PEGAWAI</th>
						<th class="text-center">NAMA PEGAWAI</th>
						<th class="text-center">JENIS KELAMIN</th>
						<th class="text-center">AGAMA</th>
						<th class="text-center">STATUS PERKAWINAN</th>
						<th class="text-center">TANGGAL MASUK</th>
						<th class="text-center">AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "SELECT no_pegawai,nama,jekel,agama,status_perkawinan,tgl_masuk FROM pegawai ORDER BY no_pegawai";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>{$data['no_pegawai']}</td>
                                    <td>{$data['nama']}</td>
									<td>";
									if ($data['jekel']=='L') {echo 'LAKI-LAKI'; }
									ELSE echo 'PEREMPUAN';
							echo "</td>
									<td>{$data['agama']}</td>
									<td>{$data['status_perkawinan']}</td>
									<td>{$data['tgl_masuk']}</td>
									<td>
										<a class='btn btn-info detail' ref='".$data['no_pegawai']."'>Detail</a>";
							 if($hak_akses==0 || $hak_akses==2  ){
										echo "<a class='btn btn-primary ubah' ref='".$data['no_pegawai']."'>Ubah</a>
										<a class='btn btn-danger hapus' ref='".$data['no_pegawai']."' nama='".$data['nama']."'>Hapus</a>&nbsp;";
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
						<?php
						 if($hak_akses==0 || $hak_akses==2 ){
							echo '<button type="button" id="tambah" class="btn btn-success">TAMBAH PEGAWAI</button>';
						}
						?>
							
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
           		window.location.replace("index.php?navigasi=pegawai&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var no_pegawai=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=pegawai&crud=edit&no_pegawai="+no_pegawai);
		});

		$('.hapus').click(function() {
    		var no_pegawai =$(this).attr('ref');
			var nama=$(this).attr('nama');
			 if (confirm('Yakin menghapus Pegawai '+nama+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_pegawai.php",
					data: 'crud=hapus&no_pegawai='+no_pegawai,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Pegawai Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Pegawai Gagal Dihapus");
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
		$(".detail").click(function () {
			var no_pegawai=$(this).attr('ref');
			window.location.replace("index.php?navigasi=pegawai&crud=detail&no_pegawai="+no_pegawai);
		});
	 });
</script>