<?php
class Course
{
    private $conn;

    public $id;
    public $title;
    public $category_id;
    public $description;
    public $price;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả khóa học
    public function getAll()
    {
        $sql = "SELECT c.*, cat.name AS category_name
                FROM courses c
                JOIN categories cat ON c.category_id = cat.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Tìm kiếm khóa học
    public function search($keyword)
    {
        $sql = "SELECT * FROM courses WHERE title LIKE :kw";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':kw', '%' . $keyword . '%');
        $stmt->execute();
        return $stmt;
    }

    // Lấy 1 khóa học
    public function getById($id)
    {
        $sql = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
