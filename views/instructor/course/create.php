<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Khóa Học Mới</title>
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        /* Banner màu trên cùng */
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
            font-size: 16px;
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

        /* Các ô info nhỏ phía trên form */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 12px;
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

        /* Form */
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
            justify-content: flex-end;
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
            form {
                grid-template-columns: 1fr;
            }
            .page {
                margin-top: 20px;
            }
            .stats-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="page">
    <!-- Banner màu nhẹ trên cùng -->
    <div class="banner">
        <div class="banner-icon">🎯</div>
        <div>
            <div class="banner-content-title">Bắt đầu một khóa học mới</div>
            <div class="banner-content-text">
                Đặt tên, mô tả và thông tin rõ ràng sẽ giúp học viên hiểu nhanh giá trị khóa học của bạn.
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Tạo khóa học mới</h1>
            <p class="page-subtitle">
                Thiết lập chi tiết cơ bản trước, bạn có thể chỉnh sửa nội dung sau.
            </p>
        </div>
        <div class="page-meta">
            Bước 1 / 3<br>
            <span>Thông tin tổng quan</span>
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
            <span class="badge">Bản nháp</span>
        </div>

        <!-- Các ô thông tin nhỏ để đỡ trống, chỉ là giao diện -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Tình trạng</div>
                <div class="stat-value">
                    Chưa xuất bản
                    <span class="stat-badge-green">An toàn chỉnh sửa</span>
                </div>
                <div class="stat-sub">Khóa học chỉ hiển thị với bạn cho đến khi xuất bản.</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Số bài học gợi ý</div>
                <div class="stat-value">8 - 15 bài</div>
                <div class="stat-sub">Độ dài vừa phải giúp học viên dễ theo dõi.</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Thời lượng gợi ý</div>
                <div class="stat-value">4 - 6 tuần</div>
                <div class="stat-sub">Phù hợp với lịch học bán thời gian.</div>
            </div>
        </div>

        <!-- GIỮ action & name ĐỂ PHP HOẠT ĐỘNG NHƯ CŨ -->
        <form action="index.php?url=course/store" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <div class="label-row">
                    <label for="title">Tên khóa học *</label>
                    <span class="hint">Tên rõ ràng, dễ tìm kiếm.</span>
                </div>
                <input type="text" id="title" name="title" required
                       value="Tên Khóa Học Mẫu">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="description">Mô tả *</label>
                    <span class="hint">Tóm tắt nội dung & lợi ích.</span>
                </div>
                <textarea id="description" name="description" rows="5" required>
Mô tả chi tiết nội dung khóa học...
                </textarea>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="category_id">Danh mục *</label>
                    <span class="hint">Chọn nhóm phù hợp.</span>
                </div>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Chọn Danh Mục Khóa Học --</option> 

                    <?php 
                    if (isset($categories) && is_array($categories) && !empty($categories)):
                        // Duyệt qua dữ liệu thực tế từ CSDL
                        foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                    <?php endforeach; 
                    endif;
                    // XÓA KHỐI IF (EMPTY($CATEGORIES)) ĐỂ TRÁNH TRÙNG LẶP
                    ?>
                </select>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="price">Giá (VNĐ)</label>
                    <span class="hint">Để 0 nếu miễn phí.</span>
                </div>
                <input type="number" id="price" name="price" step="0.01" min="0" value="500000">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="duration_weeks">Thời lượng (tuần)</label>
                    <span class="hint">Số tuần dự kiến.</span>
                </div>
                <input type="number" id="duration_weeks" name="duration_weeks" min="1" value="4">
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="level">Cấp độ *</label>
                    <span class="hint">Trình độ mục tiêu.</span>
                </div>
                <select id="level" name="level" required>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="course_image">Ảnh khóa học</label>
                    <span class="hint">Tỷ lệ ngang, rõ nét.</span>
                </div>
                <input type="file" id="course_image" name="course_image" accept="image/*">
            </div>

            <div class="form-footer">
                <button type="button" class="btn btn-secondary">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu & tạo khóa học</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>
