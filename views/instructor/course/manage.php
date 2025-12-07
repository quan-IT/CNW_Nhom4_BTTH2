<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khóa Học - Giảng Viên</title>
    <style>
        /* CSS đơn giản cho bảng */
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { border-bottom: 2px solid #eee; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-link { margin-right: 10px; text-decoration: none; color: #007bff; }
        .action-link:hover { text-decoration: underline; }
        .create-btn { display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>🛠️ Danh Sách Khóa Học Của Tôi</h2>
    
    <a href="index.php?url=course/create" class="create-btn">➕ Tạo Khóa Học Mới</a>

    <?php if (empty($courses)): ?>
        <p>Bạn chưa tạo khóa học nào.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Bài học</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><?= htmlspecialchars($course['title']) ?></td>
                        <td><?= htmlspecialchars($course['category_id']) ?></td> <td><?= number_format($course['price'], 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <a href="index.php?url=lesson/manageLessons/<?= htmlspecialchars($course['id']) ?>" class="action-link">Quản lý</a>
                        </td>
                        <td>
                            <a href="index.php?url=course/edit/<?= htmlspecialchars($course['id']) ?>" class="action-link">Sửa</a>
                            <a href="index.php?url=course/delete/<?= htmlspecialchars($course['id']) ?>" class="action-link" 
                                onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>