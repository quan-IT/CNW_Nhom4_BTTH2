<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Tài Liệu</title>
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
            max-width: 1000px;
            margin: 32px auto 40px;
            padding: 0 16px;
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
            margin-bottom: 4px;
        }

        .page-header a {
            font-size: 13px;
            color: var(--accent);
            text-decoration: none;
        }

        .page-header a:hover {
            text-decoration: underline;
        }

        .card {
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.05);
            padding: 20px;
            margin-top: 20px;
        }

        .alert-success {
            padding: 10px 12px;
            margin-bottom: 15px;
            background-color: #d1fae5;
            color: #059669;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid #6ee7b7;
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

        .form-upload {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .file-input {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            background: #f9fafb;
        }

        .btn-upload {
            padding: 8px 15px;
            background-color: var(--accent);
            color: white;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-upload:hover {
            background-color: #1d4ed8;
        }

        .table-wrapper {
            margin-top: 15px;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .material-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .material-table th,
        .material-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .material-table th {
            background-color: #f9fafb;
            color: var(--text-soft);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .material-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .action-link-delete {
            color: #dc2626;
            text-decoration: none;
            font-size: 13px;
        }

        .action-link-delete:hover {
            text-decoration: underline;
        }

        .empty-state {
            font-size: 14px;
            color: var(--text-soft);
            text-align: center;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="page-header">
        <h2>📂 Quản lý tài liệu học tập</h2>
        <p>
            Bài học: <strong><?= htmlspecialchars($lesson['title'] ?? 'N/A') ?></strong>
            (Khóa học: <?= htmlspecialchars($course['title'] ?? 'N/A') ?>)
        </p>
        <a href="index.php?url=lesson/manage/<?= htmlspecialchars($lesson['course_id'] ?? '') ?>">
            ← Quay lại danh sách bài học
        </a>
    </div>

    <?php 
    if (isset($_GET['status']) && $_GET['status'] == 'uploaded'): ?>
        <div class="alert-success">
            Tài liệu đã được tải lên thành công!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert-error">
            Lỗi upload: <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <div style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Tải lên tài liệu mới</div>

        <form action="index.php?url=material/store/<?= htmlspecialchars($lesson['id']) ?>" 
              method="POST"
              enctype="multipart/form-data"
              class="form-upload">

            <input type="file" name="material_file" class="file-input" required>
            <button type="submit" class="btn-upload">Tải lên</button>
        </form>
        <p style="font-size: 12px; color: var(--text-soft); margin-top: 8px;">
            Hỗ trợ: PDF, DOCX, DOC, JPG, PNG, ZIP. Tối đa 5MB.
        </p>
    </section>

    <section class="card">
        <div style="font-size: 16px; font-weight: 600; margin-bottom: 15px;">
            Danh sách tài liệu (<?= count($materials ?? []) ?> file)
        </div>

        <?php if (empty($materials)): ?>
            <p class="empty-state">
                Bài học này chưa có tài liệu nào được đính kèm.
            </p>
        <?php else: ?>
            <div class="table-wrapper">
                <table class="material-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 50%;">Tên file</th>
                            <th style="width: 15%;">Loại file</th>
                            <th style="width: 20%;">Ngày tải lên</th>
                            <th style="width: 10%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($materials as $material): ?>
                            <tr>
                                <td><?= htmlspecialchars($material['id']) ?></td>
                                <td><?= htmlspecialchars($material['filename']) ?></td>
                                <td><?= htmlspecialchars(strtoupper(pathinfo($material['file_path'], PATHINFO_EXTENSION))) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($material['uploaded_at'])) ?></td>
                                <td>
                                    <a href="index.php?url=material/delete/<?= htmlspecialchars($material['id']) ?>"
                                       class="action-link-delete"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?');">
                                        Xóa
                                    </a>
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
