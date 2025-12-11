<?php
$courses = [
    ['id' => 1, 'title' => 'Học ReactJS Từ A-Z Cho Người Mới Bắt Đầu',               'instructor' => 'Nguyễn Văn A', 'progress' => 78, 'img' => 'assets/java.png'],
    ['id' => 2, 'title' => 'Lập Trình Laravel 10 - Xây Dựng Website Bán Hàng',      'instructor' => 'Trần Thị B',   'progress' => 45, 'img' => 'assets/java.png'],
    ['id' => 3, 'title' => 'Vue 3 + Vuex + Firebase - Fullstack Real Project',      'instructor' => 'Lê Văn C',     'progress' => 100, 'img' => 'assets/java.png'],
    ['id' => 4, 'title' => 'HTML CSS Từ Zero đến Hero',                             'instructor' => 'Phạm Thị D',   'progress' => 0,  'img' => 'assets/java.png'],
    ['id' => 5, 'title' => 'Node.js & Express - Xây dựng RESTful API',              'instructor' => 'Hoàng Văn E',  'progress' => 23, 'img' => 'assets/java.png'],
    ['id' => 6, 'title' => 'Thiết Kế Giao Diện Web Với Figma 2025',                 'instructor' => 'Nguyễn Thị F', 'progress' => 95, 'img' => 'assets/java.png'],
];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học của tôi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="views/home/courses.css">
</head>

<body>
<div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edukate</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="index.php?url=test/dashboard" class="nav-item nav-link">About</a>
                    <a href="course.html" class="nav-item nav-link">Courses</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="detail.html" class="dropdown-item">Course Detail</a>
                            <a href="feature.html" class="dropdown-item">Our Features</a>
                            <a href="team.html" class="dropdown-item">Instructors</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <a href="index.php?url=auth/login" class="btn btn-primary py-2 px-4 d-none d-lg-block">Login</a>
                <a href="index.php?url=auth/register" class="btn btn-primary py-2 px-4 d-none d-lg-block mr-2">Register</a>
                </div>
        </nav>
    </div>
    <div class="container">
        <h1 class="page-title">Khóa học của tôi</h1>
        <p class="page-subtitle">Tiếp tục hành trình học tập của bạn</p>

        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <div class="course-thumb">
                        <!-- ĐÃ SỬA: dùng đúng $course['img'] -->
                        <img src="<?= htmlspecialchars($course['img']) ?>"
                            alt="<?= htmlspecialchars($course['title']) ?>"
                            class="img-cover">




                    </div>

                    <div class="course-body">
                        <h3 class="course-title"><?= htmlspecialchars($course['title']) ?></h3>

                        <p class="course-instructor">
                            <i class="fas fa-chalkboard-teacher"></i> <?= htmlspecialchars($course['instructor']) ?>
                        </p>

                        <?php if ($course['progress'] > 0): ?>
                            <div class="progress-bar-container">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $course['progress'] ?>%"></div>
                                </div>
                                <span class="progress-label">
                                    <?= $course['progress'] == 100 ? 'Hoàn thành' : $course['progress'] . '% hoàn thành' ?>
                                </span>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Chưa bắt đầu học</p>
                        <?php endif; ?>

                        <a href="course-detail.php?id=<?= $course['id'] ?>" class="btn-action">
                            <i class="fas fa-play-circle"></i>
                            <?= $course['progress'] > 0 && $course['progress'] < 100 ? 'Tiếp tục học' : ($course['progress'] == 100 ? 'Xem lại khóa học' : 'Bắt đầu học') ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>