<?php
// models/Material.php

require_once 'config/Database.php';

class Material {
    private $db;
    private $table_name = "materials";

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    /**
     * Lấy danh sách tài liệu theo ID bài học
     */
    public function getMaterialsByLesson($lesson_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE lesson_id = :lesson_id ORDER BY uploaded_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Đăng tải tài liệu mới
     */
    public function uploadMaterial($lesson_id, $filename, $file_path, $file_type) {
        $query = "INSERT INTO " . $this->table_name . " (lesson_id, filename, file_path, file_type, uploaded_at) 
                  VALUES (:lesson_id, :filename, :file_path, :file_type, NOW())";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':file_path', $file_path);
        $stmt->bindParam(':file_type', $file_type);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Xóa tài liệu
     */
    public function deleteMaterial($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>