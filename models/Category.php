<?php
class Category
{
    private $conn;

    public $id;
    public $name;
    public $description;
    public $created_at;

class Category {
    private $db;
    private $table_name = "categories";

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
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
