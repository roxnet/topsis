<!DOCTYPE html>
<html lang="en">
<?php
    include_once "../koneksi.php";
    include_once "../include/kontrol/cek_user.php";
    $username=$data_user['user_name'];
    $hak_akses=$data_user['hak_akses'];
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pamella Supermarket Yogyakarta</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

     <!-- Custom CSS -->
    <link href="../vendor/bootstrap/css/print.min.css"  type="text/css" media="print">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!--DatePicker -->
    <link href="../vendor/bootstrap/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body >

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Pamella Supermarket Yogyakarta</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li><center>
                        <li><button id="logout" type="button"><i class="fa fa-sign-out fa-fw"></i> Logout</button>
                        </center></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    <?php
                        if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                           echo '  
                            <li>
                                <a href="index.php?navigasi=bagian&crud=view"><i class="fa fa-table fa-fw"></i> Bagian</a>
                            </li>
                           ';

                        }
                        if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=toko&crud=view"><i class="fa fa-table fa-fw"></i> Toko</a>
                            </li>
                            ';

                        }
                      
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=kriteria&crud=view"><i class="fa fa-table fa-fw"></i> Kriteria</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=pegawai&crud=view"><i class="fa fa-table fa-fw"></i> Pegawai</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=jabatan_pegawai&crud=view"><i class="fa fa-table fa-fw"></i> Jabatan Pegawai</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=bobot_penilaian&crud=view"><i class="fa fa-table fa-fw"></i> Bobot</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=penilaian&crud=view"><i class="fa fa-table fa-fw"></i> Penilaian</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="index.php?navigasi=usulan_pegawai_terbaik&crud=view"><i class="fa fa-table fa-fw"></i>  Usulan Pegawai Terbaik</a>
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                            echo '
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Laporan Penilaian<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">';
                                if($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                                   echo ' <li>
                                        <a href="index.php?navigasi=laporan_penilaian_pegawai&crud=view">Penilain Pegawai</a>
                                    </li>';
                                }
                                if ($hak_akses==0 || $hak_akses==1 || $hak_akses==2 || $hak_akses==3 || $hak_akses==4){
                                    echo '<li>
                                        <a href="index.php?navigasi=history_usulan_pegawai_terbaik&crud=view">History Usulan Pegawai Terbaik</a>
                                    </li>';
                                }
                            echo '    </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            ';

                        }
                         if($hak_akses==0 || $hak_akses=2){
                            echo ' 
                            <li>
                            <a href="index.php?navigasi=user&crud=view"><i class="fa fa-table fa-fw"></i> User</a>
                            </li>
                            ';

                        }
                    ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->

        <div class="page-wrapper" >
            <div class="container" >
                <div class="row" >
                   
                    <!-- /.col-lg-12 -->
                <!--</div>-->
                <!-- /.row -->
                <!--<div class="row">
                    Mulai Koding
                </div>-->
                <?php
                			
                	include_once "../include/navigasi/navigasi.php";
                				
                ?>
                </div>
            </div>
            <!-- /.container-->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/bootstrap/js/print.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


<script src="../vendor/bootstrap/js/moment.js"></script>
<script src="../vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<div id="hasil" class="alert alert-success" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div id="pesan_berhasil"></div>
</div>

<div id="gagal" class="alert alert-danger" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div id="pesan_gagal"></div>
</div>
<div id="required" class="alert alert-warning" style="position: fixed;right:2%;display:none; top: 55px;width: 20%; z-index:9999">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div id="pesan_required"></div>
</div>
</body>

</html>
<script>
        $(document).ready(function () {
            $("#logout").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "../include/kontrol/login.php",
                        data: "type=logout",
                        success: function (respons) {
                            console.log(respons);
                            if (respons == 'true') {
                            
                                window.location = "login.php";
                            }
                            else {
                                $("#konfirmasi_login").html(respons);
                            }
                        }
                    })
                });
        });
    </script>