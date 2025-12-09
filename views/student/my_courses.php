<?php
$courses = [
    ['id' => 1, 'title' => 'Học ReactJS Từ A-Z Cho Người Mới Bắt Đầu', 'instructor' => 'Nguyễn Văn A', 'progress' => 78],
    ['id' => 2, 'title' => 'Lập Trình Laravel 10 - Xây Dựng Website Bán Hàng', 'instructor' => 'Trần Thị B', 'progress' => 45],
    ['id' => 3, 'title' => 'Vue 3 + Vuex + Firebase - Fullstack Real Project', 'instructor' => 'Lê Văn C', 'progress' => 100],
    ['id' => 4, 'title' => 'HTML CSS Từ Zero đến Hero', 'instructor' => 'Phạm Thị D', 'progress' => 0],
    ['id' => 5, 'title' => 'Node.js & Express - Xây dựng RESTful API', 'instructor' => 'Hoàng Văn E', 'progress' => 23],
    ['id' => 6, 'title' => 'Thiết Kế Giao Diện Web Với Figma 2025', 'instructor' => 'Nguyễn Thị F', 'progress' => 95],
];

// Danh sách ảnh đẹp từ Unsplash (không cần tải về)
$sampleImages = [
    'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&q=80',
    'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800&q=80',
    'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=800&q=80',
    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80',
    'https://images.unsplash.com/photo-1534665482403-a909d0d97c67?w=800&q=80',
    'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=800&q=80',
];
?>

<div class="container">
    <h1 class="page-title">Khóa học của tôi</h1>
    <p class="page-subtitle">Tiếp tục hành trình học tập của bạn</p>

    <div class="courses-grid">
        <?php foreach ($courses as $index => $course): 
            $img = $sampleImages[$index % count($sampleImages)]; // Lấy ảnh theo vòng
        ?>
            <div class="course-card">
                <div class="course-thumb">
                    <img src="<?= $img ?>" 
                         alt="<?= htmlspecialchars($course['title']) ?>" 
                         class="img-cover"
                         onerror="this.src='https://via.placeholder.com/800x450/6366f1/ffffff?text=Khóa+Học+Online';">
                    
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
                        <?= $course['progress'] > 0 && $course['progress'] < 100 ? 'Tiếp tục học' : 
                           ($course['progress'] == 100 ? 'Xem lại khóa học' : 'Bắt đầu học') ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
