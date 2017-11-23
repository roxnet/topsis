<?php
include_once "../../koneksi.php";

if(isset($_POST['id_bagian']) || isset ($_POST['bagian']) ){



    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_bagian=$_POST['id_bagian'];
            $bagian=$_POST['bagian'];
            $proses="UPDATE bagian SET bagian='$bagian' WHERE id_bagian='$id_bagian'";
            $hasil = mysqli_query($db_link,$proses);
            if($hasil){
                echo "berhasil";
            }
            else{
                echo "gagal";
                echo mysqli_error();
            }
        }

        if($_POST['crud']=='tambah'){
            $id_bagian=$_POST['id_bagian'];
            $bagian=$_POST['bagian'];
            $sql = "INSERT INTO bagian (id_bagian, bagian)
                    VALUES ('$id_bagian','$bagian') ";
            $hasil = mysqli_query($db_link,$sql); 
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error();
            }
        }

        if($_POST['crud']=='hapus'){
           $id_bagian = $_POST['id_bagian'];
            $sql = "DELETE from bagian where id_bagian='$id_bagian'";
            $hasil = mysqli_query($db_link,$sql);
            if($hasil){
                 echo "berhasil";
            }
            else{
             echo "gagal";
                echo mysqli_error();
            }
        }
    };
};
?>
