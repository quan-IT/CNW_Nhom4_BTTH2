<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khóa Học - Giảng Viên</title>
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

        .page-title-wrap h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .page-title-wrap p {
            font-size: 14px;
            color: var(--text-soft);
        }

        .page-meta {
            font-size: 12px;
            color: var(--text-soft);
            text-align: right;
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .info-pill {
            border-radius: 999px;
            border: 1px solid var(--border);
            background: #ffffff;
            padding: 6px 10px;
            font-size: 12px;
            color: var(--text-soft);
        }

        .info-pill strong {
            color: var(--text);
            font-weight: 600;
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

        .card-subtitle {
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

        .create-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background-color: var(--accent);
            color: white;
            text-decoration: none;
            border-radius: 999px;
            font-size: 13px;
            border: none;
        }

        .create-btn:hover {
            background-color: #1d4ed8;
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

        .price-cell { white-space: nowrap; }

        .empty-state {
            padding: 18px 0;
            font-size: 14px;
            color: var(--text-soft);
        }

        .action-link {
            margin-right: 8px;
            text-decoration: none;
            color: var(--accent);
            font-size: 13px;
        }

        .action-link:hover { text-decoration: underline; }

        .chip-id {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-size: 12px;
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
        <div class="page-title-wrap">
            <h2>Quản lý khóa học</h2>
            <p>Xem và chỉnh sửa các khóa học bạn đang phụ trách.</p>
        </div>
        <div class="page-meta">
            Vai trò: Giảng viên<br>
            <span>Trang danh sách khóa học</span>
        </div>
    </div>

    <div class="info-row">
        <div class="info-pill">
            Tổng khóa học: <strong><?= isset($courses) ? count($courses) : 0 ?></strong>
        </div>
        <div class="info-pill">
            Trạng thái: <strong>Đang hoạt động</strong>
        </div>
        <div class="info-pill">
            Gợi ý: Sắp xếp khóa học theo chủ đề để học viên dễ tìm.
        </div>
    </div>

    <section class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Danh sách khóa học của tôi</div>
                <div class="card-subtitle">
                    Bạn có thể chỉnh sửa nội dung, quản lý bài học hoặc xóa khóa học.
                </div>
            </div>
            <span class="badge-count">
                <?= isset($courses) ? count($courses) : 0 ?> khóa học
            </span>
        </div>

        <div style="margin-bottom: 10px;">
            <a href="index.php?url=course/create" class="create-btn">
                <span>➕</span> <span>Tạo khóa học mới</span>
            </a>
        </div>

        <?php if (empty($courses)): ?>
            <div class="empty-state">
                Bạn chưa tạo khóa học nào. Hãy bấm "<strong>Tạo khóa học mới</strong>" để bắt đầu.
            </div>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Cấp độ</th>
                        <th>Thời lượng</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Bài học</th>
                        <th>Thao tác</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td>
                                <span class="chip-id">
                                    #<?= htmlspecialchars($course['id']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($course['title']) ?></td>
                            <td>
                                <?= htmlspecialchars($course['category_name'] ?? 'Chưa có') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($course['level'] ?? '-') ?>
                            </td>
                            <td>
                                <?= isset($course['duration_weeks']) && $course['duration_weeks'] > 0
                                    ? (int)$course['duration_weeks'] . ' tuần'
                                    : '—' ?>
                            </td>
                            <td class="price-cell">
                                <?= number_format($course['price'], 0, ',', '.') ?> VNĐ
                            </td>
                            <td>
                                <?php if (!empty($course['image'])): ?>
                                    <img src="<?= htmlspecialchars($course['image']) ?>"
                                        alt="Ảnh khóa học"
                                        style="width: 80px; height: 48px; object-fit: cover; border-radius: 6px; border:1px solid #e5e7eb;">
                                <?php else: ?>
                                    <span style="font-size:12px; color:#9ca3af;">Chưa có</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="index.php?url=lesson/manage/<?= htmlspecialchars($course['id']) ?>"
                                   class="action-link">Quản lý bài học</a>
                            </td>
                            <td>
                                <a href="index.php?url=course/edit/<?= htmlspecialchars($course['id']) ?>"
                                   class="action-link">Sửa</a>
                                <a href="index.php?url=course/delete/<?= htmlspecialchars($course['id']) ?>"
                                   class="action-link"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</div>
</body>
</html>
