<?php
include_once "../../koneksi.php";

if( isset($_POST['no_pegawai']) ||
    isset($_POST['nama_pegawai']) ||
    isset($_POST['tempat_lahir']) ||
    isset($_POST['tanggal_lahir']) ||
    isset($_POST['jekel']) ||
    isset($_POST['agama']) ||
    isset($_POST['status']) ||
    isset($_POST['no_telp']) ||
    isset($_POST['alamat']) ||
    isset($_POST['tanggal_masuk'])){



    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $no_pegawai=$_POST['no_pegawai'];
            $nama_pegawai=$_POST['nama_pegawai'];
            $tempat_lahir=$_POST['tempat_lahir'];
            $tanggal_lahir=$_POST['tanggal_lahir'];
            $jekel=$_POST['jekel'];
            $agama=$_POST['agama'];
            $status=$_POST['status'];
            $no_telp=$_POST['no_telp'];
            $alamat=$_POST['alamat'];
            $tanggal_masuk=$_POST['tanggal_masuk'];
            $proses="UPDATE pegawai SET nama='$nama_pegawai',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir=STR_TO_DATE('".$tanggal_lahir."', '%d/%m/%Y'),
                jekel='$jekel',
                agama='$agama',
                status_perkawinan='$status',
                no_telp='$no_telp',
                alamat='$alamat',
                tgl_masuk=STR_TO_DATE('".$tanggal_masuk."', '%d/%m/%Y') WHERE no_pegawai='$no_pegawai'";
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
             $no_pegawai=$_POST['no_pegawai'];
            $nama_pegawai=$_POST['nama_pegawai'];
            $tempat_lahir=$_POST['tempat_lahir'];
            $tanggal_lahir=$_POST['tanggal_lahir'];
            $jekel=$_POST['jekel'];
            $agama=$_POST['agama'];
            $status=$_POST['status'];
            $no_telp=$_POST['no_telp'];
            $alamat=$_POST['alamat'];
            $tanggal_masuk=$_POST['tanggal_masuk'];
            $sql = "INSERT INTO pegawai (no_pegawai,
                nama,
                tempat_lahir,
                tanggal_lahir,
                jekel,
                agama,
                status_perkawinan,
                no_telp,
                alamat,
                tgl_masuk)
                    VALUES ('$no_pegawai','$nama',
                    '$tempat_lahir',
                    STR_TO_DATE('".$tanggal_lahir."', '%d/%m/%Y'),
                    '$jekel',
                    '$agama',
                    '$status',
                    '$no_telp',
                    '$alamat',
                    STR_TO_DATE('".$tanggal_masuk."', '%d/%m/%Y')) ";
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
           $no_pegawai = $_POST['no_pegawai'];
            $sql = "DELETE from pegawai where id_pegawai='$no_pegawai'";
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
