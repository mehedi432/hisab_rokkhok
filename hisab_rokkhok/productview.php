<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class=" mt-3">

    <!-- Main content -->

    <div class="container">
        <div class="card card-outline card-primary shadow mb-3">
            <div class="card-header text-center">
            <div class="card-title"><a href="productlist.php" class="btn btn-block nav-link" role="button"><i class="fa fa-arrow-left"></i>  Product List</a></div>
            </div>
            <div class="card-body ">
                <div class="row">

<?php
$id = $_GET['id'];

$query = $pdo->prepare("select * from products where prod_id=$id");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo '
<div class="col-md-6">
  <ul class="list-group">
    <center><p class="list-group-item list-group-item-primary"><b>Product Details</b></p></center>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Product ID
      <span class="badge badge-primary badge-pill">' . $row->prod_id . '</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Name
      <span class="badge badge-danger badge-pill">' . $row->name . '</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Category
      <span class="badge badge-primary badge-pill">' . $row->category . '</span>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Purchase Price
      <span class="badge badge-warning badge-pill">' . $row->purchase_price . '</span>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Selling Price
      <span class="badge badge-warning badge-pill">' . $row->selling_price . '</span>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Product profit
      <span class="badge badge-success badge-pill">' . $row->profit . '</span>
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      Stock
      <span class="badge badge-danger badge-pill">' . $row->stock . '</span>
    </li>

    <li class="list-group-item align-items-center">
      <strong>Description :- </strong> ' . $row->prod_description . '
    </li>
  </ul>
</div>


<div class="col-md-6">
  <ul class="list-group">
    <center><p class="list-group-item list-group-item-primary"><b>Product Image</b></p></center>
    <img src = "dist/img/prod-1.jpg" class="image-responsive" />
  </ul>
</div>
    ';
}
?>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once "include/footer_dashboard.php"?>