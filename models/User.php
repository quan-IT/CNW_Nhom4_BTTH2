<?php
// models/User.php
require_once 'config/Database.php';

class User
{
    private $db;
    private $table_name = "users";

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Đăng ký tài khoản
     */
    public function register($username, $email, $password, $fullname, $role = 0)
    {
        $sql = "INSERT INTO {$this->table_name}
                (username, email, password, fullname, role, created_at)
                VALUES (:username, :email, :password, :fullname, :role, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Đăng nhập (username hoặc email)
     */
    public function login($email, $pass)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $pass === $user['password']) {
            return $user; // login thành công
        } else {
            return false; // login thất bại
        }
    }

    /**
     * Lấy user theo ID
     */
    public function getUserById($id)
    {
        $sql = "SELECT *
                FROM {$this->table_name}
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tất cả user (ADMIN)
     */
    public function getAllUsers()
    {
        $sql = "SELECT id, username, email, fullname, role, created_at
                FROM {$this->table_name}
                ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt;
    }

    /**
     * Cập nhật thông tin user
     */
    // public function updateUser($id, $fullname, $email)
    // {
    //     $sql = "UPDATE {$this->table_name}
    //             SET fullname = :fullname, email = :email
    //             WHERE id = :id";

    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':fullname', $fullname);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    //     return $stmt->execute();
    // }
        public function updateUser($id, $data)
        {
            // Ngăn không cho cập nhật cột id
            unset($data['id']);

            // Nếu không có field nào để update thì return false
            if (empty($data)) {
                return false;
            }

            $fields = [];
            foreach ($data as $key => $value) {
                // Optional: validate/sanitize key nếu cần (ngăn injection qua tên cột)
                // Ví dụ chỉ cho phép các cột hợp lệ
                $fields[] = "$key = :$key";
            }

            $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            // Bind các giá trị từ $data
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            // Bind id riêng (luôn là giá trị gốc)
            $stmt->bindValue(":id", $id);

            return $stmt->execute();
        }


    /**
     * Đổi mật khẩu
     */
    public function changePassword($id, $newPassword)
    {
        $sql = "UPDATE {$this->table_name}
                SET password = :password
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Cập nhật quyền (ADMIN)
     * 0: học viên | 1: giảng viên | 2: admin
     */
    public function updateRole($id, $role)
    {
        $sql = "UPDATE {$this->table_name}
                SET role = :role
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa user
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM {$this->table_name}
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Kiểm tra tồn tại username hoặc email
     */
    public function checkExists($username, $email)
    {
        $sql = "SELECT id FROM {$this->table_name}
                WHERE username = :username OR email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
