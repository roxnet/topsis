<!doctype html>
<html>
  <head>
    <title>multi</title>
  </head>
  <body>
  <?php
  require_once("koneksi.php");
	$colspan="select * from kriteria ";
	$setelah=mysqli_query($db_link,$colspan);
	$aksi=mysqli_num_rows($setelah);
	?>
  <center>
  <h1><b>DAFTAR BOBOT KRITERIA</b></h1>
  <table border="0" cellpadding="0" cellspacing="0">
  </table>
  </center>
  <center>
    <table border='1' cellpadding="0" cellspacing="0">
        <tr bgcolor="#00CC00">
          <th rowspan='2'>ID Bagian</th>
          <th rowspan='2'>Nama Bagian</th>
          <th colspan='<?php echo $aksi;?>'>Kriteria</th>
          <th rowspan='2'>Action</th>
        </tr>
		 <tr bgcolor="#00CC00">
 	<?php
			while($ja=mysqli_fetch_array($setelah)){
				echo "<td align='center'>".$ja['nama_kriteria']."</td>";
			}
	?>
    </tr>
	<?php
 	include 'koneksi.php'; 
	$sql1="SELECT * FROM bagian";
	$data_baru1=mysqli_query($db_link,$sql1); 	
        while ($data_bagian=mysqli_fetch_array($data_baru1)){
          echo "<tr bgcolor='#FFFFFF'>";
                 echo "<td>{$data_bagian['id_bagian']}</td>"
                  ."<td>{$data_bagian['bagian']}</td>";
          $sql2="SELECT  * FROM bagian B, kriteria_bagian K
		  		WHERE B.id_bagian=K.id_bagian
                  AND B.id_bagian='".$data_bagian['id_bagian']."'";
          $data_baru2=mysqli_query($db_link,$sql2);
          while($data_kriteria=mysqli_fetch_array($data_baru2)){
            echo "<td align='center'>{$data_kriteria['bobot']}</td>";
          }
		  
          echo "<td align='center'>&nbsp<a href='bobot_edit.php?id_bagian={$data_bagian['id_bagian']}'>Edit</a> |&nbsp;
  		<a href='bobot_hapus.php?id_bagian={$data_bagian['id_bagian']}' 
		onclick='return confirm(\"Yakin menghapus Bagian {$data_bagian['bagian']}????\");'>Hapus</a>&nbsp;</td>";
 
	echo "</tr>";

		}
        ?>
    </table>
	</center>
</body>
</html>
