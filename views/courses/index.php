<?php
// DỮ LIỆU MẪU – ĐÚNG 100% CẤU TRÚC BẢNG courses (chỉ dùng các cột có thật)
// $courses = [
//     ['id'=>1,  'title'=>'Laravel 10 Từ A-Z – Xây Dựng Website Bán Hàng',           'instructor_id'=>101, 'category_id'=>1, 'price'=>1299000, 'duration_weeks'=>10, 'level'=>'Intermediate', 'image'=>'assets/java.png'],
//     ['id'=>2,  'title'=>'ReactJS + Next.js 14 Fullstack 2025',                    'instructor_id'=>102, 'category_id'=>2, 'price'=>999000,  'duration_weeks'=>12, 'level'=>'Intermediate', 'image'=>'assets/java.png'],
//     ['id'=>3,  'title'=>'UI/UX Design Với Figma Từ Sơ Cấp Đến Chuyên Nghiệp',      'instructor_id'=>103, 'category_id'=>3, 'price'=>699000,  'duration_weeks'=>8,  'level'=>'Beginner',     'image'=>'assets/java.png'],
// ];

// Giả lập tên giảng viên (bạn sẽ JOIN với bảng users sau này)
// $instructors = [
//     101=>'Nguyễn Văn An', 102=>'Trần Minh Quân', 103=>'Lê Thị Hương', 104=>'Phạm Văn Hùng',
//     105=>'Hoàng Thị Mai', 106=>'Đỗ Văn Nam',    107=>'Nguyễn Đức Minh', 108=>'Vũ Thị Lan',
//     109=>'Trần Văn Tuấn', 110=>'Lý Văn Hùng',   111=>'Phạm Ngọc Ánh',   112=>'Đặng Văn Khánh'
// ];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả khóa học</title>
    <!-- sửa đường dẫn CSS: dùng dấu / để tương thích trên web -->
    <link rel="stylesheet" href="assets/css/Courses/course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <h1>Tất cả khóa học</h1>
        <p class="subtitle">Khám phá các khóa học chất lượng cao</p>
        <div class="search-wrapper">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search courses..." id="searchCourse">
            </div>

            <button class="btn-search">Tìm kiếm</button>
        </div>
        <div class="courses-grid">
            <?php foreach ($courses as $c): ?>
                <?php
                // đảm bảo các trường tồn tại
                $id = $c['id'];
                $title = $c['title'] ?? 'Không tên';
                $image = $c['image'] ?? 'assets/java.png';
                $instructorName = $c['fullname'] ?? 'Ẩn danh';
                $levelLabel = ($c['level'] == 'Beginner') ? 'Sơ cấp' : (($c['level'] == 'Intermediate') ? 'Trung cấp' : 'Nâng cao');
                $duration = isset($c['duration_weeks']) ? (int)$c['duration_weeks'] : 0;
                $priceFormatted = isset($c['price']) ? number_format($c['price'], 0, ',', '.') . ' ₫' : 'Miễn phí';
                ?>
                <a href="index.php?url=course/detail/<?= urlencode($id) ?>" class="course-card">
                    <div class="thumb">
                        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($title) ?>">
                    </div>
                    <div class="body">
                        <h3 class="title"><?= htmlspecialchars($title) ?></h3>
                        <p class="instructor">
                            <i class="fas fa-user-tie"></i> <?= htmlspecialchars($instructorName) ?>
                        </p>
                        <div class="info">
                            <span class="level"><?= htmlspecialchars($levelLabel) ?></span>
                            <span class="duration"><i class="far fa-clock"></i> <?= $duration ?> tuần</span>
                        </div>
                        <div class="price"><?= $priceFormatted ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>