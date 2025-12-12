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
        $courses = $this->courseModel->getAllCourse();

        $view = 'views/courses/index.php';
        include 'views/layouts/student/student_layout.php';
    }
    //Chi tiết khóa học
    public function detail($course_id)
    {

        $course = $this->courseModel->getCourseById($course_id);
        $lessons = $this->lessonModel->getLessonsByCourse($course_id);

        $view = 'views/courses/detail.php';
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
            $instructor_id = 1; // TẠM THỜI GÁN CỐ ĐỊNH

            $title = $_POST['title'] ?? 'Khóa học mới';
            $description = $_POST['description'] ?? 'Mô tả khóa học';
            $category_id = (int)($_POST['category_id'] ?? 1);
            $price = (float)($_POST['price'] ?? 0.00);
            $duration_weeks = (int)($_POST['duration_weeks'] ?? 1);
            $level = $_POST['level'] ?? 'Beginner';

            // XỬ LÝ UPLOAD ẢNH
            $image_path = "uploads/default.jpg";
            if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = $_FILES['course_image']['name'];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = uniqid('course_', true) . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;

                if (move_uploaded_file($_FILES['course_image']['tmp_name'], $target_file)) {
                    $image_path = $target_file;
                }
            }

            if ($this->courseModel->createCourse(
                $title,
                $description,
                $instructor_id,
                $category_id,
                $price,
                $duration_weeks,
                $level,
                $image_path
            )) {
                header('Location: index.php?url=course/manage');
                exit;
            } else {
                // Xử lý lỗi
            }
        }
    }


    // Hiển thị form chỉnh sửa khóa học
    public function edit($course_id)
    {
        $instructor_id = 1; // TẠM THỜI GÁN CỐ ĐỊNH

        // 1. Lấy chi tiết khóa học, kiểm tra quyền sở hữu
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);
        $categories = $this->categoryModel->getAllCategories();

        if (!$course) {
            header('Location: index.php?url=course/manage');
            exit;
        }

        // 2. Gọi view: views/instructor/course/edit.php 
        include 'views/instructor/course/edit.php';
    }

    // Xử lý cập nhật khóa học
    public function update($course_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $instructor_id = 1; // TẠM THỜI GÁN CỐ ĐỊNH

            // 1. Kiểm tra quyền sở hữu và lấy dữ liệu cũ
            $existing_course = $this->courseModel->getCourseById($course_id, $instructor_id);
            if (!$existing_course) {
                header('Location: index.php?url=course/manage');
                exit;
            }

            // 2. Lấy dữ liệu mới (sử dụng dữ liệu cũ nếu form trống)
            $title = $_POST['title'] ?? $existing_course['title'];
            $description = $_POST['description'] ?? $existing_course['description'];
            $category_id = (int)($_POST['category_id'] ?? $existing_course['category_id']);
            $price = (float)($_POST['price'] ?? $existing_course['price']);
            $duration_weeks = (int)($_POST['duration_weeks'] ?? $existing_course['duration_weeks']);
            $level = $_POST['level'] ?? $existing_course['level'];

            // 3. Xử lý Upload Ảnh Mới
            $image_path = $existing_course['image']; // Giữ ảnh cũ

            if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_name = $_FILES['course_image']['name'];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = uniqid('course_', true) . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;

                if (move_uploaded_file($_FILES['course_image']['tmp_name'], $target_file)) {
                    $image_path = $target_file;

                    // Xóa ảnh cũ (nếu không phải ảnh mặc định)
                    $old_image_path = $existing_course['image'];
                    if (!empty($old_image_path) && $old_image_path !== 'uploads/default.jpg' && file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
            }

            // 4. Gọi hàm cập nhật trong Model
            if ($this->courseModel->updateCourse(
                $course_id,
                $title,
                $description,
                $category_id,
                $price,
                $duration_weeks,
                $level,
                $image_path
            )) {
                // Cập nhật thành công
                header('Location: index.php?url=course/manage');
                exit;
            } else {
                // Cập nhật thất bại
                header('Location: index.php?url=course/edit/' . $course_id . '&error=update_failed');
                exit;
            }
        }
        // Nếu không phải POST request, chuyển hướng về manage
        header('Location: index.php?url=course/manage');
        exit;
    }


    // Xóa khóa học
    public function delete($course_id)
    {
        $instructor_id = 1; // TẠM THỜI GÁN CỐ ĐỊNH
        // Tái kiểm tra quyền sở hữu trước khi xóa
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);

        if ($course) {
            // **QUAN TRỌNG**: Cần xóa hết Lessons và Materials liên quan trước khi xóa Course
            // $this->lessonModel->deleteAllLessonsByCourse($course_id); 

            if ($this->courseModel->deleteCourse($course_id)) {

                // Xóa file ảnh vật lý sau khi xóa khóa học
                $image_path = $course['image'];
                if (!empty($image_path) && $image_path !== 'uploads/default.jpg' && file_exists($image_path)) {
                    unlink($image_path);
                }

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
