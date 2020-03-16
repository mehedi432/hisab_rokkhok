
<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';?>

<div class="content-wrapper">
    <!-- Main content -->
    <div class="container mt-3">
        <div class="card shadow card-outline card-dark">
            <div class="card-header card-title text-center">
                Create Order
            </div>

            <div class="card-body">
                <form class="form-group" action="" method="get">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="order_date">Order Date</label>
                            <input class="form-control" type="date" id="datemin" name="datemin" min="2000-01-02" name="order_date">
                        </div>
                        <div class="col-md-2">
                            <label for="delivery_date">Delivery Date</label>
                            <input class="form-control" type="date" id="datemin" name="datemin" min="2000-01-02" name="delivery_date">
                        </div>

                        <div class="col-md-2">
                            <label for="order_date">Area</label>
                            <select class="form-control"><option>Area</option></select>
                        </div>

                        <div class="col-md-6">
                            <label for="order_date">Shop name</label>
                            <input type='text' class="form-control" placeholder="Shop Name">
                        </div>

                        <div class="col-md-12 mt-3">
                            <table id="producttable" class="table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#Number</th>
                                        <th>Products</th>
                                        <th>Trade Price</th>
                                        <th>Order Piece</th>
                                        <th>Trade Offer</th>
                                        <th>Total Taka</th>
                                        <th><button type="button" id='' class="btn btn-sm add_order"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Taka</span>
                                </div>
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Trade Offer</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Trade offer">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Grant Total</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Grant Total">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-outline-dark" name="create_order">Create Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- main content ends here -->
  <!-- /.content-wrapper -->

  <script>
      $(document).ready(function() {
          $(document).on('click', '.add_order', function () {

            var html = "";
            html = html+'<tr>';

            html = html + '<td><input type="hidden" class="form-control prod_id" name="productid[]" ></td>';
            html = html + '<td><select class=" form-group form-control prod_id"><option value="">Products</option></select></td>';
            html = html + '<td><input type="text" class="form-control prod_price" name="productprice[]" readonly></td>';
            html = html + '<td><input type="number" min(0) class="form-control order_piece" name="orderpiece[]"></td>';
            html = html + '<td><input type="text" class="form-control trade_offer" name="tradeoffer[]" readonly></td>';
            html = html + '<td><input type="text" class="form-control total_taka" name="totaltaka[]" readonly></td>';
            html = html + '<td><button class="btn remove_order"><i class="fa fa-minus"></i></button></td>';

            $('#producttable').append(html);
          });

          $(document).on('click', '.remove_order', function() {
            $(this).closest('tr').remove();
          });
      });
  </script>

