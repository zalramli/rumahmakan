<!doctype html>
<html lang="en">
<?php 
session_start();
include "koneksi/koneksi.php";
include "koneksi/function.php";
if (!isset($_SESSION['username_user'])) {
    header('location:index.php');
} 
// elseif ($_SESSION['akses'] != "Kasir")
// {
//     echo "<script>alert('Maaf Anda tidak berhak mengakses halaman ini')</script>";
//     echo "<script>window.history.back();</script>";
// }
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="assets/js/sweetalert.js"></script>

    <title>Warung Barokah</title>
</head>

<body>
    <?php 
                if(!isset($_GET['halaman'])) {
                        error_reporting(0);
                    }
                    // if ($_GET['halaman'] == 'dashboard') {
                    //     include "dashboard/dashboard_admin.php";
                    // }
                    // Tutup Dashboard

                    // Parsing halaman Pegawai
                    if ($_GET['halaman'] == 'kasir') {
                        include "system/transaksi/kasir/tampil.php";
                    }
                ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.mask.js"></script>


</body>

</html>