<?php
// models/Category.php

require_once 'config/Database.php';

class Category
{
    private $db;
    private $table_name = "categories";

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Lấy tất cả danh mục
     */
    public function getAllCategories()
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        // Trả về tất cả kết quả dưới dạng mảng kết hợp
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy chi tiết một danh mục theo ID
     */
    public function getCategoryById($id)
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Tạo danh mục mới (Chức năng Admin)
     */
    public function createCategory($name, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, description, created_at) 
                  VALUES (:name, :description, NOW())";

        $stmt = $this->db->prepare($query);

        // Làm sạch và gán giá trị
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Cập nhật danh mục (Chức năng Admin)
     */
    public function updateCategory($id, $name, $description)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, description = :description
                  WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Xóa danh mục (Chức năng Admin)
     */
    public function deleteCategory($id)
    {
        // Lưu ý: Nếu có khóa học đang liên kết với danh mục này, MySQL sẽ đặt category_id
        // của các khóa học đó về NULL (nhờ cài đặt ON DELETE SET NULL trong CSDL)
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
