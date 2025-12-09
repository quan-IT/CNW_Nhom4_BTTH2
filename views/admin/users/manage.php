<?php
$users = [
    [
        'id' => 1,
        'username' => 'nguyenvana',
        'email' => 'an@student.com',
        'fullname' => 'Nguyễn Văn An',
        'role' => 0, // 0 = học viên
        'created_at' => '2025-03-15 08:30:00',
        'course_count' => 12
    ],
    [
        'id' => 2,
        'username' => 'tranthingoc',
        'email' => 'ngoc@instructor.edu',
        'fullname' => 'Trần Thị Ngọc',
        'role' => 1, // 1 = giảng viên
        'created_at' => '2024-11-20 14:20:00',
        'course_count' => 8
    ],
    [
        'id' => 3,
        'username' => 'admin_hung',
        'email' => 'hung@edukate.com',
        'fullname' => 'Admin Hùng',
        'role' => 2, // 2 = quản trị viên
        'created_at' => '2024-01-10 09:00:00',
        'course_count' => 0
    ],
    [
        'id' => 4,
        'username' => 'phamvanminh',
        'email' => 'minh@gmail.com',
        'fullname' => 'Phạm Văn Minh',
        'role' => 0,
        'created_at' => '2025-06-01 11:15:00',
        'course_count' => 5
    ],
    [
        'id' => 5,
        'username' => 'levithuhuong',
        'email' => 'huong.teacher@edu.vn',
        'fullname' => 'Lê Thị Thu Hương',
        'role' => 1,
        'created_at' => '2024-08-10 10:45:00',
        'course_count' => 15
    ],
];
?>

<div class="page-header">
    <h1>Quản lý người dùng</h1>
    <p>Hiện có <strong><?= count($users) ?></strong> tài khoản trong hệ thống</p>
</div>

<!-- Bộ lọc & tìm kiếm -->
<div class="users-controls">
    <div class="filters">
        <input type="text" placeholder="Tìm kiếm tên, email, username..." class="search-input">

        <select class="filter-select">
            <option value="">Tất cả vai trò</option>
            <option value="0">Học viên</option>
            <option value="1">Giảng viên</option>
            <option value="2">Quản trị viên</option>
        </select>

        <select class="filter-select">
            <option value="">Tất cả trạng thái</option>
            <option value="active">Hoạt động</option>
            <option value="inactive">Vô hiệu hóa</option>
        </select>
    </div>

    <div class="actions">
        <button class="btn-export">
            <i class="fas fa-file-export"></i> Xuất Excel
        </button>
        <a href="?url=admin/users/create" class="btn-add">
            <i class="fas fa-plus"></i> Thêm người dùng
        </a>
    </div>
</div>

<!-- Bảng người dùng -->
<div class="table-container">
    <table class="users-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Username</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Khóa học</th>
                <th>Tham gia</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><input type="checkbox" class="row-check"></td>
                    <td>#<?= $user['id'] ?></td>
                    <td>
                        <div class="user-cell">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['fullname']) ?>&background=random"
                                alt="<?= htmlspecialchars($user['fullname']) ?>" class="user-avatar-sm">
                            <span><?= htmlspecialchars($user['fullname']) ?></span>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <span class="role-badge role-<?= $user['role'] ?>">
                            <?= $user['role'] == 0 ? 'Học viên' : ($user['role'] == 1 ? 'Giảng viên' : 'Quản trị viên') ?>
                        </span>
                    </td>
                    <td><strong><?= $user['course_count'] ?></strong></td>
                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <span class="status-badge active">Hoạt động</span>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="?url=admin/users/edit&id=<?= $user['id'] ?>" class="btn-icon" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-icon <?= $user['role'] == 2 ? 'disabled' : '' ?>" title="Vô hiệu hóa">
                                <i class="fas fa-ban"></i>
                            </button>
                            <button class="btn-icon danger <?= $user['role'] == 2 ? 'disabled' : '' ?>" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination">
    <span>Hiển thị 1-10 của 28782</span>
    <div class="page-controls">
        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <span>...</span>
        <button class="page-btn">48</button>
        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>