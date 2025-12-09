<?php 
// Giả định biến $course đã được LessonController chuẩn bị
if (!isset($course)) {
    die("Lỗi: Không tìm thấy khóa học.");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Bài Học Mới</title>
    <style>
        :root {
            --accent: #2563eb;
            --accent-soft: rgba(37, 99, 235, 0.08);
            --border: #e5e7eb;
            --text: #111827;
            --text-soft: #6b7280;
            --bg: #ffffff;
            --bg-page: #f3f4f6;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg-page);
            color: var(--text);
            min-height: 100vh;
        }

        .page {
            max-width: 1000px;
            margin: 32px auto 40px;
            padding: 0 16px;
        }

        .banner {
            background: linear-gradient(135deg, #eef2ff, #eff6ff);
            border-radius: 16px;
            border: 1px solid #dbeafe;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .banner-icon {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #2563eb;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .banner-title {
            font-size: 14px;
            font-weight: 600;
        }

        .banner-text {
            font-size: 13px;
            color: var(--text-soft);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 16px;
        }

        .page-title {
            font-size: 22px;
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

        .btn {
            border-radius: 999px;
            padding: 7px 14px;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
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

        .card {
            background: var(--bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.05);
            padding: 18px 20px 20px;
        }

        .card-header {
            margin-bottom: 14px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .card-subtitle {
            font-size: 13px;
            color: var(--text-soft);
        }

        form {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 16px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
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
        textarea {
            width: 100%;
            font-size: 13px;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #f9fafb;
            color: var(--text);
            outline: none;
            transition: 0.15s ease;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        input:focus,
        textarea:focus {
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

        @media (max-width: 900px) {
            form { grid-template-columns: 1fr; }
            .page { margin-top: 20px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-meta { text-align: left; }
        }
    </style>
</head>
<body>
<div class="page">

    <div class="banner">
        <div class="banner-icon">📘</div>
        <div>
            <div class="banner-title">Thêm bài học vào khóa học</div>
            <div class="banner-text">
                Khóa học: <strong><?= htmlspecialchars($course['title']) ?></strong> (ID: <?= htmlspecialchars($course['id']) ?>)
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Tạo bài học mới</h1>
            <p class="page-subtitle">
                Thiết lập tiêu đề, nội dung tóm tắt và vị trí của bài học trong khóa học.
            </p>
        </div>
        <div class="page-meta">
            <a href="index.php?url=lesson/manage/<?= htmlspecialchars($course['id']) ?>" 
               class="btn btn-secondary">&lt; Quay lại</a>
        </div>
    </div>

    <section class="card">
        <div class="card-header">
            <div class="card-title">Chi tiết bài học</div>
            <div class="card-subtitle">
                Thêm một bài học mới cho khóa học hiện tại.
            </div>
        </div>

        <!-- GIỮ NGUYÊN action & name để backend hoạt động như cũ -->
        <form action="index.php?url=lesson/store/<?= htmlspecialchars($course['id']) ?>" method="POST">

            <div class="form-group full-width">
                <label for="title">Tiêu đề bài học *</label>
                <span class="hint">Ví dụ: Bài 1: Giới thiệu về mô hình MVC.</span>
                <input type="text" id="title" name="title" required
                       placeholder="Ví dụ: Bài 1: Giới thiệu về MVC">
            </div>

            <div class="form-group full-width">
                <label for="content">Nội dung bài học (tóm tắt)</label>
                <span class="hint">Mô tả tóm tắt nội dung hoặc ghi chú chính của bài học.</span>
                <textarea id="content" name="content" rows="5"
                          placeholder="Mô tả tóm tắt nội dung bài học hoặc ghi chú quan trọng."></textarea>
            </div>

            <div class="form-group">
                <label for="video_url">Đường dẫn Video (URL)</label>
                <span class="hint">Link YouTube, Vimeo hoặc nguồn video khác (nếu có).</span>
                <input type="text" id="video_url" name="video_url"
                       placeholder="Ví dụ: https://www.youtube.com/watch?v=...">
            </div>

            <div class="form-group">
                <label for="order">Thứ tự bài học *</label>
                <span class="hint">Vị trí xuất hiện trong danh sách bài học (1, 2, 3,...).</span>
                <input type="number" id="order" name="order" min="1" value="1" required>
            </div>

            <div class="form-footer">
                <a href="index.php?url=lesson/manage/<?= htmlspecialchars($course['id']) ?>"
                   class="btn btn-secondary">Hủy</a>
                <button type="submit" class="btn btn-primary">Tạo bài học</button>
            </div>
        </form>
    </section>
</div>
</body>
</html>
