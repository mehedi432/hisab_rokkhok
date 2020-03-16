<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';

$id = $_GET['id'];
$query = $pdo->prepare("select * from products where prod_id=$id");
$query->execute();

$row = $query->fetch(PDO::FETCH_ASSOC);

print_r($row);

// Getting all database data for showing forms placeholder with previous inserted data
$id_db = $row['prod_id'];
$product_name = $row['name'];
$product_category = $row['category'];
$product_purchase_price = $row['purchase_price'];
$product_selling_price = $row['selling_price'];
$product_profit = $row['profit'];
$product_stock = $row['stock'];
$product_description = $row['prod_description'];

// Update product to database
if (isset($_POST['update_product_btn'])) {

    $name_input = $_POST['product_input'];
    $category_input = $_POST['category'];
    $purchase_input = $_POST['product_puchase_price_input'];
    $selling_input = $_POST['product_selling_price_input'];
    $stock_input = $_POST['product_stock_input'];
    $product_description_input = $_POST['product_description_input'];

    if (empty($name_input)) {
        echo "Input field can not be empty";
    } else {
        $update = $pdo->prepare("update products set name=:pname, category=:pcategory,
        purchase_price=:pprice, selling_price=:sprice, stock=:pstock,
        prod_description=:pdescription where prod_id = $id");

        $update->bindParam(':pname', $name_input);
        $update->bindParam(':pcategory', $category_input);
        $update->bindParam(':pprice', $purchase_input);
        $update->bindParam(':sprice', $selling_input);
        $update->bindParam(':pstock', $stock_input);
        $update->bindParam(':pdescription', $product_description_input);

        if ($update->execute()) {
            echo "Product updated successfully";
        } else {
            echo "Product is not updated";
        }
    }

    // Getting all database data for showing forms placeholder with previous inserted data
    $id_db = $row['prod_id'];
    $product_name = $row['name'];
    $product_category = $row['category'];
    $product_purchase_price = $row['purchase_price'];
    $product_selling_price = $row['selling_price'];
    $product_profit = $row['profit'];
    $product_stock = $row['stock'];
    $product_description = $row['prod_description'];
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
        <div class="container mt-3" >
            <div class="card shadow">
                <div style="text-align: center" class="card-header card-title">Product Edit</div>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" placeholder="<?php echo $product_name; ?>" class="form-control"  name="product_input">
                                </div>
                                <div class="form-group">
                                    <label for="select_category">Category</label>
                                    <select class="form-control" name="category">
                                        <option value="" disabled selected>Select a category</option>
    <?php
$query = $pdo->prepare("select * from products order by prod_id desc");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    ?>
        <option <?php if ($row['category'] == $product_category) {?>
            selected="selected"
        <?php }?> >
            <?php echo $row['category']; ?></option>
<?php
}
?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Purchase price</label>
                                    <input type="number" min="1" step="0.01" class="form-control" placeholder="<?php echo $product_purchase_price; ?>" name="product_puchase_price_input">
                                </div>
                                <div class="form-group">
                                    <label for="name">Selling price</label>
                                    <input type="number" min="1" step="0.01" class="form-control" placeholder="<?php echo $product_selling_price; ?>" name="product_selling_price_input">
                                </div>

                                <div class="form-group">
                                    <label for="name">Profit</label>
                                    <input type="number" min="1" step="0.01" class="form-control" placeholder="<?php echo $product_profit; ?>" name="product_selling_price_input">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Stock</label>
                                    <input type="number" min="1" step="1" class="form-control" placeholder="<?php echo $product_stock; ?>" name="product_stock_input">
                                </div>
                                <div class="form-group">
                                    <label for="name">Purchase Description</label>
                                    <textarea rows="5" type="textarea" class="form-control" placeholder="<?php echo $product_description; ?>" name="product_description_input"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" class="input-group" name="product_image_input">
                                    <p>Upload image</p>
                                </div>
                                <button type="submit" class="btn btn-block btn-outline-warning text-dark " name="update_product_btn">Update Product</button>

                            </div>
                        </div>
                    </form>
                </div>
            </dv>
        </div>

    <!-- Main content ends -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
