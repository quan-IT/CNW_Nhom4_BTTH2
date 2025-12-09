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
                <i class="fas fa-book-reader"></i> <span>My Courses</span>
            </a>

            <a href="index.php?url=student/document"
                class="nav-item <?= ($current_url === 'student/quiz') ? 'active' : '' ?>">
                <i class="fas fa-question-circle"></i> <span>My Document</span>
            </a>
            <a href="index.php?url=student/courseprogress"
                class="nav-item <?= ($current_url === 'student/quiz') ? 'active' : '' ?>">
                <i class="fas fa-question-circle"></i> <span>My Course Progress</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">LEARN</div>
            <a href="index.php?url=course/courses"
                class="nav-item <?= ($current_url === 'courses') ? 'active' : '' ?>">
                <i class="fas fa-book"></i> <span>All Courses</span>
            </a>
            <a href="index.php?url=student/projects"
                class="nav-item <?= ($current_url === 'student/projects') ? 'active' : '' ?>">
                <i class="fas fa-code"></i> <span>Projects</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">ACCOUNT</div>
            <a href="index.php?url=student/profile"
                class="nav-item <?= ($current_url === 'student/profile') ? 'active' : '' ?>">
                <i class="fas fa-user-edit"></i> <span>Edit Profile</span>
            </a>
            <a>
                <i class="fas fa-sign-out-alt"></i> <span>Sign Out</span>
            </a>
        </div>
    </nav>
</aside>