<?php
// config/Database.php

class Database {
    // Thông tin kết nối của bạn - Hầu hết XAMPP/WAMP mặc định là như sau:
    private $host = "localhost";
    private $db_name = "onlinecourse"; // Tên CSDL bạn vừa tạo
    private $username = "root";       // Tên người dùng CSDL của bạn (thường là root)
    private $password = "";           // Mật khẩu CSDL của bạn (thường để trống nếu dùng XAMPP/WAMP)
    public $conn;

    /**
     * Lấy kết nối CSDL
     * @return PDO | null
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", 
                                  $this->username, 
                                  $this->password);
            
            // Thiết lập chế độ báo lỗi (giúp debug dễ hơn)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Yêu cầu sử dụng Prepared Statements một cách nghiêm ngặt
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            
        } catch(PDOException $exception) {
            // Xử lý lỗi kết nối
            echo "Lỗi kết nối CSDL: " . $exception->getMessage();
            // Trong môi trường production, bạn nên ghi log thay vì hiển thị lỗi
            die(); 
        }

        return $this->conn;
    }
}
?>