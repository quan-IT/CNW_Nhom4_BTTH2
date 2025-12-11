<!-- views/admin/courses/pending.php -->
<?php
// Dữ liệu mẫu 100% đúng bảng courses + JOIN users & categories
$pendingCourses = [
    [
        'id' => 101,
        'title' => 'Laravel 11 – Xây Dựng Website Bán Hàng Thực Tế',
        'instructor_name' => 'Nguyễn Văn Hùng',
        'category_name' => 'Lập trình Web',
        'price' => 1999000,
        'duration_weeks' => 12,
        'level' => 'Intermediate',
        'image' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&q=80',
        'created_at' => '2025-04-08 10:30:00',
        'lesson_count' => 68
    ],
    [
        'id' => 102,
        'title' => 'Flutter 4 – App Bán Hàng iOS & Android',
        'instructor_name' => 'Trần Thị Mai',
        'category_name' => 'Lập trình Mobile',
        'price' => 1799000,
        'duration_weeks' => 14,
        'level' => 'Advanced',
        'image' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800&q=80',
        'created_at' => '2025-04-07 15:20:00',
        'lesson_count' => 92
    ],
    [
        'id' => 103,
        'title' => 'Machine Learning Từ Cơ Bản Đến Nâng Cao',
        'instructor_name' => 'Lê Minh Tuấn',
        'category_name' => 'Data Science & AI',
        'price' => 2499000,
        'duration_weeks' => 16,
        'level' => 'Advanced',
        'image' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=800&q=80',
        'created_at' => '2025-04-06 09:10:00',
        'lesson_count' => 110
    ],
];
?>

<div class="page-header">
    <div>
        <h1>Duyệt khóa học mới</h1>
        <p>Có <strong><?= count($pendingCourses) ?></strong> khóa học đang chờ duyệt</p>
    </div>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khóa học</th>
                <th>Giảng viên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Thời lượng</th>
                <th>Trình độ</th>
                <th>Ngày nộp</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pendingCourses as $c): ?>
            <tr>
                <td>#<?= $c['id'] ?></td>
                <td>
                    <div class="course-title">
                        <img src="<?= $c['image'] ?>" alt="" class="thumb-sm">
                        <div>
                            <strong><?= htmlspecialchars($c['title']) ?></strong>
                            <small><?= $c['lesson_count'] ?> bài học</small>
                        </div>
                    </div>
                </td>
                <td><?= htmlspecialchars($c['instructor_name']) ?></td>
                <td><?= htmlspecialchars($c['category_name']) ?></td>
                <td><?= number_format($c['price']) ?>₫</td>
                <td><?= $c['duration_weeks'] ?> tuần</td>
                <td>
                    <span class="level-badge <?= strtolower($c['level']) ?>">
                        <?= $c['level']=='Beginner'?'Sơ cấp':($c['level']=='Intermediate'?'Trung cấp':'Nâng cao') ?>
                    </span>
                </td>
                <td><?= date('d/m/Y', strtotime($c['created_at'])) ?></td>
                <td>
                    <div class="action-group">
                        <a href="?url=admin/courses/detail&id=<?= $c['id'] ?>" class="btn-icon view" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="?url=admin/courses/approve" method="POST" style="display:inline;">
                            <input type="hidden" name="course_id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn-icon approve" title="Duyệt">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="?url=admin/courses/reject" method="POST" style="display:inline;">
                            <input type="hidden" name="course_id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn-icon reject" title="Từ chối"
                                    onclick="return confirm('Từ chối khóa học này?')">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>