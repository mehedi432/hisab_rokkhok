<?php
include_once "database.php";
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'admin') {
    header("location:login.php");
}

include_once 'include/header_user.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$_SESSION['role']?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="user_dashboard.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="#">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <pre>
    <?php echo $_SESSION['email'] . " " .
    $_SESSION['role']; ?>
    </pre>
    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once "include/aside.php"?>
<?php include_once "include/footer_dashboard.php"?>