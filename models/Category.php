<?php
class Category
{
    private $conn;

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả danh mục
    public function getAll()
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
