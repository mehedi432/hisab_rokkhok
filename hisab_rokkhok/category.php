<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';

// Create category to database
if (isset($_POST['btnsave'])) {
    $category = $_POST['category_input'];

    if (empty($category)) {
        $error = '<script type=text/javascript>
        jQuery(function validation () {
            swal({
                title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Field empty",
                text: "Created a category",
                icon: "error",
                button: "So, sad!",
            });
        });
    </script>';

        echo $error;
    }

    if (!isset($error)) {
        $query = $pdo->prepare('insert into tbl_category(category) values(:category)');
        $query->bindParam(':category', $category);

        if ($query->execute()) {
            '<script type=text/javascript>
        jQuery(function validation () {
            swal({
                title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Category added successfully",
                text: "Created a user",
                icon: "success",
                button: "WOW!",
            });
        });
    </script>';

        } else {
            echo '<script type=text/javascript>
            jQuery(function validation () {
                swal({
                    title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Insertion failed",
                    text: "45",
                    icon: "error",
                    button: "WOW!",
                });
            });
        </script>';
        }
    }
}

// Update a category
if (isset($_POST['update'])) {
    $edit_category = $_POST['category_edit_input'];
    $cat_id = $_POST['category_id'];

    if (empty($edit_category)) {
        $error = '<script type=text/javascript>
        jQuery(function validation () {
            swal({
                title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Field empty",
                text: "Created a category",
                icon: "error",
                button: "So, sad!",
            });
        });
    </script>';

        echo $error;
    }

    if (!isset($error)) {
        $query = $pdo->prepare("update tbl_category set category='$edit_category' where cat_id='$cat_id'");
        $query->bindParam(':category', $edit_category);

        if ($query->execute()) {
            '<script type=text/javascript>
        jQuery(function validation () {
            swal({
                title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Category edited successfully",
                text: "Created a user",
                icon: "success",
                button: "WOW!",
            });
        });
    </script>';

        } else {
            echo '<script type=text/javascript>
            jQuery(function validation () {
                swal({
                    title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Insertion failed",
                    text: "45",
                    icon: "error",
                    button: "WOW!",
                });
            });
        </script>';
        }
    }
}

// Delete a category
if (isset($_POST['deletebtn'])) {

    $query = $pdo->prepare("delete from tbl_category where cat_id=" . $_POST['deletebtn']);

    if ($query->execute()) {
        echo '<script type=text/javascript>
    jQuery(function validation () {
        swal({
            title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Delete a category",
            text: "A category is deleted successfully",
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

    <!-- Main content -->
    <div class="container mt-3">
        <div class="card card-outline card-primary shadow">
            <div class="card-header text-center">
                <h3 class="card-title ">Edit a category</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form role="form" action="" method="POST">

<?php

?>

<?php
if (isset($_POST['editbtn'])) {
    $query = $pdo->prepare("select * from tbl_category where cat_id=" . $_POST['editbtn']);
    $query->execute();

    if ($query) {
        $row = $query->fetch(PDO::FETCH_OBJ);
        echo '
        <!-- form start -->
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" value="' . $row->cat_id . '" placeholder="Category id" name="category_id">
                </div>
                <div class="form-group">
                    <label for="name">Update category</label>
                    <input type="text" class="form-control" value="' . $row->category . '" placeholder="Edit name" name="category_edit_input">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-outline-primary" name="update">Update</button>
            </div>
        </div>';
    }

} else {
    $query = $pdo->prepare("select * from tbl_category");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);

    echo '
    <!-- form start -->
        <div class="card-body">
            <input type="hidden" class="form-control" value="' . $row->cat_id . '" placeholder="Category id" name="category_id">
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" class="form-control" id="" placeholder="Category name" name="category_input">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-block btn-outline-primary" name="btnsave">Save</button>
        </div>
    </div>';
}

?>


                    <div class="col-md-8">
                        <div class="container mt-2">
                        <table id="tablecategory" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                                <tbody>
        <?php
$query = $pdo->prepare("select * from tbl_category order by cat_id desc");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo '
                                        <tr>
                                            <td>' . $row->cat_id . '</td>
                                            <td>' . $row->category . '</td>
                                            <td>
                                                <button type="submit" value=' . $row->cat_id . ' class="btn btn-danger" name="editbtn"><i class="fa fa-edit"></i></button>
                                            </td>
                                            <td>
                                                <button type="submit" value=' . $row->cat_id . ' class="btn btn-danger" name="deletebtn"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    ';
}
?>
                                </tbody>
                            </table>
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

  <!-- <script>
      $(document).ready( function () {
        $('#tablecategory').DataTable();
        }
    );
  </script> -->

<?php include_once "include/footer_dashboard.php"?>