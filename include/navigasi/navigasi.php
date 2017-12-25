<?php
if(isset($_GET['navigasi'])){
      if($_GET['navigasi']=='dasboard'){
        include_once "../view/dashboard.php";
      }
      
      if($_GET['navigasi']=='bagian'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/bagian_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/bagian_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_bagian.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/bagian.php";
        }
      }

      if($_GET['navigasi']=='toko'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/toko_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/toko_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_toko.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/toko.php";
        }
      }

      if($_GET['navigasi']=='pegawai'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/pegawai_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/pegawai_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_pegawai.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/pegawai.php";
        }
         if($_GET['crud']=='detail'){
          include_once "../include/view/read/pegawai_detail.php";
        }
      }

      if($_GET['navigasi']=='jabatan_pegawai'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/jabatan_pegawai_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/jabatan_pegawai_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_jabatan_pegawai.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/jabatan_pegawai.php";
        }
      }

      
      if($_GET['navigasi']=='kriteria'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/kriteria_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/kriteria_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_kriteria.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/kriteria.php";
        }
      }

      
      if($_GET['navigasi']=='bobot_penilaian'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/bobot_penilaian_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/bobot_penilaian_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_bobot_penilaian.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/bobot_penilaian.php";
        }
      }

      
      if($_GET['navigasi']=='penilaian'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/penilaian_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/penilaian_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/penilaian_hapus.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/penilaian.php";
        }
      }

      if($_GET['navigasi']=='laporan_penilaian_pegawai'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/laporan_penilaian_pegawai.php";
        }
        if($_GET['crud']=='detail'){
          include_once "../include/view/read/laporan_penilaian_pegawai_detail.php";
        }
      }
       if($_GET['navigasi']=='usulan_pegawai_terbaik'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/usulan_terbaik.php";
        }
      }

      if($_GET['navigasi']=='history_usulan_pegawai_terbaik'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/history_usulan_terbaik.php";
        }
      }
	  
	  	  if($_GET['navigasi']=='user'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/user_tampil.php";
        }
       if($_GET['crud']=='edit'){
          include_once "../include/view/edit/user_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/user_hapus.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/user.php";
        }
      }
	  
    };

?>