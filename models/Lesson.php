<?php
// models/Lesson.php

require_once 'config/Database.php';

class Lesson {
    private $db;
    private $table_name = "lessons";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Lấy danh sách bài học theo ID khóa học
     */
    public function getLessonsByCourse($course_id) {
        // Sắp xếp theo cột 'order'
        $query = "SELECT * FROM " . $this->table_name . " WHERE course_id = :course_id ORDER BY `order` ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Lấy chi tiết một bài học
     */
    public function getLessonById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Tạo bài học mới
     */
    public function createLesson($course_id, $title, $content, $video_url, $order) {
        $query = "INSERT INTO " . $this->table_name . " (course_id, title, content, video_url, `order`, created_at) 
                  VALUES (:course_id, :title, :content, :video_url, :order, NOW())";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->bindParam(':order', $order, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Cập nhật bài học
     */
    public function updateLesson($id, $title, $content, $video_url, $order) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, content = :content, video_url = :video_url, `order` = :order
                  WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->bindParam(':order', $order, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    /**
     * Xóa bài học (sẽ tự động xóa tài liệu liên quan nhờ FOREIGN KEY ON DELETE CASCADE)
     */
    public function deleteLesson($id) {
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