<?php
include_once "../../koneksi.php";




    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
           $count=$_POST['count'];
           $id_nilai=$_POST['id_nilai'];
            $jabatan=$_POST['jabatan'];
            $tgl_nilai=$_POST['tgl_nilai'];
            $b=1;
            $id_bobot=array();
            $nilai=array();
            $value=NULL;
             $cek_kriteria="INSERT INTO penilaian (id_jabatan,tgl_penilaian,status)
                SELECT * FROM (SELECT $jabatan bb,STR_TO_DATE('".$tgl_nilai."', '%d/%m/%Y') cc,1 dd)AS Temp
                     WHERE NOT EXISTS  (SELECT B.id_nilai FROM penilaian A
                     INNER JOIN detail_penilaian B ON A.id_nilain=B.id_nilai
                     WHERE A.id_nilai=$id_nilai )";
                $end=mysqli_query($db_link,$cek_kriteria);
            while($b<=$count){
                 $id_bobot[]=$_POST["bobot$b"];
                $nilai[]=$_POST["nilai$b"];
               $cek_penilaian="INSERT INTO detail_penilaian (id_nilai,id_detailbobot)
               SELECT * FROM (SELECT $id_nilai,".$id_bobot[$b-1].")as Temp
                WHERE NOT EXISTS (SELECT id_detailbobot FROM detail_penilaian WHERE id_nilai=$id_nilai AND id_detailbobot=".$id_bobot[$b-1].")";
                mysqli_query($db_link,$cek_penilaian);
                 $proses="UPDATE detail_penilaian SET nilai=".$nilai[$b-1]."
                 WHERE id_nilai=$id_nilai AND id_detailbobot=".$id_bobot[$b-1]."";
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
             $proses="UPDATE penilaian SET status=0
                 WHERE id_jabatan=$jabatan";
            mysqli_query($db_link,$proses);
            $sql = "INSERT INTO penilaian (id_jabatan,tgl_penilaian,status)
                    VALUES (".$jabatan.",STR_TO_DATE('".$tgl_nilai."', '%d/%m/%Y'),1) ";
            $hasil = mysqli_query($db_link,$sql); 
            $id_nilai=mysqli_insert_id($db_link);
            
            while($b<=$count){
                $id_detailbobot[]=$_POST["bobot$b"];
                $nilai[]=$_POST["nilai$b"];

             $detail_nilai="INSERT INTO detail_penilaian (id_nilai,id_detailbobot,nilai)
             VALUES ($id_nilai,".$id_detailbobot[$b-1].",".$nilai[$b-1].")";
             $hasil=mysqli_query($db_link,$detail_nilai);
            mysqli_error($db_link);
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
           $id_nilai = $_POST['id_nilai'];
            $sqll = "DELETE from detail_penilaian where id_nilai=".$id_nilai;
            mysqli_query($db_link,$sqll);
            $sql = "DELETE from penilaian where id_nilai=".$id_nilai;
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

?>
