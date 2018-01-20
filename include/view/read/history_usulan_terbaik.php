 

<div class="col-sm-10 col-xs-offset-2">  
 
	<h2 class="text-center">FILTER HISTORY PENILAIAN PEGAWAI TERBAIK</h2> 
	<div class="panel-group" >
		<div class="panel panel-default" style="padding:10px" >
            <br/>
         <form class="form-horizontal">
              <div class="form-group">
                    <label class="control-label col-sm-3" for="start">Periode Start :</label>
                    <div class="col-sm-5">
                        <div class='input-group date datetimepicker1'>
                            <input type="text" class="form-control" id="start" name="start" placeholder="Bulan" >
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
                            <input type="text" class="form-control" id="end"  name="end" placeholder="Bulan" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
           <div class="text-center">	
					<button type="button" id="tampil" class="btn btn-success">TAMPIL</button>
			</div>
            </form>
            
        </div>   <br/>
        <div class="point"></div>
	</div>
</div>


<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {
        $("#tampil").click(function () {
             var start= $('input[name=start]').val();
             var end= $('input[name=end]').val();
               if (start=='' || start==null ) {

                $("#id_group_start").addClass("form-group has-error has-feedback");
                $("#start").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Tidak Boleh Kosong");
                  $("#required").show();
                }
         if (end=='' || end==null) {

                $("#id_group_end").addClass("form-group has-error has-feedback");
                $("#end").after("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
                 $('#pesan_required').text("Tidak Boleh Kosong");
                  $("#required").show();
                }
                else {
           	$.ajax({
					type: "POST",
					url: "../include/view/read/history_usulan_terbaik2.php",
					data: 'start='+start+'&end='+end,
					success: function (respons) {
                        $('.point').html(respons);
                        
                    }
               });
                }
        });


        $(".detail").click(function () {
           		window.location.replace("index.php?navigasi=laporan_penilaian_pegawai&crud=detail");
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
  $(function () {
                $('.datetimepicker1').datetimepicker({
                viewMode: 'months',
                format: 'MM/YYYY'
            }
                );
            });
	 });
</script>



