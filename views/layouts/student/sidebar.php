<?php
$current_url = $_GET['url'] ?? 'student/dashboard';

$parts = explode('/', $current_url);

// Mặc định
$controller = $parts[0] ?? null;   // student
$action     = $parts[1] ?? null;   // dashboard
$id         = $_SESSION['user_id']  // 4

?>


<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>Edukate</span>
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section">

            <!-- DASHBOARD -->
            <a href="index.php?url=student/dashboard/<?= $id ?>"
                class="nav-item <?= ($controller == 'student' && $action == 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            <!-- MY COURSES -->
            <a href="index.php?url=student/mycourse/<?= $id ?>"
                class="nav-item <?= ($controller == 'student' && $action == 'mycourse') ? 'active' : '' ?>">
                <i class="fas fa-book-reader"></i>
                <span>Khóa học của tôi</span>
            </a>

        </div>  

        <div class="nav-section">
            <div class="nav-section-title">LEARN</div>

            <!-- ALL COURSES -->
            <a href="index.php?url=course/courses/<?= $id ?>"
                class="nav-item <?= ($controller == 'course' && $action == 'courses') ? 'active' : '' ?>">
                <i class="fas fa-book"></i>
                <span>Tất cả khóa học</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">ACCOUNT</div>

            <!-- PROFILE -->
            <a href="index.php?url=student/profile/<?= $id ?>"
                class="nav-item <?= ($controller == 'student' && $action == 'profile') ? 'active' : '' ?>">
                <i class="fas fa-user-edit"></i>
                <span>Cá nhân</span>
            </a>

            <!-- LOGOUT -->
            <a href="index.php?url=home/index">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </div>

    </nav>
</aside>