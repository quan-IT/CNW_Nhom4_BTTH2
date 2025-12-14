<?php
// controllers/LessonController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'models/Lesson.php';
require_once 'models/Material.php';
require_once 'models/Course.php';
// require_once 'helpers/FileUploader.php'; // Cần một Helper để xử lý upload file

class LessonController
{
    private $lessonModel;
    private $materialModel;
    private $courseModel;

    public function __construct()
    {
        $this->lessonModel = new Lesson();
        $this->materialModel = new Material();
        $this->courseModel = new Course();
        // Giả định: Kiểm tra quyền Giảng viên ở đây
    }
    public function manage($course_id)
    {
        $instructor_id = 1;

        // Kiểm tra quyền sở hữu
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);
        if (!$course) {
            header('Location: index.php?url=course/manage');
            exit;
        }

        // Lấy danh sách bài học và gọi fetchAll()
        $stmt = $this->lessonModel->getLessonsByCourse($course_id);
        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $view = 'views/instructor/lessons/manage.php';

        // Tải view
        include 'views/layouts/instructor/instructor_layout.php';
    }

    // Hiển thị form tạo bài học mới cho một khóa học cụ thể
    public function learn()
    {


    if (!isset($_GET['course_id'])) {
        die("Thiếu course_id");
    }

    $courseId  = intval($_GET['course_id']);
    $studentId = $_SESSION['user_id'] ?? null;

    if (!$studentId) {
        die("Bạn phải đăng nhập!");
    }

    $lessonModel = new Lesson();
    $courseModel = new Course();
    $enrollModel = new Enrollment();

    // 1. Lấy khóa học
    $course = $courseModel->getCourseById($courseId);
    if (!$course) {
        die("Khóa học không tồn tại");
    }

    // 2. Lấy enrollment (tiến trình học)
    $enrollment = $enrollModel->getEnrollment($courseId, $studentId);

    // 3. Lấy danh sách bài học
    $lessons = $lessonModel->getLessonsByCourse($courseId)->fetchAll(PDO::FETCH_ASSOC);

    if (!$lessons || count($lessons) === 0) {
        die("Khóa học chưa có bài học nào");
    }

    // 4. Xác định bài học hiện tại
    if (isset($_GET['lesson_id'])) {
        $lessonId = intval($_GET['lesson_id']);
        $lesson   = $lessonModel->getLessonById($lessonId);
    } else {
        $lesson = $lessons[0]; // bài đầu tiên
    }

    if (!$lesson) {
        die("Bài học không tồn tại");
    }



        // 5. Truyền sang view
        $view = 'views/student/detail_mycourses.php';
        include 'views/layouts/student/student_layout.php';
    }


    // Xử lý tạo bài học
    public function store($course_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            global $instructor_id;
            // BƯỚC 1: Kiểm tra Giảng viên có sở hữu CourseID này không
            $course = $this->courseModel->getCourseById($course_id, $instructor_id);
            if (!$course) {
                return;
            }

            // BƯỚC 2: Lấy dữ liệu
            $title = $_POST['title'];
            $content = $_POST['content'];
            $video_url = $_POST['video_url'] ?? null;
            $order = $_POST['order'] ?? 1;

            // BƯỚC 3: Gọi Model để tạo
            if ($this->lessonModel->createLesson($course_id, $title, $content, $video_url, $order)) {
                // Thành công
                header("Location: index.php?url=lesson/manage/{$course_id}&status=created");
                exit;
            } else {
                header("Location: index.php?url=lesson/create/{$course_id}&error=failed");
            }
        }
    }

    public function document()
    {
        $view = '';
    }

    // Hiển thị form upload tài liệu
    public function uploadMaterial($lesson_id)
    {
        // BƯỚC 1: Lấy thông tin bài học và kiểm tra quyền sở hữu (Lesson thuộc Course, Course thuộc Instructor)
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if (!$lesson) { /* Xử lý lỗi */
            return;
        }

        $course = $this->courseModel->getCourseById($lesson['course_id'], $_SESSION['user_id']);
        if (!$course) { /* Xử lý lỗi */
            return;
        }

        // Lấy danh sách tài liệu hiện có để hiển thị
        $materials = $this->materialModel->getMaterialsByLesson($lesson_id)->fetchAll(PDO::FETCH_ASSOC);

        // Gọi view: views/instructor/materials/upload.php
        include 'views/instructor/materials/upload.php';
    }

    // Xử lý upload file tài liệu
    public function storeMaterial($lesson_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['material_file'])) {
            // BƯỚC 1: Kiểm tra quyền sở hữu (tương tự như hàm uploadMaterial)
            // ...

            // BƯỚC 2: Xử lý upload file vật lý
            // $uploader = new FileUploader('assets/uploads/materials/');
            //$upload_result = $uploader->handleUpload($_FILES['material_file']); // Giả định FileUploader trả về đường dẫn file và loại file

            // if ($upload_result['success']) {
            //     $filename = $upload_result['original_name'];
            //     $file_path = $upload_result['filepath']; // Ví dụ: assets/uploads/materials/file_12345.pdf
            //     $file_type = $upload_result['file_type'];

            //     // BƯỚC 3: Ghi thông tin vào CSDL
            //     if ($this->materialModel->uploadMaterial($lesson_id, $filename, $file_path, $file_type)) {
            //         // Thành công
            //         header("Location: /lesson/{$lesson_id}/materials/upload");
            //         exit;
            //     } else {
            //         // Lỗi CSDL -> Xóa file đã upload
            //     }
            // } else {
            //     // Xử lý lỗi upload file
            // }
        }
    }

    // ... Các hàm edit, delete Lesson, delete Material (tương tự như trong CourseController) ...
}
