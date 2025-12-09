<?php
// Dữ liệu mẫu (bạn có thể thay bằng DB sau)
$courses = [
    [
        'id' => 1,
        'title' => 'Học ReactJS Từ A-Z Cho Người Mới Bắt Đầu',
        'instructor' => 'Nguyễn Văn A',
        'image' => 'assets/java.png',
        'progress' => 78
    ],
    [
        'id' => 2,
        'title' => 'Lập Trình Laravel 10 - Xây Dựng Website Bán Hàng',
        'instructor' => 'Trần Thị B',
        'image' => 'assets/java.png',
        'progress' => 45
    ],
    [
        'id' => 3,
        'title' => 'Vue 3 + Vuex + Firebase - Fullstack Real Project',
        'instructor' => 'Lê Văn C',
        'image' => 'assets/java.png',
        'progress' => 100
    ],
    [
        'id' => 4,
        'title' => 'HTML CSS Từ Zero đến Hero',
        'instructor' => 'Phạm Thị D',
        'image' => 'assets/java.png',
        'progress' => 0
    ],
    [
        'id' => 5,
        'title' => 'Node.js & Express - Xây dựng RESTful API',
        'instructor' => 'Hoàng Văn E',
        'image' => 'assets/java.png',
        'progress' => 23
    ],
    [
        'id' => 6,
        'title' => 'Thiết Kế Giao Diện Web Với Figma 2025',
        'instructor' => 'Nguyễn Thị F',
        'image' => 'assets/java.png',
        'progress' => 95
    ]
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học của tôi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h1 class="page-title">Khóa học của tôi</h1>
    
    <div class="courses-grid">
        <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <div class="course-thumb">
                    <img src="<?= htmlspecialchars($course['image']) ?>" alt="<?= htmlspecialchars($course['title']) ?>">
                    
                    <?php if ($course['progress'] > 0): ?>

                    <?php endif; ?>
                </div>

                <div class="course-body">
                    <h3 class="course-title"><?= htmlspecialchars($course['title']) ?></h3>
                    
                    <p class="course-instructor">
                        <i class="fas fa-user-tie"></i> <?= htmlspecialchars($course['instructor']) ?>
                    </p>

                    <?php if ($course['progress'] > 0): ?>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?= $course['progress'] ?>%"></div>
                            </div>
                            <span class="progress-label">
                                <?= $course['progress'] == 100 ? 'Hoàn thành' : $course['progress'] . '% hoàn thành' ?>
                            </span>
                        </div>
                    <?php else: ?>
                        <p class="text-muted"><small>Chưa bắt đầu</small></p>
                    <?php endif; ?>

                    <a href="course-detail.php?id=<?= $course['id'] ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-play-circle"></i>
                        <?= $course['progress'] > 0 && $course['progress'] < 100 ? 'Tiếp tục học' : ($course['progress'] == 100 ? 'Xem lại' : 'Bắt đầu học') ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>