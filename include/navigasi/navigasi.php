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
      }

      if($_GET['navigasi']=='riwayat_pegawai'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/read/riwayat_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/riwayat_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_riwayat.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/riwayat.php";
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

      
      if($_GET['navigasi']=='bobot'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/bobot_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/bobot_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/kontrol/kontrol_bobot.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/bobot.php";
        }
      }

      
      if($_GET['navigasi']=='penilaian'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/penilaian_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/penilaian_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/view/delete/penilaian_hapus.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/penilaian.php";
        }
      }
      
    };

?>