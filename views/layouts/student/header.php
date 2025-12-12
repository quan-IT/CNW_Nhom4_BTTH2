<header class="dashboard-header">
    <div class="header-left">
        <a href="index.php?url=student/dashboard"><h1>My Dashboard</h1></a>
    </div>

    <!-- <div class="header-center">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search courses..." id="searchCourse">
        </div>
    </div> -->

    <div class="header-right">
        <!-- NOTIFICATION BELL + DROPDOWN -->
        <div class="notification-wrapper">
            <div class="notification-bell" id="notificationBell">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>

            <!-- Dropdown thông báo -->
            <div class="notification-dropdown" id="notificationDropdown">
                <div class="notification-header">
                    <h3>Notifications</h3>
                    <a href="#" class="mark-all-read">Mark all as read</a>
                </div>
                <div class="notification-list">
                    <div class="notification-item unread">
                        <div class="notif-icon bg-blue">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="notif-content">
                            <p><strong>Congrats!</strong> You completed HTML5 course</p>
                            <span class="notif-time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="notification-item unread">
                        <div class="notif-icon bg-green">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="notif-content">
                            <p>New badge unlocked: <strong>JavaScript Ninja</strong></p>
                            <span class="notif-time">5 hours ago</span>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notif-icon bg-purple">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="notif-content">
                            <p>Your quiz will expire in 2 days</p>
                            <span class="notif-time">1 day ago</span>
                        </div>
                    </div>
                </div>
                <div class="notification-footer">
                    <a href="#" class="view-all-notif">View all notifications</a>
                </div>
            </div>
        </div>

        <!-- User Avatar -->
        <div class="user-profile">
            <img src="assets/VN.png" alt="User">
        </div>
    </div>
</header>