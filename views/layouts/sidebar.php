<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
  
<!-- layouts/sidebar.php -->
<div class="col-sm-auto bg-light sticky-top sidebar">
    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">

        <!-- Logo -->
        <a href="/" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip"
           data-bs-placement="right" title="Trang chủ">
            <i class="bi-bootstrap fs-1"></i>
        </a>

        <!-- Menu -->
        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto 
                   text-center justify-content-between w-100 px-3 align-items-center">

            <li class="nav-item">
                <a href="index.php" class="nav-link py-3 px-2" title="Home" data-bs-toggle="tooltip">
                    <i class="bi-house fs-3"></i>
                </a>
            </li>

            <li>
                <a href="dashboard.php" class="nav-link py-3 px-2" title="Dashboard" data-bs-toggle="tooltip">
                    <i class="bi-speedometer2 fs-3"></i>
                </a>
            </li>

            <li>
                <a href="orders.php" class="nav-link py-3 px-2" title="Orders" data-bs-toggle="tooltip">
                    <i class="bi-table fs-3"></i>
                </a>
            </li>

            <li>
                <a href="products.php" class="nav-link py-3 px-2" title="Products" data-bs-toggle="tooltip">
                    <i class="bi-heart fs-3"></i>
                </a>
            </li>

            <li>
                <a href="customers.php" class="nav-link py-3 px-2" title="Users" data-bs-toggle="tooltip">
                    <i class="bi-people fs-3"></i>
                </a>
            </li>

        </ul>

        <!-- User dropdown -->
        <div class="dropdown pb-3">
            <a class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
               id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi-person-circle h2"></i>
            </a>

            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="#">Tài khoản</a></li>
                <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
            </ul>
        </div>

    </div>
</div>


</body>
</html>