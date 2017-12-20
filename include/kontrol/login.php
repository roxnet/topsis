<?php
include_once "../../koneksi.php";
session_start();




    if (isset($_POST['type'])){
        if($_POST['type']=='login'){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $proses="SELECT user_name,hak_akses FROM user WHERE user_name='$username' AND password='$password'";
            $hasil = mysqli_query($db_link,$proses);
            $data=mysqli_fetch_assoc($hasil);
            $_SESSION['username']=$data['user_name'];
            $_SESSION['hak_akses']=$data['hak_akses'];
            if($hasil){
                echo "true";
            }
            else{
                echo "gagal";
                echo mysqli_error($db_link);
            }
        }



        if($_POST['type']=='logout'){
          unset($_SESSION['username']);
         unset($_SESSION['hak_akses']);
            
                 echo "true";
          
        }
    };
?>
