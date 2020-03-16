<?php
include_once 'database.php';
?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
<!-- Control sidebar content goes here -->
<div class="p-3">

    <div class="card">
        <div class="card-header text-center"><?=$_SESSION['name']?></div>
        <div class="card-body">
           <p> <?=$_SESSION['role']?> </p>
           <p> <?=$_SESSION['email']?> </p>
        </div>


        <div class="container">
            <div class="card">
                <button class="btn btn-outline-primary"><a href="logout.php" class="text-dark"> Sign out</a></button>
            </div>
            <div class="card">
                <button class="btn btn-outline-primary"><a href="password_change.php" class="text-dark"> Change Password</a></button>
            </div>
        </div>
    </div>


</div>
</aside>
<!-- /.control-sidebar -->
