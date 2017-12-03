

  
<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {
		$('.ubah').click(function() {
				var id_bobot=$(this).attr('ref');
			 window.location.replace("index.php?navigasi=bobot_penilaian&crud=edit&id_bagian="+id_bagian);
		});

		$('.hapus').click(function() {
    		var id_bobot =$(this).attr('ref');
		
			 if (confirm('Yakin menghapus Bobot Penilaian ????')) {
					$.ajax({
					type: "POST",
					url: "../include/kontrol/kontrol_bobot_penilaian.php",
					data: 'crud=hapus&id_bagian='+id_bagian,
					success: function (respons) {
						
						console.log(respons);
						if (respons=='berhasil'){
							$('#pesan_berhasil').text("Bobot Penilaian Berhasil Dihapus");
								$("#hasil").show();
								setTimeout(function(){
									$("#hasil").hide();
									window.location.reload(1);
								}, 2000);
						}

						else {
								$('#pesan_gagal').text("Bobot Penilaian Gagal Dihapus");
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
	 });
</script>              
                   
               
			