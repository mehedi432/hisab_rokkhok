<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Sweet alert -->
<script src="plugins/sweetalert/sweetalert.js"></script>


<?php

include_once "database.php";
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("select * from users where email='$email' AND password='$password'");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($row['email'] == $email and $row['password'] == $password and $row['role'] == 'admin') {

        // Adding db data to session
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['password'] = $row['password'];

        echo '<script type=text/javascript>
            jQuery(function validation () {
                swal({
                    title: "Hei ' . $_SESSION['name'] . ' you are logged in now",
                    text: "Everythong is provided correctly",
                    icon: "success",
                    button: "Okay",
                });
            });
        </script>';
        header("location: dashboard.php");
    } elseif ($row['email'] == $email and $row['password'] == $password and $row['role'] == 'user') {

        // Adding db data to session
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['password'] = $row['password'];

        echo '<script type=text/javascript>
            jQuery(function validation () {
                swal({
                    title: "Hei ' . $_SESSION['name'] . ' you are logged in now",
                    text: "success",
                    icon: "success",
                    button: "Okay",
                });
            });
        </script>';
        header("location: user_dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>দোকানের হিসাব | লগইন করুন</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page ">
<div class="login-box mb-5">
  <div class="login-logo">
    <a href="dashboard.php"><b>দোকানের</b> <strong>হিসাব</strong></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-dark">
    <div class="card-body login-card-body">
      <p class="login-box-msg">ব্যাবহার করতে লগইন করুন</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="ইমেইল দেন" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="পাসওয়ার্ড দেন" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-1">
                <a href="" class="text-dark" onclick="swal('পাসওয়ার্ড পাবার জন্যে', 'আপনার অ্যাডমিন এর সাথে যোগাযোগ করেন', 'error')">পাসওয়ার্ড ভুলে গেছেন</a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-block btn-dark" name="login">প্রবেশ</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


</body>
</html>
