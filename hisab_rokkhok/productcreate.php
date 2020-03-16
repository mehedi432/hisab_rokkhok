<?php
include_once 'database.php';
session_start();
include_once 'include/header_dashboard.php';

// Create product to database
if (isset($_POST['add_product_btn'])) {

    $name = $_POST['product_input'];
    $category = $_POST['category'];
    echo $category;
    $purchase_price = $_POST['product_puchase_price_input'];
    $selling_price = $_POST['product_selling_price_input'];
    $stock = $_POST['product_stock_input'];
    $product_description = $_POST['product_description_input'];

    if (empty($name || $category || $purchase_price)) {
        echo "Field is empty";
    } else {
        $insert = $pdo->prepare('insert into products(name, category, purchase_price, selling_price, stock, prod_description)
                                               values(:name, :category, :purchase_price, :selling_price, :stock, :prod_description)');
        $insert->bindParam(':name', $name);
        $insert->bindParam(':category', $category);
        $insert->bindParam(':purchase_price', $purchase_price);
        $insert->bindParam(':selling_price', $selling_price);
        $insert->bindParam(':stock', $stock);
        $insert->bindParam(':prod_description', $product_description);

        if ($insert->execute()) {
            //     echo '<script type=text/javascript>
            //     jQuery(function validation () {
            //         swal({
            //             title: "Hei ' . $_SESSION['name'] . ' ! ' . 'A Product is added",
            //             text: "A product is added successfully",
            //             icon: "success",
            //             button: "Congratulations!",
            //         });
            //     });
            // </script>';

            echo "Successfully added a product";
        } else {
            //     echo '<script type=text/javascript>
            //     jQuery(function validation () {
            //         swal({
            //             title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Product add failed",
            //             text: "Product add failed",
            //             icon: "error",
            //             button: "Sorry!",
            //         });
            //     });
            // </script>';
            echo "Fail to add a product";

        }
    }

}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="container mt-3">
        <div class="card card-outline card-primary shadow">
            <div class="card-header">
                <div class="card-title"><a href="productlist.php" class="btn btn-block nav-link" role="button"><i class="fa fa-arrow-left"></i>  Product List</a></div>
            </div>

            <div class="container">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" placeholder="Product name" name="product_input">
                            </div>
                            <div class="form-group">
                                <label for="select_category">Category</label>
                                <select class="form-control" name="category">
                                    <option disabled selected>Select a category</option>
<?php
$query = $pdo->prepare("select * from tbl_category order by cat_id desc");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    ?>
    <option value=<?php echo $row['category'] ?>><?php echo $row['category'] ?></option>

    <?php
}
?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Purchase price</label>
                                <input type="number" min="1" step="0.01" class="form-control" placeholder="Purchase price" name="product_puchase_price_input">
                            </div>
                            <div class="form-group">
                                <label for="name">Selling price</label>
                                <input type="number" min="1" step="0.01" class="form-control" placeholder="Selling price" name="product_selling_price_input">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Stock</label>
                                <input type="number" min="1" step="1" class="form-control" placeholder="Product stocks" name="product_stock_input">
                            </div>
                            <div class="form-group">
                                <label for="name">Purchase Description</label>
                                <textarea rows="5" type="textarea" class="form-control" placeholder="Purchase Description" name="product_description_input"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="input-group" placeholder="Product stocks" name="product_image_input">
                                <p>Upload image</p>
                            </div>
                            <button type="submit" class="btn btn-block btn-outline-primary " name="add_product_btn">Add Product</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
