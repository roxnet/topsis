<?php
include_once "../../koneksi.php";

if(isset($_POST['id_bobot'])|| isset ($_POST['jabatan'])){


    if (isset($_POST['crud'])){
        if($_POST['crud']=='update'){
            $count=$_POST['count'];
            $id_bobot=$_POST['id_bobot'];
            $bagian=$_POST['bagian'];
            $jabatan=$_POST['jabatan'];
            $b=1;
            $kriteria=array();
            $bobot=array();

                 $proses="UPDATE bobot_penilaian SET jabatan='".$jabatan."' 
                 WHERE id_bagian='$bagian' AND id_bobot=$id_bobot";
            $hasil = mysqli_query($db_link,$proses);


            $nilai=NULL;
            while($b<=$count){
                $kriteria[]=$_POST["kriteria$b"];
                $bobot[]=$_POST["bobot$b"];
               $cek_kriteria=" INSERT INTO detail_bobot (id_bobot,id_kriteria)
                    SELECT * FROM (SELECT ".$id_bobot." aa,'".$kriteria[$b-1]."' cc,) AS Temp
                     WHERE NOT EXISTS (SELECT * FROM detail_bobot WHERE id_bobot=$id_bobot AND id_kriteria='".$kriteria[$b-1]."')
                ";
               mysqli_query($db_link,$cek_kriteria);

                $detail_bobot="UPDATE detail_bobot SET bobot=".$bobot[$b-1]."
                 WHERE id_bobot=$id_bobot AND id_kriteria='".$kriteria[$b-1]."'";
            $hasil = mysqli_query($db_link,$detail_bobot);
                $b++;
            }
            $c=1; 
            while($c<=$count){
                $kriteriaa[]=$_POST["kriteria$c"];
                $bobott[]=$_POST["bobot$c"];
            $akumulasi_hitung=mysqli_query($db_link,"SELECT (".$bobott[$c-1]."/SUM(B.bobot))*100 hitung FROM bobot_penilaian A
                            INNER JOIN detail_bobot B ON A.id_bobot=B.id_bobot
                                WHERE   A.id_bobot=".$id_bobot."");
                $hasil_hitung=mysqli_fetch_assoc($akumulasi_hitung);

                $sql_akumulasi="UPDATE detail_bobot SET akumulasi=".$hasil_hitung['hitung']." WHERE id_bobot=".$id_bobot." AND id_kriteria='".$kriteriaa[$c-1]."'
                AND bobot=".$bobott[$c-1]."";
                $akumulasi=mysqli_query($db_link,$sql_akumulasi);
                $c++;
            }
            if($akumulasi){
                echo "berhasil";
            }
            else{
                echo "gagal";
               echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='tambah'){
            $count=$_POST['count'];
            $bagian=$_POST['bagian'];
            $jabatan=$_POST['jabatan'];
            $b=1;
            $kriteria=array();
            $bobot=array();
            $nilai=NULL;
             $update=mysqli_query($db_link,"UPDATE bobot_penilaian SET status=0 WHERE id_bagian='".$bagian."' AND jabatan='".$jabatan."' ");

             $sql = "INSERT INTO bobot_penilaian (id_bagian,jabatan,status)
                    VALUES ('".$bagian."','".$jabatan."',1) ";
            $hasil = mysqli_query($db_link,$sql); 
            $id_bobot=mysqli_insert_id($db_link);

            while($b<=$count){
                $kriteria[]=$_POST["kriteria$b"];
                $bobot[]=$_POST["bobot$b"];
                 $detail_bobot = "INSERT INTO detail_bobot (id_bobot,bobot,id_kriteria)
                    VALUES (".$id_bobot.",".$bobot[$b-1].",'".$kriteria[$b-1]."') ";
                     mysqli_query($db_link,$detail_bobot); 
                $b++;
            }
            $c=1;
              while($c<=$count){
                $kriteriaa[]=$_POST["kriteria$c"];
                $bobott[]=$_POST["bobot$c"];
             $akumulasi_hitung=mysqli_query($db_link,"SELECT (".$bobott[$c-1]."/SUM(B.bobot))*100 hitung FROM bobot_penilaian A
             INNER JOIN detail_bobot B ON A.id_bobot=B.id_bobot 
             WHERE B.id_bobot=".$id_bobot." ");
                $hasil_hitung=mysqli_fetch_assoc($akumulasi_hitung);
                $sql_akumulasi="UPDATE detail_bobot SET akumulasi=".$hasil_hitung['hitung']." WHERE id_bobot=".$id_bobot."
                 AND id_kriteria='".$kriteriaa[$c-1]."'";
                $akumulasi=mysqli_query($db_link,$sql_akumulasi);
                $c++;
              }
            
            if ($akumulasi) {
                echo "berhasil";
            } 
            else {
                echo "gagal";
                echo mysqli_error($db_link);
            }
        }

        if($_POST['crud']=='hapus'){
<<<<<<< HEAD
           $id_bagian = $_POST['id_bagian'];
           $jabatan= $_POST['jabatan'];
            $sql = "DELETE FROM bobot_penilaian WHERE id_bagian='".$id_bagian."' AND jabatan='".$jabatan."'";
=======
           $id_bobot = $_POST['id_bobot'];
         
           $sql = "DELETE from detail_bobot where id_bobot=$id_bobot";
            $hasil = mysqli_query($db_link,$sql);
            $sql = "DELETE from bobot_penilaian where id_bobot=$id_bobot";
>>>>>>> fc803ec1fed62d052695cdca5c18dbd6c1032789
            $hasil = mysqli_query($db_link,$sql);
            if($hasil){
                
                 echo "berhasil";
            }
            else{
             echo "gagal";
                echo mysqli_error();
            }
        }
    }
}
?>
