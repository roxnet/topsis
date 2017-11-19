<?php
$localhost	= 'localhost'; 
$user		= 'root'; //nama username
$pass		= ''; //password jika tadak ada bisa di kosongi seperti contoh 
$db_name	= 'spk_topsis'; //nama database

$db_link	= mysqli_connect($localhost,$user,$pass,$db_name);
if (!$db_link){
	echo 'Tidak dapat terhubung ke database';
}
?>