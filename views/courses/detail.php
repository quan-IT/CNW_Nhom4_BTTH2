<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['title']) ?></title>

    <link rel="stylesheet" href="assets/css/Courses/course_detail.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="detail-container">

        <!-- LEFT -->
        <div class="left-content">

            <h1 class="course-title"><?= htmlspecialchars($course['title']) ?></h1>

            <p class="course-desc"><?= nl2br(htmlspecialchars($course['description'])) ?></p>

            <div class="meta">
                <p><i class="fas fa-user-tie"></i>
                    Giảng viên: <strong><?= htmlspecialchars($course['instructor_name']) ?></strong>
                </p>

                <p><i class="fas fa-list"></i>
                    Danh mục: <?= htmlspecialchars($course['category_name']) ?>
                </p>

                <p><i class="far fa-clock"></i>
                    Thời lượng: <?= $course['duration_weeks'] ?> tuần
                </p>

                <p><i class="fas fa-signal"></i>
                    Trình độ:
                    <?= $course['level'] == 'Beginner' ? 'Sơ cấp' : ($course['level'] == 'Intermediate' ? 'Trung cấp' : 'Nâng cao') ?>
                </p>
            </div>

            <h2 class="lesson-title">Danh sách bài học</h2>

            <div class="lesson-list">
                <?php foreach ($lessons as $lesson): ?>
                    <div class="lesson-item">
                        <div>
                            <h4><?= htmlspecialchars($lesson['title']) ?></h4>
                            <small>Bài số: <?= $lesson['order'] ?></small>
                        </div>
                        <a href="index.php?url=lesson/detail&id=<?= $lesson['id'] ?>" class="btn-learn">
                            Học ngay
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="right-sidebar">

            <div class="thumbnail">
                <img src="assets/images/<?= $course['image'] ?>" alt="">
            </div>

            <div class="course-box">
                <h3 class="price"><?= number_format($course['price'], 0, ',', '.') ?> ₫</h3>

                <a href="index.php?url=enroll&course_id=<?= $course['id'] ?>" class="btn-enroll">
                    Đăng ký học
                </a>

                <ul class="course-info">
                    <li><i class="fas fa-users"></i> Trình độ: <?= $course['level'] ?></li>
                    <li><i class="fas fa-video"></i> <?= count($lessons) ?> bài học</li>
                    <li><i class="far fa-clock"></i> <?= $course['duration_weeks'] ?> tuần</li>
                    <li><i class="fas fa-globe"></i> Học mọi lúc, mọi nơi</li>
                </ul>
            </div>

        </div>

    </div>

</body>

</html>