<?php
class Database
{
    private $host = "localhost";
    private $db_name = "onlinecourse";
    private $username = "root";
    private $password = "";
    private static $instance = null; // Singleton
    private $conn;

    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );

            // Thiết lập PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi kết nối Database: " . $e->getMessage());
        }
    }

    // 👉 Lấy instance duy nhất
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // 👉 Hàm trả về kết nối
    public function getConnection()
    {
        return $this->conn;
    }
}
