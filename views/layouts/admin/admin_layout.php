<?php
// views/layouts/student/layout.php
$current_url = $_GET['url'] ?? 'test/dashboard';
?>
<?php
// Dữ liệu mẫu cho Admin Dashboard
$stats = [
    'total_users' => 28782,
    'active_users' => 24560,
    'pending_courses' => 18,
    'total_courses' => 156,
    'total_revenue' => '₫2,456,780,000',
    'new_users_today' => 142
];

$recent_users = [
    ['name' => 'Nguyễn Văn An', 'email' => 'an@gmail.com', 'status' => 'active', 'joined' => '10/12/2025'],
    ['name' => 'Trần Thị Lan', 'email' => 'lan@yahoo.com', 'status' => 'pending', 'joined' => '10/12/2025'],
    ['name' => 'Lê Minh Tuấn', 'email' => 'tuan@outlook.com', 'status' => 'active', 'joined' => '09/12/2025'],
];

$pending_courses = [
    ['title' => 'Advanced Machine Learning with TensorFlow', 'instructor' => 'Dr. Phạm Văn Hùng', 'submitted' => '10/12/2025'],
    ['title' => 'Flutter Mobile Dev - Build Real Apps', 'instructor' => 'Nguyễn Thị Mai', 'submitted' => '09/12/2025'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edukate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="assets/css/admin/sidebar.css">
    <link rel="stylesheet" href="assets/css/admin/header.css">
    <link rel="stylesheet" href="assets/css/admin/manage.css">
      <link rel="stylesheet" href="assets/css/admin/catagory.css">



</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <?php include 'views/layouts/admin/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- HEADER -->
            <?php include 'views/layouts/admin/header.php'; ?>

            <!-- NỘI DUNG CHÍNH -->
            <div class="dashboard-content">
                <?php include $view; // Biến này từ Controller 
                ?>
            </div>


        </main>
    </div>

    <!-- FOOTER (nếu có) -->
    <?php include 'views/layouts/admin/footer.php'; ?>

</body>

</html>