<?php
include_once "../../koneksi.php";

if(isset($_POST['id_kriteria']) || isset ($_POST['nama_kriteria']) || isset($_POST['atribut']) ){

    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $id_kriteria=$_POST['id_kriteria'];
            $nama_kriteria=$_POST['nama_kriteria'];
            $atribut=$_POST['atribut'];
            $proses="UPDATE kriteria SET nama_kriteria='$nama_kriteria',atribut='$atribut' WHERE id_kriteria='$id_kriteria'";
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
            $id_kriteria=$_POST['id_kriteria'];
            $nama_kriteria=$_POST['nama_kriteria'];
            $atribut=$_POST['atribut'];
            $sql = "INSERT INTO kriteria (id_kriteria,nama_kriteria,atribut)
                    VALUES ('$id_kriteria','$nama_kriteria','$atribut') ";
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
           $id_kriteria = $_POST['id_kriteria'];
            $sql = "DELETE from kriteria where id_kriteria='$id_kriteria'";
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
