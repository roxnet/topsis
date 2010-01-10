 	<h2 class="text-center">HISTORY PENILAIAN PEGAWAI TERBAIK</h2> 

        <div class="col-sm-3 input-group pull-right">
         <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" class="form-control" id="nama" placeholder="Search">
        <span class="input-group-btn">
        <button id="showall" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-align-justify"></i></button>
        </span>
        </div>
        <br/><br/>
<?php 
include_once "../../../koneksi.php";
$start=$_POST['start'];
$end=$_POST['end'];
$sql_rangking="SELECT * FROM usulan WHERE
     date_format(periode,'MM/YYYY')>=date_format($start, 'MM/YYYY') AND date_format(periode,'MM/YYYY')<=date_format($end, 'MM/YYYY')
 ORDER BY nilai DESC";
$hasil_rangking=mysqli_query($db_link,$sql_rangking);
        echo '<table class="table table-bordered table-hover text-center panel panel-primary" >
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">RANGKING</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO PEGAWAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NAMA PEGAWAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">PAMELLA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NILAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">PERIODE</th>
                </tr>
        </thead>
        <tbody> ';
        $s=1;
        $number=0;
        while ($data_rangking=mysqli_fetch_assoc($hasil_rangking)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                 <td>{$data_rangking['no_pegawai']}</td>
                <td>{$data_rangking['nama_pegawai']}</td>
                <td>{$data_rangking['nama_toko']}</td>
                <td>".$data_rangking['nilai']."</td>
                <td>{$data_rangking['bagian']}</td>
                <td>{$data_rangking['jabatan']}</td>
                <td>".date("d-m-Y", strtotime($data_rangking['periode']))."</td>";
            echo "</tr>";
           
            $number=$s;
        $s++;
        }
?>
	 </tbody>
     </table>
		</div>
        <br><br>
         <center>
             <button class="btn btn-primary hidden-print" onclick="printJS('../pdf/print_history.php')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
	    </center>


<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $(".detail").click(function () {
           		window.location.replace("index.php?navigasi=laporan_penilaian_pegawai&crud=detail");
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



