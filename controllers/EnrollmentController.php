<?php
require_once 'models/Enrollment.php';

class EnrollmentController
{
    private $EnrollmentModel;

    public function __construct()
    {
        $this->EnrollmentModel = new Enrollment();
    }

    // Đăng ký khóa học
    public function register()
    {
        if (!isset($_SESSION['user_id'])) {
            die("Bạn chưa đăng nhập");
        }

        if (!isset($_GET['course_id'])) {
            die("Thiếu course_id");
        }

        $student_id = $_SESSION['user_id'];
        $course_id = $_GET['course_id'];

        // Gọi model thực hiện INSERT
        $this->EnrollmentModel->register($student_id, $course_id);

        // Chuyển hướng về trang học
        header("Location: index.php?url=lesson/learn&course_id=$course_id");
        exit;
    }

    // Trang khóa học đã đăng ký
    public function my_courses()
    {
        if (!isset($_SESSION['user_id'])) {
            die("Bạn chưa đăng nhập");
        }

        $student_id = 1;
        // ------------------------------------------
    //     $courses = $this->EnrollmentModel->getCourseByUser($student_id); 
    
    // echo "<pre>"; print_r($courses); echo "</pre>"; exit; // THÊM DÒNG NÀY ĐỂ DEBUG
        // Lấy danh sách khóa học của Sinh viên này

        $courses = $this->EnrollmentModel->getCourseByUser($student_id);

        $view = 'views/student/my_courses.php';
        include 'views/layouts/student/student_layout.php';
    }
}
