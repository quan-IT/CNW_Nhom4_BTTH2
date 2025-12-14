<?php 
// Giả định các biến $course và $lessons đã được LessonController chuẩn bị
if (!isset($course) || !isset($lessons)) {
    die("Lỗi: Không đủ dữ liệu để hiển thị.");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Bài Học: <?= htmlspecialchars($course['title']) ?></title>
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
            max-width: 1100px;
            margin: 32px auto 40px;
            padding: 0 16px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 18px;
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
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.05);
            padding: 16px 18px 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
        }

        .card-description {
            font-size: 13px;
            color: var(--text-soft);
        }

        .badge-count {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .table-wrapper {
            margin-top: 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background-color: #f9fafb;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-weight: 500;
            color: var(--text-soft);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        .lesson-title {
            font-weight: 600;
        }

        .col-center {
            text-align: center;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .link {
            font-size: 13px;
            text-decoration: none;
        }

        .link-blue { color: #2563eb; }
        .link-red  { color: #dc2626; }

        .empty-state {
            text-align: center;
            padding: 20px;
            color: #9ca3af;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-meta { text-align: left; }
        }
    </style>
</head>
<body>
<div class="page">

    <div class="page-header">
        <div>
            <h1 class="page-title">Quản lý bài học</h1>
            <p class="page-subtitle">
                Khóa học: <strong><?= htmlspecialchars($course['title']) ?></strong>
                (ID: <?= htmlspecialchars($course['id']) ?>)
            </p>
        </div>
        <div class="page-meta">
            <a href="index.php?url=course/manage" class="btn btn-secondary">&lt; Quay lại</a>
        </div>
    </div>

    <section class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách bài học</div>
                <div class="card-description">
                    Tổng số bài học: <?= count($lessons) ?>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <span class="badge-count"><?= count($lessons) ?> bài</span>
                <a href="index.php?url=lesson/create/<?= htmlspecialchars($course['id']) ?>"
                   class="btn btn-primary">+ Thêm bài học mới</a>
            </div>
        </div>

        <?php if (!empty($lessons)): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tiêu đề bài học</th>
                        <th>Video</th>
                        <th class="col-center">Tài liệu</th>
                        <th class="col-center">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lessons as $lesson): ?>
                        <tr>
                            <td><?= htmlspecialchars($lesson['order']) ?></td>
                            <td>
                                <span class="lesson-title">
                                    <?= htmlspecialchars($lesson['title']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($lesson['video_url'])): ?>
                                    <a href="<?= htmlspecialchars($lesson['video_url']) ?>" target="_blank"
                                       class="link link-blue">Xem video</a>
                                <?php else: ?>
                                    <span style="font-size:12px; color:#9ca3af;">(Chưa có)</span>
                                <?php endif; ?>
                            </td>
                            <td class="col-center">
                                <a href="index.php?url=material/document/<?= htmlspecialchars($lesson['id']) ?>"
                                   class="link link-blue">QL Tài liệu</a>
                            </td>
                            <td class="col-center">
                                <div class="actions">
                                    <a href="index.php?url=lesson/edit/<?= htmlspecialchars($lesson['id']) ?>"
                                       class="link link-blue">Sửa</a>
                                    <a href="index.php?url=lesson/delete/<?= htmlspecialchars($lesson['id']) ?>"
                                       class="link link-red"
                                       onclick="return confirm('Xóa bài học này sẽ xóa tất cả tài liệu liên quan. Bạn có chắc không?');">
                                        Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="table-wrapper">
                <div class="empty-state">
                    Khóa học này chưa có bài học nào. Hãy bắt đầu tạo bài học đầu tiên!
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>
</body>
</html>
