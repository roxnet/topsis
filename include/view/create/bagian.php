
<script language="JavaScript" type="text/javascript">
    function cek(){
   	if(submit.bagian.value==""){
    alert ("Nama Bagian tidak boleh kosong");
    submit.bagian.focus()
    return false
    }
    return true
    }
    </script>
<!--tidak boleh kosong-->



<script language="javascript">
    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else if (e) {
         key = e.which;
     } else return true;
  
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
   
    function huruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
    }
</script>

<div class="col-sm-6 col-sm-offset-4">  
<h2 class="text-center">INPUT DATA BAGIAN</h2> 
    <div class="panel-group">
        <div class="panel panel-default" style="padding:10px">


<?php
$query = "SELECT max(id_bagian) as maxKode FROM bagian";
$hasil = mysqli_query($db_link,$query);
$data  = mysqli_fetch_array($hasil);
$kodeBarang = $data['maxKode'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "B-";
$newID = $char . sprintf("%04s", $noUrut);
?>


<form class="form-default panel panel-default" onsubmit="return cek()" >
 <div class="form-group">

  <label class="control-label " for="name">ID Bagian :</label>
  <td> <input class="form-control" type="text" name="id_bagian" disabled autocomplete="off" size="8" value="<?php echo $newID;?>"/>
  		<input type="hidden" name="id_bagian" autocomplete="off" value="<?php echo $newID;?>"/>
  </tr>
  
  <tr>
  <label class="control-label " for="name">Nama Bagian :</label>
  <input class="form-control"  type="text" name="bagian" size="30" maxlength="20"  onkeypress="return huruf(event)"></td>
 
  <td colspan="3" align="center">
  <div class="panel-heading"  style="margin:10px">
					<div class="row">
						<div class="col-sm-12 col-sm-offer-2">
							<center><button type="button" id="tambah" class="btn btn-success">SIMPAN</button>
                            <button type="button" id="cancel" onclick=" window.history.go(-1); return false;" class="btn btn-danger">CANCEL</button></center>
						</div>
					</div>
			</div>
  </tr>

</table>

</div>
</form>
     </div>
    </div>
</div>


<div id="hasil" class="alert alert-success" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Bagian Berhasil Disimpan.
</div>

<div id="gagal" class="alert alert-danger" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Gagal!</strong> Bagian Gagal Disimpan.
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
 $(document).ready(function () {
          $("#tambah").click(function () {
            var id_bagian = $('input[name=id_bagian]').val();
            var bagian = $('input[name=bagian]').val();
            $.ajax({
              type: "POST",
              url: "../include/kontrol/kontrol_bagian.php",
              data: 'crud=tambah&id_bagian=' + id_bagian + '&bagian=' + bagian,
              success: function (respons) {
                  if (respons='berhasil'){
                        $("#hasil").show(respons);setTimeout(function(){
                            $("#hasil").hide(); 
                        }, 2000);
                  }
                  else {
                        $("#gagal").show(respons);setTimeout(function(){
                            $("#gagal").hide(); 
                        }, 2000);

                  }
              }
            });
          });
      });
</script>