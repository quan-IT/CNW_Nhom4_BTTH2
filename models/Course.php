<?php
// models/Course.php

require_once 'config/Database.php';

class Course {
    private $db;
    private $table_name = "courses";

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Lấy tất cả khóa học của một giảng viên
    public function getCoursesByInstructor($instructor_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE instructor_id = :instructor_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->execute();
        return $stmt;
    }

    // Lấy chi tiết một khóa học
    public function getCourseById($id, $instructor_id = null) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        if ($instructor_id !== null) {
            // Thêm điều kiện instructor_id để kiểm tra quyền sở hữu
            $query .= " AND instructor_id = :instructor_id";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($instructor_id !== null) {
            $stmt->bindParam(':instructor_id', $instructor_id);
        }
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo khóa học mới
    public function createCourse($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $image) {
        $query = "INSERT INTO " . $this->table_name . " (title, description, instructor_id, category_id, price, duration_weeks, level, image, created_at, updated_at) 
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image, NOW(), NOW())";
        
        $stmt = $this->db->prepare($query);
        
        // Làm sạch và gán giá trị
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':duration_weeks', $duration_weeks);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':image', $image);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cập nhật khóa học
    public function updateCourse($id, $title, $description, $category_id, $price, $duration_weeks, $level, $image) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, description = :description, category_id = :category_id, price = :price, duration_weeks = :duration_weeks, level = :level, image = :image, updated_at = NOW()
                  WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':duration_weeks', $duration_weeks);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':image', $image);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Xóa khóa học
    public function deleteCourse($id) {
        // Lưu ý: Cần xóa các bài học (lessons) và tài liệu (materials) liên quan trước
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>