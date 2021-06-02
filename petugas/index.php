<?php
session_start();
error_reporting(0);
include '../conn/koneksi.php';
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
} elseif ($_SESSION['level'] != "petugas") {
    header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 4.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
  ================================================================================ -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Materialize - Material Design Admin Template</title>
    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    <!-- CORE CSS-->
    <link href="../css//materialize.css" type="text/css" rel="stylesheet">
    <link href="../css//style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="../css/custom/custom.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link href="../vendors/flag-icon/css/flag-icon.min.css" type="text/css" rel="stylesheet">
</head>

<body>
    <!-- Start Page Loading -->

    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color gradient-45deg-light-blue-cyan">
                <div class="nav-wrapper">
                    <ul class="left">
                        <li>
                            <h1 class="logo-wrapper">
                                <a href="index.html" class="brand-logo darken-1">

                                    <span class="logo-text hide-on-med-and-down">Pengaduan Masyarakat</span>
                                </a>
                            </h1>
                        </li>
                    </ul>

            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">

                    <li class="no-padding">
                        <ul class="collapsible" data-collapsible="accordion">
                            <li class="bold">
                                <a href="index.php?p=dashboard" class="waves-effect waves-cyan">
                                    <i class="material-icons">pie_chart_outlined</i>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                            </li>

                            <li class="bold">
                                <a href="index.php?p=pengaduan" class="waves-effect waves-cyan">
                                    <i class="material-icons">report</i>
                                    <span class="nav-text">Pengaduan</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="index.php?p=respon" class="waves-effect waves-cyan">
                                    <i class="material-icons">chat</i>
                                    <span class="nav-text">Respon</span>
                                </a>
                            </li>

                            <li class="bold">
                                <a href="../index.php?p=logout" class="waves-effect waves-cyan">
                                    <i class="material-icons">exit_to_app</i>
                                    <span class="nav-text">Logout</span>
                                </a>
                            </li>

                            <li>

                            </li>
                        </ul>
                    </li>
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
                    <i class="material-icons">menu</i>
                </a>
            </aside>
            <!-- END LEFT SIDEBAR NAV-->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START CONTENT -->
            <section id="content">
                <!--start container-->
                <div class="container">
                    <!--card stats start-->
                    <?php
                    if (@$_GET['p'] == "") {
                        include_once 'dashboard.php';
                    } elseif (@$_GET['p'] == "dashboard") {
                        include_once 'dashboard.php';
                    } elseif (@$_GET['p'] == "pengaduan") {
                        include_once 'pengaduan.php';
                    } elseif (@$_GET['p'] == "pengaduan_hapus") {
                        $query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='" . $_GET['id_pengaduan'] . "'");
                        $data = mysqli_fetch_assoc($query);
                        unlink('../img/' . $data['foto']);
                        if ($data['status'] == "proses") {
                            $delete = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='" . $_GET['id_pengaduan'] . "'");
                            header('location:index.php?p=pengaduan');
                        } elseif ($data['status'] == "selesai") {
                            $delete = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='" . $_GET['id_pengaduan'] . "'");
                            if ($delete) {
                                $delete2 = mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_pengaduan='" . $_GET['id_pengaduan'] . "'");
                                header('location:index.php?p=pengaduan');
                            }
                        }
                    } elseif (@$_GET['p'] == "more") {
                        include_once 'more.php';
                    } elseif (@$_GET['p'] == "tanggapan") {
                        include_once 'tanggapan.php';
                    } elseif (@$_GET['p'] == "respon") {
                        include_once 'respon.php';
                    } elseif (@$_GET['p'] == "tanggapan_hapus") {

                        $query = mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_tanggapan='" . $_GET['id_tanggapan'] . "'");
                        if ($query) {
                            header('location:index.php?p=respon');
                        }
                    }
                    ?>




                    <!-- END WRAPPER -->
                </div>
                <!-- END MAIN -->
                <!-- //////////////////////////////////////////////////////////////////////////// -->
                <!-- START FOOTER -->

                <!-- END FOOTER -->
                <!-- ================================================
    Scripts
    ================================================ -->
                <!-- jQuery Library -->
                <script type="text/javascript" src="../vendors/jquery-3.2.1.min.js"></script>
                <!--materialize js-->
                <script type="text/javascript" src="../js/materialize.min.js"></script>
                <!--scrollbar-->
                <script type="text/javascript" src="../vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
                <!--plugins.js - Some Specific JS codes for Plugin Settings-->
                <script type="text/javascript" src="../js/plugins.js"></script>
                <!--custom-script.js - Add your own theme custom JS-->
                <script type="text/javascript" src="../js/custom-script.js"></script>
</body>

</html>