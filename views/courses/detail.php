<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả khóa học</title>
    <link rel="stylesheet" href="assets/css\Courses/courses.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <h1>Chi tiết khóa học</h1>
        <p class="subtitle">Khám phá các khóa học chất lượng cao</p>

        <!-- Tiêu đề khóa học -->
        <h3 class="title"><?= htmlspecialchars($course['title']) ?></h3>

        <!-- Mô tả -->
        <p><?= nl2br(htmlspecialchars($course['description'])) ?></p>

        <!-- Giảng viên -->
        <p class="instructor">
            <i class="fas fa-user-tie"></i>
            <?= htmlspecialchars($course['instructor_name'] ?? 'Ẩn danh') ?>
        </p>

        <!-- Danh mục -->
        <p class="instructor">
            <i class="fas fa-list"></i>
            <?= htmlspecialchars($course['category_name'] ?? 'Chưa phân loại') ?>
        </p>

        <!-- Giá -->
        <div class="price">
            <?= number_format($course['price'], 0, ',', '.') ?> ₫
        </div>

        <!-- Thời lượng -->
        <span class="duration">
            <i class="far fa-clock"></i> <?= $course['duration_weeks'] ?> tuần
        </span>

        <!-- Trình độ -->
        <span class="level">
            <?= $course['level'] == 'Beginner' ? 'Sơ cấp' : ($course['level'] == 'Intermediate' ? 'Trung cấp' : 'Nâng cao') ?>
        </span>

        <div class="lesson-grid">
            <?php foreach ($lessons as $l): ?>
                <a href="course-detail.php?id=<?= $l['id'] ?>" class="course-card">
                    <h3 class="title"><?= htmlspecialchars($l['title']) ?></h3>
                </a>
            <?php endforeach; ?>
        </div>

    </div>


</body>

</html>