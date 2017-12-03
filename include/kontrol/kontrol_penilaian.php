<?php
include_once "../../koneksi.php";

if( isset ($_POST['jabatan'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
           $count=$_POST['count'];
            $jabatan=$_POST['jabatan'];
            $tgl_nilai=$_POST['tgl_nilai'];
            $b=1;
            $id_bobot=array();
            $nilai=array();
            $value=NULL;
            while($b<=$count){
                 $id_bobot[]=$_POST["bobot$b"];
                $nilai[]=$_POST["nilai$b"];
                 $proses="UPDATE penilaian SET nilai=".$nilai[$b-1].",tgl_penilaian=STR_TO_DATE('".$tgl_nilai."', '%d/%m/%Y') 
                 WHERE id_jabatan='$jabatan' AND id_bobot=".$id_bobot[$b-1]."";
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
            $jabatan=$_POST['jabatan'];
            $tgl_nilai=$_POST['tgl_nilai'];
            $b=1;
            $id_bobot=array();
            $nilai=array();
            $value=NULL;
            while($b<=$count){
                $id_bobot[]=$_POST["bobot$b"];
                $nilai[]=$_POST["nilai$b"];
                $value="".$id_bobot[$b-1].",".$nilai[$b-1]."";
                $sql = "INSERT INTO penilaian (id_bobot,nilai,id_jabatan,tgl_penilaian)
                    VALUES ($value,'".$jabatan."',STR_TO_DATE('".$tgl_nilai."', '%d/%m/%Y')) ";
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
           $id_jabatan = $_POST['id_jabatan'];
            $sql = "DELETE from penilaian where id_jabatan=".$id_jabatan;
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
