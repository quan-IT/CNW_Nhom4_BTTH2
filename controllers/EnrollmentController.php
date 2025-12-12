<?php
// controllers/EnrollmentController.php
require_once 'models/Enrollment.php';

require_once "config/database.php";
$db = new Database();

class EnrollmentController
{
    public $EnrollmentModel;


    public function __construct()
    {
        $this->EnrollmentModel = new Enrollment();
    }

    // Đăng ký khóa học
    public function register($user_id, $course_id)
    {
        // if ($this->EnrollmentModel->isRegistered($user_id, $course_id)) {
        //     return "Bạn đã đăng ký khóa học này!";
        // }

        // $success = $this->EnrollmentModel->register($user_id, $course_id);
        // return $success ? "Đăng ký thành công!" : "Đăng ký thất bại!";
        // Kiểm tra user đã đăng ký chưa
      
    }

    // Hiển thị danh sách khóa học của sinh viên đã đăng ký

    public function my_courses()
    {

        $student_id = 2;
        // ------------------------------------------

        // Lấy danh sách khóa học của Sinh viên này

        $courses = $this->EnrollmentModel->getCourseByUser($student_id);

        // Gọi view: views/instructor/course/manage.php
        include 'views/student/my_courses.php';
    }
}
