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
                            <label class="control-label col-sm-3" for="periode">PERIODE :</label>
                            <div class="col-sm-5">
                                <div class='input-group date datetimepicker1'>
                                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Tanggal Jabat" >
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
        <div class="point">
        </div>
    </tbody>
    </table>

		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $("#tampil").click(function () {
             var periode= $('select[name=periode]').val();
            var id_toko= $('select[name=toko]').val();
            var jabatan= $('select[name=jabatan]').val();
            var id_bagian= $('select[name=bagian]').val();
            var jum_terbaik= $('input[name=jumlah_terbaik]').val();
           	$.ajax({
					type: "POST",
					url: "../include/view/read/usulan_terbaik2.php",
					data: 'periode='+periode+'&id_toko='+id_toko+'&jabatan='+jabatan+'&id_bagian='+id_bagian+'&jum_terbaik='+jum_terbaik,
					success: function (respons) {
                        $('.point').html(respons);
                        
                    }
               });
        });
        $(function () {
                $('.datetimepicker1').datetimepicker({
                viewMode: 'years',
                format: 'DD/MM/YYYY'
            }
                );
            });
     });
</script>