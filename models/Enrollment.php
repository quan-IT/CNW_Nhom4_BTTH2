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
        // Đã sửa lỗi gán cứng ID (giả định bạn đã sửa)
        $sql = "INSERT INTO enrollments (student_id, course_id, enrolled_date)
                VALUES (:student_id, :course_id, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':student_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                // Trường hợp execute thất bại nhưng không ném ra Exception (ít xảy ra)
                error_log("Enrollment INSERT failed without exception: " . implode(":", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
        // IN LỖI RA MÀN HÌNH ĐỂ DEBUG:
        echo "LỖI PDO KHI ĐĂNG KÝ: " . $e->getMessage(); 
        die(); // <--- RẤT QUAN TRỌNG ĐỂ XÁC ĐỊNH LỖI CSDL CỤ THỂ
    }
    }

    // Kiểm tra xem học viên đã đăng ký hay chưa
     // models/Enrollment.php (Hàm isRegistered ĐÃ SỬA)

public function isRegistered($user_id, $course_id)
{
    // BỎ DÒNG LỖI NÀY: $user_id = 2; 

    $sql = "SELECT id FROM enrollments  -- Chỉ cần SELECT id là đủ
            WHERE student_id = :user_id AND course_id = :course_id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); // Dùng tham số truyền vào
    $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT); // Dùng tham số truyền vào

    $stmt->execute();
    return $stmt->rowCount() > 0;
}
    // Lấy danh sách khóa học mà học viên đã đăng ký
    public function getCourseByUser($user_id)
    {
          $sql = "SELECT c.*, e.enrolled_date as enrolled_at

            FROM enrollments e

            JOIN courses c ON e.course_id = c.id

            WHERE e.student_id = :user_id

            ORDER BY e.enrolled_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // models/Enrollment.php

public function getStudentsByCourse($course_id)
{
    // Lấy thông tin học viên (users) đã đăng ký (enrollments)
    $sql = "SELECT 
                u.id as student_id,
                u.fullname,           
                u.email,
                e.enrolled_date
            FROM enrollments e
            JOIN users u ON e.student_id = u.id 
            WHERE e.course_id = :course_id
            ORDER BY e.enrolled_date DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    
    // Thực thi và trả về kết quả
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
}
