<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Perpegawai </title>
<center>
<h1><b>LAPORAN PENILAIAN PER PEGAWAI</b></h1>
<?php
	echo '<table border="0"  align="center">';
  		
	require_once("koneksi.php");
    $no_pegawai= $_POST['no_pegawai']; //get the nama value from form
   	$sql=("select * from hasil p, pegawai g
		where g.no_pegawai=p.no_pegawai  
		and g.no_pegawai='$no_pegawai' limit 1");
		  	$hasil	= mysqli_query($db_link,$sql);
  		$cekdata=mysqli_num_rows($hasil);
  			if($cekdata=='0'){
				echo "<center>Maaf Nomor Pegawai tidak valid</center>";
  			}
 	while($data_pegawai=mysqli_fetch_assoc($hasil)) {
 	echo "<tr>";
		echo "<td> No Pegawai</td>";
		echo "<td>:</td>";
		echo "<td>".$data_pegawai['no_pegawai']."</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td> Nama Pegawai</td>";
		echo "<td>:</td>";
		echo "<td>".$data_pegawai['nama']."</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td> No. Telepon</td>";
		echo "<td>:</td>";
		echo "<td>".$data_pegawai['no_telp']."</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td> Pamella</td>";
		echo "<td>:</td>";
		echo "<td>".$data_pegawai['pamella']."</td>";
	echo "</tr>";
	
	echo '</table>';
   
/*----Penilaian----*/
	$month = $_POST['month'];
	$year = $_POST['year'];
	?>
		<table border="1" cellspacing="0" cellpadding="0">
		<tr>
		  <td colspan="3" bgcolor="#FFFFFF"><b>Bulan :  <?php  echo "$month"; ?>  - <?php echo "$year"; ?> </b></td>
		</tr>
		<tr bgcolor="#00CC00">
    		<th>Nomor</th>
    		<th width="200">&nbsp; Nama Kriteria</th>
    		<th width="35">Nilai</th>
  		</tr>
		
		 <?php
		$month = $_POST['month'];
		$year = $_POST['year'];
		$nilai="select * from hasil h, penilaian p, kriteria k
				where h.id_hasil=p.id_hasil
				and p.id_kriteria=k.id_kriteria 
				and h.no_pegawai='".$data_pegawai['no_pegawai']."'
				and month(tgl_penilaian)='$month' and year(tgl_penilaian) = '$year'";
			$exekusi=mysqli_query($db_link,$nilai);
			  $no=0;
			while($muncul=mysqli_fetch_array($exekusi)){
			  $no++;
  			echo "<tr bgcolor='#FFFFFF'>"
			 	."<td align='center'>$no</td>"
				."<td>&nbsp;{$muncul['nama_kriteria']}</td>"
				."<td align='center'>&nbsp;{$muncul['nilai']}</td>";
				
			echo "</tr>";
			}
}
	$sql="SELECT g.nama, g.no_pegawai, g.pamella, r.status, h.tgl_penilaian, h.id_hasil, p.nilai, k.id_kriteria, k.nama_kriteria, k.atribut, kb.bobot, kb.id_bagian
		FROM hasil h, penilaian p, kriteria k, kriteria_bagian kb, pegawai g, riwayat_pegawai r
		WHERE g.no_pegawai=r.no_pegawai
		AND r.no_pegawai=h.no_pegawai
		AND h.id_hasil=p.id_hasil
		AND p.id_kriteria=k.id_kriteria
		AND k.id_kriteria=kb.id_kriteria 
    AND r.status='Pegawai'
	AND  month(tgl_penilaian)='$month' AND year(tgl_penilaian) = '$year'";
	
$result=$db_link->query($sql);
 
while($row=$result->fetch_object()){
  if(!isset($data[$row->nama])){
    $data[$row->nama]=array();
  }
  if(!isset($data[$row->nama][$row->nama_kriteria] )){
    $data[$row->nama][$row->nama_kriteria]=array();
  }
  if(!isset($nilai_kuadrat[$row->nama_kriteria])){
    $nilai_kuadrat[$row->nama_kriteria]=0;
  }
  $bobot[$row->nama_kriteria]=$row->bobot;
  $atribut[$row->nama_kriteria]=$row->atribut;
  $data[$row->nama][$row->nama_kriteria]=$row->nilai;
  $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
  $nopegawai[]=$row->no_pegawai;
  $kriterias[]=$row->nama_kriteria;
}
$no_pegawai=array_unique($nopegawai);
$kriteria=array_unique($kriterias);
$jml_kriteria=count($kriteria);


    	foreach($kriteria as $k)
		
		/*menghitung normalisasi R*/
        for($n=1;$n<=$jml_kriteria;$n++)
        $i=0;

        foreach($data as $nama=>$krit){
          {  
            ($krit[$k]/sqrt($nilai_kuadrat[$k]));
          }
        }

   		/*menghitung normalisasi terbobot Y*/
	    foreach($data as $nama=>$krit){
          ++$i;
          foreach($kriteria as $k){  
            $y[$k][$i]=($krit[$k]/sqrt($nilai_kuadrat[$k]))*$bobot[$k];
          }
        }
		
		/*menghitung solusi ideal positif*/
          $yplus=array();
          foreach($kriteria as $k){
            $yplus[$k]=($atribut[$k]=='K'?max($y[$k]):min($y[$k]));
          }

		/*menghitung solusi ideal negatif */
		  $ymin=array();
          foreach($kriteria as $k){
            $ymin[$k]=$atribut[$k]=='B'?max($y[$k]):min($y[$k]);
          }
		
		/*menghitung jarak D*/
        $i=0;
        $dplus=array();
		$dmin=array();
        foreach($data as $nama=>$krit){
          ++$i;
          foreach($kriteria as $k){ 
          	{ 
            if(!isset($dplus[$i])) $dplus[$i]=0;
            	$dplus[$i]+=pow($yplus[$k]-$y[$k][$i],2);
			
            }
				sqrt($dplus[$i]);
            
            {
            if(!isset($dmin[$i]))$dmin[$i]=0;
            	$dmin[$i]+=pow($ymin[$k]-$y[$k][$i],2);
          	}
          		sqrt($dmin[$i]);
          }
        }
    /*menghitung preferensi (Vi)*/  

          foreach($kriteria as $k){  
            $V[$i]=$dmin[$i]/($dmin[$i]+$dplus[$i]);
          } 
         
         	echo "<th colspan='2' bgcolor='#00CC00'>Total Penilaian</th><th bgcolor='#00CC00'>{$V[$i]}</th>";
				
          echo " </tr>";
        
		echo "</table>";
		
	?>
 </body>
</html>