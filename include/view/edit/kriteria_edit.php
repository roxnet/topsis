<?php
  $id_kriteria=$_GET['id_kriteria'];
  $edit=("select * from kriteria where id_kriteria='$id_kriteria'");
  $hasil = mysqli_query($db_link,$edit);
  $row=mysqli_fetch_array($hasil);
?>

<div class="col-sm-6 col-sm-offset-4">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">UBAH KRITERIA</h2></div>
                <div class="panel-body">
               <form class="form-horizontal">
                    <div class="form-group" >
                      <label class="control-label col-sm-3" for="id_kriteria">ID Kriteria :</label>
                      <div class="col-sm-8">
                      <input type="text" class="form-control" id="id_kriteria" name="id_kriteria" placeholder="Id Kriteria" value="<?php echo $row['id_kriteria'];?>" readonly/>
                      </div>
                    </div>
                    <div class="form-group" id="id_group">
                        <label class="control-label col-sm-3" for="name">Nama Kriteria : </label>
                         <div class="col-sm-8">
                            <input class="form-control" id="nama_kriteria" type="text" name="nama_kriteria" value="<?php echo $row['nama_kriteria'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="atribut">Atribut :</label>
                        <div class="col-sm-8"> 
                          <select  class="form-control" id="atribut" name="atribut">
                              <option value="K" <?php if ($row['atribut']=='K') echo "selected='selected'";?>>Keuntungan</option>  
                            <option value="B" <?php if ($row['atribut']=='B') echo "selected='selected'";?>>Biaya</option>
                          </select>
                        </div>
                    </div>
                </form>
             </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
					<button type="button" id="simpan" class="btn btn-success">SIMPAN</button>
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=kriteria&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
 $(document).ready(function () {
          $("#simpan").click(function () {
            var id_kriteria = $('input[name=id_kriteria]').val();
            var nama_kriteria = $('input[name=nama_kriteria]').val();
            var atribut= $('select[name=atribut]').val();
           if (nama_kriteria=='' || nama_kriteria==null) {

                $("#id_group").addClass("form-group has-error has-feedback");
                $("#nama_kriteria").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Nama Kriteria Tidak Boleh Kosong");
                  $("#required").show();
                }
            else{
            $.ajax({
                type: "POST",
                url: "../include/kontrol/kontrol_kriteria.php",
                data: 'crud=update&id_kriteria=' + id_kriteria + '&nama_kriteria='+nama_kriteria+'&atribut='+atribut,
                success: function (respons) {
                    if (respons=='berhasil'){
                            $('#pesan_berhasil').text("Kriteria Berhasil Dirubah");
                            $("#hasil").show();
                            setTimeout(function(){
                                $("#hasil").hide(); 
                            }, 2000);
                    }
                    else {
                            $('#pesan_gagal').text("Kriteria Gagal Dirubah");
                            $("#gagal").show();
                            setTimeout(function(){
                                $("#gagal").hide(); 
                            }, 2000);

                    }
                }
            });
            }
          });
      });
</script>
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">