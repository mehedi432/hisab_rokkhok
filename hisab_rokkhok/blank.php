<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->


    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once "include/footer_dashboard.php"?>