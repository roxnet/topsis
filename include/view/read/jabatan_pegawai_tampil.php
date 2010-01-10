<div class="col-sm-11 col-sm-offset-2">  
	<h2 class="text-center">DAFTAR JABATAN PEGAWAI</h2> 
	<div class="panel-group">
	<div class="panel panel-default" style="padding:10px">
            <div class="col-sm-3 input-group pull-right">
         <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" class="form-control" id="nama" placeholder="Search">
        <span class="input-group-btn">
        <button id="showall" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-align-justify"></i></button>
        </span>
        </div>
        <br/><br/>
		<div class="panel panel-default">
			<table class="table table-bordered table-hover text-center panel panel-primary">
				<thead class="panel-heading">
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">NO PEGAWAI</th>
						<th class="text-center">NAMA PEGAWAI</th>
						<th class="text-center">TOKO</th>
						<th class="text-center">BAGIAN</th>
						<th class="text-center">JABATAN</th>
						<th class="text-center">MULAI TUGAS</th>
						<th class="text-center">STATUS</th>
						<th class="text-center">AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php /*php pembuka tabel atas*/
							$sql = "SELECT A.id_jabatan,B.no_pegawai,B.nama,C.nama_toko,D.bagian,A.jabatan,A.tgl_jabat,A.Status
                                    FROM jabatan_pegawai A
                                    INNER JOIN pegawai B ON A.id_pegawai=B.no_pegawai
                                    INNER JOIN toko C ON A.id_toko=C.id_toko
                                    INNER JOIN bagian D ON A.id_bagian=D.id_bagian 
										LEFT JOIN user bb ON b.no_pegawai=bb.id_pegawai
										WHERE  A.id_toko=
							CASE WHEN $hak_akses=3 THEN
							(SELECT  id_toko FROM jabatan_pegawai a 
							INNER JOIN pegawai b ON a.id_pegawai=b.no_pegawai
							INNER JOIN user c ON b.no_pegawai=c.id_pegawai
							WHERE c.user_name='$username' limit 1)  
							ELSE A.id_toko END
							AND A.id_bagian=
							CASE WHEN $hak_akses=3 THEN(SELECT  id_bagian FROM jabatan_pegawai a 
							INNER JOIN pegawai b ON a.id_pegawai=b.no_pegawai
							INNER JOIN user c ON b.no_pegawai=c.id_pegawai
							WHERE c.user_name='$username' limit 1)
							ELSE A.id_bagian END
							AND 1= CASE WHEN $hak_akses<>4 THEN 1
WHEN $hak_akses=4 AND bb.user_name='$username' THEN 1
ELSE 0 END
                                AND A.Status=1 ORDER BY B.no_pegawai";
							$hasil = mysqli_query($db_link,$sql);
							if (!$hasil){
							die(mysqli_error($db_link));}
							
							$no=1;
							while ($data=mysqli_fetch_array($hasil)) {
							echo "<tr>";
                            echo "  <td>$no</td>
									<td>{$data['no_pegawai']}</td>
                                    <td>{$data['nama']}</td>
									<td>".$data['nama_toko']."</td>
									<td>{$data['bagian']}</td>
									<td>";
									echo ucwords($data['jabatan']); 
									echo "</td>
									<td>".date("d-m-Y", strtotime($data['tgl_jabat']))."</td>
									<td>";
               							if ($data['Status']==1) echo "Aktif"; else echo "Non Aktif";
        							echo "</td>
									<td>";
									 if($hak_akses==0 || $hak_akses==2){
										echo "<a class='btn btn-primary ubah' ref='".$data['id_jabatan']."'>Ubah</a>
										<a class='btn btn-danger hapus' ref='".$data['id_jabatan']."' nama='".$data['nama']."'>Hapus</a>&nbsp;";
									}
                                  		
                                   echo" </td>";
							echo "</tr>";
							$no++;
						}
					?>
				</tbody>
			</table>
						<hr style="height:2px; border:none;margin:0; color:#000; background-color:#428bca;">
			<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12">
						<?php
						 if($hak_akses==0 || $hak_akses==2  ){
							echo '<button type="button" id="tambah" class="btn btn-success">TAMBAH JABATAN PEGAWAI</button>';
						}
						?>
						<button class="btn btn-primary hidden-print" onclick="printJS('../pdf/print_jabatan_pegawai.php')">
						<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
	
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {
        $("#tambah").click(function () {
           		window.location.replace("index.php?navigasi=jabatan_pegawai&crud=tambah");
          });
		
		$('.ubah').click(function() {
				var id_jabatan=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=jabatan_pegawai&crud=edit&id_jabatan="+id_jabatan);
		});

		$('.hapus').click(function() {
    		var id_jabatan =$(this).attr('ref');
			var nama=$(this).attr('nama');
			 if (confirm('Yakin menghapus Jabatan Pegawai '+nama+'????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_jabatan_pegawai.php",
					data: 'crud=hapus&id_jabatan='+id_jabatan,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Jabatan Pegawai Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Jabatan Pegawai Gagal Dihapus");
								$("#gagal").show();
								setTimeout(function(){
									$("#gagal").hide(); 
									window.location.reload(1);
								}, 2000);
							
						}
					}
					});
			 }
			
		});

        var $rows = $('tbody tr');
     $rows.show().filter(function() {
    $("tr:contains('Non')").hide();
     }).hide();

    $('tbody tr:visible').each(function (i) {
   $(" td:first", this).html(i+1);
    });

    $('#showall').click(function() {
    $("tr:contains('Non')").toggle();
    $('tbody tr:visible').each(function (i) {
   $(" td:first", this).html(i+1);
    });
    });

    var $rows = $('tbody tr:visible');
$('#nama').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
	 });
</script>