<?php
    $d=1;
    $x=array();
    $dd=1;
    //mengambil data kriteria
    $kriteria=mysqli_query($db_link,"SELECT kriteria,atribut FROM kriteria ");
    while($data_kriteria=mysqli_fetch_assoc($kriteria)){
        //per kriteria
        //masih seluruh pegawai belum ada filter
    $nilai=mysqli_query($db_link,"SELECT A.id_jabatan,A.nilai,D.bobot FROM penilaian A
                                        INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                                        INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai
                                        INNER JOIN bobot_nilai D ON A.id_bobot=D.id_bobot
                                        WHERE D.id_kriteria=".$data_kriteria['kriteria']."
                                      ORDER BY A.id_jabatan");

         
        $nilai=NULL;

        //nilai per pegawai per kriteria
        while($data_nilai=mysqli_fetch_assoc($nilai)){
                //nilai merupakan hasil pangkat
                $nilai=$nilai+pow($data_nilai['nilai'],2);   
        }
        $x[$d]=sqrt($nilai);
        $e=1;
        $ee=1;
        $y=array();
        //matrix keputusan normalisasi per kriteria
         while($data_nilai=mysqli_fetch_assoc($nilai)){
                //nilai merupakan hasil pangkat
                $y[$d][$e]=($data_nilai['nilai']/$x[$d])*$data_nilai['bobot'];   
        
         //mencari nilai Y;
        $nilai_ypositif=array();
        $nilai_ynegatif=array();
        $nilai_ypositif[$d]=0;
        $nilai_ynegatif[$d]=$y[$d][1];
        if($data_kriteria['atribut']=='K'){
            foreach ($y as $d => $val) {
                foreach ($val as $e => $value) {
                    if($value>$nilai_ypositif[$d]){
                        $nilai_ypositif[$d]=$value;
                    }
                }
            }

            foreach ($y as $d => $val) {
                foreach ($val as $e => $value) {
                    if($value<$nilai_ynegatif[$d]){
                        $nilai_ynegatif[$d]=$value;
                    }
                }
            }
        }
         $nilai_ypositif[$d]=$y[$d][1];
         $nilai_ynegatif[$d]=0;
         if($data_kriteria['atribut']=='B'){
            foreach ($y as $d => $val) {
                foreach ($val as $e => $value) {
                    if($value<$nilai_ypositif[$d]){
                        $nilai_ypositif[$d]=$value;
                    }
                }
            }

            foreach ($y as $d => $val) {
                foreach ($val as $e => $value) {
                    if($value>$nilai_ynegatif[$d]){
                        $nilai_ynegatif[$d]=$value;
                    }
                }
            }
        }

        $ee=$ee+$e;
        $e++;
        }

        
       
          
        $dd=$dd+$d;
        $d++;
    }

    //mencari nilai D;

    $d_plus=array();
    $d_minus=array();
    $zz=1;
    $nn=1;
    $d_plus[1]=NULL;
    $d_minus[1]=NULL;
    $v=array();
    while ($zz<=$ee){
        
        while($nn<=$dd){
        $d_plus[$zz]=$d_plus[$zz]+pow($nilai_dpositif[$nn]-$y[$nn][$ee],2);
        $d_minus[$zz]=$d_minus[$zz]+pow($nilai_dnegatif[$nn]-$y[$nn][$ee],2);
        $nn++;
        }
        $d_plus[$zz]=sqrt($d_plus[$zz]);
        $d_minus[$zz]=sqrt($d_minus[$zz]);
        //nilai preferensi alternatif
        $v[$zz]=$d_minus[$zz]/($d_minus[zz]-$d_plus[zz]);

        $zz++;
    }


?>