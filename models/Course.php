<?php
// models/Course.php
class Course
{
    private $db;
    private $table_name = "courses";

    public function __construct()
    {
        $database = new Database(); 
        $this->db = $database->getConnection();
    }

    // Lấy tất cả khóa học của một giảng viên
    public function getCoursesByInstructor($instructor_id) {
        $query = "SELECT 
                    t1.*, 
                    t2.name AS category_name 
                  FROM " . $this->table_name . " t1
                  LEFT JOIN categories t2 ON t1.category_id = t2.id
                  WHERE t1.instructor_id = :instructor_id 
                  ORDER BY t1.created_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt;
    }

    // Lấy chi tiết một khóa học
    public function getCourseById($id, $instructor_id = null)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        if ($instructor_id !== null) {
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
    public function createCourse($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $image)
    {
        $query = "INSERT INTO " . $this->table_name . " 
        (title, description, instructor_id, category_id, price, duration_weeks, level, image, created_at, updated_at)
        VALUES 
        (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image, NOW(), NOW())";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':duration_weeks', $duration_weeks);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    // Cập nhật khóa học
    public function updateCourse($id, $title, $description, $category_id, $price, $duration_weeks, $level, $image)
    {
        $query = "UPDATE " . $this->table_name . " SET
                  title = :title,
                  description = :description,
                  category_id = :category_id,
                  price = :price,
                  duration_weeks = :duration_weeks,
                  level = :level,
                  image = :image,
                  updated_at = NOW()
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

        return $stmt->execute();
    }

    // Xóa khóa học
    public function deleteCourse($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
