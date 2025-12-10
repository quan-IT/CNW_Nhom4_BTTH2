<?php
class Enrollment
{
    private $conn;

    public $id; //đang ko dùng

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
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
    public function getCourseByUser($user_id)
    {
        $sql = "SELECT c.*, e.created_at as enrolled_at
            FROM enrollments e
            JOIN courses c ON e.course_id = c.id
            WHERE e.user_id = :user_id
            ORDER BY e.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
