<?php
include_once "../../koneksi.php";

if(isset($_POST['id_bobot'])|| isset($_POST['kriteria']) || isset ($_POST['jabatan'])|| isset($_POST['bobot'])||
    isset($_POST['status'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_bobot=$_POST['id_bobot'];
            $id_kriteria=$_POST['kriteria'];
            $bobot=$_POST['bobot'];
            $jabatan=$_POST['jabatan'];
            $status=$_POST['status'];
            $proses="UPDATE bobot_penilaian SET id_kriteria='$id_kriteria',bobot='$bobot'
            ,jabatan='".$jabatan."',Status=".$status." WHERE id_bobot='$id_bobot'";
            $hasil = mysqli_query($db_link,$proses);
            if($hasil){
                echo "berhasil";
            }
            else{
                echo "gagal";
               echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='tambah'){
            $id_kriteria=$_POST['kriteria'];
            $bobot=$_POST['bobot'];
            $jabatan=$_POST['jabatan'];
            $status=$_POST['status'];
            $sql = "INSERT INTO bobot_penilaian (id_kriteria,bobot,jabatan,status)
                    VALUES ('".$id_kriteria."',".$bobot.",'".$jabatan."',".$status.") ";
            $hasil = mysqli_query($db_link,$sql); 
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='hapus'){
           $id_bobot = $_POST['id_bobot'];
            $sql = "DELETE from bobot_penilaian where id_bobot=".$id_bobot;
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
