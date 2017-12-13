<?php
include_once "../../koneksi.php";

if(isset($_POST['id_pegawai']) || isset ($_POST['user_name']) || isset ($_POST['password'])|| isset($_POST['hak_akses']) ){


  if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_pegawai=$_POST['id_pegawai'];
            $user_name=$_POST['user_name'];
            $password=$_POST['password'];
			$hak_akses=$_POST['hak_akses'];
            $sql_update="UPDATE user SET user_name='$user_name',password='$password',hak_akses='$hak_akses' WHERE user_name='$user_name'";
            $hasil = mysqli_query($db_link,$sql_update);
            if($hasil){
                echo "berhasil";
            }
            else{
                echo "gagal";
                echo mysqli_error();
            }
        }

        if($_POST['crud']=='tambah'){
            $id_pegawai=$_POST['id_pegawai'];
            $user_name=$_POST['user_name'];
			$password=$_POST['password'];
			$hak_akses=$_POST['hak_akses'];
            $sql_tambah="INSERT INTO user (user_name, password, hak_akses, id_pegawai) 
			VALUE ('".$user_name."', '".$password."','".$hak_akses."', '".$id_pegawai."')";
            $hasil = mysqli_query($db_link,$sql_tambah); 
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error();
            }
        }

        if($_POST['crud']=='hapus'){
           $user_name = $_POST['user_name'];
            $sql_delete = "DELETE from user where user_name='$user_name'";
            $hasil = mysqli_query($db_link,$sql_delete);
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
