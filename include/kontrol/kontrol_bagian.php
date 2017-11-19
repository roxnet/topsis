<?php
include_once "../../koneksi.php";


    $id_bagian=$_POST['id_bagian'];
    $bagian=$_POST['bagian'];
    if (isset($_POST['crud'])){
    if($_POST['crud']=='update'){
    
    $proses="update bagian set bagian='$bagian' where id_bagian='$id_bagian'";
    $hasil = mysqli_query($db_link,$proses);
    if($hasil){
        echo "berhasil";
    }else{
        echo "gagal";
        echo mysqli_error();
    }
    }
}
if (isset($_POST['crud'])){
    if($_POST['crud']=='tambah'){
        echo $id_bagian.$bagian;
        $sql = "insert into bagian (id_bagian, bagian)
                        values ('$id_bagian','$bagian') ";
        $hasil = mysqli_query($db_link,$sql); 
        
        if (!$hasil) {
            echo "Gagal Simpan Data bagian ";
        } else {
        echo '<script>alert("Data Bagian Berhasil di Simpan")</script>';
            echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bagian.php">';
            }


    }
}

?>
