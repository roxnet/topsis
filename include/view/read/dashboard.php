<?php
   //session_start();
    $username=$_SESSION['username'];
    $hak_akses=$_SESSION['hak_akses'];
    $cek_user=("SELECT user_name,hak_akses FROM user WHERE user_name ='$username' AND hak_akses=$hak_akses");
	$hasil = mysqli_query($db_link,$cek_user);
	if (!$hasil){
	die("Gagal Query Data User ");}
	$data=mysqli_fetch_array($hasil);
?>
<div class="col-sm-9 col-sm-offset-3">  
<h1 class="text-center">
<br /><br />

<b>SELAMAT DATANG</b><br /><br />
<span style='color:blue'>
<?php echo $data['user_name'];?>  </span> Anda Login Sebagai 
<span style='color:blue'>
<?php 
if ($data['hak_akses']=='0') {echo 'Admin';} 
if ($data['hak_akses']=='1') {echo 'Manajer';} 
if ($data['hak_akses']=='2') {echo 'HRD';} 
if ($data['hak_akses']=='3') {echo 'Koordinator';} 
if ($data['hak_akses']=='4') {echo 'Karyawan';} 
?>
</span>

 <br /> <br />
<b>DI APLIKASI PEMILIHAN PEGAWAI TERBAIK <br />
PAMELLA SUPERMARKET YOGYAKARTA</b>
</h1>
</div>
