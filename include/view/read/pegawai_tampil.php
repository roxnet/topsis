<div class="col-sm-8 col-sm-offset-3">  
	<h2 class="text-center">DAFTAR BAGIAN</h2> 
	<div class="panel-group">
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">No Pegawai</th>
						<th class="text-center">PAMELLA CABANG</th>
						<th class="text-center">NAMA PEGAWAI</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
						<?php /*php pembuka tabel atas*/
							$sql = "select * from pegawai  order by no_pegawai";
							$hasil	= mysqli_query($db_link,$sql);
							if (!$hasil){
							die("Gagal Query Data ");}
							
							$no=0;
							while ($data=mysqli_fetch_array($hasil)) {
								$no++;
							if ($no % 2 == 0){
								echo "<tr style='background-color:grey'>";
							}else {
								echo "<tr style='background-color:white'>";
							}

							echo "<td align='center'>{$data['no_pegawai']}</td>"
								."<td>{$data['pamella']}</td>"
								."<td>{$data['nama']}</td>"
								."<td align='center'><a href='detail_pegawai.php?no_pegawai={$data['no_pegawai']}'>&nbsp; Detail &nbsp;</td>";
							echo "</tr>";
						}
						echo '</table>';
						?>

</tbody>
			</table>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" id="tambah" class="btn btn-success">TAMBAH PEGAWAI</button>
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
      });
</script>