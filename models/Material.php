<?php
// models/Material.php

require_once 'config/Database.php';

class Material {
    private $db;
    private $table_name = "materials";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    /**
     * Lấy danh sách tài liệu theo ID bài học
     */
    public function getMaterialsByLesson($lesson_id) {
        // Giữ nguyên logic cũ
        $query = "SELECT * FROM " . $this->table_name . " WHERE lesson_id = :lesson_id ORDER BY uploaded_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Lấy chi tiết tài liệu theo ID (MỚI: Rất quan trọng để lấy file_path)
     */
    public function getMaterialById($id) {
        $query = "SELECT id, lesson_id, file_path, filename FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Đăng tải tài liệu mới (Đổi tên tham số 'filename' thành 'title' để khớp với thực tế)
     */
    public function uploadMaterial($lesson_id, $title, $file_path, $file_type) {
        // Tên cột trong CSDL nên là 'title' hoặc 'filename', tôi dùng 'filename' như bạn đã có.
        $query = "INSERT INTO " . $this->table_name . " (lesson_id, filename, file_path, file_type, uploaded_at) 
                  VALUES (:lesson_id, :filename, :file_path, :file_type, NOW())";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->bindParam(':filename', $title); // Sử dụng $title làm filename/tên hiển thị
        $stmt->bindParam(':file_path', $file_path);
        $stmt->bindParam(':file_type', $file_type);
        
        return $stmt->execute();
    }

    /**
     * Xóa tài liệu (Cập nhật logic: Xóa file vật lý trước)
     */
    public function deleteMaterial($id) {
        $material = $this->getMaterialById($id);

        if (!$material) {
            return false; // Không tìm thấy
        }

        // 1. Xóa file vật lý
        $this->deletePhysicalFile($material['file_path']);

        // 2. Xóa record trong CSDL
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /**
     * Xóa TẤT CẢ tài liệu theo ID bài học (Cập nhật logic: Xóa file vật lý trước)
     */
    public function deleteMaterialsByLesson($lesson_id) {
        // 1. Lấy danh sách đường dẫn file cần xóa
        $stmt = $this->getMaterialsByLesson($lesson_id);
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 2. Xóa từng file vật lý
        foreach ($materials as $material) {
            $this->deletePhysicalFile($material['file_path']);
        }

        // 3. Xóa records trong CSDL
        $query = "DELETE FROM " . $this->table_name . " WHERE lesson_id = :lesson_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Hàm nội bộ để xóa file vật lý an toàn (MỚI)
     */
    private function deletePhysicalFile($file_path) {
        // Đảm bảo BASE_DIR đã được định nghĩa trong index.php
        if (defined('BASE_DIR')) {
            $full_path = BASE_DIR . '/' . $file_path;
            
            // Kiểm tra file tồn tại và không phải là thư mục gốc
            if (file_exists($full_path) && is_file($full_path)) {
                @unlink($full_path); // Sử dụng @ để tránh Warning nếu file không thể xóa
            }
        }
    }
}
?>