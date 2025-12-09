<?php
// views/layouts/student/layout.php
$current_url = $_GET['url'] ?? 'admin/dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edukate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin/dashboard.css">

</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <?php include 'views/layouts/admin/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- HEADER -->
            <?php include 'views/layouts/admin/header.php'; ?>

            <!-- NỘI DUNG CHÍNH -->
            <div class="dashboard-content">
                <?php //include $view; // Biến này từ Controller 
                ?>
                <div class="header">
                    <h1>Admin Dashboard</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Tìm kiếm...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <div>
                            <h3><?= number_format($stats['total_users']) ?></h3>
                            <p>Tổng người dùng</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-user-check"></i>
                        <div>
                            <h3><?= number_format($stats['active_users']) ?></h3>
                            <p>Người dùng hoạt động</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-book-open"></i>
                        <div>
                            <h3><?= $stats['total_courses'] ?></h3>
                            <p>Tổng khóa học</p>
                        </div>
                    </div>
                    <div class="stat-card pending">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3><?= $stats['pending_courses'] ?></h3>
                            <p>Khóa học chờ duyệt</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity + Pending Courses -->
                <div class="content-grid">
                    <!-- Recent Users -->
                    <div class="widget">
                        <h2>Người dùng mới đăng ký</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tham gia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_users as $u): ?>
                                    <tr>
                                        <td><?= $u['name'] ?></td>
                                        <td><?= $u['email'] ?></td>
                                        <td><span class="status <?= $u['status'] ?>"><?= $u['status'] == 'active' ? 'Hoạt động' : 'Chờ duyệt' ?></span></td>
                                        <td><?= $u['joined'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pending Courses -->
                    <div class="widget pending-courses">
                        <h2>Khóa học chờ duyệt <span class="badge"><?= count($pending_courses) ?></span></h2>
                        <?php foreach ($pending_courses as $c): ?>
                            <div class="pending-item">
                                <h4><?= $c['title'] ?></h4>
                                <p>Giảng viên: <?= $c['instructor'] ?> • Nộp ngày <?= $c['submitted'] ?></p>
                                <div class="actions">
                                    <button class="btn-approve">Duyệt</button>
                                    <button class="btn-reject">Từ chối</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- FOOTER (nếu có) -->
    <?php include 'views/layouts/admin/footer.php'; ?>

</body>

</html>