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
    public function register($course_id = null) 
    {
        // 1. Gán cứng ID học viên (cho mục đích debug/test)
        $user_id = 1; // HOẶC ID MÀ BẠN ĐANG DÙNG ĐỂ DEBUG
        
        // 2. Kiểm tra nếu thiếu ID khóa học
        if ($course_id === null) {
            // Xử lý lỗi hoặc chuyển hướng về trang chủ
            header('Location: index.php');
            exit;
        }

        // 3. Kiểm tra xem user có tồn tại không
        if (!$user_id) {
            header('Location: index.php?url=auth/login');
            exit;
        }

        // 4. Logic đăng ký (Gọi Model)
        if ($this->EnrollmentModel->isRegistered($user_id, $course_id)) {
            $status = "already_registered";
        } else {
            if ($this->EnrollmentModel->register($user_id, $course_id)) {
                $status = "success";
            } else {
                $status = "failed"; 
            }
        }
        
        header("Location: index.php?url=enrollment/my_courses&status=$status");
        exit;
    }

    // Hiển thị danh sách khóa học của sinh viên đã đăng ký
    // controllers/EnrollmentController.php (Hàm view_students)

public function view_students($course_id = null)
{
    // 1. Lấy ID Giảng viên (Giả định ID 2 đang đăng nhập để test)
    $instructor_id = 2; // *** BẠN PHẢI THAY BẰNG $_SESSION['user_id'] THẬT ***

    // 2. Kiểm tra quyền sở hữu Khóa học (Đảm bảo Giảng viên chỉ xem được khóa học của mình)
    $courseModel = new Course(); // Cần khởi tạo Course Model
    $courseInfo = $courseModel->getCourseById($course_id); 

    if (!$courseInfo || $courseInfo['instructor_id'] != $instructor_id) {
        echo "<h1>LỖI: Bạn không có quyền truy cập khóa học này.</h1>";
        exit;
    }
    
    // 3. Gọi Model
    $students = $this->EnrollmentModel->getStudentsByCourse($course_id);
    $courseTitle = $courseInfo['title'];

    // 4. Hiển thị View
    $view = BASE_DIR . '/views/instructor/students/list.php'; 
    // Gán biến $courseTitle và $students vào View để hiển thị
    include BASE_DIR . '/views/layouts/student/student_layout.php'; // Sử dụng layout của bạn
}    public function my_courses()
    {

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
