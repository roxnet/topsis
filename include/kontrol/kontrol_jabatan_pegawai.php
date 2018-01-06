<?php
include_once "../../koneksi.php";

if(isset($_POST['id_jabatan'])|| isset($_POST['id_pegawai']) || isset ($_POST['id_toko'])|| isset($_POST['id_bagian'])||
    isset($_POST['jabatan'])|| isset($_POST['status'])||isset($_POST['tgl_jabat'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_jabatan=$_POST['id_jabatan'];
            $id_pegawai=$_POST['id_pegawai'];
            $id_toko=$_POST['id_toko'];
            $id_bagian=$_POST['id_bagian'];
            $jabatan=$_POST['jabatan'];
            $status=$_POST['status'];
            $tgl_jabat=$_POST['tgl_jabat'];
            $proses="UPDATE jabatan_pegawai SET id_pegawai='$id_pegawai',id_toko='$id_toko',id_bagian='$id_bagian'
            ,jabatan='".$jabatan."',Status=".$status.",tgl_jabat=STR_TO_DATE('".$tgl_jabat."', '%d/%m/%Y') WHERE id_jabatan='$id_jabatan'";
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
            $id_pegawai=$_POST['id_pegawai'];
            $id_toko=$_POST['id_toko'];
            $id_bagian=$_POST['id_bagian'];
            $jabatan=$_POST['jabatan'];
            $status=$_POST['status'];
            $tgl_jabat=$_POST['tgl_jabat'];
            $proses="UPDATE jabatan_pegawai SET Status=0 WHERE id_pegawai='$id_pegawai'";
             mysqli_query($db_link,$proses);
            $sql = "INSERT INTO jabatan_pegawai (id_pegawai,id_toko,id_bagian,jabatan,Status,tgl_jabat)
                    VALUES ('".$id_pegawai."',".$id_toko.",'".$id_bagian."','".$jabatan."',".$status.",STR_TO_DATE('".$tgl_jabat."', '%d/%m/%Y')) ";
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
           $id_jabatan = $_POST['id_jabatan'];
            $sql = "DELETE from jabatan_pegawai where id_jabatan=".$id_jabatan;
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
