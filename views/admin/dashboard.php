<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-Learning Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

  <div class="container">

    <!-- Header -->
    <header class="header">
      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search Entire Dashboard">
      </div>
      <div class="header-right">
        <i class="far fa-bell"></i>
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="user" class="user-avatar">
      </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <div class="top-bar">
        <h1>Dashboard</h1>
        <div class="actions">
          <input type="text" placeholder="Select Date" class="date-input">
          <button class="btn-settings">Settings</button>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div>
            <p class="label">SALES</p>
            <p class="value">$10,800</p>
            <p class="change positive">+20.9% Number of sales</p>
          </div>
          <i class="fas fa-dollar-sign icon"></i>
        </div>
        <div class="stat-card">
          <div>
            <p class="label">COURSES</p>
            <p class="value">2,456</p>
            <p class="change negative">120+ Number of pending</p>
          </div>
          <i class="fas fa-book-open icon"></i>
        </div>
        <div class="stat-card">
          <div>
            <p class="label">STUDENTS</p>
            <p class="value">1,22,456</p>
            <p class="change positive">+1200 Students</p>
          </div>
          <i class="fas fa-users icon"></i>
        </div>
        <div class="stat-card">
          <div>
            <p class="label">INSTRUCTOR</p>
            <p class="value">22,786</p>
            <p class="change positive">+1200 Instructor</p>
          </div>
          <i class="fas fa-chalkboard-teacher icon"></i>
        </div>
      </div>

      <!-- Bottom Section -->
      <div class="bottom-grid">

        <!-- Traffic -->
        <div class="box traffic-box">
          <h3>Traffic</h3>
          <svg class="donut-chart" viewBox="0 0 36 36">
            <path class="bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
            <path class="ring direct" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-dasharray="65 100" />
            <path class="ring referral" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-dasharray="25 100" transform="rotate(130 18 18)" />
            <path class="ring organic" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-dasharray="10 100" transform="rotate(210 18 18)" />
          </svg>
          <div class="legend">
            <span><i class="dot direct"></i> Direct</span>
            <span><i class="dot referral"></i> Referral</span>
            <span><i class="dot organic"></i> Organic</span>
          </div>
        </div>

        <!-- Popular Instructors -->
        <div class="box">
          <div class="box-header">
            <h3>Popular Instructor</h3>
            <a href="#" class="view-all">View all</a>
          </div>
          <div class="instructor-list">
            <div class="instructor-item">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
              <div>
                <p class="name">Rob Percival</p>
                <p class="info">42 Courses • 110,124 Students • 32,000 Reviews</p>
              </div>
            </div>
            <div class="instructor-item">
              <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="">
              <div>
                <p class="name">Jose Portilla</p>
                <p class="info">12 Courses • 21,567 Students • 22,000 Reviews</p>
              </div>
            </div>
            <div class="instructor-item">
              <img src="https://randomuser.me/api/portraits/women/52.jpg" alt="">
              <div>
                <p class="name">Eleanor Pena</p>
                <p class="info">32 Courses • 11,504 Students • 12,230 Reviews</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Courses + Activity -->
        <div class="right-column">
          <!-- Recent Courses -->
          <div class="box recent-courses">
            <div class="box-header">
              <h3>Recent Courses</h3>
              <a href="#" class="view-all">View all</a>
            </div>
            <div class="course-item">
              <div class="course-thumb laravel"><i class="fab fa-laravel"></i></div>
              <div>
                <p class="title">Revolutionize how you build the web...</p>
                <p class="author">Brooklyn Simmons</p>
              </div>
            </div>
            <div class="course-item">
              <div class="course-thumb gatsby"><i class="fab fa-gatsby"></i></div>
              <div>
                <p class="title">Guide to Static Sites with Gatsby.js</p>
                <p class="author">Jenny Wilson</p>
              </div>
            </div>
            <div class="course-item">
              <div class="course-thumb js"><i class="fab fa-js-square"></i></div>
              <div>
                <p class="title">The Modern JavaScript Courses</p>
                <p class="author">Guy Hawkins</p>
              </div>
            </div>
          </div>

          <!-- Activity -->
          <div class="box activity-box">
            <h3>Activity</h3>
            <div class="activity-item">
              <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
              <div>
                <p><strong>Dianna Smiley</strong> Just buy the courses “Build React Application Tutorial”</p>
                <span class="time">2m ago</span>
              </div>
            </div>
            <div class="activity-item">
              <img src="https://randomuser.me/api/portraits/women/86.jpg" alt="">
              <div>
                <p><strong>Irene Hargrove</strong> Comment on “Bootstrap Tutorial” Says “Hi, I’m Irene...”</p>
                <span class="time">1 hour ago</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>

</body>
</html>