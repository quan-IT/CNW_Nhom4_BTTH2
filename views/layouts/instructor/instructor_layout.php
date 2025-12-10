<?php
// views/layouts/student/layout.php
$current_url = $_GET['url'] ?? 'test/dashboard';
?>
<?php
// Dữ liệu mẫu cho Admin Dashboard
$stats = [
    'total_users' => 28782,
    'active_users' => 24560,
    'pending_courses' => 18,
    'total_courses' => 156,
    'total_revenue' => '₫2,456,780,000',
    'new_users_today' => 142
];

$recent_users = [
    ['name' => 'Nguyễn Văn An', 'email' => 'an@gmail.com', 'status' => 'active', 'joined' => '10/12/2025'],
    ['name' => 'Trần Thị Lan', 'email' => 'lan@yahoo.com', 'status' => 'pending', 'joined' => '10/12/2025'],
    ['name' => 'Lê Minh Tuấn', 'email' => 'tuan@outlook.com', 'status' => 'active', 'joined' => '09/12/2025'],
];

$pending_courses = [
    ['title' => 'Advanced Machine Learning with TensorFlow', 'instructor' => 'Dr. Phạm Văn Hùng', 'submitted' => '10/12/2025'],
    ['title' => 'Flutter Mobile Dev - Build Real Apps', 'instructor' => 'Nguyễn Thị Mai', 'submitted' => '09/12/2025'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors Dashboard - Edukate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- <link rel="stylesheet" href="assets/css/instructor/sidebar.css"> -->
    <link rel="stylesheet" href="assets/css/instructor/sidebar.css?v=<?= time() ?>">

    <style>
    </style>

</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <?php include './sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- HEADER -->
            <?php include './header.php'; ?>

            <!-- NỘI DUNG CHÍNH -->
            <div class="dashboard-content">
                <h1>Chào mừng trở lại, <strong>Thầy Nguyễn Văn Hùng</strong></h1>
                <p class="subtitle">Dưới đây là tổng quan hoạt động giảng dạy của bạn</p>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-book-open"></i>
                        <div>
                            <h3>8</h3>
                            <p>Khóa học đang dạy</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <div>
                            <h3>1,248</h3>
                            <p>Học viên đang học</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-star"></i>
                        <div>
                            <h3>4.8</h3>
                            <p>Đánh giá trung bình</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-money-bill-wave"></i>
                        <div>
                            <h3>₫86,400,000</h3>
                            <p>Doanh thu tháng này</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="activity-section">
                    <h2>Hoạt động gần đây</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <i class="fas fa-user-plus"></i>
                            <div>
                                <p><strong>25 học viên mới</strong> đăng ký khóa <strong>Laravel 11 Pro</strong></p>
                                <small>2 giờ trước</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <i class="fas fa-comment"></i>
                            <div>
                                <p>Bạn nhận được <strong>12 đánh giá mới</strong> 5 sao</p>
                                <small>5 giờ trước</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p>Khóa <strong>ReactJS Master</strong> có <strong>89%</strong> học viên hoàn thành</p>
                                <small>Hôm qua</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="course/create.php" class="quick-btn">
                        <i class="fas fa-plus-circle"></i>
                        Tạo khóa học mới
                    </a>
                    <a href="my-courses.php" class="quick-btn">
                        <i class="fas fa-list"></i>
                        Quản lý khóa học
                    </a>
                    <a href="students/list.php" class="quick-btn">
                        <i class="fas fa-users"></i>
                        Xem học viên
                    </a>
                </div>
            </div>
    </div>


    </main>
    </div>

    <!-- FOOTER (nếu có) -->
    <?php include 'views/layouts/admin/footer.php'; ?>

</body>

</html>