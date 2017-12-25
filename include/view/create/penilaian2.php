 <?php
    include_once "../../../koneksi.php";
    $id_jabatan=$_GET['id_jabatan'];
    $kriteria=("SELECT DISTINCT DD.id_detailbobot,D.nama_kriteria FROM bagian A
                INNER JOIN jabatan_pegawai B ON A.id_bagian=B.id_bagian
                INNER JOIN bobot_penilaian C ON A.id_bagian=C.id_bagian AND B.jabatan=C.jabatan
                INNER JOIN detail_bobot DD On C.id_bobot=DD.id_bobot
                INNER JOIN kriteria D ON DD.id_kriteria=D.id_kriteria 
                WHERE B.id_jabatan='".$id_jabatan."'
                AND C.status=1");
    $kriteria_query = mysqli_query($db_link,$kriteria);
    echo mysqli_error($db_link);
    $b=1;
    while ($kriteria_tampil=mysqli_fetch_assoc($kriteria_query)){
        echo '
            <div class="form-group">
            <label class="control-label col-sm-4 col-sm-offset-1" for="bobot">'.$kriteria_tampil["nama_kriteria"].' : </label>
            <div class="col-sm-3" >
                <input type="hidden" class="form-control" id="bobot" name="bobot'.$b.'" value="'.$kriteria_tampil["id_detailbobot"].'" >
                <input type="text" class="form-control" id="penilaian" name="penilaian'.$b.'" placeholder="PENILAIAN" >
            </div>
        </div>   ';
    $b++;
    }

?>
<script src="../vendor/jquery/jquery.min.js"></script>
<script>
   var penilaiancount=<?php echo $b; ?>;
          

</script>