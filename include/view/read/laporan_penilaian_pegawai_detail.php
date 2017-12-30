<div class="col-sm-6 col-xs-offset-4">  
	<h2 class="text-center">DETAIL PENILAIAN PEGAWAI</h2> 
	<div class="panel-group" >
		<div class="panel panel-default" style="padding:5px" >
			<?php
			include_once "../koneksi.php";
			
       $id_jabatan=$_GET['id_jabatan'];
		$sql_data="SELECT A.no_pegawai, A.nama, B.jabatan, B.id_jabatan, C.nama_toko, D.tgl_penilaian, E.bagian
				FROM pegawai A, jabatan_pegawai B, toko C, penilaian D, bagian E
				WHERE A.no_pegawai=B.id_pegawai
				AND C.id_toko=B.id_toko
				AND B.id_jabatan=D.id_jabatan
				AND E.id_bagian=B.id_bagian
				AND B.id_jabatan='".$id_jabatan."'";
		$hasil_data=mysqli_query($db_link,$sql_data);
		$data=mysqli_fetch_assoc($hasil_data);
			?>
			
			
	<div class="panel-body">
        <form class="form-horizontal">
             <div class="form-group" id="no_pegawai">
	             <label class="control-label col-sm-4" >No Pegawai : </label><?php echo $data['no_pegawai'];?>
             </div>
             <div class="form-group" id="nama_group">
                  <label class="control-label col-sm-4" for="nama_pegawai" id="nama_group">Nama Pegawai :</label><?php echo $data['nama'];?>
             </div>
             <div class="form-group" id="jabatan_group">
                   <label class="control-label col-sm-4" for="jabatan">Jabatan :</label><?php echo $data['jabatan'];?>
             </div>
             <div class="form-group" id="bagian_group">
                   <label class="control-label col-sm-4" for="bagian">Bagian :</label> <?php echo $data['bagian'];?>
             </div>
             <div class="form-group" id="toko_group">
                   <label class="control-label col-sm-4" for="nama_toko">Toko :</label><?php echo $data['nama_toko'];?>
             </div>
             <div class="form-group" id="tgl_penilaian_group">
                   <label class="control-label col-sm-4" for="tgl_penilaian">Tanggal Penilaian :</label> <?php echo $data['tgl_penilaian'];?>
             </div>
         </form>
      </div>
<?php
$sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
$hasil_kriteria=mysqli_query($db_link,$sql_kriteria);

$id_jabatan=$_GET['id_jabatan'];
$sql_penilaian="SELECT B.id_jabatan, A.nilai FROM detail_penilaian A 
				INNER JOIN penilaian C ON A.id_nilai=C.id_nilai
				INNER JOIN jabatan_pegawai B ON C.id_jabatan=B.id_jabatan
				WHERE B.id_jabatan='".$id_jabatan."'";

				
$hasil_nilai=mysqli_query($db_link,$sql_penilaian);

        echo '<table class="table table-bordered table-hover text-center panel panel-primary" >
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center col-sm-1" style="vertical-align: middle;">NO</th>
                    <th class="text-center col-sm-5" style="vertical-align: middle;">KRITERIA</th>
                    <th class="text-center col-sm-4" style="vertical-align: middle;">NILAI</th>
					
                </tr>';
				 echo '  </thead>
				<tbody> ';
		$s=1;
        $kriteriaarray=array();
            while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                echo "
                <tr>
					<td>".$s++."</td>
					<td>".$data_kriteria['nama_kriteria']."</td>";
			            
				$data_nilai=mysqli_fetch_assoc($hasil_nilai);
					echo "<td>".$data_nilai['nilai']."</td>";
					
				echo"</tr>";
            }
			
 echo "</tbody></table>";
	
?>
			<div class="panel-footer">
				<div class="text-center">	
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=laporan_penilaian_pegawai&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
				</div>

</div></div>