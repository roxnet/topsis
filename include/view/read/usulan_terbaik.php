<div class="col-sm-6 col-sm-offset-4">  
<?php 
$toko=mysqli_query($db_link,"SELECT id_toko,nama_toko FROM toko");
$bag=mysqli_query($db_link,"SELECT id_bagian,bagian FROM bagian");  
?>

<h2 class="text-center">LAPORAN USULAN PEGAWAI TERBAIK</h2> 
	<div class="panel-group" >
		<div class="panel panel-default" style="padding:10px" >
            <br/>
            <form class="form-horizontal">
              <div class="form-group">
                    <label class="control-label col-sm-3" for="start">Periode Start :</label>
                    <div class="col-sm-5">
                        <div class='input-group date datetimepicker1'>
                            <input type="text" class="form-control"  name="start" placeholder="Bulan" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-sm-3" for="end">Periode End :</label>
                    <div class="col-sm-5">
                        <div class='input-group date datetimepicker1'>
                            <input type="text" class="form-control"  name="end" placeholder="Bulan" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
             <div class="form-group">
                <label class="control-label col-sm-3" for="toko">Toko : </label>
                <div class="col-sm-5">
                    <select  class="form-control" name="toko">  
                        <option value='0'>All</option>
                    <?php
                        while ($data_toko=mysqli_fetch_assoc($toko)){
                            echo "<option value='".$data_toko['id_toko']."'>".$data_toko['nama_toko']."</option>";
                        }
                    ?>
                </select> 
                </div>
            </div>
             <div class="form-group">
                <label class="control-label col-sm-3" for="jabatan">Jabatan : </label>
                <div class="col-sm-5">
                        <select  class="form-control" name="jabatan" id="jabatan">  
                        <option value="none">All</option>
                        <option value="koordinator">Koordinator</option>
                        <option value="karyawan">Karyawan</option>
                    </select> 
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="bagian">Bagian : </label>
                <div class="col-sm-5">
                    <select  class="form-control" name="bagian">  
                        <option value='none' >All</option>
                    <?php
                        while ($data_bag=mysqli_fetch_assoc($bag)){
                            echo "<option value='".$data_bag['id_bagian']."'>".$data_bag['bagian']."</option>";
                        }
                    ?>
                </select> 
                </div>
           </div>
           <div class="form-group">
                <label class="control-label col-sm-3" for="toko">Jumlah Terbaik : </label>
                <div class="col-sm-5">
                   <input type="number" name='jumlah_terbaik' class="form-control" >
                </div>
           </div>
           <div class="text-center">	
					<button type="button" id="tampil" class="btn btn-success">TAMPIL</button>
				</div>
                    
            </form>
            </div>
            <br/>
        <div class="point"></div>
    </tbody>
    </table>
                     
		</div>
      <div class="text-center"  id="show">	
    <button type="button"  id='simpan' class="btn btn-success">SIMPAN</button>
</div>
	</div>
      
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {
$('#show').hide();
        $("#tampil").click(function () {
             var start= $('input[name=start]').val();
             var end= $('input[name=end]').val();
            var id_toko= $('select[name=toko]').val();
            var jabatan= $('select[name=jabatan]').val();
            var id_bagian= $('select[name=bagian]').val();
            var jum_terbaik= $('input[name=jumlah_terbaik]').val();
           	$.ajax({
					type: "POST",
					url: "../include/view/read/usulan_terbaik2.php",
					data: 'start='+start+'&end='+end+'&id_toko='+id_toko+'&jabatan='+jabatan+'&id_bagian='+id_bagian+'&jum_terbaik='+jum_terbaik,
					success: function (respons) {
                        $('.point').html(respons);
                        $('#show').show();
                        
                    }
               });
        });
        $("#simpan").click(function () {

              penilaiancount=penilaiancount;
            var count=1;
             var no_peg=[];
            var nama_peg=[];
            var toko_kerja=[];
            var nilai_kerja=[];
            var bagian=[];
            var jabatan_peg=[];
            var tgl_rangking=[];

             var no_pegstring='';
            var nama_pegstring='';
            var toko_kerjastring='';
            var nilai_kerjastring='';
            var bagianstring='';
            var jabatan_pegstring='';
            var tgl_rangkingstring='';
        while (count<=penilaiancount){
            no_peg[count]=$('input[name=no_peg'+count+']').val();
            nama_peg[count]=$('input[name=nama_peg'+count+']').val();
            toko_kerja[count]=$('input[name=toko_kerja'+count+']').val();
            nilai_kerja[count]=$('input[name=nilai_kerja'+count+']').val();
            bagian[count]=$('input[name=bagian'+count+']').val();
            jabatan_peg[count]=$('input[name=jabatan_peg'+count+']').val();
            tgl_rangking[count]=$('input[name=tgl_rangking'+count+']').val();

            no_pegstring=no_pegstring+'&no_peg'+count+'='+no_peg[count];
            nama_pegstring=nama_pegstring+'&nama_peg'+count+'='+nama_peg[count];
            toko_kerjastring=toko_kerjastring+'&toko_kerja'+count+'='+toko_kerja[count];
            nilai_kerjastring=nilai_kerjastring+'&nilai_kerja'+count+'='+nilai_kerja[count];
            bagianstring=bagianstring+'&bagian'+count+'='+bagian[count];
            jabatan_pegstring=jabatan_pegstring+'&jabatan_peg'+count+'='+jabatan_peg[count];
            tgl_rangkingstring=tgl_rangkingstring+'&tgl_rangking'+count+'='+tgl_rangking[count];
            count++;
        }

           	$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_usulan.php",
					data: 'crud=tambah&count='+penilaiancount+
                   no_pegstring+nama_pegstring+toko_kerjastring+nilai_kerjastring+bagianstring+jabatan_pegstring+tgl_rangkingstring,
					success: function (respons) {
                         if (respons=='berhasil'){
                         $('#pesan_berhasil').text("Usulan Pegawai Berhasil Ditambah");
                        $("#hasil").show();
                        setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $('#pesan_gagal').text("Usulan Pegawai Gagal Ditambah");
                        $("#gagal").show();
                        setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
                        
                    }
               
               });    

        });

        $(function () {
                $('.datetimepicker1').datetimepicker({
                viewMode: 'months',
                format: 'MM/YYYY'
            }
                );
            });

     });
</script>