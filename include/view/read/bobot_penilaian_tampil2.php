<?php   
        include_once "../../../koneksi.php";
      
        $id_jabatan=$_GET['id_jabatan'];
 
        $sql = "SELECT A.id_bobot,B.nama_kriteria,A.jabatan,A.bobot,A.status FROM bobot_penilaian A
        INNER JOIN kriteria B ON A.id_kriteria=B.id_kriteria
        WHERE jabatan=CASE WHEN '$id_jabatan'='all' THEN jabatan
                    ELSE '$id_jabatan' END
        ORDER BY id_bobot ASC";
        $hasil = mysqli_query($db_link,$sql);
        if (!$hasil){
                 echo mysqli_error($db_link);
            die("Gagal Query Data ");
           
        }

        echo '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center">KRITERIA</th>
                    <th class="text-center">JABATAN</th>
                    <th class="text-center">BOBOT</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">AKSI</th>
                </tr>
                </thead>
                <tbody> ';
    
        while ($data=mysqli_fetch_array($hasil)) {
        echo "<tr>";
        echo "  <td>{$data['nama_kriteria']}</td>
                <td>{$data['jabatan']}</td>
                <td>".$data['bobot']."</td>
                <td>{$data['status']}</td>
                <td>
                    <a class='btn btn-primary ubah' ref='".$data['id_bobot']."'>Ubah</a>
                    <a class='btn btn-danger hapus' ref='".$data['id_bobot']."'>Hapus</a>&nbsp;
                </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

?>

                
                   
               
			