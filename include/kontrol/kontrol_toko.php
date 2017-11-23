<?php
include_once "../../koneksi.php";

if(isset($_POST['id_toko']) || isset ($_POST['nama_toko'])|| isset($_POST['alamat_toko'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_toko=$_POST['id_toko'];
            $proses="UPDATE toko SET nama_toko='$nama_toko',alamat_toko='$alamat_toko' WHERE id_toko'$id_toko'";
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
        $nama_toko=$_POST['nama_toko'];
        $alamat_toko=$_POST['alamat_toko'];
            $sql = "INSERT INTO toko (nama_toko,alamat_toko)
                    VALUES ('".$nama_toko."','".$alamat_toko."') ";
            $hasil = mysqli_query($db_link,$sql); 
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error();
            }
        }
    }
}
?>
