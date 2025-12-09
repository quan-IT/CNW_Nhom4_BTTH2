<!-- admin/categories/edit.php -->
<?php
// Giả lập dữ liệu đang sửa (sẽ lấy từ DB thật)
$category = [
    'id' => 1,
    'name' => 'Lập trình Web',
    'description' => 'HTML, CSS, JavaScript, PHP, Laravel, Node.js, React, Vue.js...',
    'created_at' => '2024-01-15'
];
?>

<div class="page-header">
    <h1>Sửa danh mục #<?= $category['id'] ?></h1>
    <a href="?url=admin/categories" class="btn-back">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="form-container">
    <form action="?url=admin/categories/update&id=<?= $category['id'] ?>" method="POST" class="category-form">
        <div class="form-group">
            <label>Tên danh mục <span class="required">*</span></label>
            <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" rows="5"><?= htmlspecialchars($category['description']) ?></textarea>
        </div>

        <div class="form-info">
            <small>Ngày tạo: <?= date('d/m/Y H:i', strtotime($category['created_at'])) ?></small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Cập nhật
            </button>
            <a href="?url=admin/categories" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>