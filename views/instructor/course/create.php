<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Khóa Học Mới</title>
    <style>
        /* CSS đơn giản cho form */
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; }
    </style>
</head>
<body>

    <h2>📝 Tạo Khóa Học Mới</h2>

    <form action="index.php?url=course/store" method="POST" enctype="multipart/form-data">

        <label for="title">Tên Khóa Học *</label>
        <input type="text" id="title" name="title" required value="Tên Khóa Học Mẫu">

        <label for="description">Mô Tả *</label>
        <textarea id="description" name="description" rows="5" required>Mô tả chi tiết nội dung khóa học...</textarea>

        <label for="category_id">Danh Mục *</label>
        <select id="category_id" name="category_id" required>
            <?php 
            // $categories được truyền từ CourseController->create()
            if (isset($categories) && is_array($categories)): 
                foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
            <?php endforeach; 
            endif;
            // Trường hợp chưa có danh mục nào trong CSDL:
            if (empty($categories)): ?>
                <option value="1">Lập trình (Tạm thời)</option>
            <?php endif; ?>
        </select>

        <div>
            <label for="price">Giá (VNĐ)</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="500000">
        </div>
        
        <div>
            <label for="duration_weeks">Thời Lượng (tuần)</label>
            <input type="number" id="duration_weeks" name="duration_weeks" min="1" value="4">
        </div>

        <label for="level">Cấp Độ *</label>
        <select id="level" name="level" required>
            <option value="Beginner">Cơ bản (Beginner)</option>
            <option value="Intermediate">Trung cấp (Intermediate)</option>
            <option value="Advanced">Nâng cao (Advanced)</option>
        </select>

        <label for="course_image">Ảnh Khóa Học</label>
        <input type="file" id="course_image" name="course_image" accept="image/*">

        <button type="submit">💾 Tạo Khóa Học</button>
    </form>
</body>
</html>