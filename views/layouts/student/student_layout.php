<?php
// views/layouts/student/layout.php
$current_url = $_GET['url'] ?? 'student/dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukate - Student Dashboard</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/student/student.css">
    <!-- <link rel="stylesheet" href="assets/css/student/mycourse.css"> -->
    <link rel="stylesheet" href="assets/css/profile.css">
    <link href="assets/css/student/courseproress.css" rel="stylesheet">
     <link href="assets/css/courses.css" rel="stylesheet">
       <link href="assets/css/student/mycourse.css" rel="stylesheet">
</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <?php include 'views/layouts/student/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- HEADER -->
            <?php include 'views/layouts/student/header.php'; ?>

            <!-- NỘI DUNG CHÍNH -->
            <div class="dashboard-content">
                <?php include $view; // Biến này từ Controller 
                ?>
            </div>

        </main>
    </div>

    <!-- FOOTER (nếu có) -->
    <?php include 'views/layouts/student/footer.php'; ?>

</body>

</html>
<script src="assets/js/student/student.js"></script>