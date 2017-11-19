<?php
if(isset($_GET['navigasi'])){
      if($_GET['navigasi']=='dasboard'){
        include_once "../view/dashboard.php";
      }
      
      if($_GET['navigasi']=='bagian'){
        if ($_GET['crud']=='view'){
          include_once "../include/view/bagian_tampil.php";
        }
        if($_GET['crud']=='edit'){
          include_once "../include/view/edit/bagian_edit.php";
        }
          if($_GET['crud']=='hapus'){
          include_once "../include/view/delete/bagian_hapus.php";
        }
         if($_GET['crud']=='tambah'){
          include_once "../include/view/create/bagian.php";
        }
      }

    };

?>