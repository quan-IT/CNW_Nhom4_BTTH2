<!-- admin/categories/create.php -->
<div class="page-header">
    <h1>Thêm danh mục mới</h1>
    <a href="?url=admin/categories" class="btn-back">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="form-container">
    <form action="?url=admin/categories/store" method="POST" class="category-form">
        <div class="form-group">
            <label>Tên danh mục <span class="required">*</span></label>
            <input type="text" name="name" required placeholder="VD: Lập trình Web">
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" rows="5" placeholder="Mô tả ngắn gọn về danh mục này..."></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Lưu danh mục
            </button>
            <a href="?url=admin/categories" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>