<div class="col-sm-10 col-sm-offset-2" style="display: inline-block;">  
	<h2 class="text-center">DAFTAR BOBOT PENILAIAN</h2> 
	<div class="panel-group">
		<div class="panel panel-default" style="padding:10px">
            <br/>
    <?php   

    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
    $sql_bagian="SELECT DISTINCT B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

        echo '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">AKSI</th>
                </tr>
                <tr>';

                $kriteriaarray=array();
                    while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                        $kriteriaarray[]=''.$data_kriteria['id_kriteria'].'';
                        echo "
                        <th>".$data_kriteria['nama_kriteria']."</th>
                        ";
                    }
                echo '</tr>
                </thead>
                <tbody> ';
        $s=1;

        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                <td>{$data_bagian['bagian']}</td>";
            $sql_jabatan="SELECT A.jabatan FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND jabatan='".$data_bagian['jabatan']."'
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT A.id_bobot,A.bobot FROM bobot_penilaian A
                INNER JOIN kriteria B ON A.id_kriteria=B.id_kriteria
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."'
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                ORDER BY A.id_bobot ASC";
                $hasil = mysqli_query($db_link,$sql);
                if (!$hasil){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $cek=mysqli_num_rows($hasil);
                if($cek==0){
                    echo "<td></td>";
                    }
                else {
                    $data=mysqli_fetch_assoc($hasil);
                    echo "<td>".$data['bobot']."</td>";
                }
                $d++;
            }
         echo  "
                <td>".$data_jabatan['jabatan']."</td>
                <td>";
                if($hak_akses==0 || $hak_akses==2  ){
                    echo "<a class='btn btn-primary ubah' ref='".$data_bagian['id_bagian']."' def='".$data_jabatan['jabatan']."'>Ubah</a>
                    <a class='btn btn-danger hapus' ref='".$data_bagian['id_bagian']."'  def='".$data_jabatan['jabatan']."'>Hapus</a>&nbsp;";
                }
                    
               echo "</td>";
        
            echo "</tr>";
        $s++;
        }
    echo "</tbody></table>";

?>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
                        <?php
                        if($hak_akses==0 || $hak_akses==2  ){
                            echo '<button type="button" id="tambah" class="btn btn-success">TAMBAH BOBOT PENILAIAN</button>';
                        }
                        ?>
							
						</div>
					</div>
			</div>
		</div>
	</div>
</div>


<div class="col-sm-10 col-sm-offset-2" style="display: inline-block;">  
	<h2 class="text-center">DAFTAR AKUMULASI BOBOT</h2> 
	<div class="panel-group">
		<div class="panel panel-default" style="padding:10px">
            <br/>
    <?php   

    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
     $sql_bagian="SELECT DISTINCT B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

        echo '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                </tr>
                <tr>';

                $kriteriaarray=array();
                    while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                        $kriteriaarray[]=''.$data_kriteria['id_kriteria'].'';
                        echo "
                        <th>".$data_kriteria['nama_kriteria']."</th>
                        ";
                    }
                echo '</tr>
                </thead>
                <tbody> ';
        $s=1;

        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                <td>{$data_bagian['bagian']}</td>";
           $sql_jabatan="SELECT A.jabatan FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND jabatan='".$data_bagian['jabatan']."'
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
              $sql="SELECT A.id_bobot,A.akumulasi FROM bobot_penilaian A
                INNER JOIN kriteria B ON A.id_kriteria=B.id_kriteria
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."'
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                ORDER BY A.id_bobot ASC";
                $hasil = mysqli_query($db_link,$sql);
                if (!$hasil){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $cek=mysqli_num_rows($hasil);
                if($cek==0){
                    echo "<td></td>";
                    }
                else {
                    $data=mysqli_fetch_assoc($hasil);
                    echo "<td>".$data['akumulasi']."</td>";
                }
                $d++;
            }
         echo  "
                <td>".$data_jabatan['jabatan']."</td>";
        
            echo "</tr>";
        $s++;
        }
    echo "</tbody></table>";

?>
		</div>
	</div>
</div>


<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $("#tambah").click(function () {
           		window.location.replace("index.php?navigasi=bobot_penilaian&crud=tambah");
          });
		
        $('.ubah').click(function() {
				var id_bagian=$(this).attr('ref');
                var jabatan=$(this).attr('def');
			 window.location.replace("index.php?navigasi=bobot_penilaian&crud=edit&id_bagian="+id_bagian+"&jabatan="+jabatan);
		});

		$('.hapus').click(function() {
    		var id_bagian =$(this).attr('ref');
             var jabatan=$(this).attr('def');
			 if (confirm('Yakin menghapus Bobot Penilaian ????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_bobot_penilaian.php",
					data: 'crud=hapus&id_bagian='+id_bagian+"&jabatan="+jabatan,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Bobot Penilaian Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Bobot Penilaian Gagal Dihapus");
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