<?php
include_once "../../koneksi.php";

if(isset($_POST['id_bobot'])|| isset ($_POST['jabatan'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $count=$_POST['count'];
            $bagian=$_POST['bagian'];
            $jabatan=$_POST['jabatan'];
            $b=1;
            $kriteria=array();
            $bobot=array();
            $nilai=NULL;
            while($b<=$count){
                $kriteria[]=$_POST["kriteria$b"];
                $bobot[]=$_POST["bobot$b"];

                $cek_kriteria=" INSERT INTO bobot_penilaian (id_bagian,id_kriteria,jabatan)
                    SELECT * FROM (SELECT '".$bagian."' aa,'".$kriteria[$b-1]."' bb,'".$jabatan."' cc) AS Temp
                     WHERE NOT EXISTS (SELECT * FROM bobot_penilaian WHERE id_bagian='".$bagian."' AND jabatan='".$jabatan."' AND id_kriteria='".$kriteria[$b-1]."')
                ";
               mysqli_query($db_link,$cek_kriteria);
                 $proses="UPDATE bobot_penilaian SET bobot=".$bobot[$b-1].",jabatan='".$jabatan."' 
                 WHERE id_bagian='$bagian' AND id_kriteria='".$kriteria[$b-1]."'";
            $hasil = mysqli_query($db_link,$proses);
                  
                $b++;
            }
            $c=1; 
            while($c<=$count){
                $kriteriaa[]=$_POST["kriteria$c"];
                $bobott[]=$_POST["bobot$c"];
            $akumulasi_hitung=mysqli_query($db_link,"SELECT (".$bobott[$c-1]."/SUM(bobot))*100 hitung FROM bobot_penilaian 
                                WHERE id_bagian='".$bagian."' AND jabatan='".$jabatan."'");
                $hasil_hitung=mysqli_fetch_assoc($akumulasi_hitung);
                $sql_akumulasi="UPDATE bobot_penilaian SET akumulasi=".$hasil_hitung['hitung']." WHERE id_bagian='".$bagian."'
                AND jabatan='".$jabatan."' AND id_kriteria='".$kriteriaa[$c-1]."'";
                $akumulasi=mysqli_query($db_link,$sql_akumulasi);
                $c++;
            }
            if($akumulasi){
                echo "berhasil";
            }
            else{
                echo "gagal";
               echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='tambah'){
            $count=$_POST['count'];
            $bagian=$_POST['bagian'];
            $jabatan=$_POST['jabatan'];
            $b=1;
            $kriteria=array();
            $bobot=array();
            $nilai=NULL;
            while($b<=$count){
                $kriteria[]=$_POST["kriteria$b"];
                $bobot[]=$_POST["bobot$b"];
                $nilai="'".$kriteria[$b-1]."',".$bobot[$b-1]."";
                $sql = "INSERT INTO bobot_penilaian (id_bagian,id_kriteria,bobot,jabatan)
                    VALUES ('".$bagian."',$nilai,'".$jabatan."') ";
            $hasil = mysqli_query($db_link,$sql); 
                $b++;
            }
            $c=1;
              while($c<=$count){
                $kriteriaa[]=$_POST["kriteria$c"];
                $bobott[]=$_POST["bobot$c"];
             $akumulasi_hitung=mysqli_query($db_link,"SELECT (".$bobott[$c-1]."/SUM(bobot))*100 hitung FROM bobot_penilaian 
             WHERE id_bagian='".$bagian."' AND jabatan='".$jabatan."'");
                $hasil_hitung=mysqli_fetch_assoc($akumulasi_hitung);
                $sql_akumulasi="UPDATE bobot_penilaian SET akumulasi=".$hasil_hitung['hitung']." WHERE id_bagian='".$bagian."'
                AND jabatan='".$jabatan."' AND id_kriteria='".$kriteriaa[$c-1]."'";
                $akumulasi=mysqli_query($db_link,$sql_akumulasi);
                $c++;
              }
            
            if ($akumulasi) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='hapus'){
           $id_bagian = $_POST['id_bagian'];
           $jabatan= $_POST['jabatan'];
            $sql = "DELETE from bobot_penilaian where id_bagian='".$id_bagian."' AND jabatan='".$jabatan."'";
            $hasil = mysqli_query($db_link,$sql);
            if($hasil){
                
                 echo "berhasil";
            }
            else{
             echo "gagal";
                echo mysqli_error();
            }
        }
    }
}
?>
