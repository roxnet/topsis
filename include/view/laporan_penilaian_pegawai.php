<?php
include('koneksi.php');

	$month = $_POST['month'];
	$year = $_POST['year'];
	$sql="SELECT g.nama, g.no_pegawai, g.pamella, r.status, h.tgl_penilaian, h.id_hasil, p.nilai, k.id_kriteria, k.nama_kriteria, k.atribut, kb.bobot, kb.id_bagian
		FROM hasil h, penilaian p, kriteria k, kriteria_bagian kb, pegawai g, riwayat_pegawai r
		WHERE g.no_pegawai=r.no_pegawai
		AND r.no_pegawai=h.no_pegawai
		AND h.id_hasil=p.id_hasil
		AND p.id_kriteria=k.id_kriteria
		AND k.id_kriteria=kb.id_kriteria 
    AND r.status='Pegawai'
	AND  month(tgl_penilaian)='$month' AND year(tgl_penilaian) = '$year'";
	
   	
	$sql1="SELECT nama,A.no_pegawai,pamella FROM pegawai A
		INNER JOIN riwayat_pegawai B ON A.no_pegawai=B.no_pegawai
		INNER JOIN hasil H ON B.no_pegawai=H.no_pegawai
		WHERE B.status='Pegawai'
		AND  month(tgl_penilaian)='$month' AND year(tgl_penilaian) = '$year'";
$data_baru1=mysqli_query($db_link,$sql1);


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

	?>
<!doctype html>
<html>
  <head>
    <title>TOPSIS</title>
  </head>
  <body>
  <center>
  <h1><b>LAPORAN PENILAIAN SEMUA PEGAWAI</b></h1>
 <b>Periode Bulan <?php  echo "$month"; ?> </b> <b> - <?php echo "$year"; ?> </b>  

  <table border="0" cellpadding="0" cellspacing="0">
  <tr>
  <th colspan="2"><font color="#00CC00">============================</font></th>
  </tr>
  </table>
  </center>
  <center>
    <table border='1' cellpadding="0" cellspacing="0">
        <tr bgcolor="#00CC00">
          <th rowspan='2'>No Pegawai</th>
          <th rowspan='2'>Nama Pegawai</th>
          <th rowspan='2'>Pamella</th>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
          <th rowspan='2'>Total</th>
        </tr>
		
	<?php

    	foreach($kriteria as $k)
        	echo "<th bgcolor='#00CC00'><font size='2'>&nbsp;{$k}&nbsp;</font></th>\n"; /* memunculkan nama kriteria*/
		
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
    $i=0; 
        while ($data_pegawai=mysqli_fetch_assoc($data_baru1)){
          echo "<tr bgcolor='#FFFFFF'>
                  <td>{$data_pegawai['no_pegawai']}</td>
                  <td>{$data_pegawai['nama']}</td>
                  <td>{$data_pegawai['pamella']}\n</td>";

		$month = $_POST['month'];
		$year = $_POST['year'];
          $sql2="SELECT  A.nilai FROM penilaian A
  					      INNER JOIN hasil D ON A.id_hasil=D.id_hasil
                  INNER JOIN riwayat_pegawai C ON D.no_pegawai=C.no_pegawai
                  WHERE C.no_pegawai='".$data_pegawai['no_pegawai']."'
				  AND  month(tgl_penilaian)='$month' AND year(tgl_penilaian) = '$year'";
          $data_baru2=mysqli_query($db_link,$sql2);
          ++$i;
          while($new_kriteria=mysqli_fetch_assoc($data_baru2)){

            echo "<td align='center' bgcolor='white'>".$new_kriteria['nilai']."</td>";
          }
          foreach($kriteria as $k){  
            $V[$i]=$dmin[$i]/($dmin[$i]+$dplus[$i]);
          } 
         
         	echo "<td>{$V[$i]}</td>";
				
          echo " </tr>";
        
		}
           /* memunculkan total nilai per pegawai */
        ?>
    </table>
	</center>
</body>
</html>
