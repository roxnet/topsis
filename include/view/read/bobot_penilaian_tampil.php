<div class="col-sm-15 col-sm-offset-2" style="display: inline-block;">  
	<h2 class="text-center">DAFTAR BOBOT PENILAIAN</h2> 
	<div class="panel-group">
		<div class="panel panel-default" style="padding:10px">
            <div class="col-sm-3 input-group pull-right">
         <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" class="form-control" id="nama" placeholder="Search">
        <span class="input-group-btn">
        <button id="showall" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-align-justify"></i></button>
        </span>
        </div>
        <br/><br/>
    <?php   

    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
    $sql_bagian="SELECT B.id_bobot,B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian
                ORDER BY B.status DESC";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

        echo '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">STATUS</th>
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
        $a=1;

        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
            echo "<tr class='tablerow'>";
            echo "  
                <td>$a</td>
                <td>{$data_bagian['bagian']}</td>";
            $sql_jabatan="SELECT A.jabatan,A.status FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_bagian['jabatan']."'
                AND A.id_bobot='".$data_bagian['id_bobot']."'
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data A");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT D.id_bobot,D.bobot FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                INNER JOIN detail_bobot D ON A.id_bobot=D.id_bobot
                INNER JOIN kriteria B ON D.id_kriteria=B.id_kriteria
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."' 
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
                ORDER BY A.id_bobot ASC";
                $hasil = mysqli_query($db_link,$sql);
                if (!$hasil){
                        echo mysqli_error($db_link);
                die("Gagal Query Data B");
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
               if ($data_jabatan['status']==1) echo "Aktif"; else echo "Non Aktif";
        echo "</td>
                <td>";
                if($hak_akses==0 || $hak_akses==2  ){
                    echo "<a class='btn btn-primary ubah' ref='".$data_bagian['id_bobot']."' >Ubah</a>
                    <a class='btn btn-danger hapus' ref='".$data_bagian['id_bobot']."' >Hapus</a>&nbsp;";
                }
                    
               echo "</td>";
        
            echo "</tr>";
        $a++;
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
						<button class="btn btn-primary hidden-print" onclick="printJS('../pdf/print_bobot.php')">
						<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
	
						</div>
					</div>
			</div>
		</div>
	</div>
</div>


<div class="col-sm-15 col-sm-offset-2" style="display: inline-block;">  
	<h2 class="text-center">DAFTAR AKUMULASI BOBOT</h2> 
	<div class="panel-group">
		<div class="panel panel-default" style="padding:10px">
            <br/>
    <?php   

    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
     $sql_bagian="SELECT  B.id_bobot,B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian
                ORDER BY B.status DESC";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

        echo '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">STATUS</th>
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
        $no=1;
        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
            echo "<tr>";
            echo "  
                <td>$no</td>
                <td>{$data_bagian['bagian']}</td>";
           $sql_jabatan="SELECT A.jabatan,A.status FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND jabatan='".$data_bagian['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
              $sql="SELECT A.id_bobot,BB.akumulasi FROM bobot_penilaian A
                INNER JOIN detail_bobot BB on A.id_bobot=BB.id_bobot
                INNER JOIN kriteria B ON BB.id_kriteria=B.id_kriteria
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."'
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
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
                <td>".$data_jabatan['jabatan']."</td>
                <td>";
               if ($data_jabatan['status']==1) echo "Aktif"; else echo "Non Aktif";
        echo "</td>
                ";
        
            echo "</tr>";
        $no++;
        }
    echo "</tbody></table>";

?><br/><center>
						<button class="btn btn-primary hidden-print" onclick="printJS('../pdf/print_akumulasi.php')">
						<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button></center>

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
				var id_bobot=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=bobot_penilaian&crud=edit&id_bobot="+id_bobot);
		});

		$('.hapus').click(function() {
    		var id_bobot =$(this).attr('ref');
			 if (confirm('Yakin menghapus Bobot Penilaian ????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_bobot_penilaian.php",
					data: 'crud=hapus&id_bobot='+id_bobot,
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

        var $rows = $('tbody tr');
     $rows.show().filter(function() {
    $("tr:contains('Non')").hide();
     }).hide();

    $('tbody tr:visible').each(function (i) {
   $(" td:first", this).html(i+1);
    });

    $('#showall').click(function() {
    $("tr:contains('Non')").toggle();
    $('tbody tr:visible').each(function (i) {
   $(" td:first", this).html(i+1);
    });
    });

    var $rows = $('tbody tr:visible');
$('#nama').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
	 });
</script>