<?php
// views/instructor/course/edit.php

if (!isset($course)) {
    echo "Không tìm thấy dữ liệu khóa học.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Khóa Học: <?= htmlspecialchars($course['title'] ?? '...') ?></title>
    <style>
        :root {
            --accent: #2563eb;
            --accent-soft: rgba(37, 99, 235, 0.08);
            --accent-soft-strong: rgba(37, 99, 235, 0.12);
            --border: #e5e7eb;
            --text: #111827;
            --text-soft: #6b7280;
            --bg: #ffffff;
            --bg-page: #f3f4f6;
            --success: #16a34a;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg-page);
            color: var(--text);
            min-height: 100vh;
        }

        .page {
            max-width: 1100px;
            margin: 32px auto 40px;
            padding: 0 16px;
        }

        .banner {
            background: linear-gradient(135deg, #eff6ff, #ecfdf3);
            border-radius: 16px;
            border: 1px solid #dbeafe;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .banner-icon {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: #2563eb;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .banner-content-title {
            font-size: 14px;
            font-weight: 600;
        }

        .banner-content-text {
            font-size: 13px;
            color: var(--text-soft);
        }

        .page-header {
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--text-soft);
        }

        .page-meta {
            font-size: 12px;
            color: var(--text-soft);
            text-align: right;
        }

        .card {
            background: var(--bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            padding: 20px 22px 22px;
            margin-top: 10px;
        }

        .card-header {
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 12px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
        }

        .card-description {
            font-size: 13px;
            color: var(--text-soft);
        }

        .badge {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-soft);
            padding: 3px 8px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #f9fafb;
            white-space: nowrap;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-card {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            padding: 8px 10px;
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-soft);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 14px;
            font-weight: 600;
        }

        .stat-sub {
            font-size: 12px;
            color: var(--text-soft);
        }

        .stat-badge-green {
            color: var(--success);
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 999px;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            margin-left: 6px;
        }

        form {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 18px 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .label-row {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 8px;
        }

        label {
            font-size: 13px;
            font-weight: 500;
        }

        .hint {
            font-size: 12px;
            color: var(--text-soft);
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            font-size: 13px;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #f9fafb;
            color: var(--text);
            outline: none;
            transition: 0.16s ease;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        input[type="file"] {
            font-size: 13px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--accent);
            background: #ffffff;
            box-shadow: 0 0 0 1px var(--accent-soft);
        }

        .form-footer {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 4px;
        }

        .btn {
            border-radius: 999px;
            padding: 8px 16px;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-secondary {
            border-color: var(--border);
            background: #ffffff;
            color: var(--text-soft);
        }

        .btn-primary {
            background: var(--accent);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        @media (max-width: 900px) {
            form { grid-template-columns: 1fr; }
            .page { margin-top: 20px; }
            .stats-row { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-meta { text-align: left; }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="banner">
        <div class="banner-icon">✏️</div>
        <div>
            <div class="banner-content-title">Chỉnh sửa khóa học hiện tại</div>
            <div class="banner-content-text">
                Cập nhật thông tin chi tiết của khóa học ID: <?= htmlspecialchars($course['id']) ?>.
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Chỉnh sửa: <?= htmlspecialchars($course['title'] ?? 'Khóa học') ?></h1>
            <p class="page-subtitle">
                Cập nhật thông tin tổng quan, giá và hình ảnh.
            </p>
        </div>
        <div class="page-meta">
            Khóa học ID: <?= htmlspecialchars($course['id']) ?><br>
            <span>Lần cập nhật cuối: <?= htmlspecialchars($course['updated_at'] ?? 'Chưa rõ') ?></span>
        </div>
    </div>

    <section class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Thông tin khóa học</div>
                <div class="card-description">
                    Tên, mô tả, danh mục, giá, thời lượng và cấp độ.
                </div>
            </div>
            <span class="badge">Đang chỉnh sửa</span>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Tình trạng</div>
                <div class="stat-value">
                    <?= htmlspecialchars($course['is_published'] ?? 'Bản nháp') ?>
                    <span class="stat-badge-green">An toàn chỉnh sửa</span>
                </div>
                <div class="stat-sub">Khóa học chỉ hiển thị với bạn cho đến khi xuất bản.</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Giá hiện tại</div>
                <div class="stat-value">
                    <?= number_format($course['price'] ?? 0, 0, ',', '.') ?> VNĐ
                </div>
                <div class="stat-sub">Thay đổi giá sẽ có hiệu lực ngay lập tức.</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tạo lúc</div>
                <div class="stat-value">
                    <?= date('d/m/Y', strtotime($course['created_at'] ?? 'now')) ?>
                </div>
                <div class="stat-sub">ID giảng viên: <?= htmlspecialchars($course['instructor_id'] ?? 'N/A') ?>.</div>
            </div>
        </div>

        <form action="index.php?url=course/update/<?= htmlspecialchars($course['id']) ?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <div class="label-row">
                    <label for="title">Tên khóa học *</label>
                    <span class="hint">Tên rõ ràng, dễ tìm kiếm.</span>
                </div>
                <input type="text" id="title" name="title" required
                       value="<?= htmlspecialchars($course['title'] ?? '') ?>">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="description">Mô tả *</label>
                    <span class="hint">Tóm tắt nội dung & lợi ích.</span>
                </div>
                <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($course['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="category_id">Danh mục *</label>
                    <span class="hint">Chọn nhóm phù hợp.</span>
                </div>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Chọn Danh Mục Khóa Học --</option>
                    <?php 
                    $current_cat_id = $course['category_id'] ?? null;
                    if (isset($categories) && is_array($categories) && !empty($categories)):
                        foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>"
                                <?= ($current_cat_id == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                    <?php endforeach;
                    endif;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="price">Giá (VNĐ)</label>
                    <span class="hint">Để 0 nếu miễn phí.</span>
                </div>
                <input type="number" id="price" name="price" step="0.01" min="0"
                       value="<?= htmlspecialchars($course['price'] ?? 0) ?>">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="duration_weeks">Thời lượng (tuần)</label>
                    <span class="hint">Số tuần dự kiến.</span>
                </div>
                <input type="number" id="duration_weeks" name="duration_weeks" min="1"
                       value="<?= htmlspecialchars($course['duration_weeks'] ?? 1) ?>">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="level">Cấp độ *</label>
                    <span class="hint">Trình độ mục tiêu.</span>
                </div>
                <select id="level" name="level" required>
                    <?php $current_level = $course['level'] ?? 'Beginner'; ?>
                    <option value="Beginner" <?= ($current_level === 'Beginner') ? 'selected' : '' ?>>Beginner</option>
                    <option value="Intermediate" <?= ($current_level === 'Intermediate') ? 'selected' : '' ?>>Intermediate</option>
                    <option value="Advanced" <?= ($current_level === 'Advanced') ? 'selected' : '' ?>>Advanced</option>
                </select>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="course_image">Ảnh khóa học</label>
                    <span class="hint">Tỷ lệ ngang, rõ nét.</span>
                </div>
                <?php $current_image = $course['image'] ?? null; ?>
                <?php if ($current_image && file_exists($current_image)): ?>
                    <img src="<?= htmlspecialchars($current_image) ?>"
                         alt="Ảnh hiện tại"
                         style="width: 100%; max-height: 150px; object-fit: cover;
                                border-radius: 8px; margin-bottom: 8px;
                                border: 1px solid var(--border);">
                    <span class="hint" style="margin-bottom: 6px;">
                        Ảnh hiện tại: <?= htmlspecialchars(basename($current_image)) ?>
                    </span>
                <?php endif; ?>
                <input type="file" id="course_image" name="course_image" accept="image/*">
                <span class="hint">Chọn file mới nếu bạn muốn thay đổi ảnh.</span>
            </div>

            <div class="form-footer">
                <a href="index.php?url=course/manage" class="btn btn-secondary" style="text-decoration:none;">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>
