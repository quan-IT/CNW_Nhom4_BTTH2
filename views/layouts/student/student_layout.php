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
    <link href="assets/css/Courses/course.css" rel="stylesheet">
    <link href="assets/css/student/mycourse.css" rel="stylesheet">
    <link href="assets/css/student/courseproress.css" rel="stylesheet">
    <link href="assets/css/Courses/detail.css" rel="stylesheet">
    <link href="assets/css/student/mycourse_detail.css" rel="stylesheet">
    <link href="assets/css/toest.css" rel="stylesheet">
    

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
            <!-- ===== TOAST CONTAINER - BẮT BUỘC PHẢI CÓ ===== -->
            <div id="toastContainer"></div>

            <!-- ===== CSS TOAST ĐẸP NHƯ ẢNH BẠN MUỐN ===== -->
            <!-- <style>
                #toastContainer {
                    position: fixed;
                    top: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    z-index: 9999;
                    display: flex;
                    flex-direction: column;
                    gap: 12px;
                    max-width: 90%;
                    pointer-events: none;
                }

                .toast {
                    background: #e74c3c;
                    color: white;
                    padding: 16px 32px;
                    border-radius: 50px;
                    font-size: 15px;
                    font-weight: 500;
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    min-width: 350px;
                    opacity: 0;
                    transform: translateY(-30px);
                    transition: all 0.4s ease;
                    pointer-events: auto;
                    animation: slideDown 0.5s ease forwards;
                }

                .toast.show {
                    opacity: 1;
                    transform: translateY(0);
                }

                .toast-success {
                    background: #27ae60;
                }

                .toast .close-btn {
                    margin-left: 20px;
                    background: none;
                    border: none;
                    color: white;
                    font-size: 28px;
                    cursor: pointer;
                    opacity: 0.8;
                    padding: 0 8px;
                    line-height: 1;
                }

                .toast .close-btn:hover {
                    opacity: 1;
                }

                @keyframes slideDown {
                    from {
                        opacity: 0;
                        transform: translateY(-30px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style> -->
        </main>
    </div>
    <script src="assets/js/student/student.js"></script>
    <script src="assets/js/student/profile.js"></script>
    <script src="assets/js/student/header.js"></script>
    <script src="assets/js/student/detail.js"></script>
    
    
    </script>
</body>

</html>