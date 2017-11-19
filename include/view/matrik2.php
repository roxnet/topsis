<center>
<h1>MATRIK</h1>

<?php
$month = $_POST['month'];
	$year = $_POST['year'];
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='spk_topsis';
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$sql=" SELECT g.nama, g.no_pegawai, r.status, h.tgl_penilaian, h.id_hasil, p.nilai, k.id_kriteria, k.nama_kriteria, k.atribut, kb.bobot, kb.id_bagian
		from hasil h, penilaian p, kriteria k, kriteria_bagian kb, pegawai g, riwayat_pegawai r
		where g.no_pegawai=r.no_pegawai
		and r.no_pegawai=h.no_pegawai
		and h.id_hasil=p.id_hasil
		and p.id_kriteria=k.id_kriteria
		and k.id_kriteria=kb.id_kriteria 
		and r.status='Pegawai'
		and month(tgl_penilaian)='$month' AND year(tgl_penilaian) = '$year'";
$result=$db->query($sql);
 
$data=array();
$nama_kriterias=array();
$bobot=array();
$atribut=array();
$nilai_kuadrat=array();
while($row=$result->fetch_object()){
  if(!isset($data[$row->nama])){
    $data[$row->nama]=array();
  }
  if(!isset($data[$row->nama][$row->nama_kriteria])){
    $data[$row->nama][$row->nama_kriteria]=array();
  }
  if(!isset($nilai_kuadrat[$row->nama_kriteria])){
    $nilai_kuadrat[$row->nama_kriteria]=0;
  }
  $bobot[$row->nama_kriteria]=$row->bobot;
  $atribut[$row->nama_kriteria]=$row->atribut;
  $data[$row->nama][$row->nama_kriteria]=$row->nilai;
  $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
  $kriterias[]=$row->nama_kriteria;
}
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
    <table border='1' bgcolor="#FFFFFF">
      <caption>Matrix Evaluasi (x<sub>ij</sub>)</caption>
      <thead>
        <tr>
          <th rowspan='3'>No</th>
          <th rowspan='3'>Alternatif</th>
          <th rowspan='3'>Nama</th>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
        </tr>
        <tr>
          <?php
          foreach($kriteria as $k)
            echo "<th>{$k}</th>\n";
          ?>
        </tr>
        <tr>
          <?php
          for($n=1;$n<=$jml_kriteria;$n++)
            echo "<th>C{$n}</th>";
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            echo "<td align='center'>{$krit[$k]}</td>";
          }
          echo
           "</tr>\n";
        }
        ?>
      </tbody>
    </table>

<table border='1' bgcolor="#FFFFFF">
      <caption>Matrik Ternormalisasi (r<sub>ij</sub>)</caption>
      <thead>
        <tr>
          <th rowspan='3'>No</th>
          <th rowspan='3'>Alternatif</th>
          <th rowspan='3'>Nama</th>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
        </tr>
        <tr>
          <?php
          foreach($kriteria as $k)
            echo "<th>{$k}</th>\n";
          ?>
        </tr>
        <tr>
          <?php
          for($n=1;$n<=$jml_kriteria;$n++)
            echo "<th>C{$n}</th>";
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            echo "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),6)."</td>";
          }
          echo
           "</tr>\n";
        }
        ?>
      </tbody>
    </table>
	
	<table border='1' bgcolor="#FFFFFF">
      <caption>Matrik Ternormalisasi Terbobot(y<sub>ij</sub>)</caption>
      <thead>
        <tr>
          <th rowspan='3'>No</th>
          <th rowspan='3'>Alternatif</th>
          <th rowspan='3'>Nama</th>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
        </tr>
        <tr>
          <?php
          foreach($kriteria as $k)
            echo "<th>{$k}</th>\n";
          ?>
        </tr>
        <tr>
          <?php
          for($n=1;$n<=$jml_kriteria;$n++)
            echo "<th>C{$n}</th>";
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        $y=array();
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            $y[$k][$i]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),6)*$bobot[$k];
            echo "<td align='center'>".$y[$k][$i]."</td>";
          }
          echo
           "</tr>\n";
        }
        ?>
      </tbody>
    </table>
	
	<table border='1' bgcolor="#FFFFFF">
      <caption>Solusi Ideal positif (A<sup>+</sup>)</caption>
      <thead>
        <tr>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
        </tr>
        <tr>
          <?php
          foreach($kriteria as $k)
            echo "<th>{$k}</th>\n";
          ?>
        </tr>
        <tr>
          <?php
          for($n=1;$n<=$jml_kriteria;$n++)
            echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $yplus=array();
          foreach($kriteria as $k){
            $yplus[$k]=($atribut[$k]=='K'?max($y[$k]):min($y[$k]));
            echo "<th>{$yplus[$k]}</th>";
          }
          ?>
        </tr>
      </tbody>
    </table>
    <table border='1' bgcolor="#FFFFFF">
      <caption>Solusi Ideal negatif (A<sup>-</sup>)</caption>
      <thead>
        <tr>
          <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
        </tr>
        <tr>
          <?php
          foreach($kriteria as $k)
            echo "<th>{$k}</th>\n";
          ?>
        </tr>
        <tr>
          <?php
          for($n=1;$n<=$jml_kriteria;$n++)
            echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $ymin=array();
          foreach($kriteria as $k){
            $ymin[$k]=$atribut[$k]=='B'?max($y[$k]):min($y[$k]);
            echo "<th>{$ymin[$k]}</th>";
          }
          ?>
        </tr>
      </tbody>
    </table>
    <table border='1' bgcolor="#FFFFFF">
      <caption>Jarak positif (D<sub>i</sub><sup>+</sup>)</caption>
      <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          <th>Nama</th>          
          <th>D<suo>+</sup></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        $dplus=array();
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            if(!isset($dplus[$i])) $dplus[$i]=0;
            $dplus[$i]+=pow($yplus[$k]-$y[$k][$i],2);
          }
          echo "<td>".round(sqrt($dplus[$i]),6)."</td>
          </tr>\n";
        }
        ?>
      </tbody>
    </table>
	<table border='1' bgcolor="#FFFFFF">
      <caption>Jarak negatif (D<sub>i</sub><sup>-</sup>)</caption>
      <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          <th>Nama</th>          
          <th>D<suo>+</sup></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        $dmin=array();
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            if(!isset($dmin[$i]))$dmin[$i]=0;
            $dmin[$i]+=pow($ymin[$k]-$y[$k][$i],2);
          }
          echo "<td>".round(sqrt($dmin[$i]),6)."</td>
          </tr>\n";
        }
        ?>
      </tbody>
    </table>
    <table border='1' bgcolor="#FFFFFF">
      <caption>Nilai Preferensi(V<sub>i</sub>)</caption>
      <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          <th>Nama</th>
          <th>V<sub>i</sub></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=0;
        $V=array();
        foreach($data as $nama=>$krit){
          echo "<tr>
           <td>".(++$i)."</td>
           <th>A{$i}</th>
           <td>{$nama}</td>";
          foreach($kriteria as $k){  
            $V[$i]=$dmin[$i]/($dmin[$i]+$dplus[$i]);
          }
          echo "<td>{$V[$i]}</td></tr>\n";
        }
        ?>
      </tbody>
    </table>
	</center>
  </body>
</html>
