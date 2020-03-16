<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}
include_once 'include/header_dashboard.php';

// Delete a product from database
if (isset($_POST['deletebtn'])) {

    $query = $pdo->prepare("delete from products where prod_id=" . $_POST['deletebtn']);

    if ($query->execute()) {
        echo '<script type=text/javascript>
    jQuery(function validation () {
        swal({
            title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Delete a Product",
            text: "A product is deleted successfully",
            icon: "success",
            button: "Congratulations!",
        });
    });
</script>';
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="container">
        <div class="card card-outline card-primary shadow">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST">
                        <div class="container mb-3">
                            <table id="productlist" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Purchase</th>
                                        <th>Sell</th>
                                        <th>Description</th>

                                        <th>Show</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                    <tbody>
    <?php
$query = $pdo->prepare("select * from products order by prod_id desc");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_OBJ)) {

    echo '
                                            <tr>
                                                <td>' . $row->prod_id . '</td>
                                                <td>' . $row->name . '</td>
                                                <td>' . $row->category . '</td>
                                                <td>' . $row->stock . '</td>
                                                <td>' . $row->purchase_price . '</td>
                                                <td>' . $row->selling_price . '</td>
                                                <td>' . $row->prod_description . '</td>
                                                <td>
                                                    <a href="productview.php?id=' . $row->prod_id . '" class="btn btn-primary" style="color:#fff" data-toggle="tooltip" title="View product"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <a href="productedit.php?id=' . $row->prod_id . '" class="btn btn-warning" style="color:#fff" data-toggle="tooltip" title="Edit product"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <button id=' . $row->prod_id . ' class="btn btn-danger prod_delete"  style="color:#fff" data-toggle="tooltip" title="Delete product"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        ';
}
?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Main content ends -->

</div>
<script>
    $(document).ready( function () {
        $('#productlist').DataTable({
            "order":[0,"desc"]
        });
    }
);
</script>

<script>
    $(document).ready(function () {
        $('.prod_delete').click(function () {
            // alert("Delete button is pressed");
            let tdh = $(this);
            let id = $(this).attr("id");
            // alert(id);
            $.ajax({
                url: 'productdelete.php',
                type: 'post',
                data: {
                    productId: id,
                },
                success: function(data) {
                    tdh.parents('tr').hide();
                }
            });
        });
    });
</script>

