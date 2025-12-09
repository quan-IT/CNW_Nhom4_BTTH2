<?php
// controllers/CourseController.php

require_once 'models/Course.php';
require_once 'models/Lesson.php';
require_once 'models/Category.php'; // Cần Category Model để lấy danh mục

class CourseController
{
    private $courseModel;
    private $lessonModel;
    private $categoryModel;

    // Giả định có hàm checkAuth() để kiểm tra Giảng viên đã đăng nhập và có vai trò hợp lệ không [cite: 100]

    public function __construct()
    {
        $this->courseModel = new Course();
        $this->lessonModel = new Lesson();
        $this->categoryModel = new Category();

        // Kiểm tra quyền truy cập giảng viên ở đây
        // if (!$this->checkInstructorAuth()) { header('Location: /login'); exit; }
    }
    //Xem danh sách tất cả khóa học
    public function courses()
    {
        $view = 'views/courses/index.php';
        include 'views/layouts/student/student_layout.php';
    }
    // Hiển thị danh sách khóa học của giảng viên
    public function manage()
    {
        // --- TẠM THỜI GÁN instructor_id CỐ ĐỊNH ---
        // Phải sử dụng cùng ID đã chèn vào bảng users (thường là 1)
        $instructor_id = 1;
        // ------------------------------------------

        // Lấy danh sách khóa học của Giảng viên này
        $stmt = $this->courseModel->getCoursesByInstructor($instructor_id);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gọi view: views/instructor/course/manage.php
        include 'views/instructor/course/manage.php';
    }

    // Hiển thị form tạo khóa học
    public function create()
    {
        $categories = $this->categoryModel->getAllCategories(); // <<< Dòng này phải chạy đúng
        // Gọi view: views/instructor/course/create.php 
        include 'views/instructor/course/create.php';
    }

    // Xử lý tạo khóa học mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // --- TẠM THỜI GÁN instructor_id CỐ ĐỊNH ---
            $instructor_id = 1;
            // ------------------------------------------

            // Lấy dữ liệu an toàn
            $title = $_POST['title'] ?? 'Khóa học mới';
            $description = $_POST['description'] ?? 'Mô tả khóa học';
            $category_id = (int)($_POST['category_id'] ?? 1);
            $price = (float)($_POST['price'] ?? 0.00);
            $duration_weeks = (int)($_POST['duration_weeks'] ?? 1);
            $level = $_POST['level'] ?? 'Beginner';

            // ==========================================================
            // >>> ĐÃ SỬA: LOGIC XỬ LÝ UPLOAD ẢNH DÙNG TÊN 'course_image' <<<
            $image_path = "uploads/default.jpg"; // Đường dẫn mặc định (bạn cần có file này)

            // Kiểm tra xem file có tồn tại và không bị lỗi upload
            if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "uploads/";

                // Đảm bảo thư mục upload tồn tại
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_name = $_FILES['course_image']['name'];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                // Tạo tên file duy nhất
                $new_file_name = uniqid('course_', true) . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;

                // Di chuyển file đã tải lên
                if (move_uploaded_file($_FILES['course_image']['tmp_name'], $target_file)) {
                    // Lưu đường dẫn tương đối vào CSDL (ví dụ: "uploads/course_65c...jpg")
                    $image_path = $target_file;
                }
            }
            // ==========================================================

            if ($this->courseModel->createCourse(
                $title,
                $description,
                $instructor_id,
                $category_id,
                $price,
                $duration_weeks,
                $level,
                $image_path // Truyền đường dẫn ảnh đã xử lý
            )) {
                // Thành công: Chuyển hướng đến danh sách khóa học
                header('Location: index.php?url=course/manage');
                exit;
            } else {
                // Xử lý lỗi
                // ...
            }
        }
    }


    // Hiển thị form chỉnh sửa khóa học
    public function edit($course_id)
    {
        $instructor_id = $_SESSION['user_id'];
        $course = $this->courseModel->getCourseById($course_id, $instructor_id); // Đảm bảo chỉ Giảng viên sở hữu mới chỉnh sửa được
        $categories = $this->categoryModel->getAllCategories();

        if (!$course) {
            // Xử lý nếu không tìm thấy hoặc không có quyền
            header('Location: instructor/courses/manage');
            exit;
        }

        // Gọi view: views/instructor/course/edit.php 
        include 'views/instructor/course/edit.php';
    }

    // Xử lý cập nhật khóa học
    public function update($course_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ... (Lấy dữ liệu và logic xử lý tương tự store, gọi updateCourse)
            // ...
            // if ($this->courseModel->updateCourse($course_id, $title, $description, $category_id, $price, $duration_weeks, $level, $image_path)) {
            //     header('Location: instructor/courses/manage');
            //     exit;
            // } else {
            //     // Xử lý lỗi
            // }
        }
    }


    // Xóa khóa học
    public function delete($course_id)
    {
        $instructor_id = $_SESSION['user_id'];
        // Tái kiểm tra quyền sở hữu trước khi xóa
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);

        if ($course) {
            // **QUAN TRỌNG**: Cần xóa hết Lessons và Materials liên quan trước khi xóa Course
            // $this->lessonModel->deleteAllLessonsByCourse($course_id); 

            if ($this->courseModel->deleteCourse($course_id)) {
                header('Location: index.php?url=course/manage');
                exit;
            }
        }
        // Xử lý không tìm thấy/không có quyền xóa
        header('Location: index.php?url=course/manage');
        exit;
    }

    // --- Quản lý Bài học (Tương tự) ---
    // Hiển thị danh sách bài học của một khóa học
    public function manageLessons($course_id)
    {
        // Đảm bảo giảng viên sở hữu khóa học đó
        $course = $this->courseModel->getCourseById($course_id, $_SESSION['user_id']);
        if (!$course) { /* Redirect */
        }

        $stmt = $this->lessonModel->getLessonsByCourse($course_id);
        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gọi view: views/instructor/lessons/manage.php 
        include 'views/instructor/lessons/manage.php';
    }

    // ... các hàm createLesson(), editLesson(), deleteLesson(), uploadMaterial() ...
}
