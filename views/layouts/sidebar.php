<!-- views/layouts/sidebar.php -->

<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar text-white">
    <div class="d-flex flex-column align-items-center align-items-sm-start 
                px-3 pt-3 min-vh-100">

        <!-- Logo -->
        <a href="index.php" class="d-flex align-items-center mb-3 text-white text-decoration-none">
            <i class="bi-mortarboard fs-3 me-2"></i>
            <span class="fs-5 d-none d-sm-inline">Student</span>
        </a>

        <hr class="text-secondary w-100">

        <!-- MENU -->
        <ul class="nav nav-pills flex-column mb-auto w-100" id="menu">

            <li class="nav-item">
                <a href="index.php?controller=student&action=dashboard"
                   class="nav-link text-white">
                    <i class="bi-speedometer2 me-2"></i>
                    <span class="d-none d-sm-inline">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="index.php?controller=student&action=my_course"
                   class="nav-link text-white">
                    <i class="bi-journal-bookmark me-2"></i>
                    <span class="d-none d-sm-inline">My Courses</span>
                </a>
            </li>

            <li>
                <a href="index.php?controller=student&action=course_progress"
                   class="nav-link text-white">
                    <i class="bi-graph-up me-2"></i>
                    <span class="d-none d-sm-inline">Learning Progress</span>
                </a>
            </li>

            <li>
                <a href="index.php?controller=student&action=profile"
                   class="nav-link text-white">
                    <i class="bi-person-circle me-2"></i>
                    <span class="d-none d-sm-inline">Profile</span>
                </a>
            </li>

            <li>
                <a href="index.php?controller=student&action=settings"
                   class="nav-link text-white">
                    <i class="bi-gear me-2"></i>
                    <span class="d-none d-sm-inline">Settings</span>
                </a>
            </li>

        </ul>

        <hr class="text-secondary w-100">

        <!-- USER -->
        <div class="dropdown w-100">
            <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown">
                <i class="bi-person-fill fs-4 me-2"></i>
                <span class="d-none d-sm-inline">Student</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>

    </div>
</div>
