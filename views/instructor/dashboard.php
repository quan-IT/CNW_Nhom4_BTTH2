<!-- instructor/dashboard.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Giảng viên - Edukate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* assets/css/instructor/dashboard.css */
        /* assets/css/instructor/common.css */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar & Header sẽ dùng chung với admin nhưng đổi màu */
        .instructor-main {
            flex: 1;
            margin-left: 280px;
            transition: 0.3s;
        }

        .content {
            padding: 30px;
        }

        /* Sidebar giống admin nhưng màu xanh lá */
        .sidebar {
            background: #10b981;
        }

        /* Thay màu sidebar thành xanh lá cho giảng viên */
        .nav-menu a.active {
            background: #059669;
        }

        .subtitle {
            font-size: 15px;
            color: #64748b;
            margin: 10px 0 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-card i {
            font-size: 36px;
            color: #10b981;
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .stat-card p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .activity-section {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .activity-section h2 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .activity-item {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item i {
            font-size: 20px;
            color: #10b981;
            margin-top: 4px;
        }

        .activity-item p {
            margin: 0;
            font-size: 15px;
        }

        .activity-item small {
            color: #94a3b8;
            font-size: 13px;
        }

        .quick-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .quick-btn {
            background: white;
            color: #1e293b;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            transition: 0.3s;
            min-width: 180px;
        }

        .quick-btn i {
            font-size: 32px;
            color: #10b981;
        }

        .quick-btn:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    < <?php include './CNW_Nhom4_BTTH2/views/layouts/instructor/sidebar.php'; ?> 

    <div class="instructor-main">
        <!-- <?php include 'views/layouts/instructor/header.php'; ?> -->

        <div class="content">
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

</body>

</html>