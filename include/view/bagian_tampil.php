


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
											<td>
											
												<a class='btn btn-primary' href='index.php?navigasi=bagian&crud=edit&id_bagian={$data['id_bagian']}'>Ubah</a>
													<a class='btn btn-danger' id='hapus' href='index.php?navigasi=bagian&crud=hapus&id_bagian={$data['id_bagian']}' 
												onclick='return confirm(\"Yakin menghapus Bagian {$data['bagian']}????\");'>Hapus</a>&nbsp;
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
							<button type="button" id="tambah" class="btn btn-success">TAMBAH BAGIAN</button>
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
      });
</script>