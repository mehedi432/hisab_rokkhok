
<?php
include_once 'database.php';
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary toggled">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/logo.svg" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">হিসাব রক্ষক</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/drgeo.svg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"> <?="স্বাগতম" . " " . $_SESSION['name'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="ordercreate.php" class="nav-link">
                  <i class="nav-icon fa fa-balance-scale"></i>
                  <p> Order
                    <span class="right badge badge-danger">!Complete</span>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="productlist.php" class="nav-link">
                  <i class="nav-icon fa fa-list"></i>
                  <p>প্রোডাক্ট সমূহ
                    <span class="right badge badge-info">নতুন</span>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="productcreate.php" class="nav-link">
                  <i class="nav-icon fa fa-cart-plus"></i>
                  <p> প্রোডাক্ট যুক্ত করুন
                    <span class="right badge badge-success">implemented</span>
                  </p>
                </a>
              </li>



              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p> ক্যাটাগরি
                    <span class="right badge badge-success">implemented</span>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="register.php" class="nav-link">
                  <i class="nav-icon fa fa-registered"></i>
                  <p> রেজিস্টার
                    <span class="right badge badge-danger">নতুন</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="nav-icon fa fa-fire"></i>
                  <p>ড্যাশবোর্ড
                    <span class="right badge badge-info">নতুন</span>
                  </p>
                </a>

              <li class="nav-item">
                <a href="contact.php" class="nav-link">
                  <i class="nav-icon fa fa-rocket" aria-hidden="true"></i>
                  <p>যোগাযোগ করুন
                    <span class="right badge badge-info">নতুন</span>
                  </p>
                </a>
              </li>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>