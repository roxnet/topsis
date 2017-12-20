<?php
    session_start();
    $username=$_SESSION['username'];
    $hak_akses=$_SESSION['hak_akses'];
    $cek_user=("SELECT user_name,hak_akses FROM user WHERE user_name ='$username' AND hak_akses=$hak_akses");
    $user_data=mysqli_query($db_link,$cek_user);
    $cek_jum=mysqli_num_rows($user_data);
    if($cek_jum==NULL || $cek_jum==0 || $cek_jum<>1){
        header("location:login.php");
    }
    else if($cek_jum==1){
        $data_user=mysqli_fetch_assoc($user_data);
    }
?>