<!-- Profile Card & Projects Section -->
<div class="dashboard-grid">
    <!-- User Profile Card -->
    <div class="card profile-card">
        <div class="profile-avatar">
            <img src="assets\VN.png" alt="User Avatar">
        </div>
        <h3 class="profile-name">Hey, Student!</h3>
        <p class="profile-id">ID: 28782</p>

        <div class="profile-course">
            <label>Current Course:</label>
            <h4>Full Stack Development</h4>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 30%"></div>
            </div>
            <p class="progress-label">Profile 30% complete</p>
        </div>

        <div class="profile-badges">
            <span class="badge badge-fire"><i class="fas fa-fire"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
            <span class="badge badge-lock"><i class="fas fa-lock"></i></span>
        </div>
    </div>

    <!-- Real World Projects Card -->
    <div class="card projects-card">
        <div class="projects-content">
            <h2>Real World Projects</h2>
            <p>Engage with real-world challenges using our projects directory. Apply your knowledge to real scenarios in a practical environment.</p>
            <button class="btn-primary">Start Project</button>
        </div>
        <div class="projects-illustration">
            <img src="assets\vietnamese-national-day-slide14.png" alt="Projects">
        </div>
        <div class="carousel-dots">
            <span class="dot"></span>
            <span class="dot active"></span>
        </div>
    </div>
</div>

<!-- Courses Section -->
<div class="courses-section">
    <div class="section-header">
        <h2><i class="fas fa-graduation-cap"></i> Learn</h2>
        <a href="index.php?url=student/mycourse"><button class="btn-view-all">View All</button></a>
    </div>

    <div class="courses-grid">
        <!-- HTML Course -->
        <div class="course-card">
            <div class="course-icon" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);">
                <i class="fab fa-html5"></i>
            </div>
            <h3>HTML5</h3>
            <h4>HTML Courses</h4>
            <div class="course-progress">
                <span>12 of 12 lessons completed...</span>
                <span class="progress-percent">100%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100%; background: #48bb78;"></div>
            </div>
            <button class="course-status completed">Completed</button>
        </div>

        <!-- JavaScript Course -->
        <div class="course-card">
            <div class="course-icon" style="background: linear-gradient(135deg, #f7df1e 0%, #efd81d 100%);">
                <i class="fab fa-js"></i>
            </div>
            <h3>JavaScript</h3>
            <h4>Javascript Courses</h4>
            <div class="course-progress">
                <span>1 of 12 lessons completed...</span>
                <span class="progress-percent">20%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 20%; background: #f7df1e;"></div>
            </div>
            <button class="course-status in-progress">In Progress</button>
        </div>

        <!-- Python Course -->
        <div class="course-card">
            <div class="course-icon" style="background: linear-gradient(135deg, #3776ab 0%, #306998 100%);">
                <i class="fab fa-python"></i>
            </div>
            <h3>Python</h3>
            <h4>Learn Python</h4>
            <div class="course-progress">
                <span>0 of 15 lessons completed...</span>
                <span class="progress-percent">0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 0%;"></div>
            </div>
            <button class="course-status not-started">Not Started</button>
        </div>

        <!-- React Course -->

    </div>