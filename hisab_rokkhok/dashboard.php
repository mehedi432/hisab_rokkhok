<?php
include_once "database.php";
session_start();

if ($_SESSION['email'] == "") {
    header("location:login.php");
}

include_once 'include/header_dashboard.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->




    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'include/aside.php'?>

  <?php include "include/footer_dashboard.php"?>