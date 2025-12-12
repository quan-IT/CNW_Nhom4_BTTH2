<div class="course-detail-wrapper">

    <!-- LEFT + RIGHT layout -->
    <div class="course-top">

        <!-- LEFT CONTENT -->
        <div class="course-left">

            <h1 class="course-title"><?= htmlspecialchars($course['title']) ?></h1>
            <p class="course-description">
                <?= nl2br(htmlspecialchars($course['description'])) ?>
            </p>

            <div class="course-info-list">

                <div class="info-item">
                    <i class="fas fa-user-tie"></i>
                    <span><strong>Giảng viên:</strong> <?= htmlspecialchars($course['fullname'] ?? 'Ẩn danh') ?></span>
                </div>

                <div class="info-item">
                    <i class="fas fa-list"></i>
                    <span><strong>Danh mục:</strong> <?= htmlspecialchars($course['category_name']) ?></span>
                </div>

                <div class="info-item">
                    <i class="far fa-clock"></i>
                    <span><strong>Thời lượng:</strong> <?= $course['duration_weeks'] ?> tuần</span>
                </div>

                <div class="info-item">
                    <i class="fas fa-bolt"></i>
                    <span><strong>Trình độ:</strong>
                        <?= $course['level'] == 'Beginner' ? 'Sơ cấp' : ($course['level'] == 'Intermediate' ? 'Trung cấp' : 'Nâng cao') ?>
                    </span>
                </div>

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="course-right">

            <!-- COURSE THUMBNAIL -->
            <img src="<?= htmlspecialchars($course['thumbnail'] ?? 'assets/python.png') ?>"
                alt="Course Thumbnail"
                class="course-thumbnail">

            <div class="price-box">
                <div class="price">
                    <?= number_format($course['price'], 0, ',', '.') ?> ₫
                </div>

                <button class="btn-enroll" id="register_course">
                    <i class="fas fa-play-circle"></i> Bắt đầu học
                </button>
            </div>
        </div>

    </div>

    <!-- LESSON LIST -->
    <h3 class="lesson-list-title">Danh sách bài học</h3>

    <div class="lesson-list">
        <?php foreach ($lessons as $l): ?>
            <a href="course-detail.php?id=<?= $l['id'] ?>" class="lesson-item">
                <i class="fas fa-book"></i>
                <span><?= htmlspecialchars($l['title']) ?></span>
            </a>
        <?php endforeach; ?>
    </div>

</div>