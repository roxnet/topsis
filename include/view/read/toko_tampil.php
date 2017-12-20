


<div class="col-sm-8 col-sm-offset-3">  
	<h2 class="text-center">DAFTAR TOKO</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">Nama Toko</th>
						<th class="text-center">Alamat Toko</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "select * from toko order by id_toko";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>{$data['nama_toko']}</td>
                                    <td>{$data['alamat_toko']}</td>
									<td>";
									 if($hak_akses==0 || $hak_akses==2  ){
										echo "	<a class='btn btn-primary ubah' ref='".$data['id_toko']."'>Ubah</a>
										<a class='btn btn-danger hapus' ref='".$data['id_toko']."' nama='".$data['nama_toko']."'>Hapus</a>&nbsp;";
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
						 if($hak_akses==0 || $hak_akses==2  ){
							echo '<button type="button" id="tambah" class="btn btn-success">TAMBAH TOKO</button>';
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
           		window.location.replace("index.php?navigasi=toko&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_toko=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=toko&crud=edit&id_toko="+id_toko);
		});

		$('.hapus').click(function() {
    		var id_toko =$(this).attr('ref');
			var nama_toko=$(this).attr('nama');
			 if (confirm('Yakin menghapus Toko '+nama_toko+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_toko.php",
					data: 'crud=hapus&id_toko='+id_toko,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Toko Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Toko Gagal Dihapus");
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