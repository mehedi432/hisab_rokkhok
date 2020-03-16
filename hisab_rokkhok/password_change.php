

<?php
include_once 'database.php';
session_start();

if ($_SESSION['email'] == "") {
    header('location:login.php');
}

if ($_SESSION['role'] == 'admin') {
    include_once 'include/header_dashboard.php';
} else {
    include_once 'include/header_user.php';
}

/**
 * For updating password
1. Fetch current user input data and store in local variable
2. get database record according to useremail
3. compare userinput and database value
4. if comaped result is true than update password or change passwors
 */

// 1. Fetch current user input data and store in local variable
if (isset($_POST['update_password'])) {
    $input_old_password = $_POST['old_password'];
    $input_new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_password'];

    // echo ($input_new_password . " " . $confirm_new_password);

    // 2. get database record according to useremail
    $email = $_SESSION['email'];
    $select = $pdo->prepare("select * from users where email='$email'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    $db_email = $row['email'];
    $db_password = $row['password'];

    // 3. compare userinput and database value
    if ($input_old_password == $db_password) {

        // 4. if comaped result is true than update password or change passwors
        if ($input_new_password == $confirm_new_password) {
            $update_query = $pdo->prepare("update users set password=:pass where email=:email");

            $update_query->bindParam(':pass', $input_new_password);
            $update_query->bindParam(':email', $email);

            if ($update_query->execute()) {
                echo '<script type=text/javascript>
                jQuery(function validation () {
                    swal({
                        title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Password matched and Changed",
                        text: "Password matched and changed",
                        icon: "success",
                        button: "Sound Good",
                    });
                });
            </script>';
            } else {
                echo '<script type=text/javascript>
                jQuery(function validation () {
                    swal({
                        title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Password not updated",
                        text: "Password is not updated",
                        icon: "error",
                        button: "Sorry",
                    });
                });
            </script>';
            }
        } else {
            echo '<script type=text/javascript>
            jQuery(function validation () {
                swal({
                    title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Password is not changed",
                    text: "Password is not changing",
                    icon: "error",
                    button: "Okay",
                });
            });
        </script>';
        }
    } else {
        echo '<script type=text/javascript>
        jQuery(function validation () {
            swal({
                title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Changing password",
                text: "You are going to change password",
                icon: "warning",
                button: "Okay",
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">পাসওয়ার্ড পরিবর্তন করুন</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">হোম</a></li>
                        <li class="breadcrumb-item active"><a href="password_change.php">পাসওয়ার্ড পরিবর্তন</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container">
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <h3 class="card-title ">পাসওয়ার্ড পরিবর্তন করেন</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="prev-password">পূর্ববর্তী পাসওয়ার্ড </label>
                        <input type="int" class="form-control" id="" placeholder="পূর্বের পাসওয়ার্ড দেন " name="old_password" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">নতুন পাসওয়ার্ড </label>
                        <input type="password" class="form-control" id="" placeholder="নতুন পাসওয়ার্ড " name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">পাসওয়ার্ড কনফার্ম করেন  </label>
                        <input type="password" class="form-control" id="" placeholder="পাসওয়ার্ড কনফার্ম করেন" name="confirm_password" required>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-outline-danger" name="update_password">পরিবর্তন করুন </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Main content ends -->
    <!-- /.content -->
</div>

  <!-- Control Sidebar -->
  <?php include_once "include/aside.php"?>

  <!-- /.control-sidebar -->

<?php include_once "include/footer_dashboard.php"?>