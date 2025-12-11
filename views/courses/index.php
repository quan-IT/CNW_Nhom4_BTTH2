<?php
// DỮ LIỆU MẪU – ĐÚNG 100% CẤU TRÚC BẢNG courses (chỉ dùng các cột có thật)
// $courses = [
//     ['id'=>1,  'title'=>'Laravel 10 Từ A-Z – Xây Dựng Website Bán Hàng',           'instructor_id'=>101, 'category_id'=>1, 'price'=>1299000, 'duration_weeks'=>10, 'level'=>'Intermediate', 'image'=>'assets/java.png'],
//     ['id'=>2,  'title'=>'ReactJS + Next.js 14 Fullstack 2025',                    'instructor_id'=>102, 'category_id'=>2, 'price'=>999000,  'duration_weeks'=>12, 'level'=>'Intermediate', 'image'=>'assets/java.png'],
//     ['id'=>3,  'title'=>'UI/UX Design Với Figma Từ Sơ Cấp Đến Chuyên Nghiệp',      'instructor_id'=>103, 'category_id'=>3, 'price'=>699000,  'duration_weeks'=>8,  'level'=>'Beginner',     'image'=>'assets/java.png'],
// ];

<<<<<<< HEAD
// Giả lập tên giảng viên (bạn sẽ JOIN với bảng users sau này)
$instructors = [
    101=>'Nguyễn Văn An', 102=>'Trần Minh Quân', 103=>'Lê Thị Hương', 104=>'Phạm Văn Hùng',
    105=>'Hoàng Thị Mai', 106=>'Đỗ Văn Nam',    107=>'Nguyễn Đức Minh', 108=>'Vũ Thị Lan',
    109=>'Trần Văn Tuấn', 110=>'Lý Văn Hùng',   111=>'Phạm Ngọc Ánh',   112=>'Đặng Văn Khánh'
];
?>foreach $courses 
$instructors[$courses['id']]
=======
// // Giả lập tên giảng viên (bạn sẽ JOIN với bảng users sau này)
// $instructors = [
//     101=>'Nguyễn Văn An', 102=>'Trần Minh Quân', 103=>'Lê Thị Hương', 104=>'Phạm Văn Hùng',
//     105=>'Hoàng Thị Mai', 106=>'Đỗ Văn Nam',    107=>'Nguyễn Đức Minh', 108=>'Vũ Thị Lan',
//     109=>'Trần Văn Tuấn', 110=>'Lý Văn Hùng',   111=>'Phạm Ngọc Ánh',   112=>'Đặng Văn Khánh'
// ];
?>
>>>>>>> a3e8c20b290b891832d1d4c1193ad8f3061a3fe3

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
        <h1>Tất cả khóa học</h1>
        <p class="subtitle">Khám phá các khóa học chất lượng cao</p>

<<<<<<< HEAD
    <div class="courses-grid">
        <?php foreach($courses as $c): ?>
            <a href="course-detail.php?id=<?= $c['id'] ?>" class="course-card">
                <div class="thumb">
                    <img src="<?= $c['image'] ?>" alt="<?= htmlspecialchars($c['title']) ?>">
                </div>
                <div class="body"> 
                    <h3 class="title"><?= htmlspecialchars($c['title']) ?></h3>
                    <p class="instructor">
                        <i class="fas fa-user-tie"></i> <?= $instructors[$c['instructor_id']] ?? 'Ẩn danh' ?>
                    </p>
                    <div class="info">
                        <span class="level">
                            <?= $c['level']=='Beginner' ? 'Sơ cấp' : ($c['level']=='Intermediate' ? 'Trung cấp' : 'Nâng cao') ?>
                        </span>
                        <span class="duration">
                            <i class="far fa-clock"></i> <?= $c['duration_weeks'] ?> tuần
                        </span>
=======
        <div class="courses-grid">
            <?php foreach ($courses as $c): ?>

                <a href="index.php?url=course/detail/<?= $c['id'] ?>" class="course-card">
                    <div class="thumb">
                        <img src="<?= $c['image'] ?>" alt="<?= htmlspecialchars($c['title']) ?>">
>>>>>>> a3e8c20b290b891832d1d4c1193ad8f3061a3fe3
                    </div>
                    <div class="body">
                        <h3 class="title"><?= htmlspecialchars($c['title']) ?></h3>
                        <p class="instructor">
                            <i class="fas fa-user-tie"></i> <?= $instructors[$c['instructor_id']] ?? 'Ẩn danh' ?>
                        </p>
                        <div class="info">
                            <span class="level">
                                <?= $c['level'] == 'Beginner' ? 'Sơ cấp' : ($c['level'] == 'Intermediate' ? 'Trung cấp' : 'Nâng cao') ?>
                            </span>
                            <span class="duration">
                                <i class="far fa-clock"></i> <?= $c['duration_weeks'] ?> tuần
                            </span>
                        </div>
                        <div class="price">
                            <?= number_format($c['price'], 0, ',', '.') ?> ₫
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>