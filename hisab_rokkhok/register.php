<?php
include_once 'database.php';
session_start();
error_reporting(0);

if ($_SESSION['email'] == "" or $_SESSION['role'] == 'user') {
    header('location:index.php');
}

include_once 'include/header_dashboard.php';

// Delete a user
$id = $_GET['id'];
$query = $pdo->prepare("delete from users where id='$id'");

if ($query->execute()) {
    echo '<script type=text/javascript>
    jQuery(function validation () {
        swal({
            title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Delete a user",
            text: "A user is deleted successfully",
            icon: "success",
            button: "Congratulations!",
        });
    });
</script>';
}

// For storing a user in database
if (isset($_POST['store_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validating email
    if (isset($_POST['email'])) {
        $query = $pdo->prepare("select email from users where email=$email");
        $query->execute();

        if ($query->rowCount() > 0) {
            echo '<script type=text/javascript>
                jQuery(function validation () {
                    swal({
                        title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Email exist",
                        text: "Email already exist",
                        icon: "warning",
                        button: "Sorry",
                    });
                });
            </script>';
        } else {
            // Write query to insert data into database
            $query = $pdo->prepare('insert into users(name, email, password, role) values(:name, :email, :password, :role)');
            $query->bindParam(':name', $name);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':role', $role);

            if ($query->execute()) {
                echo '<script type=text/javascript>
                jQuery(function validation () {
                    swal({
                        title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Created a user",
                        text: "Created a user",
                        icon: "success",
                        button: "Congratulations!",
                    });
                });
            </script>';
            } else {
                echo '<script type=text/javascript>
                jQuery(function validation () {
                    swal({
                        title: "Hei ' . $_SESSION['name'] . ' ! ' . 'Failed to created a user",
                        text: "Failed to created a user",
                        icon: "error",
                        button: "Failed!",
                    });
                });
            </script>';
            }
        }
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="container mt-3">
        <div class="card card-outline card-primary shadow">
            <div class="card-header text-center">
                <h3 class="card-title ">ব্যবহারকারী যুক্ত করুন</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- form start -->
                    <form role="form" action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">নাম</label>
                                <input type="text" class="form-control" id="" placeholder="ব্যবহারকারীর নাম দেন" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">ইমেইল</label>
                                <input type="email" class="form-control" id="" placeholder="ব্যবহারকারীর ইমেইল দেন" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">পাসওয়ার্ড</label>
                                <input type="password" class="form-control" id="" placeholder="পাসওয়ার্ড দেন" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="select_role">ব্যবহার কারী কি হবে</label>
                                <select class="form-control" name="role">
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-outline-primary" name="store_user">Save</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-8">
                    <div class="container mt-2">
                    <table id="tablecategory" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
<?php
$query = $pdo->prepare("select * from users order by id desc");
$query->execute();

while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    echo '
                                <tr>
                                    <td>' . $row->id . '</td>
                                    <td>' . $row->name . '</td>
                                    <td>' . $row->email . '</td>
                                    <td>' . $row->password . '</td>
                                    <td>' . $row->role . '</td>
                                    <td>
                                    <a href="register.php?id=' . $row->id . '" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            ';
}
?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content ends -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      $(document).ready( function () {
        $('#tablecategory').DataTable();

        }
    );
  </script>

  <!-- Control Sidebar -->
<?php include_once 'include/aside.php'?>