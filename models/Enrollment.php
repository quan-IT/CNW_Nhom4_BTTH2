<?php
class Enrollment
{
    private $conn;

    public $id;
    public $user_id;
    public $course_id;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Đăng ký khóa học
    public function register($user_id, $course_id)
    {
        $sql = "INSERT INTO enrollments (user_id, course_id, created_at)
                VALUES (:user_id, :course_id, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':course_id', $course_id);

        return $stmt->execute();
    }

    // Kiểm tra xem học viên đã đăng ký hay chưa
    public function isRegistered($user_id, $course_id)
    {
        $sql = "SELECT * FROM enrollments 
                WHERE user_id = :user_id AND course_id = :course_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':course_id', $course_id);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Lấy danh sách khóa học mà học viên đã đăng ký
    public function getByUser($user_id)
    {
        $sql = "SELECT e.*, c.title 
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE e.user_id = :user_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();

        return $stmt;
    }
}
