<?php
    include_once "../../../koneksi.php";
	$start 			=$_POST['start'];
	$end 			=$_POST['end'];
    $id_toko		=$_POST['id_toko'];
    $jabatan		=$_POST['jabatan'];
    $id_bagian		=$_POST['id_bagian'];
    $jum_terbaik	=$_POST['jum_terbaik'];
    $d=1;
    $x=array();
    $dd=0;
    $y=array();

     mysqli_query($db_link,"CREATE TEMPORARY TABLE rangking(Rangking INT AUTO_INCREMENT primary key
		,no_pegawai varchar(8)
		,nama varchar(50)
        ,nilai decimal(10,8)
        ,toko varchar(255)
        ,jabatan varchar(12)
        ,bagian varchar(255)
        ,tgl_penilaian date);");

        $nilai_ypositif=array();
        $temp_positif=NULL;
        $temp_negatif=NULL;
        
        $nilai_ynegatif=array();
        $id_jabatan=array();
        $peri=array();
    //mengambil data kriteria
    $kriteria=mysqli_query($db_link,"SELECT id_kriteria,atribut FROM kriteria ");
    while($data_kriteria=mysqli_fetch_assoc($kriteria)){
        //per kriteria
        //masih seluruh pegawai belum ada filter
        $sqlfornilai="SELECT DISTINCT C.no_pegawai,C.nama,BB.nilai,DD.akumulasi,E.nama_toko,B.jabatan,F.bagian,A.tgl_penilaian FROM penilaian A
                    INNER JOIN detail_penilaian BB ON A.id_nilai=BB.id_nilai
                      INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                      INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai
                       INNER JOIN detail_bobot DD ON BB.id_detailbobot=DD.id_detailbobot
                      INNER JOIN bobot_penilaian D ON DD.id_bobot=D.id_bobot AND B.jabatan=D.jabatan
                      INNER JOIN toko E ON B.id_toko=E.id_toko
                      INNER JOIN bagian F ON B.id_bagian=F.id_bagian
                      WHERE DD.id_kriteria='".$data_kriteria['id_kriteria']."'
                      AND E.id_toko=CASE WHEN ".$id_toko."=0 THEN E.id_toko ELSE ".$id_toko." END
                      AND B.jabatan=CASE WHEN '".$jabatan."'='none'THEN B.jabatan ELSE '".$jabatan."' END
                      AND F.id_bagian=CASE WHEN '".$id_bagian."'='none' THEN F.id_bagian ELSE '".$id_bagian."' END
                      AND date_format(A.tgl_penilaian,'%m/%Y')>='$start' AND date_format(A.tgl_penilaian,'%m/%Y')<='$end'
                      AND D.status=1 AND A.status=1
                      ORDER BY C.no_pegawai;
                      "; 
    $nilai_krit=mysqli_query($db_link,$sqlfornilai); 
    echo mysqli_error($db_link);                                 
    $nilai_krit2=mysqli_query($db_link,$sqlfornilai);
         if(!$nilai_krit){
                 mysqli_errno($db_link);
         }
        $nilai=NULL;
		
        //nilai per pegawai per kriteria
        while($data_nilai=mysqli_fetch_assoc($nilai_krit)){
                //nilai merupakan hasil pangkat
                $nilai=$nilai+pow($data_nilai['nilai'],2);   
        }
        $x[$d]=sqrt($nilai);
        $e=1;
        $ee=0;
               
        //matrix keputusan normalisasi per kriteria
         while($data_nilai=mysqli_fetch_assoc($nilai_krit2)){
                //nilai merupakan hasil pangkat
                $y[$d][$e]=($data_nilai['nilai']/$x[$d])*$data_nilai['akumulasi'];   
  
         //mencari nilai Y;
            if($data_kriteria['atribut']=='K'){
               if(empty($nilai_ypositif[$d])){
                   $nilai_ypositif[$d]=$y[$d][$e];
               }
               if(empty($nilai_ynegatif[$d])){
                   $nilai_ynegatif[$d]=$y[$d][$e];
               }
                if( $y[$d][$e]> $nilai_ypositif[$d]){
                    $nilai_ypositif[$d]=$y[$d][$e];
                }
                 if( $y[$d][$e]< $nilai_ynegatif[$d]){
                    $nilai_ynegatif[$d]=$y[$d][$e];
                }
            }
            if($data_kriteria['atribut']=='B'){
               if(empty($nilai_ypositif[$d])){
                   $nilai_ypositif[$d]=$y[$d][$e];
               }
               if(empty($nilai_ynegatif[$d])){
                   $nilai_ynegatif[$d]=$y[$d][$e];
               }
                if( $y[$d][$e]< $nilai_ypositif[$d]){
                    $nilai_ypositif[$d]=$y[$d][$e];
                }
                 if( $y[$d][$e]> $nilai_ynegatif[$d]){
                    $nilai_ynegatif[$d]=$y[$d][$e];
                }
            }
            $nama_pegawai[$e]=$data_nilai['nama'];
            $no_pegawai[$e]=$data_nilai['no_pegawai'];
            $toko[$e]=$data_nilai['nama_toko'];
            $bag[$e]=$data_nilai['bagian'];
            $jab[$e]=$data_nilai['jabatan'];
            $peri[$e]=$data_nilai['tgl_penilaian'];
        $ee=$e;
        $e++;
        }
        $dd=$d;
        $d++;
    }
    //mencari nilai D;
 
    $d_plus=array();
    $d_minus=array();
    $v=array();
    echo '<br>';
    for ($zz=1;$zz<=$ee;$zz++){
        $d_plus[$zz]=NULL;
        $d_minus[$zz]=NULL;
        $v[$zz]=NULL;
        
        for($nn=1;$nn<=$dd;$nn++){
            //echo $y[$nn][$ee];

        $d_plus[$zz]=$d_plus[$zz]+pow($nilai_ypositif[$nn]-$y[$nn][$zz],2);
               
        $d_minus[$zz]=$d_minus[$zz]+pow($nilai_ynegatif[$nn]-$y[$nn][$zz],2);
           //echo $nilai_ynegatif[$nn].'|'.$y[$nn][$zz].'<br>';
        }

        $d_plus[$zz]=sqrt($d_plus[$zz]);
        $d_minus[$zz]=sqrt($d_minus[$zz]);
        //nilai preferensi alternatif
        //echo $d_minus[$zz].'/'.$d_minus[$zz].'+'.$d_plus[$zz].'<br>';
        $v[$zz]=$d_minus[$zz]/($d_minus[$zz]+$d_plus[$zz]);
        $queryfinish=mysqli_query($db_link,"INSERT INTO rangking (no_pegawai,nama,nilai,toko,jabatan,bagian,tgl_penilaian) 
        VALUES ('".$no_pegawai[$zz]."','".$nama_pegawai[$zz]."',".$v[$zz].",'".$toko[$zz]."','".$jab[$zz]."','".$bag[$zz]."','".$peri[$zz]."')");
    }
    //munculkan toko
$sql_rangking="SELECT no_pegawai,nama,nilai,toko,jabatan,bagian,tgl_penilaian FROM rangking ORDER BY nilai DESC limit ".$jum_terbaik." ";
$hasil_rangking=mysqli_query($db_link,$sql_rangking);
echo '<h2 class="text-center">USULAN PEGAWAI TERBAIK</h2>';
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
        $no_peg=array();
        $nama_peg=array();
        $toko_kerja=array();
        $nilai_kerja=array();
        $bagian=array();
        $jabatan_peg=array();
        $tgl_rangking=array();
        $number=0;
        while ($data_rangking=mysqli_fetch_assoc($hasil_rangking)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                 <td>{$data_rangking['no_pegawai']}</td>
                <td>{$data_rangking['nama']}</td>
                <td>{$data_rangking['toko']}</td>
                <td>".$data_rangking['nilai']."</td>
                <td>{$data_rangking['bagian']}</td>
                <td>{$data_rangking['jabatan']}</td>
                <td>".date("d-m-Y", strtotime($data_rangking['tgl_penilaian']))."</td>";
            echo "</tr>";
            echo "<input type='hidden' name='no_peg$s' value='".$data_rangking['no_pegawai']."'>";
            echo "<input type='hidden' name='nama_peg$s' value='".$data_rangking['nama']."'>";
            echo "<input type='hidden' name='toko_kerja$s' value='".$data_rangking['toko']."'>";
            echo "<input type='hidden' name='nilai_kerja$s' value='".$data_rangking['nilai']."'>";
            echo "<input type='hidden' name='bagian$s' value='".$data_rangking['bagian']."'>";
            echo "<input type='hidden' name='jabatan_peg$s' value='".$data_rangking['jabatan']."'>";
            echo "<input type='hidden' name='tgl_rangking$s' value='".$data_rangking['tgl_penilaian']."'>";
            $number=$s;
        $s++;
        }
?>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
   var penilaiancount=<?php echo $number; ?>;
          

</script>

   