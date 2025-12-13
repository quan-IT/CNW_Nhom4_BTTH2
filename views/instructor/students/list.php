<h2>Học viên đã đăng ký Khóa học: **<?= htmlspecialchars($courseTitle) ?>**</h2>
    
<?php if (empty($students)): ?>
    <p>Chưa có học viên nào đăng ký.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Học viên</th>
                <th>Email</th>
                <th>Ngày Đăng ký</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 1; foreach ($students as $student): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= htmlspecialchars($student['fullname']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= date('d/m/Y', strtotime($student['enrolled_date'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>