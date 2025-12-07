<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Toggle</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
      /* Sidebar mặc định */
      .sidebar {
          width: 80px;
          transition: width 0.3s;
          overflow: hidden;
      }

      /* Sidebar khi mở */
      .sidebar.open {
          width: 220px;
      }

      /* Ẩn text khi sidebar thu nhỏ */
      .sidebar .text {
          display: none;
          white-space: nowrap;
      }

      .sidebar.open .text {
          display: inline;
      }

      .menu-item {
          display: flex;
          align-items: center;
          gap: 12px;
      }

      /* Nội dung dịch sang phải khi sidebar mở */
      #content {
          transition: margin-left 0.3s;
          margin-left: 80px;
      }

      #content.shift {
          margin-left: 220px;
      }
  </style>
</head>

<body class="bg-light">

<!-- Button Toggle -->
<button id="toggleBtn" class="btn btn-dark m-2">
    <i class="bi bi-list fs-3"></i>
</button>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar bg-light border-end vh-100 position-fixed">

        <div class="p-3">
            <div class="menu-item mb-4">
                <i class="bi-bootstrap fs-2"></i>
                <span class="text fs-4 fw-bold">Bootstrap</span>
            </div>

            <hr>

            <a href="index.php" class="menu-item nav-link py-2">
                <i class="bi-house fs-4"></i>
                <span class="text fs-5">Home</span>
            </a>

            <a href="dashboard.php" class="menu-item nav-link py-2">
                <i class="bi-speedometer2 fs-4"></i>
                <span class="text fs-5">Dashboard</span>
            </a>

            <a href="orders.php" class="menu-item nav-link py-2">
                <i class="bi-table fs-4"></i>
                <span class="text fs-5">Orders</span>
            </a>

            <a href="products.php" class="menu-item nav-link py-2">
                <i class="bi-heart fs-4"></i>
                <span class="text fs-5">Products</span>
            </a>

            <a href="customers.php" class="menu-item nav-link py-2">
                <i class="bi-people fs-4"></i>
                <span class="text fs-5">Customers</span>
            </a>

            <hr>

            <div class="dropdown">
                <a class="menu-item nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi-person-circle fs-4"></i>
                    <span class="text fs-5">Account</span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item">Tài khoản</a></li>
                    <li><a class="dropdown-item">Cài đặt</a></li>
                    <li><a class="dropdown-item">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div id="content" class="p-4">
        <h1>Content area...</h1>
        <p>Bấm nút menu để đóng/mở sidebar.</p>
    </div>

</div>

<!-- JS Toggle -->
<script>
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.getElementById("toggleBtn");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        content.classList.toggle("shift");
    });
</script>

</body>
</html>
