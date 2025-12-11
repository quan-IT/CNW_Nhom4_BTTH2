<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Bài Học</title>
    <style>
        :root {
            --accent: #2563eb;
            --accent-soft: rgba(37, 99, 235, 0.08);
            --border: #e5e7eb;
            --text: #111827;
            --text-soft: #6b7280;
            --bg-page: #f3f4f6;
            --bg-card: #ffffff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg-page);
            color: var(--text);
            min-height: 100vh;
        }

        .page {
            max-width: 900px;
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
            font-size: 16px;
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
            margin-bottom: 16px;
        }

        .page-header h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .page-header p {
            font-size: 14px;
            color: var(--text-soft);
        }

        .card {
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.05);
            padding: 20px;
        }

        .alert-error {
            padding: 10px 12px;
            margin-bottom: 15px;
            background-color: #fee2e2;
            color: #b91c1c;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 5px;
        }

        .hint {
            font-size: 12px;
            color: var(--text-soft);
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 9px 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text);
            background: #f9fafb;
            outline: none;
            transition: 0.15s ease;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        input:focus,
        textarea:focus {
            border-color: var(--accent);
            background: #ffffff;
            box-shadow: 0 0 0 1px var(--accent-soft);
        }

        .form-footer {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-submit {
            padding: 8px 18px;
            background-color: var(--accent);
            color: white;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .link-cancel {
            font-size: 13px;
            color: var(--text-soft);
            text-decoration: none;
        }

        .link-cancel:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="page">

    <div class="banner">
        <div class="banner-icon">✏️</div>
        <div>
            <div class="banner-title">
                Chỉnh sửa bài học: <?= htmlspecialchars($lesson['title'] ?? 'Bài học') ?>
            </div>
            <div class="banner-text">
                Thuộc khóa học: <strong><?= htmlspecialchars($course['title']) ?></strong>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h2>Chỉnh sửa bài học</h2>
        <p>Cập nhật tiêu đề, thứ tự, video và nội dung chi tiết.</p>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'failed'): ?>
        <div class="alert-error">
            Lỗi! Không thể cập nhật bài học. Vui lòng kiểm tra lại dữ liệu.
        </div>
    <?php endif; ?>

    <section class="card">
        <form action="index.php?url=lesson/update/<?= htmlspecialchars($lesson['id']) ?>" method="POST">

            <div class="form-group">
                <label for="title">Tiêu đề bài học</label>
                <span class="hint">Tên rõ ràng, thể hiện nội dung chính của bài.</span>
                <input type="text" id="title" name="title"
                       value="<?= htmlspecialchars($lesson['title'] ?? '') ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="order">Thứ tự hiển thị</label>
                <span class="hint">Vị trí xuất hiện trong danh sách bài học (1, 2, 3...).</span>
                <input type="number" id="order" name="order"
                       value="<?= htmlspecialchars($lesson['order'] ?? 1) ?>"
                       min="1" required>
            </div>

            <div class="form-group">
                <label for="video_url">Liên kết Video (URL YouTube, Vimeo...)</label>
                <span class="hint">Dán link video nếu bài học có phần video minh họa.</span>
                <input type="text" id="video_url" name="video_url"
                       value="<?= htmlspecialchars($lesson['video_url'] ?? '') ?>"
                       placeholder="Ví dụ: https://youtube.com/watch?v=xyz">
            </div>

            <div class="form-group">
                <label for="content">Nội dung chi tiết (mô tả, chữ viết...)</label>
                <span class="hint">Bạn có thể ghi tóm tắt, ghi chú hoặc nội dung chính của bài.</span>
                <textarea id="content" name="content" required><?= htmlspecialchars($lesson['content'] ?? '') ?></textarea>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">Lưu thay đổi bài học</button>
                <a href="index.php?url=lesson/manage/<?= htmlspecialchars($course['id']) ?>"
                   class="link-cancel">Hủy</a>
            </div>
        </form>
    </section>
</div>
</body>
</html>
