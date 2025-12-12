<div class="course-detail-wrapper">
    <?php
    // đảm bảo các trường tồn tại
    $id = $course['id'];
    $title = $course['title'] ?? 'Không tên';
    $description = $course['description'] ?? '';
    $image = $course['imag'] ?? 'assets/java.png';      //image
    $instructorName = $course['instructor_name'] ?? 'Ẩn danh';
    $category_name = $course['category_name'] ?? '';
    $levelLabel = ($course['level'] == 'Beginner') ? 'Sơ cấp' : (($course['level'] == 'Intermediate') ? 'Trung cấp' : 'Nâng cao');
    $duration = isset($course['duration_weeks']) ? (int)$course['duration_weeks'] : 0;
    $priceFormatted = isset($course['price']) ? number_format($course['price'], 0, ',', '.') . ' ₫' : 'Miễn phí';
    ?>
    <!-- LEFT + RIGHT layout -->
    <div class="course-top">

        <!-- LEFT CONTENT -->
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
                    <span><strong>Trình độ:</strong>
                        <?= $levelLabel ?>
                    </span>
                </div>

            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="course-right">

            <!-- COURSE THUMBNAIL -->
            <img src="<?= htmlspecialchars($image) ?>"
                alt="Course Thumbnail"
                class="course-thumbnail">
            <?php if (!$active): ?>
                <!-- CHƯA ĐĂNG KÍ -->
                <div class="price-box">
                    <div class="price">
                        <?= number_format($course['price'], 0, ',', '.') ?> ₫
                    </div>

                    <form method="POST">
                        <button name="enroll" class="btn-enroll">
                            <i class="fas fa-play-circle"></i> Đăng kí học
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <!-- ĐÃ ĐĂNG KÍ -->
                <a href="mycourse_detail.php?id=<?= $course['id'] ?>" class="btn-enroll">
                    <i class="fas fa-door-open"></i> Cút con mm
                </a>
            <?php endif; ?>
        </div>

    </div>

    <!-- LESSON LIST -->
    <h3 class="lesson-list-title">Danh sách bài học</h3>

    <div class="lesson-list">
        <?php foreach ($lessons as $l): ?>
            <?php
            $id = $l['id'];
            $title = $l['title'];
            ?>
            <a href="course-detail.php?id=<?= $id ?>" class="lesson-item">
                <i class="fas fa-book"></i>
                <span><?= htmlspecialchars($title) ?></span>
            </a>
        <?php endforeach; ?>
    </div>

</div>
<script src="assets/js/register/register.js"></script>