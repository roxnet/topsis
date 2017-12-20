<div class="col-sm-10 col-sm-offset-2">  
	<h2 class="text-center">DAFTAR JABATAN PEGAWAI</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">NO PEGAWAI</th>
						<th class="text-center">NAMA PEGAWAI</th>
						<th class="text-center">TOKO</th>
						<th class="text-center">BAGIAN</th>
						<th class="text-center">JABATAN</th>
						<th class="text-center">MULAI TUGAS</th>
						<th class="text-center">AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "SELECT A.id_jabatan,B.no_pegawai,B.nama,C.nama_toko,D.bagian,A.jabatan,A.tgl_jabat
                                    FROM jabatan_pegawai A
                                    INNER JOIN pegawai B ON A.id_pegawai=B.no_pegawai
                                    INNER JOIN toko C ON A.id_toko=C.id_toko
                                    INNER JOIN bagian D ON A.id_bagian=D.id_bagian 
                                    WHERE A.Status=1 ORDER BY B.no_pegawai";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>{$data['no_pegawai']}</td>
                                    <td>{$data['nama']}</td>
									<td>".$data['nama_toko']."</td>
									<td>{$data['bagian']}</td>
									<td>";
									echo ucwords($data['jabatan']); 
									echo "</td>
									<td>{$data['tgl_jabat']}</td>
									<td>";
									 if($hak_akses==0 || $hak_akses==2){
										echo "<a class='btn btn-primary ubah' ref='".$data['id_jabatan']."'>Ubah</a>
										<a class='btn btn-danger hapus' ref='".$data['id_jabatan']."' nama='".$data['nama']."'>Hapus</a>&nbsp;";
									}
                                  		
                                   echo" </td>";
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
						 if($hak_akses==0 || $hak_akses==2  ){
							echo '<button type="button" id="tambah" class="btn btn-success">TAMBAH JABATAN PEGAWAI</button>';
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
           		window.location.replace("index.php?navigasi=jabatan_pegawai&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_jabatan=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=jabatan_pegawai&crud=edit&id_jabatan="+id_jabatan);
		});

		$('.hapus').click(function() {
    		var id_jabatan =$(this).attr('ref');
			var nama=$(this).attr('nama');
			 if (confirm('Yakin menghapus Jabatan Pegawai '+nama+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_jabatan_pegawai.php",
					data: 'crud=hapus&id_jabatan='+id_jabatan,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Jabatan Pegawai Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Jabatan Pegawai Gagal Dihapus");
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