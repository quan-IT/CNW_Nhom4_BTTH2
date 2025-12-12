<?php
// ====== SAMPLE DATA (CHUẨN THEO CẤU TRÚC BẢNG) ====== //

// COURSE
$course = [
    'id' => 10,
    'title' => "Kiến Thức Nhập Môn IT",
    'description' => "Khóa học cung cấp kiến thức nền tảng về CNTT.",
    'instructor_id' => 3,
    'category_id' => 1,
    'price' => 0.00,
    'duration_weeks' => 4,
    'level' => "Beginner",
    'image' => "uploads/courses/course10.jpg",
    'created_at' => "2024-01-10 08:00:00",
    'updated_at' => "2024-02-01 14:22:00"
];

// ENROLLMENT
$enrollment = [
    'id' => 55,
    'course_id' => 10,
    'student_id' => 7,
    'enrolled_date' => "2024-03-01 09:15:00",
    'status' => "active",
    'progress' => 25
];

// CURRENT LESSON
$lesson = [
    'id' => 1,
    'course_id' => 10,
    'title' => "Mô hình Client - Server là gì?",
    'content' => "Giải thích chi tiết mô hình Client - Server...",
    'video_url' => "uploads/videos/client_server.mp4",
    'order' => 1,
    'created_at' => "2024-01-12 10:00:00",
    'duration' => "11:35"
];

// ALL LESSONS
$lessons = [
    ['id' => 1, 'course_id' => 10, 'title' => "Mô hình Client - Server là gì?", 'duration' => "11:35", 'order' => 1],
    ['id' => 2, 'course_id' => 10, 'title' => "Domain là gì? Tên miền là gì?", 'duration' => "10:34", 'order' => 2],
    ['id' => 3, 'course_id' => 10, 'title' => "Mua tên miền & Hosting", 'duration' => "09:00", 'order' => 3],
    ['id' => 4, 'course_id' => 10, 'title' => "HTTP hoạt động như thế nào?", 'duration' => "12:40", 'order' => 4],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/onlinecourse/CNW_Nhom4_BTTH2/assets/css/student/mycourse_detail.css" rel="stylesheet">
</head>

<body>
    <!-- ======================= HTML =========================== -->
    <!-- ============== TOP HEADER LIKE F8 ============== -->
    <div class="learn-header">

        <div class="learn-header-left">
            <a href="http://localhost/onlinecourse/CNW_Nhom4_BTTH2/index.php?url=student/mycourse" class="back-btn">←</a>
            <span><?= htmlspecialchars($course['title']) ?></span>
        </div>

        <div class="learn-header-right">
            <div class="learn-progress">
                <?= $enrollment['progress'] ?>% •
                <?= $enrollment['progress'] / 100 * count($lessons) ?>/<?= count($lessons) ?> bài học
            </div>
        </div>

    </div>

    <div class="learning-wrapper">

        <!-- LEFT CONTENT  -->
        <div class="learning-left">

            <div class="video-container">
                <!-- <video controls>
                <source src="" type="video/mp4">
                
            </video> -->
                <iframe
                    src="https://www.youtube.com/embed/zoELAirXMJY?si=abc123"
                    width="100%"
                    height="400"
                    allowfullscreen>
                </iframe>

            </div>

            <h2 class="lesson-title"><?= htmlspecialchars($lesson['title']) ?></h2>


            <div class="lesson-description">
                <?= nl2br(htmlspecialchars($lesson['content'])) ?>
            </div>

            <!-- Navigation -->
            <div class="learning-nav">
                <button class="prev-btn">◀ Bài trước</button>
                <button class="next-btn">Bài tiếp theo ▶</button>
            </div>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="learning-sidebar">
            <h3>Nội dung khóa học</h3>

            <div class="course-progress">
                <span>0/<?= count($lessons) ?> bài học</span>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
            </div>

            <div class="lesson-list">
                <?php foreach ($lessons as $ls): ?>
                    <div class="lesson-item <?= $ls['id'] == $lesson['id'] ? 'active' : '' ?>">
                        <a href="index.php?url=student/learn&id=<?= $ls['id'] ?>">
                            <div class="lesson-info">
                                <i class="fas fa-play-circle"></i>
                                <span><?= htmlspecialchars($ls['title']) ?></span>
                            </div>
                            <span class="lesson-time"><?= $ls['duration'] ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>

</html>