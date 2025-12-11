
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i> Edukate
    </div>

    <nav class="nav-menu">
        <a href="?url=" class="<?= ($current_url == 'admin/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="?url=test/intructorcoursemanage" class="<?= (strpos($current_url, 'test/manage') !== false) ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Quản lý khóa học
        </a>
        <a href="?url=test/intructorlessonmanage" class="<?= (strpos($current_url, 'admin/categories') !== false) ? 'active' : '' ?>">
            <i class="fas fa-tags"></i> Quản lý bài học
        </a>
        <a href="index.php?url=test/intructormaterialsmanage">
            <i class="fas fa-book"></i> Đăng tải tài liệu
        </a>
        <a href="?url=admin/reports">
            <i class="fas fa-chart-bar"></i> Học viên đã đăng ký
        </a>
        <a href="">
            <i class="fas fa-chart-bar"></i> Tiến độ học viên
        </a>    
    </nav>

    <div class="menu-section">ACCOUNT</div>
    <nav class="nav-menu">
        <a href="?url=admin/profile"><i class="fas fa-cog"></i> Cài đặt</a>
        <a href="?url=auth/logout" class="logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </nav>
</div>