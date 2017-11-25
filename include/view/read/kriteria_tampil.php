


<div class="col-sm-8 col-sm-offset-3">  
	<h2 class="text-center">DAFTAR KRITERIA</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">ID Kriteria</th>
						<th class="text-center">Nama Kriteria</th>
						<th class="text-center">Atribut</th>
                        <th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "select * from kriteria order by id_kriteria";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>{$data['id_kriteria']}</td>
                                    <td>{$data['nama_kriteria']}</td>
                                    <td>{$data['atribut']}</td>
                                    <td>
                                  		<a class='btn btn-primary ubah' ref='".$data['id_kriteria']."'>Ubah</a>
										<a class='btn btn-danger hapus' ref='".$data['id_kriteria']."' nama='".$data['nama_kriteria']."'>Hapus</a>&nbsp;
                                    </td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" id="tambah" class="btn btn-success">TAMBAH KRITERIA</button>
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
           		window.location.replace("index.php?navigasi=kriteria&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_kriteria=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=kriteria&crud=edit&id_kriteria="+id_kriteria);
		});

		$('.hapus').click(function() {
    		var id_kriteria =$(this).attr('ref');
			var nama_kriteria=$(this).attr('nama');
			 if (confirm('Yakin menghapus Kriteria '+nama_kriteria+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_kriteria.php",
					data: 'crud=hapus&id_kriteria='+id_kriteria,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Kriteria Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Kriteria Gagal Dihapus");
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