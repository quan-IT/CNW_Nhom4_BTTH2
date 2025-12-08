<?php
// models/Category.php
class Category
{
    private $conn;

    public $id;
    public $name;
    public $description;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Lấy danh mục theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Lấy khóa học theo danh mục
    public function getCourseByCategories($id)
    {
        $sql = "SELECT * 
                FROM categories ca
                join course co on co.category_id=ca.id
                WHERE ca.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
