<?php ?>

<div class="container">
    <div class="head-title">
        <h1 class="page-title">Khóa học của tôi</h1>
        <p class="page-subtitle">Tiếp tục hành trình học tập của bạn</p>

        <div class="search-wrapper">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search courses..." id="searchCourse">
            </div>
            <button class="btn-search">Tìm kiếm</button>
        </div>
    </div>

    <div class="courses-grid">
        <?php foreach ($courses as $course): ?>

            <?php
            $id = $course['id'];
            $title = $course['title'] ?? 'Không tên';
            $image = $course['image'] ?? 'assets/java.png';
            $instructor = $course['instructor_name'] ?? 'Ẩn danh';
            $level = $course['level'] ?? '';
            $levelLabel = $level == 'Beginner' ? 'Sơ cấp' : ($level == 'Intermediate' ? 'Trung cấp' : 'Nâng cao');
            $duration = $course['duration_weeks'] ?? 0;
            $priceFormatted = isset($course['price'])
                ? number_format($course['price'], 0, ',', '.') . " ₫"
                : 'Miễn phí';
            $progress = $course['progress'] ?? 0;
            ?>

            <div class="course-card">

                <div class="course-thumb">
                    <img src="<?= htmlspecialchars($image) ?>"
                        alt="<?= htmlspecialchars($title) ?>"
                        class="img-cover">
                </div>

                <div class="course-body">
                    <h3 class="course-title"><?= htmlspecialchars($title) ?></h3>

                    <p class="course-instructor">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <?= htmlspecialchars($instructor) ?>
                    </p>

                    <?php if ($progress > 0): ?>
                        <div class="progress-bar-container">
                            <div class="progress-bar">
                                <div class="progress-fill"
                                    style="width: <?= $progress ?>%;"></div>
                            </div>
                            <span class="progress-label"><?= $progress ?>%</span>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Chưa bắt đầu học</p>
                    <?php endif; ?>

                    <a href="index.php?url=lesson/learn&course_id=<?= $id ?>" class="btn-action">
                        <i class="fas fa-play-circle"></i>
                        Vào học
                    </a>

                </div>

            </div>

        <?php endforeach; ?>
    </div>
</div>