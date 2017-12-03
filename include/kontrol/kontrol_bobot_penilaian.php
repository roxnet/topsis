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
                 $proses="UPDATE bobot_penilaian SET bobot=".$bobot[$b-1].",jabatan='".$jabatan."' 
                 WHERE id_bagian='$bagian' AND id_kriteria=".$kriteria[$b-1]."";
            $hasil = mysqli_query($db_link,$proses);
                $b++;
            }
           
            if($hasil){
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
            
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='hapus'){
           $id_bagian = $_POST['id_bagian'];
            $sql = "DELETE from bobot_penilaian where id_bagian=".$id_bagian;
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
