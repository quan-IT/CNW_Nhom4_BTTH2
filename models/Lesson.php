<?php
class Lesson
{
    private $db;
    private $table_name = "lessons";

    // Nhận kết nối CSDL từ controller
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Lấy danh sách bài học theo ID khóa học
     */
    public function getLessonsByCourse($course_id)
    {
        $sql = "SELECT * FROM {$this->table_name} 
                WHERE course_id = :course_id 
                ORDER BY `order` ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Lấy chi tiết một bài học
     */
    public function getLessonById($id)
    {
        $sql = "SELECT * FROM {$this->table_name} 
                WHERE id = :id 
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Tạo bài học mới
     */
    public function createLesson($course_id, $title, $content, $video_url, $order)
    {
        $sql = "INSERT INTO {$this->table_name} 
                (course_id, title, content, video_url, `order`, created_at) 
                VALUES (:course_id, :title, :content, :video_url, :order, NOW())";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':video_url', $video_url);
        $stmt->bindValue(':order', $order, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Cập nhật bài học
     */
    public function updateLesson($id, $title, $content, $video_url, $order)
    {
        $sql = "UPDATE {$this->table_name}
                SET title = :title, 
                    content = :content, 
                    video_url = :video_url, 
                    `order` = :order
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':video_url', $video_url);
        $stmt->bindValue(':order', $order, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa bài học
     */
    public function deleteLesson($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
