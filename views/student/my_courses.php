 <?php
    // $courses = [
    //     ['id' => 1, 'title' => 'Học ReactJS Từ A-Z Cho Người Mới Bắt Đầu',               'instructor' => 'Nguyễn Văn A', 'progress' => 78, 'img' => 'assets/java.png'],
    //     ['id' => 2, 'title' => 'Lập Trình Laravel 10 - Xây Dựng Website Bán Hàng',      'instructor' => 'Trần Thị B',   'progress' => 45, 'img' => 'assets/java.png'],
    //     ['id' => 3, 'title' => 'Vue 3 + Vuex + Firebase - Fullstack Real Project',      'instructor' => 'Lê Văn C',     'progress' => 100, 'img' => 'assets/java.png'],
    //     ['id' => 4, 'title' => 'HTML CSS Từ Zero đến Hero',                             'instructor' => 'Phạm Thị D',   'progress' => 0,  'img' => 'assets/java.png'],
    //     ['id' => 5, 'title' => 'Node.js & Express - Xây dựng RESTful API',              'instructor' => 'Hoàng Văn E',  'progress' => 23, 'img' => 'assets/java.png'],
    //     ['id' => 6, 'title' => 'Thiết Kế Giao Diện Web Với Figma 2025',                 'instructor' => 'Nguyễn Thị F', 'progress' => 95, 'img' => 'assets/java.png'],
    // ];
    ?>



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
                // đảm bảo các trường tồn tại
                $id = $course['id'];
                $title = $course['title'] ?? 'Không tên';
                $image = $course['image'] ?? 'assets/java.png';
                $instructorName = $course['instructor_name'] ?? 'Ẩn danh';
                $levelLabel = ($course['level'] == 'Beginner') ? 'Sơ cấp' : (($course['level'] == 'Intermediate') ? 'Trung cấp' : 'Nâng cao');
                $duration = isset($course['duration_weeks']) ? (int)$course['duration_weeks'] : 0;
                $priceFormatted = isset($course['price']) ? number_format($course['price'], 0, ',', '.') . ' ₫' : 'Miễn phí';
                $progress = $course['progress'] ?? 0;
                ?>
             <div class="course-card">
                 <div class="course-thumb">
                     <!-- ĐÃ SỬA: dùng đúng $course['img'] -->
                     <img src="<?= htmlspecialchars($image) ?>"
                         alt="<?= htmlspecialchars($title) ?>"
                         class="img-cover">




                 </div>

                 <div class="course-body">
                     <h3 class="course-title"><?= htmlspecialchars($title) ?></h3>

                     <p class="course-instructor">
                         <i class="fas fa-chalkboard-teacher"></i> <?= htmlspecialchars($instructorName) ?>
                     </p>

                     <?php if ($progress > 0): ?>
                         <div class="progress-bar-container">
                             <div class="progress-bar">
                                 <div class="progress-fill" style="width: <?= $course['progress'] ?>%"></div>
                             </div>
                             <span class="progress-label">
                                 <?= htmlspecialchars($progress) ?>
                             </span>
                         </div>
                     <?php else: ?>
                         <p class="text-muted">Chưa bắt đầu học</p>
                     <?php endif; ?>

                     <a href="index.php?url=test/lesson" class="btn-action">
                         <i class="fas fa-play-circle"></i>
                         <?= htmlspecialchars($progress) ?>
                     </a>
                 </div>
             </div>
         <?php endforeach; ?>
     </div>
 </div>