<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors Dashboard - Edukate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- <link rel="stylesheet" href="assets/css/instructor/sidebar.css"> -->
    <link rel="stylesheet" href="assets/css/instructor/instructor.css">
    <link rel="stylesheet" href="assets/css/instructor/sidebar.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    

</head>

<body>

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <?php include 'views/layouts/instructor/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <?php include $view; // Biến này từ Controller 
            ?>
        </main>
    </div>

    <!-- FOOTER (nếu có) -->
    <!-- <?php include 'views/layouts/admin/footer.php'; ?> -->

</body>

</html>