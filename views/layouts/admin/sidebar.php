<!-- views/layouts/admin/sidebar.php -->
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i> Edukate
    </div>

    <nav class="nav-menu">
        <a href="?url=test/dashboard" class="<?= ($current_url == 'admin/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="?url=test/manage" class="<?= (strpos($current_url, 'test/manage') !== false) ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Quản lý người dùng
        </a>
        <a href="?url=test/categories" class="<?= (strpos($current_url, 'admin/categories') !== false) ? 'active' : '' ?>">
            <i class="fas fa-tags"></i> Danh mục
        </a>
        <a href="?url=admin/courses/pending" class="<?= (strpos($current_url, 'admin/courses') !== false) ? 'active' : '' ?>">
            <i class="fas fa-book"></i> Duyệt khóa học
        </a>
        <a href="?url=admin/reports">
            <i class="fas fa-chart-bar"></i> Báo cáo
        </a>
    </nav>

    <div class="menu-section">ACCOUNT</div>
    <nav class="nav-menu">
        <a href="?url=admin/profile"><i class="fas fa-cog"></i> Cài đặt</a>
        <a href="?url=auth/logout" class="logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </nav>
</div>