<?php
// controllers/instructor/MaterialController.php

require_once BASE_DIR . '/models/Material.php'; 
require_once BASE_DIR . '/models/Lesson.php';
require_once BASE_DIR . '/models/Course.php';
require_once BASE_DIR . '/views/helpers/FileUploader.php';// Cần helper để upload

class MaterialController {
    private $materialModel;
    private $lessonModel;
    private $courseModel;

    public function __construct() {
        $this->materialModel = new Material();
        $this->lessonModel = new Lesson();
        $this->courseModel = new Course();
        // Giả định: Tại đây, bạn sẽ kiểm tra quyền Giảng viên
    }

    /**
     * Hiển thị form upload và danh sách tài liệu
     * URL: index.php?url=material/manage/{lesson_id}
     */
    public function manage($lesson_id) {
        $instructor_id = 1; // ID Giảng viên tạm thời

        // 1. Kiểm tra quyền sở hữu bài học/khóa học
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if (!$lesson) { die("Bài học không tồn tại."); }
        
        $course = $this->courseModel->getCourseById($lesson['course_id'], $instructor_id);
        if (!$course) { die("Bạn không có quyền truy cập khóa học này."); }

        // 2. Lấy danh sách tài liệu
        $stmt = $this->materialModel->getMaterialsByLesson($lesson_id);
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gọi view (Đảm bảo đường dẫn view đúng)
        include BASE_DIR . '/views/instructor/materials/upload.php';
    }

    /**
     * Xử lý upload tài liệu mới
     * URL: index.php?url=material/store/{lesson_id}
     */
    // controllers/instructor/MaterialController.php (Sửa lại hàm store)

public function store($lesson_id) {
    
    // ... (Logic kiểm tra quyền sở hữu lesson/course) ...
    
    // 1. Khởi tạo các biến quan trọng với NULL hoặc giá trị mặc định
    // Đảm bảo PHP luôn biết về các biến này
    $db_file_path = null; 
    $filepath_full = null; 
    $status = '';
    
    // 2. Chuẩn bị Uploader
    $uploader = new FileUploader(BASE_DIR . '/uploads/materials/'); 
    $upload_result = $uploader->handleUpload($_FILES['material_file']);
    
    if ($upload_result['success']) {
        // --- CHỈ THỰC HIỆN KHU VỰC NÀY KHI UPLOAD VẬT LÝ THÀNH CÔNG ---
        
        // 3. Gán giá trị thực cho các biến
        $title = $_POST['title'] ?? $upload_result['original_name'];
        $db_file_path = $upload_result['filepath_db']; 
        $file_type = $upload_result['file_type'];
        $filepath_full = $upload_result['filepath_full']; // Được sử dụng để unlink nếu DB lỗi
        
        // 4. Lưu vào Database
        if ($this->materialModel->uploadMaterial($lesson_id, $title, $db_file_path, $file_type)) {
            $status = "uploaded";
        } else {
            // Lỗi CSDL -> Xóa file đã upload
            @unlink($filepath_full);
            $status = "db_error";
        }
        
    } else {
        // --- XỬ LÝ KHI UPLOAD VẬT LÝ THẤT BẠI ---
        
        // Lỗi upload file
        $status = "upload_failed&error=" . urlencode($upload_result['error']);
    }

    // 5. Chuyển hướng
    // Dòng này không sử dụng $db_file_path, nhưng nếu bạn có code dùng nó
    // sau khối if/else thì việc khởi tạo là bắt buộc.
    header("Location: index.php?url=material/manage/$lesson_id&status=$status");
    exit;
}
    /**
     * Xóa tài liệu
     * URL: index.php?url=material/delete/{material_id}
     */
    public function delete($material_id) {
        $material = $this->materialModel->getMaterialById($material_id);
        
        if ($material) {
            $lesson_id = $material['lesson_id'];
            $instructor_id = 1;

            // Kiểm tra quyền sở hữu (Lesson -> Course -> Instructor)
            $lesson = $this->lessonModel->getLessonById($lesson_id);
            $course = $this->courseModel->getCourseById($lesson['course_id'], $instructor_id);
            if (!$course) { die("Không có quyền."); }
            
            // Xóa file vật lý và record (xử lý trong Model)
            if ($this->materialModel->deleteMaterial($material_id)) {
                $status = 'deleted';
            } else {
                $status = 'delete_failed';
            }
            
            header("Location: index.php?url=material/manage/$lesson_id&status=$status");
            exit;
        }
        
        header('Location: index.php?url=course/manage');
        exit;
    }
}
?>