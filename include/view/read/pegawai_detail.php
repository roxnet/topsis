 <?php
            $no_pegawai=$_GET['no_pegawai'];
            $edit=("select * from pegawai where no_pegawai='$no_pegawai'");
            $hasil = mysqli_query($db_link,$edit);
            $row=mysqli_fetch_array($hasil);
?>
<div class="col-sm-8 col-sm-offset-3">  
	<div class="panel-group">
		<div class="panel panel-primary">
            <div class="panel-heading"><h2 class="text-center">DETAIL PEGAWAI</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="no_pegawai">NO PEGAWAI : </label><?php echo $no_pegawai;?>
                        </div>
                        <div class="form-group" id="nama_group">
                            <label class="control-label col-sm-4" for="nama_pegawai">NAMA PEGAWAI :</label><?php echo $row['nama'];?>
                           
                        </div>
                        <div class="form-group" id="tempat_group">
                            <label class="control-label col-sm-4" for="tempat_lahir">TEMPAT LAHIR :</label><?php echo $row['tempat_lahir'];?>
                            
                        </div>
                        <div class="form-group" id="tgl_lhr_group">
                            <label class="control-label col-sm-4" for="tanggal_lahir">TANGGAL LAHIR :</label> <?php echo date("d-m-Y", strtotime($row['tanggal_lahir']));?>
                            
                        </div>
                        <div class="form-group" id="jekel_group">
                            <label class="control-label col-sm-4" for="jekel">JENIS KELAMIN :</label>  <?php if ($row['jekel']=='L') {echo 'Laki - laki'; }
									ELSE echo 'Perempuan';?>
                            
                        </div>
                        <div class="form-group" id="agama_group">
                            <label class="control-label col-sm-4" for="agama">AGAMA :</label>    <?php echo $row['agama'];?>  
                            
                        </div>
                        <div class="form-group" id="status_group">
                            <label class="control-label col-sm-4" for="status">STATUS PERKAWINAN :</label> <?php echo $row['status_perkawinan'];?>
                           
                        </div>
                        <div class="form-group" id="no_telp_group">
                            <label class="control-label col-sm-4" for="no_telp">NO TELPONE :</label> <?php echo $row['no_telp'];?>
                        
                        </div>
                        <div class="form-group" id="alamat_group">
                            <label class="control-label col-sm-4" for="alamat">ALAMAT :</label><?php echo $row['alamat'];?>
                           
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-4" for="tanggal_masuk">TANGGAL MASUK :</label><?php echo date("d-m-Y", strtotime($row['tgl_masuk']));?>
                           
                        </div>
                    </form>
                </div>
			<hr style="height:1px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-footer">
				<div class="text-center">	
                    <button type="button" id="cancel" onclick="window.location ='index.php?navigasi=pegawai&crud=view';" class="btn btn-danger">CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>