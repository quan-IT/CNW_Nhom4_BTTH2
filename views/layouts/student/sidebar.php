<?php $current_url = $_GET['url'] ?? 'student/dashboard'; ?>

<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>Edukate</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <a href="index.php?url=student/dashboard"
                class="nav-item <?= ($current_url === 'student/dashboard') ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> <span>Dashboard</span>
            </a>

            <a href="index.php?url=student/mycourse"
                class="nav-item <?= ($current_url === 'student/mycourse') ? 'active' : '' ?>">
                <i class="fas fa-book-reader"></i> <span>Khóa học của tôi</span>
            </a>

            <!-- <a href="index.php?url=student/document"
                class="nav-item <?= ($current_url === 'student/quiz') ? 'active' : '' ?>">
                <i class="fas fa-question-circle"></i> <span>My Document</span>
            </a> -->
            <!-- <a href="index.php?url=student/courseprogress"
                class="nav-item <?= ($current_url === 'student/quiz') ? 'active' : '' ?>">
                <i class="fas fa-question-circle"></i> <span>My Course Progress</span>
            </a> -->
        </div>

        <div class="nav-section">
            <div class="nav-section-title">LEARN</div>
            <a href="index.php?url=course/courses"
                class="nav-item <?= ($current_url === 'course/courses') ? 'active' : '' ?>">
                <i class="fas fa-book"></i> <span>Tất cả khóa học</span>
            </a>

        </div>

        <div class="nav-section">
            <div class="nav-section-title">ACCOUNT</div>
            <a href="index.php?url=student/profile"
                class="nav-item <?= ($current_url === 'student/profile') ? 'active' : '' ?>">
                <i class="fas fa-user-edit"></i> <span>Cá nhân</span>
            </a>
            <a href = 'index.php?url=home/index'>
                <i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span>
            </a>
        </div>
    </nav>
</aside>