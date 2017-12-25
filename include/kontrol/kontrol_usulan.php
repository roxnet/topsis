<?php
include_once "../../koneksi.php";

  if (isset($_POST['crud'])){

        if($_POST['crud']=='tambah'){
           $b=1;
           $count=$_POST['count'];
           $no_peg=array();
            $nama_peg=array();
            $toko_kerja=array();
            $nilai_kerja=array();
            $bagian=array();
            $jabatan_peg=array();
            $tgl_rangking=array();
            
            while($b<=$count){
                 $no_peg[]=$_POST["no_peg$b"];
                 $nama_peg[]=$_POST["nama_peg$b"];
                 $toko_kerja[]=$_POST["toko_kerja$b"];
                 $nilai_kerja[]=$_POST["nilai_kerja$b"];
                 $bagian[]=$_POST["bagian$b"];
                 $jabatan_peg[]=$_POST["jabatan_peg$b"];
                 $tgl_rangking[]=$_POST["tgl_rangking$b"];
               $usulan="INSERT INTO usulan(no_peg,nama_peg,toko_kerja,nilai_kerja,bagian,jabatan_peg,tgl_rangking)
               VALUES ($no_peg[$b],'$nama_peg[$b]','$toko_kerja[$b]',$nilai_kerja[$b],'$bagian[$b]','$jabatan_peg[$b]',STR_TO_DATE('".$tgl_rangking[$b]."', '%d/%m/%Y'))";
                $hasil = mysqli_query($db_link,$usulan); 
                echo mysqli_error($db_link);
           $b++;
            }
        
            
            
            if ($hasil) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error(db_link);
            }
        }

        if($_POST['crud']=='hapus'){
           $id_usulan = $_POST['id_usulan'];
            $sql_delete = "DELETE from usulan where id_usulan='$id_usulan'";
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
?>
