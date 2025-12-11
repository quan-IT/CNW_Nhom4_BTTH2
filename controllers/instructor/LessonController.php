<?php
// controllers/LessonController.php

require_once 'models/Lesson.php';
require_once 'models/Material.php';
require_once 'models/Course.php'; 
// require_once 'helpers/FileUploader.php'; // Cần một Helper để xử lý upload file

class LessonController {
    private $lessonModel;
    private $materialModel;
    private $courseModel;
    
    public function __construct() {
        $this->lessonModel = new Lesson();
        $this->materialModel = new Material();
        $this->courseModel = new Course();
        // Giả định: Kiểm tra quyền Giảng viên ở đây
    }
    public function edit($lesson_id) {
        $instructor_id = 1; // ID Tạm thời
        
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        
        // 1. Kiểm tra bài học tồn tại
        if (!$lesson) { 
            header('Location: index.php?url=course/manage'); 
            exit;
        }

        $course_id = $lesson['course_id'];

        // 2. Kiểm tra quyền sở hữu khóa học
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);
        if (!$course) {
            header('Location: index.php?url=course/manage');
            exit;
        }

        // Tải view chỉnh sửa
        // Sử dụng biến $lesson và $course trong view
        include 'views/instructor/lessons/edit.php'; 
    }
    public function update($lesson_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?url=lesson/edit/{$lesson_id}");
            exit;
        }

        $instructor_id = 1; // ID Tạm thời
        
        // 1. Lấy thông tin bài học cũ
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if (!$lesson) { 
            header('Location: index.php?url=course/manage'); 
            exit;
        }
        
        // 2. Kiểm tra quyền sở hữu trước khi cập nhật
        $course = $this->courseModel->getCourseById($lesson['course_id'], $instructor_id);
        if (!$course) {
            header('Location: index.php?url=course/manage');
            exit;
        }

        // 3. Lấy dữ liệu từ POST
        $title = trim($_POST['title'] ?? '');
        $content = $_POST['content'] ?? '';
        $video_url = $_POST['video_url'] ?? '';
        $order = (int)($_POST['order'] ?? 1);
        $course_id = $lesson['course_id']; // Dùng để chuyển hướng sau khi update

        // 4. Gọi Model để cập nhật
        // Hàm updateLesson đã có sẵn trong models/Lesson.php của bạn
        if ($this->lessonModel->updateLesson($lesson_id, $title, $content, $video_url, $order)) {
            header("Location: index.php?url=lesson/manage/{$course_id}&status=updated");
            exit;
        } else {
            // Xử lý lỗi
            header("Location: index.php?url=lesson/edit/{$lesson_id}&error=failed");
            exit;
        }
    }
    public function manage($course_id) { 
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

        // Tải view
        include 'views/instructor/lessons/manage.php';
    }
    
    // Hiển thị form tạo bài học mới cho một khóa học cụ thể
    public function create($course_id) {
        global $instructor_id;
        // BƯỚC 1: Kiểm tra Giảng viên có sở hữu CourseID này không
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);
        if (!$course) {
             header('Location: index.php?url=course/manage');
             return;
        }

        // Gọi view: views/instructor/lessons/create.php
        include 'views/instructor/lessons/create.php';
    }

    // Xử lý tạo bài học
    public function store($course_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            global $instructor_id;
            // BƯỚC 1: Kiểm tra Giảng viên có sở hữu CourseID này không
            $course = $this->courseModel->getCourseById($course_id,$instructor_id );
            if (!$course) { return; }

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
    
    // Hiển thị form upload tài liệu
    public function uploadMaterial($lesson_id) {
        $instructor_id = 1; // ID Giảng viên tạm thời

        // 1. Lấy thông tin bài học
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if (!$lesson) { 
            header('Location: index.php?url=course/manage'); 
            exit;
        }
        
        // 2. Kiểm tra quyền sở hữu khóa học
        $course = $this->courseModel->getCourseById($lesson['course_id'], $instructor_id);
        if (!$course) { 
            header('Location: index.php?url=course/manage'); 
            exit;
        }
        
        // 3. Lấy danh sách tài liệu hiện có để hiển thị
        $stmt = $this->materialModel->getMaterialsByLesson($lesson_id);
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Sử dụng biến $lesson, $course và $materials trong view
        include 'views/instructor/materials/upload.php'; 
    }
    // Xử lý upload file tài liệu
    // ... trong LessonController.php (Phần storeMaterial)

public function storeMaterial($lesson_id) {
    // ... (Kiểm tra quyền) ...

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['material_file'])) {
        
        // Cần require FileUploader ở đầu Controller
        // require_once '../helpers/FileUploader.php'; // Đã thêm ở trên
        
        // 2. Xử lý upload file vật lý
        // Thư mục lưu trữ: public/uploads/materials/ (SỬ DỤNG BASE_DIR cho đường dẫn vật lý)
        $uploader = new FileUploader(BASE_DIR . '/uploads/materials/'); 
        $upload_result = $uploader->handleUpload($_FILES['material_file']); 

        if ($upload_result['success']) {
            $filename = $upload_result['original_name'];
            
            // LƯU Ý: FileUploader nên trả về đường dẫn TƯƠNG ĐỐI TỪ GỐC DỰ ÁN để lưu vào DB
            // Tôi giả định $upload_result['filepath_db'] = 'uploads/materials/file_12345.pdf'
            $file_path_db = $upload_result['filepath_db']; 
            $file_type = $upload_result['file_type'];

            // 3. Ghi thông tin vào CSDL
            if ($this->materialModel->uploadMaterial($lesson_id, $filename, $file_path_db, $file_type)) {
                header("Location: index.php?url=lesson/uploadMaterial/{$lesson_id}&status=uploaded");
                exit;
            } else {
                // Lỗi CSDL -> Xóa file đã upload (Dùng đường dẫn vật lý đầy đủ từ FileUploader)
                @unlink($upload_result['filepath_full']); // Sử dụng @ để bỏ qua cảnh báo nếu xóa lỗi
                header("Location: index.php?url=lesson/uploadMaterial/{$lesson_id}&error=db_failed");
                exit;
            }
        } else {
            // Lỗi upload file
            header("Location: index.php?url=lesson/uploadMaterial/{$lesson_id}&error=" . urlencode($upload_result['error']));
            exit;
        }
    }
    // ...
}
    public function delete($lesson_id) {
        $instructor_id = 1; // ID Tạm thời
        
        // 1. Lấy thông tin bài học
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if (!$lesson) { 
            header('Location: index.php?url=course/manage');
            exit;
        }

        $course_id = $lesson['course_id'];

        // 2. Kiểm tra quyền sở hữu khóa học
        $course = $this->courseModel->getCourseById($course_id, $instructor_id);
        if (!$course) {
            header('Location: index.php?url=course/manage');
            exit;
        }

        // BƯỚC 3: XÓA TÀI LIỆU LIÊN QUAN TRƯỚC (Data Cascading Delete)
        try {
            // Xóa records trong bảng materials
            $this->materialModel->deleteMaterialsByLesson($lesson_id);
            
            // BƯỚC 4: Xóa bản ghi bài học
            if ($this->lessonModel->deleteLesson($lesson_id)) {
                // Thành công
                header("Location: index.php?url=lesson/manage/{$course_id}&status=deleted");
                exit;
            } else {
                // Lỗi xóa bài học
                throw new Exception("Lỗi CSDL khi xóa bài học.");
            }
        } catch (Exception $e) {
            // Xử lý lỗi
            header("Location: index.php?url=lesson/manage/{$course_id}&error=delete_failed");
            exit;
        }
    }
    // ... trong LessonController.php (Thêm hàm mới)

    /**
     * Xóa một tài liệu cụ thể
     * Đường dẫn: index.php?url=lesson/deleteMaterial/{material_id}
     */
    public function deleteMaterial($material_id) {
        $instructor_id = 1; // ID Tạm thời
        
        // 1. Lấy thông tin tài liệu
        $material = $this->materialModel->getMaterialById($material_id); // Cần tạo hàm này trong Material.php
        if (!$material) { header('Location: index.php?url=course/manage'); exit; }
        
        // 2. Kiểm tra quyền sở hữu (Lesson -> Course -> Instructor)
        $lesson = $this->lessonModel->getLessonById($material['lesson_id']);
        $course = $this->courseModel->getCourseById($lesson['course_id'], $instructor_id);
        if (!$course) { header('Location: index.php?url=course/manage'); exit; }
        
        // 3. Xóa file vật lý trước (Nếu có)
        // unlink($material['file_path']); 

        // 4. Xóa bản ghi CSDL
        if ($this->materialModel->deleteMaterial($material_id)) {
            header("Location: index.php?url=lesson/uploadMaterial/{$material['lesson_id']}&status=material_deleted");
            exit;
        } else {
            header("Location: index.php?url=lesson/uploadMaterial/{$material['lesson_id']}&error=material_delete_failed");
            exit;
        }
    }
    
    // ... Các hàm edit, delete Lesson, delete Material (tương tự như trong CourseController) ...
}
?>