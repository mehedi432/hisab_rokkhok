<?php
include_once 'database.php';

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

$id = $_POST['productId'];
$delete = $pdo->prepare("delete from products where prod_id=$id");

if ($delete->execute()) {
    echo 'Product deleted successfully';
} else {
    echo 'Product is not deleted';
}
