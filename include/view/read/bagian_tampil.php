

<div class="col-sm-8 col-sm-offset-3">  
	<h2 class="text-center">DAFTAR BAGIAN</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">ID Bagian</th>
						<th class="text-center">Nama Bagian</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "select * from bagian order by id_bagian";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
								echo "<td>{$data['id_bagian']}</td>
											<td>{$data['bagian']}</td>
											<td>";
											 if($hak_akses==0 || $hak_akses==2 ){
												echo "<a class='btn btn-primary ubah' ref='".$data['id_bagian']."'>Ubah</a>
												<a class='btn btn-danger hapus' ref='".$data['id_bagian']."'>Hapus</a>&nbsp;";
											}
												
										echo"	</td>";
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
						echo '	<button type="button" id="tambah" class="btn btn-success">TAMBAH BAGIAN</button>';
							 }
						?>
						<button class="btn btn-primary hidden-print" onclick="printJS('../pdf/print_bagian.php')">
						<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>

							
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
           		window.location.replace("index.php?navigasi=bagian&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_bagian=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=bagian&crud=edit&id_bagian="+id_bagian);
		});

		$('.hapus').click(function() {
    		var id_bagian =$(this).attr('ref');
			 if (confirm('Yakin menghapus Bagian '+id_bagian+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_bagian.php",
					data: 'crud=hapus&id_bagian='+id_bagian,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Bagian Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Bagian Gagal Dihapus");
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

