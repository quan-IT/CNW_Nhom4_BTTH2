<!-- admin/categories/list.php -->
<?php
// Dữ liệu mẫu 100% đúng bảng categories
$categories = [
    ['id'=>1, 'name'=>'Lập trình Web', 'description'=>'HTML, CSS, JavaScript, PHP, Laravel...', 'created_at'=>'2024-01-15 09:00:00', 'course_count'=>48],
    ['id'=>2, 'name'=>'Lập trình Mobile', 'description'=>'Flutter, React Native, Kotlin, Swift...', 'created_at'=>'2024-02-20 14:30:00', 'course_count'=>32],
    ['id'=>3, 'name'=>'Thiết kế UI/UX', 'description'=>'Figma, Adobe XD, Sketch...', 'created_at'=>'2024-03-10 10:15:00', 'course_count'=>28],
    ['id'=>4, 'name'=>'Data Science & AI', 'description'=>'Python, ML, Deep Learning...', 'created_at'=>'2024-04-05 11:45:00', 'course_count'=>19],
    ['id'=>5, 'name'=>'DevOps & Cloud', 'description'=>'Docker, Kubernetes, AWS...', 'created_at'=>'2024-05-12 16:20:00', 'course_count'=>15],
];
?>

<div class="page-header">
    <div>
        <h1>Quản lý danh mục</h1>
        <p>Hiện có <strong><?= count($categories) ?></strong> danh mục</p>
    </div>
    <a href="?url=admin/categories/create" class="btn-primary">
        <i class="fas fa-plus"></i> Thêm danh mục
    </a>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Khóa học</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $cat): ?>
            <tr>
                <td>#<?= $cat['id'] ?></td>
                <td>
                    <div class="category-title">
                        <i class="fas fa-folder"></i>
                        <strong><?= htmlspecialchars($cat['name']) ?></strong>
                    </div>
                </td>
                <td class="desc">
                    <?= htmlspecialchars(strlen($cat['description']) > 70 ? substr($cat['description'],0,70).'...' : $cat['description']) ?>
                </td>
                <td><span class="badge blue"><?= $cat['course_count'] ?></span></td>
                <td><?= date('d/m/Y', strtotime($cat['created_at'])) ?></td>
                <td>
                    <a href="index.php?url=test/categoriesEdit/id=<?= $cat['id'] ?>" class="btn-icon edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="?url=admin/categories/delete&id=<?= $cat['id'] ?>" 
                       class="btn-icon delete" 
                       onclick="return confirm('Xóa danh mục này? Các khóa học sẽ bị ảnh hưởng!')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>