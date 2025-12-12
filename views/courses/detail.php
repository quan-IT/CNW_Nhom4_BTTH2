<div class="course-detail-wrapper">
    <?php
    $id = $course['id'];
    $title = $course['title'] ?? 'Không tên';
    $description = $course['description'] ?? '';
    $image = $course['imag'] ?? 'assets/java.png';
    $instructorName = $course['instructor_name'] ?? 'Ẩn danh';
    $category_name = $course['category_name'] ?? '';
    $levelLabel = ($course['level'] == 'Beginner') ? 'Sơ cấp' : (($course['level'] == 'Intermediate') ? 'Trung cấp' : 'Nâng cao');
    $duration = isset($course['duration_weeks']) ? (int)$course['duration_weeks'] : 0;
    $priceFormatted = isset($course['price']) ? number_format($course['price'], 0, ',', '.') . ' ₫' : 'Miễn phí';
    ?>

    <div class="course-top">
        <div class="course-left">
            <h1 class="course-title"><?= htmlspecialchars($title) ?></h1>
            <p class="course-description">
                <?= nl2br(htmlspecialchars($description)) ?>
            </p>

            <div class="course-info-list">
                <div class="info-item">
                    <i class="fas fa-user-tie"></i>
                    <span><strong>Giảng viên:</strong> <?= htmlspecialchars($instructorName) ?></span>
                </div>

                <div class="info-item">
                    <i class="fas fa-list"></i>
                    <span><strong>Danh mục:</strong> <?= htmlspecialchars($category_name) ?></span>
                </div>

                <div class="info-item">
                    <i class="far fa-clock"></i>
                    <span><strong>Thời lượng:</strong> <?= $duration ?> tuần</span>
                </div>

                <div class="info-item">
                    <i class="fas fa-bolt"></i>
                    <span><strong>Trình độ:</strong> <?= $levelLabel ?></span>
                </div>
            </div>
        </div>

        <div class="course-right">
            <img src="<?= htmlspecialchars($image) ?>" class="course-thumbnail">

            <?php if (!$active): ?>
                <div class="price-box">
                    <div class="price"><?= $priceFormatted ?></div>
                    <button type="button" id="btnEnroll" class="btn-enroll">
                        <i class="fas fa-play-circle"></i> Đăng kí học
                    </button>
                </div>
            <?php else: ?>
                <a href="mycourse_detail.php?id=<?= $course['id'] ?>" class="btn-enroll">
                    <i class="fas fa-door-open"></i> Vào học
                </a>
            <?php endif; ?>
        </div>
    </div>

    <h3 class="lesson-list-title">Danh sách bài học</h3>

    <div class="lesson-list">
        <?php foreach ($lessons as $l): ?>
            <a href="lesson_detail.php?id=<?= $l['id'] ?>" class="lesson-item">
                <i class="fas fa-book"></i>
                <span><?= htmlspecialchars($l['title']) ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Container dành cho toast -->
<div id="toastContainer"></div>
