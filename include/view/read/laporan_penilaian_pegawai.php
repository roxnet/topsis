 

<div class="col-sm-12 col-xs-offset-2">  
 
	<h2 class="text-center">LAPORAN PENILAIAN PEGAWAI</h2> 
	<div class="panel-group" >
		<div class="panel panel-default" style="padding:10px" >
            <br/>

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

$sql_penilaian="SELECT DISTINCT C.nama,B.id_jabatan,A.status FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai
                WHERE A.status=1
                ORDER BY C.nama,A.status DESC";
$hasil_penilaian=mysqli_query($db_link,$sql_penilaian);
        echo '<table class="table table-bordered table-hover text-center panel panel-primary" >
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NAMA PEGAWAI</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
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
        $s=1;

        while ($data_penilaian=mysqli_fetch_assoc($hasil_penilaian)) {
            echo "<tr class='tablerow'>";
            echo "  
                <td></td>
                <td>{$data_penilaian['nama']}</td>";
                $sql_jabatan="SELECT B.jabatan,C.bagian FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN bagian C ON B.id_bagian=C.id_bagian
                WHERE  B.id_jabatan='".$data_penilaian['id_jabatan']."'
                AND A.status=".$data_penilaian['status']."
                ORDER BY A.id_nilai ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);

            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT A.id_nilai,BB.nilai FROM penilaian A
                        INNER JOIN detail_penilaian BB ON A.id_nilai=BB.id_nilai
                         INNER JOIN detail_bobot CC ON BB.id_detailbobot=CC.id_detailbobot
                        INNER JOIN bobot_penilaian B ON CC.id_bobot=B.id_bobot
                        INNER JOIN jabatan_pegawai C ON A.id_jabatan=C.id_jabatan
                        WHERE CC.id_kriteria='".$kriteriaarray[$d-1]."'
                        AND C.id_jabatan='".$data_penilaian['id_jabatan']."'
                        AND A.status=".$data_penilaian['status']."
                        ORDER BY A.id_nilai ASC";
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
                    echo "<td>".$data['nilai']."</td>";
                }
                $d++;
            }
         echo  "
                <td>".$data_jabatan['bagian']."</td>
                <td>".$data_jabatan['jabatan']."</td>
                <td>";
                if ( $data_penilaian['status']==1 )echo 'Aktif';
                else echo'Non Aktif';
               
        echo "</td>
                <td>
                    <a class='btn btn-primary detail' ref='".$data_penilaian['id_jabatan']."'>Detail</a>
                </td>";
        
            echo "</tr>";
        $s++;
        }
    echo '</tbody></table>
    <br/>

    ';

?>
	 <center>
             <button class="btn btn-primary hidden-print" onclick="printJS('../include/view/read/laporan_penilaian_pegawai_for_print.php')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
	    </center>
		</div>
	</div>
    
  
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $(".detail").click(function () {
				var id_jabatan=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=laporan_penilaian_pegawai&crud=detail&id_jabatan="+id_jabatan);
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