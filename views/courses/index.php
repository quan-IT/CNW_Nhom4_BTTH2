<?php
$courses = [
    [
        'id' => 1,
        'title' => 'HTML5 Mastery',
        'image' => 'assets/java.png',
        'price' => 0,
        'instructor' => 'Nguyễn Văn A'
    ],
    [
        'id' => 2,
        'title' => 'Java Basic',
        'image' => 'assets/java.png',
        'price' => 499000,
        'instructor' => 'Nguyễn Văn Trường'
    ]
];
?>



<h1 style="text-align:center; margin-bottom:50px; font-size:2.8rem; color:#1e293b; font-weight:700;">
     Danh Sách Khóa Học
</h1>

<div class="courses-grid">

    <?php foreach ($courses as $course): ?>
        <div class="course-card">

            <div class="course-thumb">
                <img src="<?= $course['image'] ?>" alt="<?= $course['title'] ?>">
            </div>

            <div class="course-body">

                <!-- Tên khóa học -->
                <h3 class="course-title"><?= $course['title'] ?></h3>

                <!-- Giảng viên -->
                <p class="course-desc">
                    Giảng viên: <?= $course['instructor'] ?>
                </p>

                <!-- Giá khóa học -->
                <p class="course-price">
                    Giá:
                    <strong style="color:#dc2626;">
                        <?= $course['price'] == 0 ? "Miễn phí" : number_format($course['price'], 0, ',', '.') . "đ" ?>
                    </strong>
                </p>

                <!-- Nút bấm chi tiết -->
                <a href="index.php?url=student/courseprogress&id=<?= $course['id'] ?>"
                   class="btn btn-primary mt-2">
                    Xem chi tiết
                </a>

            </div>
        </div>
    <?php endforeach; ?>

</div>
